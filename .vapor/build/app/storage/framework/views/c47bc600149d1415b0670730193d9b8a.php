

<?php $__env->startSection('nav-back'); ?>
    <a class="nav-link" href="<?php echo e(route('inventory')); ?>" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        < Back
    </a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Edit Inventory
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="text-center">Requesting an Item</h2>
    <p class="text-center">Request details for ID: <?php echo e($Inventory->id); ?> - <?php echo e($Inventory->school_property); ?></p>

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





    <form action="<?php echo e(route('addRequest')); ?>" method="POST" class="mx-auto">
        <?php echo csrf_field(); ?>
   
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="id" class="form-label">User</label>
                    <input type="text" class="form-control bg-secondary"" id="user_id" name="user_id" value="<?php echo e(auth()->id()); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="id" class="form-label">Item ID</label>
                    <input type="text" class="form-control bg-secondary"" id="inventory_id" name="inventory_id" value="<?php echo e($Inventory->id); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="school_property" class="form-label">School Property</label>
                    <input type="text" class="form-control bg-secondary""" id="school_property" name="school_property" value="<?php echo e($Inventory->school_property); ?> " readonly>
                </div>

                <div class="mb-3">
                    <label for="property_number" class="form-label">Property Number</label>
                    <input type="text" class="form-control bg-secondary"" id="property_number" name="property_number" value="<?php echo e($Inventory->property_number); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="unit_of_measure" class="form-label">Unit of Measure</label>
                    <input type="text" class="form-control bg-secondary"" id="unit_of_measure" name="unit_of_measure" value="<?php echo e($Inventory->unit_of_measure); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="unit_value" class="form-label">Unit Value</label>
                    <input type="text" class="form-control" id="unit_value" name="unit_value" value="<?php echo e($Inventory->unit_value); ?>" >
                </div>

                <div class="mb-3">
                    <label for="quantity_per_property" class="form-label">Quantity per Property</label>
                    <input type="text" class="form-control" id="quantity_per_property" name="quantity_per_property" value="<?php echo e($Inventory->quantity_per_property); ?>">
                </div>

                <div class="mb-3">
                    <label for="quantity_per_physical" class="form-label">Quantity per Physical</label>
                    <input type="text" class="form-control" id="quantity_per_physical" name="quantity_per_physical" value="<?php echo e($Inventory->quantity_per_physical); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo e($Inventory->quantity); ?>">
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" class="form-control" id="value" name="value" value="<?php echo e($Inventory->value); ?>">
                </div>

                <div class="mb-3">
                    <label for="total_value" class="form-label">Total Value</label>
                    <input type="text" class="form-control" id="total_value" name="total_value" value="<?php echo e($Inventory->total_value); ?>">
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" class="form-control bg-secondary"" id="remarks" name="remarks" value="<?php echo e($Inventory->remarks); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control bg-secondary"" id="category" name="category" value="<?php echo e($Inventory->category); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="acquisition_type" class="form-label">Acquisition Type</label>
                    <input type="text" class="form-control bg-secondary"" id="acquisition_type" name="acquisition_type" value="<?php echo e($Inventory->acquisition_type); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="grade_level" class="form-label">Grade Level</label>
                    <input type="text" class="form-control bg-secondary" id="grade_level" name="grade_level" value="<?php echo e($Inventory->grade_level); ?> " readonly>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <a class="btn btn-danger btn-md my-4 mx-2" href="<?php echo e(url('requests')); ?>" > Cancel</a>
                <button type="submit" class="btn btn-primary btn-md my-4 mx-2">Request</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\include\requestDetails.blade.php ENDPATH**/ ?>