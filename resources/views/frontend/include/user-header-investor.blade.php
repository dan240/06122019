<style type="text/css">
         .notification {
   position: relative;
  }
.notification .badge {
        position: absolute;
    top: -4px;
    right: -7px;
    border-radius: 50%;
    background-color: #2277b5;
    color: white;
    height: 20px;
    width: 20px;
    padding: 5px 0px;
}
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      display: none;
    }
    .resendEmail{
        cursor: pointer;
        font-size: 14px;
        font-weight: 700;
    }
     </style> 
     <div class="se-pre-con" style="background: url(<?php echo url('/'); ?>/images/giphy.gif) center no-repeat #fff;"></div>
   <div class="header sticky" id="myHeader">
    <nav class="navbar navbar-expand-lg navbar-light">
           <a class="navbar-brand" id="home" href=""><img src="{{ asset('images/Logo%20LondCap.png')}}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12 col-xl-5">
                        <ul class="navbar-nav left_menu">
                        <?php if(Session::get('User.usertype') != 2 || empty(Session::has('User.id'))) { ?>
                        <li class="nav-item"><a class="nav-link" href="javascript:;" id="browse-investor">Browse Investors <span class="sr-only">(current)</span></a></li>
                        <?php } if(Session::get('User.usertype') != 1 || empty(Session::has('User.id'))) { ?>
                        <li class="nav-item"><a class="nav-link" href="javascript:;" id="browse-company">Browse Companies</a></li>
                        <?php } ?>
                         </ul>
                     </div>
                    <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12 col-xl-7">
                        <ul class="navbar-nav right_menu">
                        <?php if((Session::get('User.usertype')) == 1 && Session::has('User')) { ?>
                        <li class="nav-item"><a class="nav-link" href="javascript:;">Suggested Companies</a></li>
                        <?php } ?>
                        <li class="nav-item"><a class="nav-link" id="contact" href="javascript:;">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" id="about" href="javascript:;">About Us</a></li>
                        <?php if(!empty(Session::has('User.id'))) { ?>
                        <li class="nav-item"><a class="nav-link" href="javascript:;" id="event">Events</a></li>
                        <li class="nav-item"><a class="nav-link notification" id="message" href="#"><i class="fa fa-envelope"></i><?php 
    $c = app('App\Http\Controllers\UserController')->getNotification(); 
    if($c>0){echo '<span class="badge">'.$c.'</span>' ;}?></a></li>
                        <li class="nav-item">
                                <div class="dropdown">
                                    <button class="dropbtn"><i class="fas fa-user"></i></button>
                                    <div class="dropdown-content">
                                    <?php $id = Session::get('User.id'); $usertype = Session::get('User.usertype'); if($usertype == 1) { ?>
                                        <a class="nav-link" href="#" onclick="userProfileCompany('{{ $id }}')">User Profile</a>
                                        <a class="nav-link" href="#" onclick="userAccountInfo('{{ $id }}')">User Account Profile</a>
                                    <?php } elseif($usertype == 2){?>
                                        <a class="nav-link" href="#" onclick="userProfileInvestor('{{ $id }}')">User Profile</a>
                                        <a class="nav-link" href="#" onclick="userAccountInfo('{{ $id }}')">User Account Profile</a>
                                    <?php } ?>
                                        <a class="nav-link" id="logout" href="{{ url('User/logout')}}">Log out</a>
                                    </div>
                                </div>
                            </li>   
                        <?php } elseif(empty(Session::has('User.id'))) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModalLong">Login</a>
                            </li>
                            <li class="nav-item">
                                <div class=" signup_btn"><a class="nav-link" href="#" id ="userSignup">Sign Up</a></div>
                            </li>                        
                        <?php } ?>
                    </ul> 
                </div> 
            </div>
        </nav>
    </div>
   <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        {{ Form::open(['method' => 'post','class'=>'loginForm']) }}
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            
          </div>
                            
          <div style="padding: 10px 40px 0px 40px;">
            <div id="login-error" class="alert alert-danger col-md-12"></div>
        </div>
        <div style="padding: 10px 40px 0px 40px;">
            
            <div class="resendEmailDiv alert alert-info col-md-12" style="display: none;">
                Please <span class="resendEmail"> Click Here</span> to resend email verification.
            </div>
        </div>
            
        <div class="modal-body" style="padding: 10px 40px 20px 40px;">


            <div class="form-group inner-label-holder"> 
                <small class="label" for="input">Enter Email</small>
                <input type="email" class="form-control" name="email" placeholder="" id="login_email">
            </div>
            <div class="form-group inner-label-holder"> 
                <small class="label" for="input">Enter Password</small>
                    <input type="password" class="form-control" name="password" placeholder="">
            </div>
            <div class="forget">
                <a href="#" id="forgetPassword">Forgot your password?</a>
            </div>
            <div class="form-group">
               <button type="button" id="loginUser" class="login-btn">Login</button>
            </div>
            <hr style="border-top: 2px dotted #eee;">
              <p class="text-center">Log in with</p>
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"><a type="button" class="linkedin-btn"><i class="fab fa-linkedin-square "></i>Log in with LinkedIn</a>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> <a type="button" href="{{ url('login/facebook') }}" class="facebook-btn"><i class="fab fa-facebook-square"></i>Log in with Facebook</a>

                    </div>
                </div>
                <hr style="border-top: 2px dotted #eee;">
              <p class="text-center"> New to LondCap? <a href="{{url('User/signupForm')}}" id="userSignup">Sign up</a></p>
          </div>
        </div>
        {{ Form::close() }}
      </div>
</div>
    <!----------------------------------------------------->
    <script>
        $(document).ready(function() {
            $('#list').click(function(event) {
                event.preventDefault();
                $('.cards .card').addClass('list-group-item');
            });
            $('#grid').click(function(event) {
                event.preventDefault();
                $('.cards .card').removeClass('list-group-item');
                $('.cards .card').addClass('grid-group-item');
            });
        });
    </script>
    <!-----------------------header-sticky-scripts---------------------------->
    <!-- <script>
        window.onscroll = function() {
            myFunction()
        };

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script> -->
    <script>

        function userAccountInfo(id){
            window.location.href="{{ url('User/userAccountInfo') }}";
        }


        function userProfileCompany(id){
            //window.location.href="{{ url('User/userProfileCompany/') }}/"+id;
            window.location.href="{{ url('User/editCompanyProfile/') }}/"+id;
        }
        function userProfileInvestor(id){
         //   window.location.href="{{ url('User/userProfileInvestor/') }}/"+id;
            window.location.href="{{ url('User/editInvestorProfile/') }}/"+id;
        }  

        

        $(document).ready(function(){
            $("#forgetPassword").click(function(){
                window.location.href = "{{ url('User/forgetPasswordForm')}}"
            });
            $("#home").click(function(){
                window.location.href = "{{ url('User/browse-investors')}}"
            });
            $("#signup").click(function(){
                window.location.href = "{{url('User/signup')}}"
            });            
            $("#logout").on('click',function(){
                window.location.href = "{{url('User/logout')}}"
            });
            $("#browse-investor").on('click',function(){
                window.location.href = "{{ url('User/browse-investors')}}"
            });
            $("#browse-company").on('click',function(){
                window.location.href = "{{ url('User/index')}}"
            });
            $("#userSignup").on('click',function(){
                window.location.href = "{{ url('User/signupForm')}}"
            });
            $("#contact").on('click',function(){
                window.location.href = "{{ url('User/contact')}}"
            });
            $("#about").on('click',function(){
                window.location.href = "{{ url('User/aboutus')}}"
            });
            $("#message").on('click',function(){
                window.location.href = "{{ url('User/message')}}"
            });
            $("#editProfile").on('click',function(){
                window.location.href = "{{ url('User/editcompanyProfile')}}"
            });
            $("#viewProfile").on('click',function(){
                window.location.href = "{{ url('User/viewcompanyProfile')}}"
            });
            $("#event").on("click",function(){
                window.location.href = "{{ url('User/events')}}"
            });

            $("#login-error").hide();
               $(".loginForm").validate({
                errorLabelContainer: "#login-error",
                wrapper: "div",
                  rules: {
                        email: {
                                required: true,
                                email: true,
                            },
                        password:{
                                required:true,
                            },
                        },
                    messages: {
                        email: 'Please enter your Email',
                        password:'Please enter password',
                    },
                submitHandler: function() {
                    $(".loginForm").submit();
                }
           });

            $("#loginUser").on('click',function(e){
                if($(".loginForm").valid()){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url:"{{ url('User/Login')}}",
                        data: $('.loginForm').serialize(),
                       success:function(data)
                        {
                            if(data.msg=='success') {

                                if(data.isEmailVerified == '1'){
                                    
                                    var usertype = data.data; 
                                    if(usertype.usertype=='1'){
                                        window.location = "{{ url('User/editCompanyProfile/')}}/"+usertype.id;
                                    }else if(usertype.usertype=='2' ){
                                        window.location = "{{ url('User/editInvestorProfile/')}}/"+usertype.id;
                                    }


                                }else{
                                    var usertype = data.data; 
                                    if(usertype.usertype=='1'){
                                        window.location = "{{ url('User/browse-investors')}}";
                                        
                                    }else if(usertype.usertype=='2' ){
                                        window.location = "{{ url('User/index')}}";
                                    }
                                }


                                } else if(data.msg == 'email_not_verified'){

                                    var u_mail = data.email;
                                    var d_msg = 'Your email is not verified.' 
                                    $("#login-error").text(d_msg);
                                    $("#login-error").parent().css('display','block');
                                    $("#login-error").show();
                                    $(".resendEmailDiv").show();

                                    } else{
                                    $("#login-error").parent().css('display','block');
                                    $("#login-error").text(data.msg);
                                    $("#login-error").show();
                                    $(".resendEmailDiv").hide();
                                }
                        }
                    });
                }
            });

            $(".resendEmail").on('click',function(e){
                var email_id = $('#login_email').val();
                console.log(email_id);
                $.ajax({
                    type: 'POST',
                    url:"{{ url('User/resendEmailCVerification')}}",
                    data: { "_token": "{{ csrf_token() }}", "email" : email_id },
                    success:function(data) {
                        if(data.success=='success') {
                            $("#login-error").html(data.msg);
                            $("#login-error").show();
                            $(".resendEmailDiv").hide();
                        }else{
                            $("#login-error").text(data.msg);
                            $("#login-error").show();
                        }
                    }
                });
            });
        })
    </script>