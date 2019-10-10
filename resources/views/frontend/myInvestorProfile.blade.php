@extends('layouts.investor')
@section('content')
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
                            <h2>{{@$data['user']['firstname'].' '.@$data['user']['lastname'] }}</h2>
                            <h3>{{ @$data['jobTitle']}}</h3>
                           <h4>{{ @$data['firmName']}}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i>{{ $data['country_data']['country_name'] .", ". $data['city_data']['city_name']}}</h4>
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
                            <li class="breadcrumb-item active">Inverstor Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                    <div class="form-card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Personal and Investor Information</h3>
                                </div>
                            </div>
                         <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">First Name </small>
                                        <input type="text" class="form-control" name="firstname" value="{{ @$data['user']['firstname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last Name</small>
                                        <input type="text" class="form-control" name="lastname" value="{{ @$data['user']['lastname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Job Title</small>
                                        <input type="text" class="form-control" name="jobTitle" value="{{ @$data['jobTitle']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Invesor Firm Name</small>
                                        <input type="text" class="form-control" name="firmName" value="{{ @$data['firmName']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>
                                        <input type="email" class="form-control" name="email" value="{{ @$data['user']['email']}}" readonly>
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>
                                        <input type="text" class="form-control" name="phoneno" value="{{ @$data['user']['phone']}}" readonly>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>
                                        <input type="text" class="form-control" name="country" value="{{ $data['country_data']['country_name']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>
                                        <input type="text" class="form-control" name="city" value="{{ $data['city_data']['city_name']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor firm url</small>
                                        <input type="text" class="form-control" name="investorfirmUrl" value="{{ $data['investorfirmUrl']}}" readonly>
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor firm Fundraising URL</small>
                                        <input type="text" class="form-control" name="fundraisUrl" value="{{ $data['fundraisUrl']}}" readonly>
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor Firm Video</small>
                                        <input type="text" class="form-control" name="investorFirmvideo" value="{{ @$data['investorFirmvideo']}}" readonly>
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>
                                        <input type="email" class="form-control" name="slideshareUrl" value="{{ @$data['slideshareUrl']}}" readonly>
                                    </div>
                                </div>

                            </div>   
                        </div>

                    </div>
                    <div class="form-card">
                       
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                   <h3>Investor Profile</h3>
                                </div>
                            </div>
                            <div class="row">
                                 
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <p>Investor Firm Tagline</p>
                                    <h6>
                                    <input type="text" class="form-control" name="firmTagline" value="{{ @$data['firmTagline']}}" readonly></h6>
                                </div>
                                
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                         
                                    <p>Investor Firm Profile</p>
                                            <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" placeholder="" rows="4" readonly>{{ @$data['profileText']}}</textarea>

                                    </div>
                                </div>
                              
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                  <p>Short Investor Biography</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" placeholder="" rows="4" readonly>{{ @$data['profileText']}}</textarea>

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
                                    <h3>Investor Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="form-group inner-label-holder"> <small class="label" for="input">INVESTOR TYPE</small>
                                        <input type="text" class="form-control" name="investorFirmvideo" value="{{ @$data['investor_type']['typeInvestor']}}" readonly>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                      <div class="form-group inner-label-holder"> <small class="label" for="input">INVESTMENT TYPE</small>
                                        <input type="text" class="form-control" name="investorFirmvideo" value="{{ @$data['investment_type']['typeInvestment']}}" readonly>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                       <div class="form-group inner-label-holder"> <small class="label" for="input">SECTOR FOCUS</small>
                                        <input type="text" class="form-control" name="investorFirmvideo" value="{{ @$data['sector_type']['sectorName']}}" readonly>
                                    </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder textarea"> <small class="label" for="input"></small>

                                        <textarea class="form-control" placeholder="" rows="3" readonly>{{ @$data['industry']['sectorName']}}</textarea>

                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Region Focus</small>

                                <input type="text" class="form-control" name="regionFocus" value="{{@$data['firstname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder textarea"> <small class="label" for="input">Country Focus</small>
                                        <textarea class="form-control" placeholder="" rows="3" readonly></textarea>
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Assets Under Management $</small>
                                    <input type="text" class="form-control" name="assetUndermgmt" value="{{@$data['assetUndermgmt']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range From $</small>
                                     <input type="text" class="form-control" name="investmentRangefrm" id="investmentRangefrm" value="{{$data['investmentRangefrm']}}" readonly>
                                 </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range to $</small>
                                       <input type="text" class="form-control" name="investmentRangeto" id="investmentRangeto" value="{{$data['investmentRangeto']}}" readonly>
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
                                  <iframe width="100%" height="500px" src="{{$t}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
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
                                  <small class="label" for="input">LinkedIn URL</small>
                                  <input type="text" class="form-control" name="linkedinUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['linkedinUrl']}}" readonly>
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                  </div>
                                  <small class="label" for="input">Facebook URL</small>
                                  <input type="text" class="form-control" name="fbUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{ $data['fbUrl']}}" readonly>
                                </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                  </div>
                                  <small class="label" for="input">Twitter URL</small>
                                  <input type="text" class="form-control" name="twitterUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['twitterUrl']}}" readonly>
                                </div>
                                </div>
                                        

                            </div>


                        </div>

                    </div>

                </div>
            </div>
   
            
        </div>

    <!---------------------------------------request meeting/call
 -------------->
    <!-- Modal -->
            <!---------------------------------------request meeting/call
 -------------->
    <!-- Modal -->
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
                            }else{
                                    $(".meeting-error").text('Sorry !! Try Agin Later');
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
        });
    </script>
    </section>

   @endsection