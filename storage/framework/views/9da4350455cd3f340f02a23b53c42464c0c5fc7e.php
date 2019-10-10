    
<?php $__env->startSection('content'); ?>
    <section class="inner-pages">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="active"><a href="#myinfo">My Info</a></li>
                            <li><a href="#balance">Balance Due</a></li>
                            <li><a href="#bill">Billing Methods</a></li>
                            <li><a href="#password">Password</a></li>
                            <li><a href="#member">Membership</a></li>
                            <!-- <li class="del_btn"><a class="nav-link" href="javascript:;" id="removeAct">Delete Account</a></li>
                             -->
                            
                                <a href="javascript:;" class="btn btn-danger btn-block" id="deleteComp">
                                    Delete Account
                                </a>

                                <strong class="text-danger">YOU CAN CHANGE STATUS NOT LOOKING FOR INVESTMENT, AND DECIDE LATER IF YOU WANT TO ACTIVATE, INSETAD OF DELETING.</strong> 
                
                           
                            <?php if($data['usertype'] == '1'): ?>
                                <a href="javascript:;" class="btn btn-success btn-block" id="changeToNoInvestment">
                                    Not Looking For Invesment
                                </a>
                            <?php else: ?>
                                <a href="javascript:;" class="btn btn-success btn-block" id="changeToNoInvestmentInv">
                                    Not Looking For Invesment
                                </a>
                            <?php endif; ?>
                            
                        </ul>
                        <div class="error"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                    <div id="myinfo">
                        <div class="form-card">
                            <div class="card-header">
                                <h4 class="title">My Info</h4>
                                <a href="javascript:;" class="btn-edit personalData"><i class="fa fa-pen"></i></a>
                            </div>
                            <div class="card-content">
                                    <?php echo e(Form::open(['class'=>'form-horizontal myInfo','method'=>'post'])); ?>

                                    <div class="form-group inner-label-holder  col-md-6 "> <small class="label" for="input">First Name </small>
                                        <input type="text" class="form-control" name="firstname" value="<?php echo e(@$data['firstname']); ?>">
                                    </div>
                                    <div class="form-group inner-label-holder  col-md-6 "> <small class="label" for="input">Last Name </small>
                                        <input type="text" class="form-control" name="lastname" value="<?php echo e(@$data['lastname']); ?>">
                                    </div>
                                    <div class="form-group inner-label-holder  col-md-6 "> <small class="label" for="input">Email </small>
                                        <input type="email" class="form-control" name="email" value="<?php echo e(@$data['email']); ?>">
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                        <a href="javascript:;" id="save" class="btn btn-primary">Save</a>
                                    </div>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    
                    <div id="balance">
                        <div class="form-card">
                            <div class="card-header">
                                <h4 class="title">Balance Due</h4>
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
                                        <p>First your balance due is <strong>$0.00</strong></p>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2"><a href="#" class="btn btn-primary">Pay Now</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="bill">
                        <div class="form-card">
                            <div class="card-header">
                                <h4 class="title">Billing Methods</h4>
                            </div>
                            <p class="card-type">Primary</p>
                            <hr>
                            <div class="card-content">
                                <div class="form-group inner-label-holder  col-md-6 "> <small class="label" for="input">Visa</small>

                                    <input type="text" class="form-control" placeholder="visa ending 4*** **** **** *231">
                                </div>
                                <div class="card-content">
                                    <p>A 3% processing fee will be assessed on all payments.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="password">
                        <div class="form-card">
                            <div class="card-header">
                                <h4 class="title">Password</h4>
                            </div>
                            <div class="card-content">
                                <p><a href="<?php echo e(url('User/ChangePasswordForm')); ?>" class="btn btn-primary"> Change Password</a></p>
                            </div>

                        </div>
                    </div>
                     <div id="member">
                    <div class="form-card">
                        <div class="card-header">
                            <h4 class="title">Membership</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">

                                    <p>Plan: <span class="text-big">LONDCAP Basic</span></p>

                                </div>
                                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                    <a href="<?php echo e(url('User/fundraising')); ?>" class="btn btn-primary">Change Plan</a>
                                </div>
                            </div>
                        </div>
                         </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('.myInfo').find('input').attr('disabled','disabled');
            $(".personalData").on('click',function(){
                $('.myInfo').find('input').removeAttr('disabled');
            });

               $(".myInfo").validate({
                errorClass: "my-error-class",
                  rules: {
                        firstname: { required: true},
                        lastname: { required: true},
                        email: { required: true},
                    },
                    messages: {
                        firstname: 'First name should not be empty!',
                        lastname: 'Last name should not be empty!',
                        email: 'Email should not be empty!',
                    },
                submitHandler: function() {
                    $(".myInfo").submit();
                }
           });

            $("#save").on('click',function(e){
                if($(".myInfo").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/editUserInfo')); ?>",
                        data:$(".myInfo").serialize(),
                        success:function(response)
                        {
                            $("#msg-response").show();
                            $(".editCompany").scrollTop();
                            if(response.msg=='success')
                            {
                                alert('Info added successfully');
                                $(".myInfo").scrollTop();
                            }else{
                                $(".myInfo").scrollTop();
                            }                
                        }      
                    });
                }else{
                    window.scrollTo(0,200);
                    return false;
                }
            });
            $("#removeAct").on('click',function(){
                $.ajax({
                    url:"<?php echo e(url('User/deleteAccount')); ?>",
                    method:"POST",
                    data:{"_token":"<?php echo e(csrf_token()); ?>"},
                    success:function(response){
                        if(response.msg){
                            window.location.href="<?php echo e(url('User/logout')); ?>";
                            alert("Account should be removed permanently after 15 days");

                        }
                    }
                });
            });

            $('#changeToNoInvestment').click(function(){
                $.ajax({
                    method:"GET",
                    url:"<?php echo e(url('User/changeToNoInvestment')); ?>",
                    cache: false,
                    processData: false, 
                    contentType: false,
                    success:function(response){
                        if (response.msg == 'success') {
                            $('.error').html('<div class="alert alert-success">Funding type changed.</div>');
                        }else{
                            $('.error').html('<div class="alert alert-danger">Funding type not changed. Something went wrong !</div>');
                        }
                    }
                });
            });
        $('#changeToNoInvestmentInv').click(function(){
            $.ajax({
                method:"GET",
                url:"<?php echo e(url('User/changeToNoInvestmentInv')); ?>",
                cache: false,
                processData: false, 
                contentType: false,
                success:function(response){
                    if (response.msg == 'success') {
                        $('.error').html('<div class="alert alert-success">Investment type changed.</div>');
                    }else{
                        $('.error').html('<div class="alert alert-danger">Investment type not changed. Something went wrong !</div>');
                    }
                }
            });
        });


        $('#deleteComp').click(function(){
            $.ajax({
                method:"GET",
                url:"<?php echo e(url('User/deleteCompany')); ?>",
                cache: false,
                processData: false, 
                contentType: false,
                success:function(response){
                    if (response.msg == 'success') {
                        location.reload();
                    }else{
                        $('#noInvErr').html('Something Went Wrong !');
                    }
                }
            });
        });

        });
        
    </script>
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/user-account-my-info.blade.php ENDPATH**/ ?>