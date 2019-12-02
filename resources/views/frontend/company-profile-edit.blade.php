@extends('layouts.home')
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
#country_chosen > .chosen-single,#city_chosen > .chosen-single{ 
    margin-top: 10px!important;
    font-size: 16px;
    font-weight: 500;
    border: 0;
    border-radius : 0;
    background:#fff;
    box-shadow: 0 0 0 0; 
}
    </style>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: 25px;
        color:#495057 !important;
            font-size: 1rem;
    }

    .smallLabel{
        z-index: 111
    }
</style>
    
        {{ Form::open(['class'=>'editCompany','method'=>'post','enctype' => 'multipart/form-data'])}}
    <section class="content-box">
        <div class="container">
            <div id="msg-response" class="col-md-12"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($data['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('public/uploads/images/'.$data['banner_name']) }}')"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="javascript:;">
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
                            <h2>{{ @$data['user']['firstname'] ." ".@$data['user']['lastname']}}</h2>
                            <h3>{{ $data['jobTitle'] }}</h3>
                           <h4>{{ $data['companyName'] }}</h4>
                            <h4 class="web-address"> <i class="fa fa-map-marker-alt"></i> {{ @$data['city_data']['city_name'].", ".@$data['country_data']['country_name']  }}</h4>
                        </div>

                        <div class="change-cover">
                            <!--<a href="#" class="btn btn-edit btn-change">Change</a>-->
                            <div class="btn btn-edit btn-change">
                                <label for="upload-photo"><i class="fa fa-pen"></i></label>
                                <input type="file" name="banner" id="upload-cover" /></div>
                                <input type="hidden" name="FilePayload" id="FilePayload" />
                        </div>

                        <!-- <button class="btn btn-meeting float-right" type="button">
                            <i class="fa fa-phone fa-flip-horizontal pull-left"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                        <button class="btn btn-meeting float-right" type="button" style="margin-right: 5px">
                            <i class="fas fa-comments pull-left"></i>
                            <span class="pull-left">Message</span></button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <?php $id = Session::get('User.id'); $usertype = Session::get('User.usertype'); ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                            <li class="breadcrumb-item active">Company Profile</li>
                             <li class="breadcrumb-item"><a href="javascript:;" onclick="userCompanyIntrestedIn('{{$id}}')">Interest In (Following)  {{ app('App\Http\Controllers\UserController')->MeExpressedIn() }}</a></li>
                            <li class="breadcrumb-item "><a href="javascript:;" onclick="userCompanyExpressed('{{$id}}')">Expressed Interested (Follower)  {{ app('App\Http\Controllers\UserController')->MeInterestedIn() }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container frm_disabled">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                    <div class="form-card">
                        <a href="javascript:;" class="btn-edit" id="personalDetail"><i class="fa fa-pen"></i></a>
                        <div class="card-content personalDetailsActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Personal and Company Information</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">FIRST NAME </small>

                                        <input type="text" class="form-control" id="firstname" name="fname" value = "{{ @$data['user']['firstname']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Last NAME</small>

                                        <input type="text" class="form-control"  id="lastname" name="lname" value="{{ @$data['user']['lastname']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Job Title</small>

                                        <input type="text" class="form-control"  id="jobTitle" name="job_title" value="{{$data['jobTitle']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Company Name</small>

                                        <input type="text" class="form-control"  name="cp_name" id="cp_name" value="{{$data['companyName']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Email</small>

                                        <input type="email" class="form-control" name="email" id="email" value="{{$data['email']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Phone Number</small>

                                        <input type="text" class="form-control" name="phoneno" id="phoneno" value="{{ $data['phoneno']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder multiselect"> 
                                        <small class="label smallLabel" for="input">Country</small>
                                        <select name="country" id="country" class="chosen-select" disabled>
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company url</small>

                                        <input type="text" class="form-control" name="cp_url" id="cp_url" value="{{ $data['companyUrl']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Fundraising URL</small>

                                        <input type="url" class="form-control" name="fr_url" id="fr_url" value="{{ @$data['fundraisUrl']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Video</small>

                                        <input type="url" class="form-control" name="fv_url" id="fv_url" value="{{ @$data['investorFirmvideo']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>

                                        <input type="url" class="form-control" name="sd_url" id="sd_url" value="{{ $data['slideshareUrl']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-card custom-editbtn">
                        <a href="javascript:;" id="companyProfile" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content companyProfileActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Profile</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <p></p>
                                    <h6><input type="text" class="form-control" value="{{ @$data['companyTagline']}}" name="c_tagline" id="c_tagline"></h6>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Company Profile</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" rows="4" id="cp_text" name="cp_text">{{ @$data['profileText']}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Personal Biography</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control"rows="4" name="personalBio" id="personalBio">{{ @$data['personalBio']}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">
                        <a href="javascript:;" class="btn-edit" id="companyDetail"><i class="fa fa-pen"></i></a>
                        <div class="card-content companyDetailsActive">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Type Company</small>
                                        <select name="cp_type[]" id="cp_type" class="chosen-select" multiple="true" disabled="true">
                                            <option value="">--Select Company Type--</option>
                                            <option value="0">All Types</option>
                                            <?php $comType = explode(",",@$data['companyType']); ?>
                                            @foreach($ctype as $comtype)
                                                <option value="{{ $comtype['id'] }}" <?php if(in_array($comtype['id'], $comType)){echo "selected";}?>>{{ $comtype['typeCompanies'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Funding Type</small>
                                        <select name="fd_type[]" id="fd_type" class="chosen-select" multiple="true" disabled="true">
                                            <option value="">--Select Funding Type--</option>
                                            <option value="0">All Types</option>
                                            <?php $funType = explode(",",@$data['fundingType']); ?>
                                           @foreach($tfunding as $ftype)
                                               <option value="{{ $ftype['id'] }}" <?php if(in_array($ftype['id'], $funType)){echo "selected";}?>>
                                                    {{ $ftype['typeFunding'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Sector Type</small>

                                        <select name="sector[]" id="sector" class="chosen-select" multiple="true" disabled="true">
                                            <option value="">--Select Sector--</option>
                                            <option value="0">All Types</option>
                                        <?php $secType = explode(",",@$data['sector']); ?>
                                          @foreach($stype as $sector)
                                            <option value="{{ $sector['id'] }}" <?php if(in_array($sector['id'], $secType)){echo "selected";}?>>{{ $sector['sectorName'] }}</option>
                                        @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Industry</small>
                                        <select name="industry[]" id="industry" class="chosen-select" multiple="true" disabled="true">
                                            <option value="">--Select Industry Type--</option>
                                            <option value="0">All Types</option>
                                        <?php $indType = explode(",",@$data['industry']); ?>
                                          @foreach($industry as $ind)

                                          <option value="{{ $ind['id'] }}" <?php if(in_array($ind['id'], $indType)){echo "selected";}?>>{{ $ind['industryName'] }}</option>


                                                
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>
                    <div class="form-card custom-editbtn">
                        <a href="javascript:;" class="btn-edit" id="fundraisingDetail"><i class="fa fa-pen"></i></a>
                        <div class="card-content fundraisDetailActive" >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Fundraising Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Amount Raised $</small>

                                        <input type="text" class="form-control" id="amt_raised" value="{{ @$data['ammountRaised']}}" name="amt_raised">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Funding Goal $</small>

                                        <input type="text" class="form-control" id="fd_goal" value="{{ @$data['fundingGoal']}}" name="fd_goal">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Minimum Reservation $</small>

                                        <input type="text" class="form-control" value="{{ @$data['minReservation']}}" name="min_reserve" id="min_reserve">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Maximum Reservation $</small>

                                        <input type="text" class="form-control" value="{{ $data['maxReservation']}}" name="max_reserve" id="max_reserve">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">% Equity</small>

                                        <input type="text" class="form-control" value="{{ $data['equity']}}" name="equity" id="equity">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder">
                                        <small class="label" for="input">Open Date</small>
                                        <input type="text" class="form-control" value="{{ @$data['openDate']}}" name="open_date" id="open_date">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> 
                                        <small class="label" for="input">Closing Date</small>
                                        <input type="text" class="form-control" value="{{ @$data['closingDate']}}" name="close_date" id="close_date" readonly>
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
                        <a href="javascript:;" class="btn-edit" id="socilMedia"><i class="fa fa-pen"></i></a>
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
                                        <small class="label" for="input">LinkedIn URL</small><input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{ @$data['linkedinUrl']}}" name="ld_url" id="ld_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group form-group inner-label-holder">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                        </div>
                                        <small class="label" for="input">Facebook URL</small><input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="fb_url" value="{{ @$data['fbUrl']}}" id="fb_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group form-group inner-label-holder">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                        </div>
                                        <small class="label" for="input">Twitter URL</small><input type="text" class="form-control" value="{{ @$data['twitterUrl']}}" aria-label="Username" aria-describedby="basic-addon1" name="tw_url" id="tw_url">
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
            <div class="button_div">
                <div class="row">

                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <a id="save" class="nav-link btn btn-primary" href="javascript:;">Save</a></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <!-- <div class="signup_btn"><a id="publish" class="nav-link" href="#">Publish</a></div> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </section>
        {{ Form::close()}}
    

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
    $(document).ready(function() {
        $('.chosen-select').chosen();

        var date_input=$('input[name="open_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";

        date_input.datepicker({
            "setDate": new Date(),
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            setDate: new Date(),
        });
       

        $("#cp_name").keyup(function(){
            var c_name = $(this).val();
            $("#dcp_name").val(c_name);
        });
    
        $.validator.addMethod( "url2", function( value, element ) {
            return this.optional( element ) || /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test( value );
        }, $.validator.messages.url );

        @if(!Session::has('email_verified'))
            $('.frm_disabled').find('input').attr('disabled','disabled');
            $('.frm_disabled').find('select').attr('disabled','disabled');
            $('.frm_disabled').find('textarea').attr('disabled','disabled');
        @else
            $("#companyDetail").find('.chosen-choices').css({
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
            $(".personalDetailsActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.personalDetailsActive').find('.multiselect').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $(".makeactivesocial").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $(".companyProfileActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $(".fundraisDetailActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
        @endif

        $("#companyDetail").on('click',function(){
            $("#companyDetail").find('.chosen-choices').css({
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
            //$('.companyDetailsActive').find('select').removeAttr('disabled');
            $('.chosen-select').prop('disabled', false).trigger("chosen:updated");
            /*$('.companyDetailsActive').find('select').removeAttr('disabled');
            $('.companyDetailsActive').find('textarea').removeAttr('disabled'); */               
        });

        $("#personalDetail").on('click',function(){
            $(".personalDetailsActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.personalDetailsActive').find('.chosen-select').removeAttr('disabled').trigger("chosen:updated");
            $('.personalDetailsActive').find('.multiselect').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            /*$(".personalDetailsActive").removeAttr('disabled');*/
            $('.personalDetailsActive').find('input,select,textarea').removeAttr('disabled');
            /*$('.personalDetailsActive').find('select').removeAttr('disabled');
            $('.personalDetailsActive').find('textarea').removeAttr('disabled');                */
        });

        $("#socilMedia").on('click',function(){
            $(".makeactivesocial").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            /*$(".makeactivesocial").removeAttr('disabled');*/
            $('.makeactivesocial').find('input,select,textarea').removeAttr('disabled');
            /*$('.makeactivesocial').find('select').removeAttr('disabled');
            $('.makeactivesocial').find('textarea').removeAttr('disabled');*/
        });

        $("#companyProfile").on('click',function(){
            $(".companyProfileActive").find('input,select,textarea').css({
                'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                'border' : '1px solid rgba(81, 203, 238, 1)'
            });
            $('.companyProfileActive').find('input').removeAttr('disabled');
            $('.companyProfileActive').find('select').removeAttr('disabled');
            $('.companyProfileActive').find('textarea').removeAttr('disabled');

        });

        $("#fundraisingDetail").on('click',function(){
            $(".fundraisDetailActive").find('input,select,textarea').css({
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
        var formData=new FormData();
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

        $("#msg-response").hide();
            $(".editCompany").validate({
            //errorLabelContainer: "#msg",
            //wrapper: "li",
            errorClass: "my-error-class",
            ignore: [],
                rules: {
                    //cp_name: { required: true},
                    //job_title: { required: true},
                    cp_url: "url2",
                    /*fr_url: { required: true},*/
                    c_tagline: { required: true},
                    /*cp_text: { required: true},*/
                    "cp_type[]": { required: true},
                    "fd_type[]": { required: true},
                    "sector[]": { required: true},
                    "industry[]": { required: true},
                    amt_raised: { required: true},
                    fd_goal: { required: true},
                    //phoneno: { required: true},
                    city: { required: true},
                    country: { required: true},
                    open_date: { required: true},
                    close_date: { required: true},
                    
                },
                
                messages: {
                    //cp_name: 'Company name should not be empty!',
                    //job_title: 'Job title should not be empty!',
                    //cp_url: 'Company url should not be empty!',
                    /*fr_url: 'Fundraising Url Should Not be Empty!',*/
                    c_tagline: 'Company tagline should not be empty!',
                    /*cp_text: 'Company description should Not be empty!',*/
                    "cp_type[]": 'Company type should not be empty!',
                    "fd_type[]": 'FundType should not be empty!',
                    "sector[]": 'Sector should not be empty!',
                    "industry[]": 'Indusrty should not be empty!',
                    amt_raised: 'Ammount raised should not be empty!',
                    fd_goal: 'Fund goal should not be empty!',
                    //phoneno: 'Phone number should not be empty!',
                    city: 'City should not be empty!',
                    country: 'Country name should not be empty!',
                    open_date: 'Open date should not be empty!',
                    close_date: 'Close date should not be empty!',

                },
            submitHandler: function() {
                $(".editCompany").submit();
            }
        });

        $("#save").on('click',function(e) {
            if ($(".editCompany").valid()) { 
                var formData = new FormData($('.editCompany')[0]);

                e.preventDefault();

                $.ajax({
                    method:"POST",
                    url:"{{ url('User/saveCompanyProfile')}}",
                    data:formData,
                    cache: false,
                    processData: false, 
                    contentType: false,
                    success:function(response)
                    {
                        $("#msg-response").show();
                        $(".editCompany").scrollTop();
                        if(response.msg=='success')
                        {
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

                            $(".editCompany").scrollTop();
                            $("#msg-response").html('<div class="alert alert-success">Data Saved Successfully.</div>');
                            $('.personalDetailsActive').find('input,select,textarea').attr('disabled', true);
                            $('.companyDetailsActive').find('input,select,textarea').attr('disabled', true);
                            $('.makeactivesocial').find('input,select,textarea').attr('disabled', true);
                            $('.companyProfileActive').find('input').attr('disabled', true);
                            $('.companyProfileActive').find('select').attr('disabled', true);
                            $('.companyProfileActive').find('textarea').attr('disabled', true);
                            $('.fundraisDetailActive').find('input').attr('disabled', true);
                            $('.fundraisDetailActive').find('select').attr('disabled', true);
                            $('.fundraisDetailActive').find('textarea').attr('disabled', true);
                            $('.personalDetailsActive').find('.multiselect').css({
                                'box-shadow' : 'none',
                                'border' : 'none'
                            });    
                        } else {
                            $(".editCompany").scrollTop();
                            //alert(response.msg);
                            $("#msg-response").html('<div class="alert alert-danger">'+response.msg+'</div>');   
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
            var country=$(this).val();
            $.ajax({
                method:"POST",
                url:"{{ url('User/getcityList')}}",
                data:{"_token":"{{csrf_token()}}",cid:country},
                success:function(response)
                {
                    $('#city').html('').trigger('chosen:updated');
                    var appenddata;
                    var data = JSON.parse(response);
                        $.each(data, function (key, value) {
                            appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                        });
                        $('#city').html(appenddata).trigger('chosen:updated');
                }
            })
        });

        $('#sector').change(function() {
            var sectorId = $("#sector").val();
            var $industry = $("#industry");

            $industry.prop('disabled', true).trigger("chosen:updated");

            $.ajax({
                type: 'GET',
                url: "{{ url('getSectorIndustry?sector_id=')}}" + sectorId,
                success: function (result) {
                    $industry.empty();

                    if (result) {
                        var result = JSON.parse(result);

                        $.each(result, function (i, industry) {
                            $industry.append('<option value="' + industry.id + '">' + industry.industryName + '</option>');
                        });
                    }

                    $industry.prop('disabled', false).trigger("chosen:updated");
                }
            });
        });

        $("#publish").on('click',function(e){
            e.preventDefault();
            $.ajax({
                method:"POST",
                url:"{{ url('User/comapnyPublishData') }}",
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
    });
            
    function viewCompanyProfile(id){
        
        window.location.href="{{ url('User/viewcProfile/') }}/"+id;
    }
    
    $(document).ready(function() {
        $('#c_tagline').on('input propertychange', function() {
            CharLimit(this, 50);
        });
    });
    
    function CharLimit(input, maxChar) {
        var len = $(input).val().length;
        if (len > maxChar) {
            $(input).val($(input).val().substring(0, maxChar));
        }
    }

    $('input#amt_raised').keyup(function(e) {
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

    $('input#fd_goal').keyup(function(e) {    
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

    $('input#min_reserve').keyup(function(e) {
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

    $('input#max_reserve').keyup(function(e) {
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
    
    
    function userCompanyIntrestedIn(id){
        
        window.location.href="{{ url('User/userCompanyIntrestedIn/') }}/"+id;
    }
    function userCompanyExpressed(id){
        
        window.location.href="{{ url('User/userProfileCompany/') }}/"+id;
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
                            <div style="padding: 20px; margin: 20px;">
                                <div id="imgContainer">
                                    <img id="cropper-img" style="max-width: 100%;" />
                                </div>
                            </div>

                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col" style="text-align:center;margin:10px">
                                        <input type="file" style="display:none" id="imagePicker" />
                                            <!-- <button type="button" id="ChooseImage" class="btn btn-primary">Choose Image</button> -->
                                            <button type="button" id="SelectImage" class="btn btn-primary">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css" />
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
            <!--
            <link rel="stylesheet" type="text/css" href="{{ asset('/js/croppie.css')}}" />
            <script type="text/javascript" src="{{ asset('/js/croppie.js')}}"></script>
            -->
            <script type="text/javascript" src="{{ asset('/js/SMS.js')}}"></script>
    @endsection
