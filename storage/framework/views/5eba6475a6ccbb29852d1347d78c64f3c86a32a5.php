
<?php $__env->startSection('content'); ?>
    <section class="inner-pages">
        <div class="container">
            <div class="row contact_div">

                <div class="col-md-7">
                        <?php echo e(Form::open(['method'=>'post','class'=>'contact-form'])); ?>


                        <div class="p-3 p-lg-5 border">
                            <div class="col-md-12 error-contact alert alert-danger" style="display: none"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">FIRST NAME </small>

                                        <input type="text" class="form-control" name="fname">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last NAME </small>

                                        <input type="text"  name="lname" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Business Email</small>

                                        <input type="text" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>

                                        <input type="text" class="form-control" name="phone" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder textarea"> <small class="label" for="input">Address</small>

                                        <textarea class="form-control" name="address" rows="3"></textarea>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder textarea"> <small class="label" for="input">Message/Query</small>

                                        <textarea class="form-control" name="text" rows="5"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="signup_btn">
                                        <button id="submitForm" type="submit" class="nav-link">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
                <div class="col-md-5 ml-auto">
                    <div class="p-4 border mb-3">
                        <span class="d-block text-primary h6 text-uppercase">Address</span>
                        <p class="mb-0"><?php echo e($address['value']); ?></p>
                    </div>
                    <div class="p-4 border mb-3">
                        <span class="d-block text-primary h6 text-uppercase">Telephone</span>
                        <p class="mb-0"><?php echo e($phone['value']); ?></p>
                    </div>
                    <div class="p-4 border mb-3">
                        <img src="<?php echo e(asset('images/address.jpg')); ?>" class="img-responsive" width="100%" />
                    </div>

                </div>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function(){

            $(".error-contact").hide();
               $(".contact-form").validate({
                  rules: {
                        fname: {required:true},
                        lname: {required:true},
                        email: {
                                required: true,
                                email: true,//add an email rule that will ensure the value entered is valid email id.
                                maxlength: 255,
                             },
                        phone:{
                                required:true,
                                },
                        address:{
                                    required:true,
                                },
                        text: {
                                required:true,
                            }
                    },
                    
                    messages: {
                        text:'Message field should not be empty',
                        fname: 'Please enter your first name',
                        lname: 'Plase enter your last name',
                        email: 'Please enter you email-id',
                        address:'Address should not be empty',
                        phone:'Phone number should not be empty',
                    },
                submitHandler: function() {
                    $(".contact-form").submit();
                }
           });

        $("#submitForm").on('click',function(e){
            if($(".contact-form").valid()){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"<?php echo e(url('User/contact-form')); ?>",
                    data:$(".contact-form").serialize(),
                    success:function(response){
                        if(response.msg=='success')
                        {
                            $(".error-contact").html('Your Message has been sent successfully.');
                            $(".error-contact").show();
                        }else{
                            $(".error-contact").html('Your message not sent.');
                            $(".error-contact").show();
                        }
                    }
                })   
            }
        });
    })
    </script>
    <!--  footer  -->
   <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/contactus.blade.php ENDPATH**/ ?>