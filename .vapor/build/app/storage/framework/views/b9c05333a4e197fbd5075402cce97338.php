

<?php $__env->startSection('title', 'Add Employee'); ?>

<?php $__env->startSection('nav-back'); ?>
    <a class="nav-link" href="<?php echo e(route('manageEmployees')); ?>" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        &lt; Back
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="mt-5">
            <?php if($errors->any()): ?>
                <div class="col-12">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-danger"><?php echo e($error); ?></div> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger"><?php echo e(session()->get('error')); ?></div>
            <?php endif; ?>

            <?php if(session()->has('success')): ?>
                <div class="alert alert-success"><?php echo e(session()->get('success')); ?></div>
            <?php endif; ?>
        </div>

        <form action="<?php echo e(route('registration.post')); ?>" method="POST" class="mx-auto" style="width: 500px;">
            <?php echo csrf_field(); ?> <!-- This is used to prevent cross-site request forgery -->
          
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="name" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label class="form-label">Employee Email address</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number (Should be 11 digits, e.g. 09921234567)</label>
                <input type="tel" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <button type="submit" class="btn btn-success d-block mx-auto">+ Add Employee</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\registration.blade.php ENDPATH**/ ?>