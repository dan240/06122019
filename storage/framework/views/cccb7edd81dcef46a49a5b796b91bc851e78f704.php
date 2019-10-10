
<?php $__env->startSection('content'); ?>
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                <?php echo e(Form::open(['method'=>'post','class'=>'login-container'])); ?>

                <!-- <form method="get" action="" class="login-container"> -->
                    <h5 class="text-center">
                        Forgot Password
                    </h5>

                    <div id="error-note" class="col-md-12 alert alert-danger"></div>
                    <hr style="border-top: 2px dotted #eee;">
                    <p class="text-center">
                        Please enter your email to reset your password

                    </p>
                    <hr style="border-top: 2px dotted #eee;">
                        <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn">Reset Password</button>
                    </div>
                <?php echo e(Form::close()); ?>

                <!-- </form> -->
            </div>
        </div>
    </section>
    <script src="<?php echo e(url('js/jquery.validate.min.js')); ?>"></script>
   <script>
    $(document).ready(function(){
        $("#error-note").hide();
               $(".login-container").validate({
                errorLabelContainer: "#error-note",
                wrapper: "",
                  rules: {
                        email: {
                                required: true,
                                email: true,//add an email rule that will ensure the value entered is valid email id.
                                maxlength: 255,
                             },
                    },
                    
                    messages: {
                        email: 'Please Enter you Email-Id',
                    },
                submitHandler: function() {
                    $(".login-container").submit();
                }
           });
        $("#submit").on('click',function(e){
            if($(".login-container").valid()){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"<?php echo e(url('User/forgetPassword')); ?>",
                    data:$(".login-container").serialize(),
                    success:function(response){
                        debugger;
                        if(response.msg == "success")
                        {
                            $("#error-note").text('Email sent please check your mailbox.');
                            $("#error-note").show();
                        }else{
                            $("#error-note").text(response.msg);
                            $("#error-note").show();
                        }
                    }
                });
            }
        });
    });
   </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.investor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/forgetPassword.blade.php ENDPATH**/ ?>