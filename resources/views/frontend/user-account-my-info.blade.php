@extends('layouts.home')
@section('content')
<section class="inner-pages">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <div class="sidebar-menu">
                    <ul>
                        <li class="active"><a href="#myinfo">My Info</a></li>
                        <li><a href="#password">Password</a></li>
                        <li><a href="#member">Membership</a></li>
                        
                        <a href="javascript:;" class="btn btn-danger btn-block" id="deleteComp">
                            Delete Account
                        </a>

                        <p class="text-danger">You can change your account status to <strong>NOT LOOKING FOR INVESTMENT</strong>, and decide
                            later if you want to activate, instead of deleting your account.</p>

                        @if($data['usertype'] == '1')
                        <a href="javascript:;" class="btn btn-success btn-block" id="changeToNoInvestment">
                            Not Looking For Invesment
                        </a>
                        @else
                        <a href="javascript:;" class="btn btn-success btn-block" id="changeToNoInvestmentInv">
                            Not Looking For Invesment
                        </a>
                        @endif

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
                            {{Form::open(['class'=>'form-horizontal myInfo','method'=>'post'])}}
                            <div class="form-group inner-label-holder  col-md-6 "> <small class="label"
                                    for="input">First Name </small>
                                <input type="text" class="form-control" name="firstname"
                                    value="{{ @$data['firstname']}}">
                            </div>
                            <div class="form-group inner-label-holder  col-md-6 "> <small class="label"
                                    for="input">Last Name </small>
                                <input type="text" class="form-control" name="lastname"
                                    value="{{ @$data['lastname']}}">
                            </div>
                            <div class="form-group inner-label-holder  col-md-6 "> <small class="label"
                                    for="input">Email </small>
                                <input type="email" class="form-control" name="email" value="{{ @$data['email']}}">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="email_notifications"
                                        name="email_notifications"
                                        value="1"
                                        @if ($data['email_notifications'] == 'yes') checked @endif
                                    >
                                    <label class="custom-control-label" for="email_notifications" style="font-size: 16px;">Enable Email Notifications</label>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                <a href="javascript:;" id="save" class="btn btn-primary">Save</a>
                            </div>

                            {{ Form::close()}}
                        </div>
                    </div>
                </div>

                
                <div id="password">
                    <div class="form-card">
                        <div class="card-header">
                            <h4 class="title">Password</h4>
                        </div>
                        <div class="card-content">
                            <p><a href="{{url('User/ChangePasswordForm')}}" class="btn btn-primary"> Change
                                    Password</a></p>
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
                                    <a href="{{ url('User/fundraising')}}" class="btn btn-primary">Change Plan</a>
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
    $(document).ready(function () {
        $('.myInfo').find('input').attr('disabled', 'disabled');
        $(".personalData").on('click', function () {
            $('.myInfo').find('input').removeAttr('disabled');
        });

        $(".myInfo").validate({
            errorClass: "my-error-class",
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true
                },
            },
            messages: {
                firstname: 'First name should not be empty!',
                lastname: 'Last name should not be empty!',
                email: 'Email should not be empty!',
            },
            submitHandler: function () {
                $(".myInfo").submit();
            }
        });

        $("#save").on('click', function (e) {
            if ($(".myInfo").valid()) {
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "{{ url('User/editUserInfo')}}",
                    data: $(".myInfo").serialize(),
                    success: function (response) {
                        $("#msg-response").show();
                        $(".editCompany").scrollTop();
                        if (response.msg == 'success') {
                            alert('Info added successfully');
                            $(".myInfo").scrollTop();
                        } else {
                            $(".myInfo").scrollTop();
                        }
                    }
                });
            } else {
                window.scrollTo(0, 200);
                return false;
            }
        });
        $("#removeAct").on('click', function () {
            $.ajax({
                url: "{{url('User/deleteAccount')}}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}"
                },
                success: function (response) {
                    if (response.msg) {
                        window.location.href = "{{url('User/logout')}}";
                        alert("Account should be removed permanently after 15 days");

                    }
                }
            });
        });

        $('#changeToNoInvestment').click(function () {
            $.ajax({
                method: "GET",
                url: "{{ url('User/changeToNoInvestment')}}",
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.msg == 'success') {
                        $('.error').html(
                            '<div class="alert alert-success">Funding type changed.</div>'
                            );
                    } else {
                        $('.error').html(
                            '<div class="alert alert-danger">Funding type not changed. Something went wrong !</div>'
                            );
                    }
                }
            });
        });
        $('#changeToNoInvestmentInv').click(function () {
            $.ajax({
                method: "GET",
                url: "{{ url('User/changeToNoInvestmentInv')}}",
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.msg == 'success') {
                        $('.error').html(
                            '<div class="alert alert-success">Investment type changed.</div>'
                            );
                    } else {
                        $('.error').html(
                            '<div class="alert alert-danger">Investment type not changed. Something went wrong !</div>'
                            );
                    }
                }
            });
        });


        $('#deleteComp').click(function () {
            $.ajax({
                method: "GET",
                url: "{{ url('User/deleteCompany')}}",
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.msg == 'success') {
                        location.reload();
                    } else {
                        $('#noInvErr').html('Something Went Wrong !');
                    }
                }
            });
        });

    });
</script>
@endsection