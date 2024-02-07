
<?php $__env->startSection('nav-back'); ?>
<h5> 
        <?php if(auth()->guard()->check()): ?>
        Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
        <?php endif; ?>
</h5>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>

<?php if(auth()->user()->usertype === 'admin'): ?>
    
<p>
    Admin Settings
</p>
<?php else: ?>

<p>
    User Settings
</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\settings.blade.php ENDPATH**/ ?>