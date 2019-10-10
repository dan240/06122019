@extends('layouts.investor')
@section('content')
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                {{Form::open(['method'=>'post','class'=>'login-container'])}}
                <!-- <form method="get" action="" class="login-container"> -->
                    <h5 class="text-center">
                        Enter New Password
                    </h5>
                    <hr style="border-top: 2px dotted #eee;">
                    <div id="error-note" class="col-md-12"></div>
                        <div class="form-group inner-label-holder"> <small class="label" for="input">New Password</small>
                        <input type="password" class="form-control" name="password">
                    </div>
                        <input type="hidden" class="form-control" name="email" value="{{ $data['email']}}">
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn">Save Password</button>
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
                wrapper: "li",
                  rules: {
                        password: {
                                required: true,
                                maxlength: 20,
                                minlength: 6,
                             },
                    },
                    
                    messages: {
                        password: '<div class="alert alert-danger">Password should be less than 20 and more than 6 characters </div>',
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
                    url:"{{url('User/resetSuccess')}}",
                    data:$(".login-container").serialize(),
                    success:function(response){
                        debugger;
                        if(response.msg == "success")
                        {
                            $("#error-note").html('<div class="alert alert-success">Password Changed Succeefully</div>');
                            $("#error-note").show();
                        }else{
                            $("#error-note").html('<div class="alert alert-danger">'+response.msg+'</div>');
                            $("#error-note").show();
                        }
                    }
                });
            }
        });
    });
   </script>
    @endsection