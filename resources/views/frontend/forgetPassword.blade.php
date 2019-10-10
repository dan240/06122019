@extends('layouts.investor')
@section('content')
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                {{Form::open(['method'=>'post','class'=>'login-container'])}}
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
                {{ Form::close() }}
                <!-- </form> -->
            </div>
        </div>
    </section>
    <script src="{{ url('js/jquery.validate.min.js')}}"></script>
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
                    url:"{{url('User/forgetPassword')}}",
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
    @endsection