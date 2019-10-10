@extends('layouts.home')
@section('content')
    <section class="login_page">
        <div class="container">
            <div class="row centered-container clearfix">
                {{ Form::open(array('method' => 'post','class' => 'changePassword')) }}
                    <?php if(!empty($response)):?>
                        <div class="alert alert-<?php echo ($response['code'] == 1)?'success':'danger';?> alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <i class="icon fa fa-<?php echo ($response['code'] == 1)?'check':'ban';?>"></i>
                          <?php echo $response['msg'];?>
                        </div>
                      <?php endif; ?>
                    <h5 class="text-center">Change Password</h5>
                    <div class="col-md-12 error-note alert alert-danger"></div>
                    <hr style="border-top: 2px dotted #eee;">
					<div class="form-group inner-label-holder"> <small class="label" for="input">Please enter old password </small>

                        <input type="password" class="form-control"  name="oldpassword" required>
                    </div>
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Please enter new password </small>

                        <input type="password" class="form-control"  name="newpassword" required>
                    </div>
					<div class="form-group inner-label-holder"> <small class="label" for="input">Please confirm old password </small>

                        <input type="password" class="form-control"  name="confirmpassword" required>
                    </div>
                    <hr style="border-top: 2px dotted #eee;">                                 
                    <button type="submit" id="submit" class="btn ">Reset Password</button>
             
                {{ Form::close() }}
            </div>
        </div>
    </section>

   <script>
    $(document).ready(function(){
            $(".error-note").hide();
               $(".changePassword").validate({
              /*  errorLabelContainer: ".error-note",
                wrapper: "li",*/
                  rules: {  
                        oldpassword: {required:true},
                        newpassword: {required:true},
                        confirmpassword:{required:true},
                    },
                    message: {
                      oldpassword: 'Old password should not be empty',
                      newpassword: 'New password should not be empty',
                      confirmpassword:'Confirm password should not be empty',  
                },
                submitHandler: function() {
                    $(".changePassword").submit();
                }
           });
            $("#submit").on('click',function(e){
                if($(".changePassword").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"{{ url('User/ChangeUserPassword') }}",
                        data:$(".changePassword").serialize(),
                        success:function(response){
                            if(response.msg=='success'){
                                $(".error-note").text('Password changed successfully');
                                $(".error-note").show();
                            }
                            else {
                                 $(".error-note").text(response.msg);
                                 $(".error-note").show();
                            }

                        }
                    });
            }
        });
    });
   </script>
   @endsection

