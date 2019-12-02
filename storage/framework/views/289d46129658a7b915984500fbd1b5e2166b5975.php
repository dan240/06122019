<!DOCTYPE html>

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="LondCap">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="LondCap">
    <title>LondCap</title>
    <!-- Icons-->
    <link href="<?php echo e(asset('admin/vendors/@coreui/icons/css/coreui-icons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/vendors/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/vendors/simple-line-icons/css/simple-line-icons.css')); ?>" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="<?php echo e(asset('admin/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/vendors/pace-progress/css/pace.min.css')); ?>" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <?php echo e(Form::open(['class'=>'loginForm','method'=>'post'])); ?>

      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Login</h1>
                <p id="errormsg"></p>
                <p class="text-muted">Sign In to your account</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input class="form-control" type="text" name ="username" placeholder="Username">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input class="form-control" name="password" type="password" placeholder="Password">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit">Login</button>
                  </div>
                  <div class="col-6 text-right">
                    <button class="btn btn-link px-0" name="password" type="button">Forgot password?</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php echo e(Form::close()); ?>

    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="<?php echo e(url('admin/vendors/jquery/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/vendors/popper.js/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/vendors/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/vendors/pace-progress/js/pace.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('admin/vendors/@coreui/coreui-pro/js/coreui.min.js')); ?>"></script>
    <script>
      $(document).ready(function(){
        $(".loginForm").on('submit',function(e){
          e.preventDefault();
          $.ajax({
            method:"POST",
            url:"<?php echo e(url('Admin/adminLogin')); ?>",
            data:$(".loginForm").serialize(),
            success:function(response){
              if(response.msg == "success"){
                window.location.href="<?php echo e(url('Admin/dashboard')); ?>";
              }
              $("#errormsg").html('<span class="alert alert-success">'+response.msg+'</span>');
            }
          });
        })
      });
    </script>
  </body>
</html>
<?php /**PATH D:\Lond Capital\Site\londcapapp\resources\views/backend/login.blade.php ENDPATH**/ ?>