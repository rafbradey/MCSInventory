
<?php $__env->startSection('title', 'Login'); ?> <!-- This is the title of the page -->
<link rel = "stylesheet" href = "<?php echo e(asset('style.css')); ?>">
<?php $__env->startSection('loginPage'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
           
            <div class="loginContainer bg-white rounded shadow p-4">
                <h1 class="h1logintext">MacArthur Central School</h1>
                <h2 class="h2logintext">Inventory Management System</h2>
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

                <form action="<?php echo e(route('login.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Employee Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\login.blade.php ENDPATH**/ ?>