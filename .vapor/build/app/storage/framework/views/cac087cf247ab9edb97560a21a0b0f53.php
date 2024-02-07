

<?php $__env->startSection('nav-back'); ?>
    <a class="nav-link" href="<?php echo e(route('manageEmployees')); ?>" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        < Back
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="text-center">Edit Employee</h2>
    <p class = "text-center">Editing details for ID: <?php echo e($user->id); ?> - <?php echo e($user->name); ?>

        <?php if($user->usertype === 'admin'): ?>
        (Admin) <br> An <b>OTP</b> may be required to update the details of the account.
        <?php elseif($user->usertype === 'user'): ?>
        (Regular User)
        <?php endif; ?>
    </p>

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

    <form action="<?php echo e(url('update-data/'.$user->id)); ?>" method="POST" class="mx-auto">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo e($user->id); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo e($user->phone); ?>">
                </div>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Make sure the email field is inside the same structure -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Employee Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto text-end">
                <a class="btn btn-danger"  href="<?php echo e(route('manageEmployees')); ?>" 
                onclick="return confirm('Changes will not be saved if you CANCEL')">
                    Cancel
                </a>
                <button type= "submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\include\edit.blade.php ENDPATH**/ ?>