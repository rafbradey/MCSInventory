<?php $__env->startSection('nav-back'); ?>
<h5> 
        <?php if(auth()->guard()->check()): ?>
        Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
        <?php endif; ?>
</h5>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-1">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Inventory Summary</h3>
                    <a href = "<?php echo e(url('/addItem')); ?>"class="btn btn-warning mr-2"> <i class="fa-solid fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($totalQuantity); ?></h5>
                                    <p class="card-text">Overall School Inventory Item Quantity</p>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($totalGCQ); ?></h5>
                                    <p class="card-text">Items in Good Condition</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($PendingRequests); ?></h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($PendingRequests); ?></h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>

             <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($PendingRequests); ?></h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($PendingRequests); ?></h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <h3 class="mt-4 mb-1">Recent Requests</h3>
    </div>
        <div class="container d-flex justify-content-center align-items-center"">
            <div class = "col-md-12">
                <!-- First table -->
                
                <div class="table-container">
                    <table class="etable text-center">
                    
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
    
    <thead>
        <tr>
            <th scope="col">Request ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Requested Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 0; ?>
        <?php $__currentLoopData = $userRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($request->status === 'pending'): ?>
                <?php if($counter < 3): ?>
                    <tr id="UserRequest_<?php echo e($request->id); ?>">
                        <td><?php echo e($request->id); ?></td>
                        <td><?php echo e($request->user->name); ?></td>
                        <td><?php echo e($request->school_property); ?></td>
                        <td><?php echo e($request->quantity); ?></td>
                        <td><?php echo e($request->status); ?></td>
                        <td>
                            <?php if(auth()->user()->usertype !== 'admin' && $request->user_id === auth()->user()->id): ?>
                                <form action="#" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <a href="<?php echo e(url('declineRequest/'.$request->id)); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel the request of <?php echo e($request->user->name); ?>')">Cancel Request</a>
                                </form>
                            <?php elseif(auth()->user()->usertype === 'admin'): ?>
                                <a href="<?php echo e(url('acceptRequest/'.$request->id)); ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to Accept the request of <?php echo e($request->user->name); ?>')">Accept</a>
                                <a href="<?php echo e(url('declineRequest/'.$request->id)); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to Decline the request of <?php echo e($request->user->name); ?>')">Decline</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php else: ?>
                    <?php break; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
                    </table>
                </div>


    </div> 
</div>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\dashboard.blade.php ENDPATH**/ ?>