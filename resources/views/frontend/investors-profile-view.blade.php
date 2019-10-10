@extends('layouts.investor')
@section('content')
<link rel="stylesheet" href="{{ asset('css/chosen.min.css')}}">
<script src="{{ asset('js/chosen.jquery.js')}}"></script>
<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: 25px;
        color:black !important;
            font-size: 17px;
    }
    .smallLabel{
        z-index: 111
    }
button#menu1 {
    border-color: #d3dae2;
    width: 100%;
    border-radius: 5px;
    text-align: left;
    height: 60px;
    color: #afb9c5;
}
.focusclass .dropdown-toggle::after {
    display: inline-block;
    vertical-align: .255em;
    content: "";
    border-top: .3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;
    position: absolute;
    right: 10px;
    top: 15px;
}
.focusclass small.label {
    padding-left: 12px;
    padding-top: 10px;
    position: absolute;
    color: #afb9c5;
    font-size: 10px;
    text-transform: uppercase;
    top: 0;
    left: 0px;
}
.focusclass ul.dropdown-menu {
    width: 100% !important;
    padding:5px;
}
.dropdown-menu.show {
    display: block;
    max-height: 200px;
    overflow-y: scroll;
    border: none;
    box-shadow: 0px 0px 10px 0px rgba(183, 181, 181, 0.46);
}
.inner-label-holder > textarea.disData {
    height: auto;
    white-space: normal;
}
.details-div{
    min-height: 60px;
    padding: 16px 0px 0px 16px;
    border: 1px solid #d3dae2;
    border-radius: 5px;
    font-size: 16px;
}
    </style>
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
                            <h2>{{ @$data['user']['firstname'].' '.@$data['user']['lastname']}}</h2>
                            <h3>{{ @$data['jobTitle']}}</h3>
                           <h4>{{ @$data['firmName']}}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i>{{ @$data['country_data']['country_name'] .", ". @$data['city_data']['city_name']}}</h4>
                        </div>

                      
                        <?php if(session()->has('User')){?>
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

                

                        <?php } ?>
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
                                <?php if($see_contacts=='yes'){?>
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
                                <?php } ?>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>
                                        <input type="text" class="form-control" name="country" value="{{ @$data['country_data']['country_name']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>
                                        <input type="text" class="form-control" name="city" value="{{ @$data['city_data']['city_name']}}" readonly>
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
                                    <div class="form-group inner-label-holder"> 
                                        <small class="label" for="input">Slideshare URL</small>
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

                                        <textarea class="form-control" placeholder="" rows="4" readonly>{{ @$data['bioData']}}</textarea>

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
                                    <?php $invType = []; ?>
                                    @foreach($investorType as $in)
                                        <?php $invType[] = $in['typeInvestor']; ?>
                                    @endforeach
                                    <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                        <small class="label" for="input">Investor Type</small>
                                        <div class="details-div">{{ implode(', ',$invType) }}</div>
                                    </div>

                                    
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                 <?php $invstment = []; ?>
                                    @foreach($investmentType as $in)
                                    <?php $invstment[]=  $in['typeInvestment']; ?>
                                    @endforeach
                                    <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                        <small class="label" for="input">Investment Type</small>
                                        <div class="details-div">{{ implode(', ',$invstment) }}</div>
                                    </div>

                                    
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                 <?php $secn = []; foreach($sectorFocus as $se) {   ?>
                                    <?php $secn[] = $se['sectorName']; ?>
                                <?php  } ?>
                                 <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                    <small class="label" for="input">Sector Focus</small>
                                    <div class="details-div">{{ implode(', ',$secn) }}</div>
                                </div>


                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    
                                <?php $inds = []; foreach ($industryList as $inn) { ?>
                                    <?php $inds[] = $inn['industryName']; ?>
                                <?php }  ?>
                            <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                <small class="label" for="input">INDUSTRY FOCUS</small>
                                <div class="details-div">{{ implode(', ',$inds) }}</div>
                            </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    

                                <?php $rf = []; foreach ($regionFocus as $re) { ?>
                                    
                                    <?php $rf[]= $re['regionName']; ?>
                                <?php } ?>

                                <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                    <small class="label" for="input">Region Focus</small>
                                    <div class="details-div">{{ implode(', ',$rf) }}</div>
                                </div>

                                    
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                
                                <?php $cn = []; foreach ($countryFocus as $co) { ?>
                                    <?php $cn[] = $co["country_name"]; ?>
                                <?php } ?>
                                <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                    <small class="label" for="input">Country Focus</small>
                                    <div class="details-div">{{ implode(', ',$cn) }}</div>
                                </div>

                                    
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Assets Under Management $</small>
                                    <input type="text" class="form-control" name="assetUndermgmt" value="{{@$data['assetUndermgmt']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range From $</small>
                                     <input type="text" class="form-control" name="assetUndermgmt" value="{{$data['investmentRangefrm']}}" readonly>
                                 </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range to $</small>
                                       <input type="text" class="form-control" name="assetUndermgmt" value="{{$data['investmentRangeto']}}" readonly>
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

                            <div class="card-content social">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3>Share</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>

                            </div>


                            <div class="card-content social">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3>Report</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        
                                        <?php if(session()->has('User')){?>
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#requestModal3">
                                            <span class="pull-left">Report/Abuse</span></button>

                                        <?php } else { ?>
                                            <button class="btn btn-warning btn-sm " type="button" data-toggle="modal" data-target="#exampleModalLong">
                                                <span class="pull-left">Report/Abuse</span>
                                            </button>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </div>
   
            
        </div>

    <!-- request meeting/call -->
    <!-- Modal -->
            <!-- request meeting/call -->
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
              <div class="form-group">
            <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">$</span>
    </div>
    <input type="text" class="form-control" name="reserved_amount" id="reserved_amount" placeholder="Maximum Reservation $6,000,000">
  </div>
         </div>  
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
        <button type="submit" id="post2" class="login-btn">Submit</button>
        </div>


        </div>
        </div>
      {{Form::close()}}
    </div>
  </div>



  <div class="modal fade" id="requestModal3" role="dialog">
    <div class="modal-dialog">
    {{ Form::open(['class'=>'submitMessageReport','method'=>'post'])}}
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Report user as abuse
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 message-error"></div>
        <div class="modal-body">
        <div class="form-group"> <label>Description</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="{{$data['userid']}}">
        <textarea class="form-control" name="message" placeholder="Add you description here..." rows="4"></textarea>

        </div>
        </div>
        <div class="form-group">
        <button type="submit" id="report" class="login-btn">Report</button>
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

                                $('#requestModal1').modal("toggle");
                                swal({
                                    title: "Thank you for your meeting.",
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });

                            } else if(response.msg == 'meetinglimit'){
                                $('#requestModal1').modal("toggle");
                                swal({
                                    title: "Your free trail meeting limit has been exceeded. Please renew your account to get unlimited access.",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                        setTimeout(() => {
                                            window.location = "{{ url('/User/fundraising') }}";
                                        }, 1);
                                });
                                //alert('Your free trail meeting limit has been exceeded. Please renew your account to get unlimited access.');
                                
                            }else if(response.code == 2 && response.msg == 'notApproved'){
                                swal({
                                    title: "You can send messages / meeting requests once account is approved",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });
                            } else{
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
                        data: $(".submitMessage").serialize(),
                        success:function(response){
                            if(response.msg == "success"){
                                $(".message-error").text('Your message sent successfully');
                                $(".message-error").show();
                                $('#requestModal2').modal("toggle");
                                swal({
                                    title: "Thank you for your message.",
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });


                            }
                            // else if(response.msg=="limitover"){
                            //         window.location.href = "{{ url('User/MessageLimits')}}";
                            // } else {
                            //     $(".meeting-error").text(response.msg);
                            //     $('.meeting-error').show();
                            // }
                            else if(response.code == 2 && response.msg == 'msglimit'){
                                $('#requestModal2').modal("toggle");
                                swal({
                                    title: "Your free trail message limit has been exceeded. Please renew your account to get unlimited access.",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                        setTimeout(() => {
                                            window.location = "{{ url('/User/fundraising') }}";
                                        }, 1);
                                });
                            }else if(response.code == 2 && response.msg == 'notApproved'){
                                swal({
                                    title: "You can send messages / meeting requests once account is approved",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });
                            }
                        }
                    });
                }
            })

            $("#report").on('click',function(e){
                if($(".submitMessageReport").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"{{ url('User/reportAbuse')}}",
                        data:$(".submitMessageReport").serialize(),
                        success:function(response){
                            if(response.msg == "success"){
                                $(".message-error").text('Your message sent successfully');
                                $(".message-error").show();
                            }else {
                                $(".meeting-error").text(response.msg);
                                $('.meeting-error').show();
                            }
                        }
                    });
                }
            })
        });
        $('.chosen-select').prop('disabled', true).trigger("chosen:updated");    
                $(".chosen-select").chosen();

                   $('input#reserved_amount').keyup(function(e) {

              // skip for arrow keys
              if(e.which >= 37 && e.which <= 40 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return;

              // format number
              $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
              });
            });
    </script>
    </section>

   @endsection