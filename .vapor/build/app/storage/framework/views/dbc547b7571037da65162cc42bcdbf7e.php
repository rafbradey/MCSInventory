
<?php $__env->startSection('title', 'Inventory'); ?>
<?php $__env->startSection('nav-back'); ?>
<h5> 
    <?php if(auth()->guard()->check()): ?>
    Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
    <?php endif; ?>
</h5>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div><?php echo e($error); ?></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<?php if(session()->has('error')): ?>
<div class="alert alert-danger"><?php echo e(session()->get('error')); ?></div>
<?php endif; ?>

<?php if(session()->has('success')): ?>
<div class="alert alert-success"><?php echo e(session()->get('success')); ?></div>
<?php endif; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <form action="<?php echo e(route('inventory')); ?>" method="GET" class="d-inline-flex">
          <div class="col">
              <input type="search" name="query" class="form-control" placeholder="Search Inventory">
          </div>
          
          <div class="col-auto mx-2">
              <select name="filter" class="form-select">
                  <option value="">All</option>
                  <option value="id">ID</option>
                  <option value="school_property">School Property</option>
                  <option value="remarks">Remarks</option>
                  <option value="category">Category</option>
                  <option value="acquisition_type">Acquisition Type</option>
                  <option value="grade_level">Grade Level</option>
              </select>
          </div>
          <div class="col-auto">
              <button type="submit" class="btn btn-primary">Search</button>
          </div>
      </form>
    </div>

    <div class="col-lg-6 text-lg-end mt-2 mt-lg-0">
      <?php if(auth()->user()->usertype != 'user'): ?>
          <a href="<?php echo e(url('/addItem')); ?>" class="btn btn-success mx-2">+ Add Item into Inventory</a>
      <?php endif; ?>
  </div>

  </div>
</div>

<div class="table-responsive">
  <table class="content-table">
    <table class="content-table">

      <thead>
        <tr>
          <th>Item Number</th>
          <th>School Property</th>
          <th>Property Number</th>
          <th>Unit of Measure</th>
          <th>Unit Value</th>
          <th>Quantity Per Property Card</th>
          <th>Quantity Per Physical Count</th>
          <th>Quantity</th>
          <th>Value</th>
          <th>Total Value</th>
          <th>Remarks</th>
          <th>Category</th>
          <th>Acquisition Type</th>
          <th>Grade Level</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        
        <?php if(count($Inventory) > 0): ?>
        <?php $__currentLoopData = $Inventory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="Inventory_<?php echo e($item->id); ?>">
          <td><?php echo e($item->id); ?></td>
          <td class="scrollable"><?php echo e($item->school_property); ?></td>
          <td><?php echo e($item->property_number); ?></td>
          <td><?php echo e($item->unit_of_measure); ?></td>
          <td><?php echo e($item->unit_value); ?></td>
          <td><?php echo e($item->quantity_per_property); ?></td>
          <td><?php echo e($item->quantity_per_physical); ?></td>
          <td><?php echo e($item->quantity); ?></td>
          <td><?php echo e($item->value); ?></td>
          <td><?php echo e($item->total_value); ?></td>
          <td><?php echo e($item->remarks); ?></td>
          <td><?php echo e($item->category); ?></td>
          <td><?php echo e($item->acquisition_type); ?></td>
          <td><?php echo e($item->grade_level); ?></td>
          <td>
            <?php if(auth()->user()->usertype === 'admin'): ?>
            <div class="btn-group" role="group">
              <a href="<?php echo e(url('editInventory/'.$item->id)); ?>" class="btn btn-sm btn-primary mr-1 mx-1">Edit</a>
              <form action="#" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(url('removeConfirm/'.$item->id)); ?>" class="btn btn-sm btn-danger mx-1">Delete</a>
              </form>
            </div>
            <?php else: ?>

            <form action="<?php echo e(url('requestDetails/'.$item->id)); ?>" method="GET" class="d-inline">       
              <button type="submit" class="btn btn-sm btn-success">Request</button>
          </form>

        <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr class="text-end">
          <td colspan="15"> Showing <?php echo e($Inventory->firstItem()); ?> to <?php echo e($Inventory->lastItem()); ?> of <?php echo e($Inventory->total()); ?> entries</td>
        </tr>
        <?php else: ?>
        <tr>
          <td colspan="15">No items found</td>
        </tr>
        <tr>
          <td colspan="15"> Showing <?php echo e($Inventory->firstItem()); ?> to <?php echo e($Inventory->lastItem()); ?> of <?php echo e($Inventory->total()); ?> entries</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </table>
</div>

<div class="pagination-container">
  <?php echo e($Inventory->appends(request()->input())->links()); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\inventory.blade.php ENDPATH**/ ?>