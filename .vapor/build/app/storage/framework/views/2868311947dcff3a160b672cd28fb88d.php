

<?php $__env->startSection('nav-back'); ?>
    <h5>
        <?php if(auth()->guard()->check()): ?>
            Account: <?php echo e(auth()->user()->name); ?> (ID: <?php echo e(auth()->user()->id); ?>)
        <?php endif; ?>
    </h5>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Requests'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container d-flex justify-content-center align-items-center"">
        <div class = "col-md-12">
            <!-- First table -->
            
            <div class="table-container">
                <table class="etable text-center">
                    <thead>
                        <h2>Pending Requests</h2>
                    </thead>
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
                        <?php $__currentLoopData = $UserRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($request->status === 'pending'): ?>
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
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Second table -->
            <?php if(auth()->user()->usertype == 'admin'): ?>
                <div class="table-container">
                    <table class="etable text-center">
                        <thead>
                            <h2>Accepted Requests</h2>
                        </thead>
                        <thead>
                            <tr>
                                <th scope="col">Request ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Requested Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $UserRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <form action="<?php echo e(url('markedAsComplete/'.$request->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <?php if($request->status === 'accepted'): ?>
                                    <tr scope="row" id="UserRequest_<?php echo e($request->id); ?>">
                                        <td><?php echo e($request->id); ?></td>
                                        <td><?php echo e($request->user->name); ?></td>
                                        <td><?php echo e($request->school_property); ?></td>
                                        <td><?php echo e($request->quantity); ?></td>
                                        <td class = "text-success"><?php echo e($request->status); ?></td>
                                        
                                        <td>
                                            <?php if(auth()->user()->usertype !== 'admin'): ?>
                                            <!--for users-->
                                                    <a href="<?php echo e(url('declineRequest/'.$request->id)); ?>" 
                                                        class="btn btn-danger" onclick="return confirm('Are you sure you want to Decline the request of <?php echo e($request->user->name); ?>')">Cancel Request</a>
                                                



                                            <?php elseif(auth()->user()->usertype === 'admin'): ?>
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to Mark this request as completed? <?php echo e($request->school_property); ?> <?php echo e($request->quantity); ?><?php echo e($request->unit_of_measure); ?>')">
                                                    Mark as completed</button>
                                               



                                                    <a href="<?php echo e(url('cancelledRequest/'.$request->id)); ?>" 
                                                    class="btn btn-danger" onclick="return confirm('Are you sure you want to CANCEL the request of <?php echo e($request->user->name); ?>')">Cancel</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </form>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
         
            <div class="table-container">
                <table class="etable text-center">
                    <thead>
                        <h2>Completed/Declined Request History</h2>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col">Request ID</th>
                            <th scope="col">Requester Name</th>
                            <th scope="col">Requested Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $request_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($request->status === 'completed' || $request->status === 'declined'): ?>
                                <tr scope="row" id="request_history_<?php echo e($request->id); ?>">
                                    <td><?php echo e($request->id); ?></td>
                                    <td><?php echo e($request->user->name); ?></td>
                                    <td><?php echo e($request->school_property); ?></td>
                                    <td><?php echo e($request->quantity); ?></td>
                                    <td class = "text-success"><?php echo e($request->status); ?></td>
                                    <td>
                                        <?php if(auth()->user()->usertype !== 'admin'): ?>
                                       
                                                <a href="<?php echo e(url('viewRequest/'.$request->id)); ?>" 
                                                    class="btn btn-secondary">
                                                    View Request</a>
                                         
                                        <?php elseif(auth()->user()->usertype === 'admin'): ?>
                                        <a href="<?php echo e(url('viewRequest/'.$request->id)); ?>" class="btn btn-secondary d-in-line">View Request</a>
                                            <a href="<?php echo e(url('deleteRequest/'.$request->id)); ?>" 
                                                class="btn btn-danger" onclick="return confirm('Are you sure you want to delete history of <?php echo e($request->school_property); ?> request')">Delete</a>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
      



        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('include.dash_side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\requests.blade.php ENDPATH**/ ?>