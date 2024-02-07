
<?php $__env->startSection('nav-back'); ?>
    <h5> 
        <?php if(auth()->guard()->check()): ?>
        Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
        <?php endif; ?>
    </h5>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', 'Damage Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1"> 
            <h3 class="text-center mt-2">Existing Damage Reports</h3>
            <div class="table-responsive"> 
                <table class="table table-striped etable">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Date Reported</th>
                            <?php if(auth()->user()->usertype == "admin"): ?>
                            <th>Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>   
                    
                    <tbody>
                        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($report->id); ?></td>
                            <td><?php echo e($report->item_name); ?></td>
                            <td><?php echo e($report->description); ?></td>
                            <td><?php echo e($report->location); ?></td>
                            <td><?php echo e($report->date_reported); ?></td>
                            <?php if(auth()->user()->usertype == "admin"): ?>
                            <td>
                                <a href="#" class="btn-submit"><i class="fa-solid fa-check"></i></a>
                                <a href="#" class="btn-submit"><i class="fa-solid fa-x"></i></a>
                            </td>

                        
                       
                
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center mt-5">Report Damaged Item</h3>
        
            <form action="<?php echo e(url('submitReport')); ?>"  method="post">
                <?php echo csrf_field(); ?>
            <?php echo method_field('put'); ?>
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description of Damage</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                
                <button class="btn btn-submit d-block mx-auto">Submit Report</button>
                </form>
                </a>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        padding-top: 30px;
    }
    .btn-submit {
        background-color: #009879;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #007564;
    }
    .damage-table {
        margin-top: 50px;
    }
    .damage-table th {
        background-color: #009879;
        color: white;
    }
  
    .form-control {
        border: 1px solid #009879;
        width: 100%;
    }

    .etable {
        width: 100%;
    }

    .text-center {
    text-align: center;
}


.text-center {
    text-align: center;
}



</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\reports.blade.php ENDPATH**/ ?>