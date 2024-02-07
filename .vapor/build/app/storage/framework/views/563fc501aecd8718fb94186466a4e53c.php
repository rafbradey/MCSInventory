
<?php $__env->startSection('title', 'Manage Employees'); ?> <!-- This is the title of the page -->

<?php $__env->startSection('nav-back'); ?>
<h5> 
        <?php if(auth()->guard()->check()): ?>
        Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
        <?php endif; ?>
</h5>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<p>
    This is the Manage Employees page, Authorized Access Only!
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
<div class = "text-end">

    <a href="<?php echo e(route('registration')); ?>" class="btn btn-success mx-2">+ Add Employee</a>
<div class="table-responsive">
    <table class="etable text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="user_<?php echo e($user->id); ?>">
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->phone); ?></td>
                <td><?php echo e($user->usertype); ?></td>

                <td>
                    <?php if($user->usertype !== 'admin'): ?>
                    <a href="<?php echo e(url('edit/'.$user->id)); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?php echo e(url('delete/'.$user->id)); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove user <?php echo e($user->name); ?> with ID <?php echo e($user->id); ?>?')">Remove</a>
                    <?php elseif($user->usertype === 'admin'): ?>
                    <a href="<?php echo e(url('edit/'.$user->id)); ?>" class="btn btn-primary">Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </tbody>
    </table>

    <?php echo e($users->links()); ?>





</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\manageEmployees.blade.php ENDPATH**/ ?>