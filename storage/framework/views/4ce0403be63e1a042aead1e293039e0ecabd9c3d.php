
<?php $__env->startSection('content'); ?>
    <!------------------------------------------------------>
    
    <!-- <script src="<?php echo e(url('js/recaptcha.api.js')); ?>" async defer></script> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                <?php echo e(Form::open(array('method' => 'post','class' => 'login-container'))); ?>

                    <h5 class="text-center">Already a member? <a href="#" data-toggle="modal" data-target="#exampleModalLong">Log in</a></h5>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="col-md-12 alert alert-danger error-note" style="display:none"></div>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger" id="display">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                     <?php if(!empty($response)):?>
                            <div class="alert alert-<?php echo ($response['code'] == 1)?'success':'danger';?> alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <i class="icon fa fa-<?php echo ($response['code'] == 1)?'check':'ban';?>"></i>
                              <?php echo $response['msg'];?>
                            </div>
                          <?php endif; ?>
                    <form-group>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <p class="text-center">I am</p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <input type="radio" id="test1" name="userType" value="1">
                                <label for="test1" name="company">Company</label>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <input type="radio" id="test2" name="userType" value="2">
                                <label for="test2">Investor</label>
                            </div>
                        </div>
                    </form-group>
                    <?php $str = @$data['name'];
                                $resData = (explode(" ",@$str)); $fname = @$resData[0]; $lname=@$resData[1]; ?>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group inner-label-holder"> <small class="label" for="input">First Name </small>

                        <input type="text" class="form-control"  name="fname" value="<?php echo e($fname); ?>">
                    </div>

                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last Name </small>

                        <input type="text" class="form-control" name="lname" value=<?php echo e($lname); ?>>
                    </div>
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>

                        <input type="email" class="form-control"  name="email" value="<?php echo e(@$data['email']); ?>"required>
                    </div>
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Password </small>

                         <input type="password" class="form-control" name="password" required>
                    </div>
                    <form-group>
                        <div class="g-recaptcha" name="captcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                    </form-group>
                    <div class="form-group">
                        <button id="submitForm" type="submit" class="btn">Create Account</button>
                    </div>
                    <p class="text-center">By signing up, you agree to the <a href="#">Terms of Use.</a></p>
                    <hr style="border-top: 2px dotted #eee;">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"><a type="button" class="linkedin-btn" href="<?php echo e(url('login/linkedin/')); ?>" ><i class="fab fa-linkedin-square "></i>Sign Up with LinkedIn</a>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> <a type="button" href="<?php echo e(url('login/facebook')); ?>" class="facebook-btn"><i class="fab fa-facebook-square"></i>Sign Up with Facebook</a>

                        </div>
                    </div>



                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </section>
    
    <script>
        $(document).ready(function(){
            $(".error-note").hide();
               $(".login-container").validate({
                errorLabelContainer: ".error-note",
                wrapper: "li",
                //ignore: ".ignore",
                  rules: {
                        fname: {required:true},
                        lname: {required:true},
                        email: {
                                required: true,
                                email: true,//add an email rule that will ensure the value entered is valid email id.
                                maxlength: 255,
                             },
                        password:{
                                    required:true,
                                    maxlength:10,
                                    minlength:6
                                },
                        userType:{
                                    required:true,
                                },
                        hiddenRecaptcha: {
                                required: function () {
                                    if (grecaptcha.getResponse() == '') {
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                    },
                    
                    messages: {
                        userType:'Please Select type either Company or Investor',
                        fname: 'Please Enter Your First Name',
                        lname: 'Plase Enter Your Last Name',
                        email: 'Please Eenter a valid Email-Id',
                        password:'Password should be minimun length 6 and maximum length 10',
                        hiddenRecaptcha:'Captcha Must be Selected',
                    },
                submitHandler: function() {
                    $(".login-container").submit();
                }
           });
            $("#submitForm").on('click',function(e){
                 if($(".login-container").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"post",
                        url:"<?php echo e(url('User/userSignup')); ?>",
                        data:$('.login-container').serialize(),
                        success:function(data){
                            if(data.msg=='Success'){
                                $(".error-note").hide();
                                window.location.href="<?php echo e(url('User/confirmSignup')); ?>"
                            }else{
                                $(".error-note").html(data.msg);
                                $(".error-note").show();
                            }
                        }
                    });
                }
            });
        });
    </script>
    <!---------------------------footer------------------------>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/signup.blade.php ENDPATH**/ ?>