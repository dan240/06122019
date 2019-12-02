@extends('layouts.investor')
@section('content')
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
#country_chosen,#city_chosen{ height: 60px; padding : 10px; border: 1px solid #d3dae2; }
#country_chosen > .chosen-single,#city_chosen > .chosen-single{ margin-top: 16px!important; }

    </style>
 
        {{ Form::open(['class'=>'editInvestors','method'=>'post','enctype' => 'multipart/form-data','novalidate' => ''])}}
        <section class="content-box">
        <div class="container">
            <div id="investor-msg"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($data['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('public/uploads/images/'.$data['banner_name']) }}');"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="javascript::">
                                <?php if(!empty($data['image_name'])){?>
                                <img id="displayimage" src="{{ asset('public/uploads/images/'.$data['image_name'])}}" alt="" title="">
                                <?php } else{ ?>
                                    <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <?php } ?>
                                <div class="changeprofile">
                                    <label for="upload-photo"><i class="fas fa-camera"></i></label>
                                    <input type="file" name="photo" id="upload-photo"></div>
                            </a>
                        </div>
                        <div class="profile-name">
                            <h2>{{ @$data['user']['firstname'].' '.@$data['user']['lastname']}}</h2>
                            <h3>{{ @$data['jobTitle'] }}</h3>
                            <h4>{{ @$data['firmName'] }}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i>{{ @$data['country_data']['country_name'] .", ". @$data['city_data']['city_name'] }}</h4>
                        </div>
                        <div class="change-cover">
                            <!--<a href="#" class="btn btn-edit btn-change">Change</a>-->
                             <div class="btn btn-edit btn-change">
                                <label for="upload-photo"><i class="fa fa-pen"></i></label>
                                <input type="file" name="banner" id="upload-cover" /></div>
                                <input type="hidden" name="FilePayload" id="FilePayload" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <?php $id = Session::get('User.id'); $usertype = Session::get('User.usertype');?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript::">Home</a></li>
                            <li class="breadcrumb-item active">Inverstor Profile</li>
                            <li class="breadcrumb-item "><a href="javascript:;" onclick="userInvestorIntrestedIn('{{$id}}')">Express Interested (Follower) {{ app('App\Http\Controllers\UserController')->MeExpressedIn() }}</a></li>
                            <li class="breadcrumb-item "><a href="javascript:;" onclick="userInvestorExpressed('{{$id}}')">Interested In (Following) {{ app('App\Http\Controllers\UserController')->MeInterestedIn() }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

<!-- -->
    <section>
        <div class="container frm_disabled">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                    <div class="form-card">
                        <a href="javascript::" class="btn-edit" id="personalDetail"><i class="fa fa-pen"></i></a>
                        <div class="card-content personalDetailsActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Personal and Investor Information</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">First Name </small>

                                        <input type="text" class="form-control" value="{{@$data['user']['firstname']}}" name="firstname" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Last Name</small>

                                        <input type="text" class="form-control" value="{{@$data['user']['lastname']}}" name="lastname" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Job Title</small>

                                        <input type="text" class="form-control" value="{{@$data['jobTitle']}}" name="jobTitle" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Invesor Firm Name</small>

                                        <input type="text" class="form-control" value="{{@$data['firmName']}}" name="firmName">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Email</small>

                                        <input type="email" class="form-control" value="{{@$data['email']}}" name="email">
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Phone Number</small>

                                        <input type="text" id="phoneno" class="form-control" value="{{@$data['phoneno']}}" name="phoneno">
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    
                                    <div class="form-group inner-label-holder multiselect"> 
                                        <small class="label smallLabel" for="input">Select Country</small>

                                        <select name="country" id="country" class="chosen-select">
                                            <option value="0">--Select Country--</option>
                                            @foreach($country as $con)
                                                <option value="{{ $con['id'] }}" <?php if(@$data['country'] == @$con['id']) echo "selected"; ?>>{{ @$con['country_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder multiselect"> 
                                        <small class="label smallLabel" for="input">City</small>
                                        <select id="city" name="city" class="chosen-select chosen-city">
                                            @foreach($city as $con)
                                                <option value="{{ $con['id'] }}" <?php if(@$data['city'] == @$con['id']) echo "selected"; ?>>{{ @$con['city_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor firm url</small>

                                        <input type="text" class="form-control" value="{{@$data['investorfirmUrl']}}" name="investorfirmUrl">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor firm Fundraising URL</small>

                                        <input type="text" class="form-control" value="{{@$data['fundraisUrl']}}" name="fundraisUrl">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor Firm Video</small>

                                        <input type="text" class="form-control" value="{{@$data['investorFirmvideo']}}" name="investorFirmvideo">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Slideshare URL</small>

                                        <input type="email" class="form-control" value="{{@$data['slideshareUrl']}}" name="slideshareUrl">
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                    <div class="form-card custom-editbtn">
                        <a href="javascript::" class="btn-edit" id="investorProfile"><i class="fa fa-pen"></i></a>
                        <div class="card-content investorProfileActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                   <h3>Investor Profile</h3>
                                </div>
                            </div>
                            <div class="row">
                                 
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <p>Investor Firm Tagline</p>
                                    <h6><input type="text" class="form-control" id="textlimit" value="{{@$data['firmTagline']}}" name="firmTagline"></h6>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Investor Firm Profile</p>
                                        <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="profileText" rows="4">{{@$data['profileText']}}</textarea>
                                    </div>
                                </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                  <p>Short Investor Biography</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="bioData" rows="4">{{@$data['bioData']}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">
                        <a href="javascript::" class="btn-edit" id="investorDetail"><i class="fa fa-pen"></i></a> 
                        <div class="card-content investorDetailsActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Investor Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect"> <small class="label smallLabel" for="input">Investor type</small>
                                        <select name="investorType[]" class="chosen-select" multiple>
                                            <option value="">--Select Investor Type--</option>
                                            <option value="0">Select All</option>
                                            <?php $invtrType = explode(",",$data['investorType']); ?>
                                            @foreach($investor as $in)
                                                <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $invtrType)) echo "selected"; ?>>{{ $in['typeInvestor'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Investment type</small>
                                        <select name="investmentType[]" class="chosen-select" multiple>
                                            <option value="">--Select Investment Type--</option>
                                            <option value="0">Select All</option>
                                            <?php $invType = explode(",",$data['investmentType']); ?>
                                            @foreach($investment as $in)
                                                <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $invType)){echo "selected";}?>>{{ $in['typeInvestment'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Sector Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Sector Focus" tabindex="4" name="sectorFocus[]" id="multiSector">
                                                <option value="">---Select Sector---</option>
                                                <option value="0">Select All</option>
                                                <?php $sec = explode(",",$data['sectorFocus']);
                                                foreach($sector as $se) {   
                                                ?>
                                                        <option value="{{ $se['id'] }}" <?php if(in_array($se['id'], $sec)){echo "selected";}?>>{{ $se['sectorName']}}</option>
                                                <?php  } ?>
                                        </select> 
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Industry Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Industry Focus" tabindex="4" name="industryFocus[]" id="industryFocus">
                                                <option value="">---Select Industry---</option>
                                                <option value="0">Select All</option>
                                                <?php
                                                    $ind = explode(",", $data['industryFocus']);

                                                    foreach ($industry as $in) {
                                                ?>
                                                        <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $ind)){ echo "selected"; }?>>{{ $in['industryName']}}</option>
                                                <?php }  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Region Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Region Focus" tabindex="4" name="regionFocus[]" id="regionFocus">
                                            <option value="">---Select Region---</option>
                                            <option value="0">Select All</option>
                                            <?php $in = explode(",",@$data['regionFocus']);
                                                
                                                    foreach ($region as $re) { ?>
                                                    <option value="{{ $re['id'] }}" <?php if(in_array($re['id'] , $in)){ echo "selected"; } ?>>{{ $re['regionName']}}</option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Country Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Country Focus" tabindex="4" name="countryFocus[]" id="countryFocus">
                                                <option value="">---Select Country---</option>
                                                <option value="0">Select All</option>
                                                <?php
                                                    $cont = explode(",", $data['countryFocus']);

                                                    foreach ($regionFocusCountries as $region_focus_country) {
                                                ?>
                                                        <option value="{{ $region_focus_country['id'] }}" <?php if(in_array($region_focus_country['id'] , $cont)){ echo "selected"; } ?>>{{ $region_focus_country["country_name"]}}</option>
                                                <?php  } ?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Assets Under Management $</small>

                                        <input type="text" class="form-control" name="assetUndermgmt" id="assetUndermgmt" value="{{@$data['assetUndermgmt']}}">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investment Range From $</small>

                                        <input type="text" class="form-control" id="investmentRangefrm" name="investmentRangefrm" value="{{ $data['investmentRangefrm']}}">

                                    </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investment Range to $</small>

                                        <input type="text" class="form-control" name="investmentRangeto" id="investmentRangeto" value="{{$data['investmentRangeto']}}">

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
                        <!-- <a href="javascript::" class="btn-edit"><i class="fa fa-pen"></i></a> -->
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                   <h3>Video</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <?php
                                    if ($data['investorFirmvideo'] && stripos($data['investorFirmvideo'], "https://www.youtube.com") !== false) {
                                        $t = preg_replace(
                                            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                                            "//www.youtube.com/embed/$2",
                                            $data['investorFirmvideo']
                                        );
                                ?>
                                    <iframe width="100%" height="500px" src="{{$t}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                <?php } ?>
                                </div>
                         
                                

                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">
                       <a href="javascript::" class="btn-edit" id="socilMedia"><i class="fa fa-pen"></i></a>
                        <div class="card-content social makeactivesocial">
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
                                  <small class="label smallLabel" for="input">LinkedIn URL</small><input type="text" class="form-control" name="linkedinUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{@$data['linkedinUrl']}}">
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                  </div>
                                  <small class="label smallLabel" for="input">Facebook URL</small><input type="text" class="form-control" name="fbUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{@$data['fbUrl']}}">
                                </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                  </div>
                                  <small class="label smallLabel" for="input">Twitter URL</small><input type="text" class="form-control" name="twitterUrl" aria-label="Username" aria-describedby="basic-addon1" value="{{@$data['twitterUrl']}}">
                                </div>
                                </div>
                                        

                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Account </h3>
                                </div>
                            </div>
                            


                        </div>

                    </div>

                </div>
            </div>
            <div class="button_div">   <div class="row">
             
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                             
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                              <div class=" signup_btn"><a id="save" class="nav-link" href="javascript::">Save</a></div>
                                </div>
                                  <!--    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                              <div class="signup_btn"><a id="publish" class="nav-link" href="#">Publish</a></div>
                                </div> -->             
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        </section>
        {{ Form::close()}}
    

<script src="{{ url('js/jquery.validate.min.js')}}"></script>
<script>
    $(document).ready(function() {
        @if(!Session::has('email_verified'))
            $('.frm_disabled').find('input').attr('disabled','disabled');
            $('.frm_disabled').find('select').attr('disabled','disabled');
            $('.frm_disabled').find('textarea').attr('disabled','disabled');
        @else
            $(".personalDetailsActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.personalDetailsActive').find('.multiselect').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.makeactivesocial').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.investorProfileActive').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.fundraisDetailActive').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
        @endif    

        $("#personalDetail").on('click',function(){
            /*$(".personalDetailsActive").removeAttr('disabled');*/
            $(".personalDetailsActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.personalDetailsActive').find('.chosen-select').removeAttr('disabled').trigger("chosen:updated");
            $('.personalDetailsActive').find('.multiselect').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.personalDetailsActive').find('input').removeAttr('disabled');
            $('.personalDetailsActive').find('select').removeAttr('disabled');
            $('.personalDetailsActive').find('textarea').removeAttr('disabled');                
        });

        $("#socilMedia").on('click',function(){
            /*$(".makeactivesocial").removeAttr('disabled');*/
            $('.makeactivesocial').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.makeactivesocial').find('input').removeAttr('disabled');
            $('.makeactivesocial').find('select').removeAttr('disabled');
            $('.makeactivesocial').find('textarea').removeAttr('disabled');
        });

        $("#investorProfile").on('click',function(){
            $('.investorProfileActive').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.investorProfileActive').find('input').removeAttr('disabled');
            $('.investorProfileActive').find('select').removeAttr('disabled');
            $('.investorProfileActive').find('textarea').removeAttr('disabled');

        });
        $("#fundraisingDetail").on('click',function(){
            $('.fundraisDetailActive').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.fundraisDetailActive').find('input').removeAttr('disabled');
            $('.fundraisDetailActive').find('select').removeAttr('disabled');
            $('.fundraisDetailActive').find('textarea').removeAttr('disabled');
        });

        function readURL(input) {
            if(input.files.length>0 && input.files[0]){
                var reader=new FileReader();
                reader.onload = function(e) {
                    $('#displayimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
                }
        }
        var formData = new FormData();
        /*$("input[name='photo']").change(function(input) {
            readURL(this);
        });*/

        $('#upload-cover').change(function () {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                formData.append("img",file);
                $('#bg-image').css('background-image', 'url("' + reader.result + '")');
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
            }
        });

        $("#investor-msg").hide();
        
        $(".editInvestors").validate({
            //errorLabelContainer: "#msg",
            //wrapper: "li",
            errorClass: "my-error-class",
            ignore: [],
            rules: {
                    firstname: { required: true},
                    lastname: { required: true},
                    //firmName: { required: true},
                    //jobTitle: { required: true},
                    cp_url: { required: true},
                    "investmentType[]": { required: true},
                    firmTagline: { required: true},
                    "investorType[]": { required: true},
                    cp_type: { required: true},
                    profileText: { required: true},
                    sector: { required: true},
                    industry: { required: true},
                    amt_raised: { required: true},
                    fd_goal: { required: true},
                    //phoneno: { required: true},
                    city: { required: true},
                    country: { required: true},
                    "countryFocus[]": { required: true},
                    "regionFocus[]": { required: true},
                    bioData:{required: true},  
                    "sectorFocus[]":{required:true},
                    "industryFocus[]":{required:true},
                    investmentRangefrm: { required: true},
                    investmentRangeto: { required: true},
                    assetUndermgmt: { required: true }
                },
                messages: {
                    firstname: 'First name should not be empty!',
                    lastname: 'Last name should not be empty!',
                    firmName: 'Firm name should not be empty!',
                    jobTitle: 'Job title should not be empty!',
                    cp_url: 'Company url should not be empty!',
                    "investorType[]": 'Investor type Should Not be Empty!',
                    firmTagline: 'Firm tagline should not be empty!',
                    "investmentType[]": 'Investment type should Not be empty!',
                    cp_type: 'Company type should not be empty!',
                    profileText: 'Profile text should not be empty!',
                    sector: 'Sector should not be empty!',
                    "industryFocus[]": 'Industry should not be empty!',
                    amt_raised: 'Ammount raised should not be empty!',
                    fd_goal: 'Fund goal should not be empty!',
                    phoneno: 'Phone number should not be empty!',
                    city: 'City should not be empty!',
                    country: 'Country name should not be empty!',
                    "countryFocus[]": 'Country focus should not be empty!',
                    "regionFocus[]": 'Region focus should not be empty!',
                    assetUndermgmt:'Assest Under Management should not empty',
                    investmentRangefrm:'Investment range from should not empty',
                    investmentRangeto:'Investment range to should not empty',
                    bioData:'Investor bio data should not empty',
                    "sectorFocus[]":'Sector focus sholud not empty',
                },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $("#save").on('click',function(e) {
            if($(".editInvestors").valid()){
                var formData = new FormData($('.editInvestors')[0]);
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/saveInvestorProfile')}}",
                    data:formData,
                    cache: false,
                    processData: false, 
                    contentType: false,
                    success:function(response) {
                        if (response.msg=='success') {   
                            $("#investor-msg").show();

                            $('input,select').css({
                                'box-shadow' : 'none',
                                'border-color' : '#d3dae2'
                            })

                            $('.chosen-choices').css({
                                'box-shadow' : 'none',
                                'border-color' : '#d3dae2'
                            })
                            
                            swal({
                                title: "Your profile has been updated successfully",
                                text: "",
                                type: "success",
                                showCancelButton: false,
                                showConfirmButton : true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Close!",
                                },function(){
                                    setTimeout(() => {
                                        window.scrollTo(0,0);
                                    }, 1);
                            });

                            $('#investor-msg').html('<div class="alert alert-success">Data Saved Successfully.</div>');
                            $('.personalDetailsActive').find('input').attr('disabled', true);
                            $('.personalDetailsActive').find('select').attr('disabled', true);
                            $('.personalDetailsActive').find('textarea').attr('disabled', true); 
                            $('.makeactivesocial').find('input').attr('disabled', true);
                            $('.makeactivesocial').find('select').attr('disabled', true);
                            $('.makeactivesocial').find('textarea').attr('disabled', true);
                            $('.investorProfileActive').find('input').attr('disabled', true);
                            $('.investorProfileActive').find('select').attr('disabled', true);
                            $('.investorProfileActive').find('textarea').attr('disabled', true);
                            $('.fundraisDetailActive').find('input').attr('disabled', true);
                            $('.fundraisDetailActive').find('select').attr('disabled', true);
                            $('.fundraisDetailActive').find('textarea').attr('disabled', true);
                            $('.chosen-select').attr('disabled', true).trigger("chosen:updated");
                            $('.personalDetailsActive').find('.multiselect').css({
                                'box-shadow' : 'none',
                                'border' : 'none'
                            });
                        } else {
                            swal({
                                title: "Invalid Values",
                                text: response.msg,
                                type: "error",
                                showCancelButton: false,
                                showConfirmButton : true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Okay",
                            });
                        }
                    }
                });
            } else {  
                swal({
                    title: "Fill all necessary fields, otherwise profile change will not be saved",
                    text: "",
                    type: "error",
                    showCancelButton: false,
                    showConfirmButton : true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ok!",
                    },function(){
                        setTimeout(() => {
                            window.scrollTo(0,200);
                        }, 1);
                });
                
                
            }
        });

        $("#country").change(function(){
            var country = $(this).val();

            $.ajax({
                method:"POST",
                url:"{{ url('User/getcityList')}}",
                data:{"_token":"{{csrf_token()}}",cid:country},
                success:function(response) {
                    var appenddata;
                    $('#city').html('').trigger('chosen:updated');
                    var data = JSON.parse(response);
                    $.each(data, function (key, value) {
                        appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                    });
                    $('#city').html(appenddata).trigger('chosen:updated');
                }
            })
        })

        $('#multiSector').change(function() {
            var sectorId = $("#multiSector").val();
            var $industryFocus = $("#industryFocus");

            $industryFocus.prop('disabled', true).trigger("chosen:updated");

            $.ajax({
                type: 'GET',
                url: "{{ url('getSectorIndustry?sector_id=')}}" + sectorId,
                success: function (result) {
                    $industryFocus.empty();

                    if (result) {
                        var result = JSON.parse(result);

                        $.each(result, function (i, industry) {
                            $industryFocus.append('<option value="' + industry.id + '">' + industry.industryName + '</option>');
                        });
                    }

                    $industryFocus.prop('disabled', false).trigger("chosen:updated");
                }
            });
        });

        $("#regionFocus").change(function() {
            var region_id = $("#regionFocus").val();
            var $countryFocus = $("#countryFocus");

            $countryFocus.prop('disabled', true).trigger("chosen:updated");

            $.ajax({
                type: 'GET',
                url: "{{ url('getRegionCountries?region_id=')}}" + region_id,
                success: function (result) {
                    $countryFocus.empty();

                    if (result) {
                        var result = JSON.parse(result);

                        $.each(result, function (i, country) {
                            $countryFocus.append('<option value="' + country.id + '">' + country.country_name + '</option>');
                        });
                    }

                    $countryFocus.prop('disabled', false).trigger("chosen:updated");
                }
            });
        });

        $("#publish").on('click',function(e) {
            e.preventDefault();
            $.ajax({
                method:"POST",
                url:"{{ url('User/investorPublishData') }}",
                data:{"_token":"{{csrf_token()}}"},
                success:function(response){
                    var res = JSON.parse(response);
                    if(res.msg =='success'){
                        alert('Data published successfully');
                        /*window.location.href="{{ url('User/index') }}";*/
                    }else{
                        alert('Data already published');
                    }
                }
            });
        });

        $("#investorDetail").on('click',function(){
            $('.chosen-select').removeAttr('disabled').trigger("chosen:updated");
            $('.investorDetailsActive').find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.chosen-choices').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.chosen-choices').find('input').css({
                'box-shadow' : 'none',
                'border' : 'none'
            });
            $('.investorDetailsActive').find('input').removeAttr('disabled');
            $('.investorDetailsActive').find('select').removeAttr('disabled');
            $('.investorDetailsActive').find('textarea').removeAttr('disabled');    
            //$('.chosen-select').prop('disabled', false).trigger("liszt:updated");            
        });

    });

    function viewInvestorProfile(id) {
        window.location.href="{{ url('User/viewiProfile/') }}/"+id;
    }
    
    $(document).ready(function() {
        $('#textlimit').on('input propertychange', function() {
            CharLimit(this, 50);
        });
    });

    function CharLimit(input, maxChar) {
        var len = $(input).val().length;
        if (len > maxChar) {
            $(input).val($(input).val().substring(0, maxChar));
        }
    }

    $('input#assetUndermgmt').keyup(function(e) {
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

    $('input#investmentRangefrm').keyup(function(e) {

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

    $('input#investmentRangeto').keyup(function(e) {

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

    $("#phoneno").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            return false;
        }
    });
    
    $('.chosen-select').prop('disabled', true).trigger("chosen:updated");

    $(".chosen-select").chosen();

    function userInvestorExpressed(id) {
        window.location.href="{{ url('User/userProfileInvestor/') }}/"+id;
    }

    function userInvestorIntrestedIn(id) {
        window.location.href="{{ url('User/userInvestorIntrestedIn/') }}/"+id;
    }
</script>
                       
<!-- Modal -->
<div class="modal fade" id="modalImgEditor" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Image</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div style="padding: 20px;margin: 20px;">
                                <div id="imgContainer">
                                    <img id="cropper-img" style="max-width: 100%;" />
                                </div>
                            </div>
                            <div class="form-horizontal">

                                <div class="form-group row">
                                    <div class="col" style="text-align:center;margin:10px">
                                        <input type="file" style="display:none" id="imagePicker" />
                                       <!--  <button type="button" id="ChooseImage" class="btn btn-primary">Choose Image</button>
                                        --> <button type="button" id="SelectImage" class="btn btn-primary">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" />
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>

            <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/js/croppie.css')}}" /> -->
            <!-- <script type="text/javascript" src="{{ asset('/js/croppie.js')}}"></script> -->
            <script type="text/javascript" src="{{ asset('/js/SMS.js')}}"></script>
       @endsection

