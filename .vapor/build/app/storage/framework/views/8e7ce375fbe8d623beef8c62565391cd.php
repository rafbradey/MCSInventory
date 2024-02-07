<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?></title> <!-- Dynamic title -->

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('style.css')); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8fae048bd3.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

  <body>
    <div class="main-container d-flex">
      <div class="sidebar" id="side_nav">

        <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <h1 class="fs-4">
                <span class="bg-white text-dark rounded shadow px-2 me-2">MacArthur Central</span>
                <span class="bg-white text-dark rounded shadow px-2 me-2"> School</span><br>
                <span class="text-white">Inventory Management System</span>
            </h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars"></i></button>
        </div>

          <ul class="list-unstyled px-2">
            <li class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid ms-2 me-1 fa-table-columns"></i> Dashboard</a></li>
            <li class="<?php echo e(request()->routeIs('reports') ? 'active' : ''); ?>"><a href="<?php echo e(route('reports')); ?>" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid ms-2 me-2 fa-flag"></i>Reports</a></li>

            <li class="<?php echo e(request()->routeIs('inventory') ? 'active' : ''); ?>"><a href="<?php echo e(route('inventory')); ?>" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa-solid ms-2 me-1 fa-warehouse"></i>Inventory</span> </a>
        </li>

              <?php if(auth()->check() && auth()->user()->usertype === 'admin'): ?>
              <li class="<?php echo e(request()->routeIs('manageEmployees') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('manageEmployees')); ?>" class="text-decoration-none px-3 py-2 d-block"> 
                      <i class="fa-solid ms-2 fa-user-group"></i> Manage Employees
                  </a>
              </li>
          <?php endif; ?>
            
          <li class="<?php echo e(request()->routeIs('requestPage') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('requestPage')); ?>" class="text-decoration-none px-3 py-2 d-block">
                <i class="fa-solid ms-2 fa-envelope"></i> Requests
            </a>
        </li>             


          </ul>
          <hr class="h-color mx-2">

          <ul class="list-unstyled px-2">
              <li class="<?php echo e(request()->routeIs('settings') ? 'active' : ''); ?>"><a href="<?php echo e(route('settings')); ?>" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid ms-2 fa-gear"></i> Settings</a></li>
              <li class="<?php echo e(request()->routeIs('logout') ? 'active' : ''); ?>"><a href="<?php echo e(route('logout')); ?>" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid ms-2 fa-right-from-bracket"></i>Logout</a></li>

          </ul>

      </div>
      <div class="content">
          <nav class="navbar navbar-expand-md navbar-light bg-light">
              <div class="container-fluid">
                  <div class="d-flex justify-content-between d-md-none d-block">
                   <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars"></i></button>
                      <a class="navbar-brand fs-4" href="<?php echo e(route('dashboard')); ?>">
                        <span style="background-color: #009879; padding: 0.25rem 0.5rem; border-radius: 0.25rem; color: white;">MCS</span>


                    </a>
                     
                  </div>
                  <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fa-solid fa-bars"></i>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php echo $__env->yieldContent('nav-back'); ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Logged in as                          
                                <?php if(auth()->guard()->check()): ?>
                                <?php echo e(auth()->user()->usertype); ?>

                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>

                  </div>
              </div>
          </nav>

          <div class="dashboard-content px-3 pt-4">
              <h2 class="fs-5"><?php echo $__env->yieldContent('title'); ?></h2>

              <p>
                    <?php echo $__env->yieldContent('content'); ?>
           
              </p>
          </div>
      </div>
  </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(".sidebar ul li").on('click', function () {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function () {
            $('.sidebar').addClass('active');

        });


        $('.close-btn').on('click', function () {
            $('.sidebar').removeClass('active');

        })
        
      </script>
  
  </body>
</html><?php /**PATH C:\xampp\htdocs\MCSInventory\Inventory_app\.vapor\build\app\resources\views\include\dash_side.blade.php ENDPATH**/ ?>