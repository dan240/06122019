<!DOCTYPE html>

<html lang="en">
  <head>
    <?php echo $__env->make('backend.include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <?php echo $__env->make('backend.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="app-body">
    <?php echo $__env->make('backend.include.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <main class="main">
        
        <?php echo $__env->yieldContent('content'); ?>
 
      </main>
    </div>
    <?php echo $__env->make('backend.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!-- CoreUI and necessary plugins-->
      
      
      <?php echo $__env->make('backend.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- nav-end -->

    
   

    <!-- Container (Footer) -->
     <?php echo $__env->make('backend.include.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </body>
</html>
<?php /**PATH D:\Lond Capital\Site\londcapapp\resources\views/layouts/admin.blade.php ENDPATH**/ ?>