@extends('layouts.home')
@section('content')
    <!------------------------------------------------------>
    
    <!-- <script src="{{ url('js/recaptcha.api.js')}}" async defer></script> -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                {{ Form::open(array('method' => 'post','class' => 'login-container')) }}
                    <h5 class="text-center">Already a member? <a href="#" data-toggle="modal" data-target="#exampleModalLong">Log in</a></h5>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="col-md-12 alert alert-danger error-note" style="display:none"></div>
                    @if ($errors->any())
                        <div class="alert alert-danger" id="display">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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

                        <input type="text" class="form-control"  name="fname" value="{{$fname}}">
                    </div>

                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last Name </small>

                        <input type="text" class="form-control" name="lname" value={{ $lname}}>
                    </div>
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>

                        <input type="email" class="form-control"  name="email" value="{{ @$data['email'] }}"required>
                    </div>
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Password </small>

                         <input type="password" class="form-control" name="password" required>
                    </div>



                    <form-group>
                        <div class="g-recaptcha" name="captcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                    </form-group>
                    <div class="form-group">
                        <button id="submitForm" type="submit" class="btn">Create Account</button>
                    </div>
                    <p class="text-center">By signing up, you agree to the <a href="#">Terms of Use.</a></p>
                    <hr style="border-top: 2px dotted #eee;">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"><a type="button" class="linkedin-btn" href="{{ url('login/linkedin/') }}" ><i class="fab fa-linkedin-square "></i>Sign Up with LinkedIn</a>
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> <a type="button" href="{{ url('login/facebook') }}" class="facebook-btn"><i class="fab fa-facebook-square"></i>Sign Up with Facebook</a>

                        </div>
                    </div>



                {{ Form::close() }}
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
                        url:"{{ url('User/userSignup')}}",
                        data:$('.login-container').serialize(),
                        success:function(data){
                            if(data.msg=='Success'){
                                $(".error-note").hide();
                                window.location.href="{{ url('User/confirmSignup')}}"
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
@endsection
