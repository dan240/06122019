@extends('layouts.home')
@section('content')

    <!------------------------------------------------------>
    <section class="content-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($data['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('uploads/images/'.$data['banner_name']) }}');"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="#">
                                <?php if(!empty($data['image_name'])){?>
                                <img id="displayimage" src="{{ asset('uploads/images/'.$data['image_name'])}}" alt="" title="">
                                <?php } else{ ?>
                                    <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <?php } ?>

                            </a>
                        </div>
                        <div class="profile-name">
                            <h2>{{ $data['user']['firstname'] ." ".$data['user']['lastname']}}</h2>
                            <h3>{{ $data['jobTitle'] }}</h3>
                           <h4>{{ $data['companyName'] }}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i> {{ $data['country_data']['country_name'] .", ". $data['city_data']['city_name']  }}</h4>
                        </div>
                        <!-- <?php if(session()->has('User')){?>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#requestModal1">
                            <i class="fa fa-phone fa-flip-horizontal pull-left"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#requestModal2">
                            <i class="fas fa-comments pull-left"></i>
                            <span class="pull-left">Message</span></button>
                        <?php } else { ?>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fa fa-phone fa-flip-horizontal pull-left"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fas fa-comments pull-left"></i>
                            <span class="pull-left">Message</span></button>

                        <?php } ?> -->
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Company Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!----------------------------------------->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                    <div class="form-card">

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Personal and Company Information</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">FIRST NAME </small>

                                        <input type="text" class="form-control" name="fname" value = "{{ $data['fname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last NAME</small>

                                        <input type="text" class="form-control"  name="lname" value="{{ $data['lname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Job Title</small>

                                        <input type="text" class="form-control"  name="job_title" value="{{$data['jobTitle']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Name</small>

                                        <input type="text" class="form-control"  name="cp_name" value="{{$data['companyName']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>

                                        <input type="email" class="form-control" name="email" value="{{$data['email']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>

                                        <input type="text" class="form-control" name="phoneno" value="{{ $data['phoneno']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>

                                        <input type="text" class="form-control" name="country" value="{{$data['country_data']['country_name']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>

                                        <input type="text" class="form-control" name="city" value="{{$data['city_data']['city_name']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company url</small>

                                        <input type="email" class="form-control" name="cp_url" value="{{ $data['companyUrl']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Fundraising URL</small>

                                        <input type="email" class="form-control" name="fr_url" value="{{ @$data['fundraisUrl']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Video</small>

                                        <input type="email" class="form-control" name="fv_url" value="{{ @$data['investorFirmvideo']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>

                                        <input type="email" class="form-control" name="sd_url"  value="{{ $data['slideshareUrl']}}" readonly>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="form-card">

                        <div class="card-content">
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Profile</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <p>Company Tagline</p>
                                    <h6>{{ $data['companyTagline'] }}</h6>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    <p>Company Profile</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" placeholder="" rows="4" readonly>{{ @$data['profileText'] }}</textarea>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Personal Biography</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" placeholder="" rows="4" readonly>{{ @$data['personalBio'] }}</textarea>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> 
                                       <small class="label" for="input">Type Company</small>
                                            <input type="email" class="form-control"  value="{{ @$data['company_type']['typeCompanies'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder">
                                    <small class="label" for="input">Funding Type</small>
                                    <input type="email" class="form-control" name="sd_url"  value="{{ @$data['type_funding']['typeFunding'] }}" readonly> 


                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder">  <small class="label" for="input">Sector Type</small>
                                        <input type="email" class="form-control" name="sd_url"  value="{{ @$data['sector']['sectorName'] }}" readonly> 
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Industry</small>
                                        <input type="email" class="form-control" name="sd_url"  value="{{ @$data['industry']['industryName'] }}" readonly> 
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="form-card">

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Fundraising Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Amount Raised $</small>

                                        <input type="text" class="form-control" name="amt_raised" value="{{ @$data['ammountRaised'] }}" readonly>

                                    </div>
                                </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Funding Goal $</small>

                                        <input type="text" class="form-control" name="fd_goal" value="{{ @$data['fundingGoal'] }}" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Minimum Reservation $</small>

                                        <input type="text" class="form-control" name="min_reserve" value="{{ @$data['minReservation'] }} " readonly>

                                    </div>
                                </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Maximum Reservation $</small>

                                        <input type="text" class="form-control" name="max_reserve" value="{{ @$data['maxReservation'] }} " readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">% Equity</small>

                                        <input type="text" class="form-control" name="equity" value="{{ @$data['equity'] }}" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Open Date</small>
                                        <input type="text" class="form-control" name="open_date" value="{{ @$data['openDate'] }}" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Closing Date</small>
                                        <input type="text" class="form-control" name="close_date" value="{{ @$data['closingDate'] }}" readonly>

                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                    <div class="form-card">

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Video</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <?php $t = preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "//www.youtube.com/embed/$2",
        $data['investorFirmvideo']
    ); ?>
                                    <iframe width="100%" height="500px" src="{{ @$t }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">

                        <div class="card-content social">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Social Media</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    
                                    <div class="input-group form-group inner-label-holder">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fab fa-linkedin-in blue"></i></span>
                                      </div>
                                      <small class="label" for="input">LinkedIn URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['linkedinUrl'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                              </div>
                              <small class="label" for="input">Facebook URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['fbUrl'] }}" readonly>
                            </div>
                                </div>
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                              </div>
                              <small class="label" for="input">Twitter URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['twitterUrl'] }}" readonly>
                            </div>
                                </div>
                      
                            </div>

                        </div>

                    </div>

                </div>
                
            </div>
        </div>
  </section>
  <div class="modal fade" id="requestModal1" role="dialog">
    <div class="modal-dialog">
    {{ Form::open(['class'=>'submitRequest','method'=>'post'])}}
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">THANK YOU FOR YOUR INTEREST
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 meeting-error"></div>
        <div class="modal-body">
        <div class="form-group"> <label>Add Comments</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="{{$data['userid']}}">
        <textarea class="form-control" name="message" placeholder="Add you comments here..." rows="4"></textarea>

        </div>
        </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <input type="radio" id="test1" name="meeting" value="1">
                    <label for="test1">Meet During Conference</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test2" name="meeting" value="2">
                    <label for="test2">Conference Call</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test3" name="meeting" value="3">
                    <label for="test3">Meet in Investors Office</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test4" name="meeting" value="4">
                    <label for="test4">Meet in Fundraiser Office</label>
                    </div>
                </div>
            </div>
        <div class="form-group">
        <button type="submit" id="post1" class="login-btn">Submit</button>
        </div>


        </div>
        </div>
      {{Form::close()}}
    </div>
  </div>
  <div class="modal fade" id="requestModal2" role="dialog">
    <div class="modal-dialog">
    {{ Form::open(['class'=>'submitMessage','method'=>'post'])}}
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">THANK YOU FOR YOUR INTEREST
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 message-error"></div>
        <div class="modal-body">
        <div class="form-group"> <label>Add Comments</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="{{$data['userid']}}">
        <textarea class="form-control" name="message" placeholder="Add you comments here..." rows="4"></textarea>

        </div>
        </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <input type="radio" id="test5" name="meeting" value="1">
                    <label for="test5">Meet During Conference</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test6" name="meeting" value="2">
                    <label for="test6">Conference Call</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test7" name="meeting" value="3">
                    <label for="test7">Meet in Investors Office</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test8" name="meeting" value="4">
                    <label for="test8">Meet in Fundraiser Office</label>
                    </div>
                </div>
            </div>
        <div class="form-group">
        <button type="submit" id="post2" class="login-btn">Submit</button>
        </div>


        </div>
        </div>
      {{Form::close()}}
    </div>
  </div>
  
    <script>
        $(document).ready(function(){
            $(".meeting-error").hide();
            $(".message-error").hide();
            $(".submitRequest").validate({
                errorLabelContainer: ".meeting-error",
                wrapper: "li",
                  rules: {
                        message: {required:true},
                        meeting: {required:true},
                    },
                    
                    messages: {
                        message:'Message should not be empty!!',
                        meeting: 'Please select an option',
                    },
                submitHandler: function() {
                    $(".submitRequest").submit();
                }
           });

            $(".submitMessage").validate({
                errorLabelContainer: ".message-error",
                wrapper: "li",
                  rules: {
                        message: {required:true},
                        meeting: {required:true},
                    },
                    
                    messages: {
                        message:'Message should not be empty!!',
                        meeting: 'Please select an option',
                    },
                submitHandler: function() {
                    $(".submitMessage").submit();
                }
           });
            $("#post1").on('click',function(e){
                if($(".submitRequest").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"{{ url('User/requestMeeting')}}",
                        data:$(".submitRequest").serialize(),
                        success:function(response){
                            if(response.msg == "success"){
                                $(".meeting-error").text('Your request sent successfully');
                                $('.meeting-error').show();
                            }else if(response.msg=="limitover"){
                                    window.location.href = "{{ url('User/MessageLimits')}}";
                            } else {
                                $(".meeting-error").text(response.msg);
                                $('.meeting-error').show();
                            }
                        }
                    });
                }
            })

            $("#post2").on('click',function(e){
                if($(".submitMessage").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"{{ url('User/requestMessage')}}",
                        data:$(".submitMessage").serialize(),
                        success:function(response){
                            if(response.msg == "success"){
                                $(".message-error").text('Your message sent successfully');
                                $(".message-error").show();
                            }else{
                                $(".message-error").text(response.msg);
                                $(".message-error").show();
                            }
                        }
                    });
                }
            })
        });
    </script>
    @endsection