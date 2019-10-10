
@extends('layouts.home')
@section('content')
<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: 15px;
        color:#495057 !important;
            font-size: 1rem;
    }

    .smallLabel{
        z-index: 111
    }
.dropdown-toggle {
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
.sectorremove {
    z-index: 300
}

#country_chosen,#city_chosen{ height: 60px; padding : 10px;}
#country_chosen > .chosen-single,#city_chosen > .chosen-single{ 
    margin-top: 10px!important; 
    margin-top: 16px!important;
    font-size: 16px;
    font-weight: 500;
    border: 0;
    border-radius : 0;
    background:#fff;
    box-shadow: 0 0 0 0;
}
    </style>
{{ Form::open(["class"=>"addInvestorData", "method"=>"post","enctype" => "multipart/form-data"])}}
    <section class="content-box">
        <div class="container">
            <div id="success-msg"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}') ">
                            <!-- <input type="file" name="profile_banner" id="profile_banner"> --></div>
                      
                        <div class="profile-img">
                            <a href="#">
                                <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <div class="changeprofile">
                                    <label for="upload-photo"><i id="uploadimage" class="fas fa-camera"><input type="file" name="photo" id="upload-photo"></i></label>
                                    </div>
                            </a>
                        </div>

                        <div class="change-cover">
                            <!--<a href="#" class="btn btn-edit btn-change">Change</a>-->
                            <div class="btn btn-edit btn-change">
                                <label for="upload-photo2"><i class="fa fa-pen"></i></label>
                                <input type="file" name="banner" id="upload-cover" /></div>
                                <input type="hidden" name="FilePayload" id="FilePayload" />
                        </div>
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
                        <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Personal and Investor Information</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> 
                                        <small class="label smallLabel" for="input">FIRST NAME </small>
                                        <input type="text" class="form-control" name="firstname" value="{{Session::get('User.firstname')}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Last NAME</small>

                                        <input type="text" class="form-control" placeholder="" name="lastname" value="{{session::get('User.lastname') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Job Title</small>
                                        <input type="text" class="form-control" placeholder="" name="jobTitle" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor Firm Name</small>
                                        <input type="text" class="form-control" placeholder="" name="firmName">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Email</small>
                                        <input type="email" name="email" class="form-control" placeholder="" value="{{ Session::get('User.email') }}"readonly>
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Phone Number</small>
                                        <input type="text" class="form-control" id="phoneno"  name="phoneno">
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder custom-select2 multiselect">
                                     <small class="label smallLabel" for="input">Country </small>
                                        <select name="country" id="country" class="chosen-select">
                                            <option value="">---Select country---</option>
                                            <?php foreach($country as $items) { ?>
                                            <option value="{{ $items['id'] }}"  <?php if($items['country_name'] == trim($UserDetails['country']) ){ echo 'selected'; $countrySelected = $items['id']; }  ?> >{{ $items['country_name']}}</option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder multiselect"> 
                                        <small class="label smallLabel" for="input">City</small>
                                        <select name="city" id="city" class="chosen-select"></select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor firm url</small>
                                        <input type="text" class="form-control" name="investorfirmUrl" placeholder="">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor firm Fundraising URL</small>
                                        <input type="text" class="form-control" name="fundraisUrl">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investor Firm Video</small>
                                        <input type="text" class="form-control" name="investorFirmvideo" placeholder="">
                                    </div>
                                </div>
                                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Slideshare URL</small>
                                        <input type="text" class="form-control" name="slideshareUrl" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-card custom-editbtn">
                        <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                   <h3>Investor Profile</h3>
                                </div>
                            </div>
                            <div class="row">
                                 
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <p>Investor Firm Tagline</p>
                               <input type="text" class="form-control" id="textlimit" name="firmTagline">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Investor Firm Profile</p>
                                            <div class="form-group inner-label-holder textarea">
                                        <textarea rows="4" class="form-control" name="profileText"></textarea>
                                    </div>
                                </div>
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                  <p>Short Investor Biography</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea rows="4" class="form-control" name="bioData"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">
                        <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Investor Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect"> <small class="label smallLabel" for="input">Investor type</small>

                                        <select name="investorType" class="chosen-select" multiple>
                                            <option value="">---Select Investor---</option>
                                            <option value="0">Select All</option>
                                            <?php foreach($investortype as $items) { ?>
                                                <option value="{{ $items['id'] }}">{{ $items['typeInvestor']}}</option>
                                            <?php } ?>
                                        </select>
                                        <label id="investorTypeLBL" name="investorTypeLBL"></label>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect"> <small class="label smallLabel" for="input">Investment type</small>

                                            <select name="investmentType" class="chosen-select" multiple>
                                                <option value="">---Select Investment---</option>
                                                <option value="0">Select All</option>
                                                <?php foreach($investmenttype as $items) { ?>
                                                    <option value="{{ $items['id'] }}">{{ $items['typeInvestment']}}</option>
                                                <?php } ?>
                                            </select>
                                            <label id="investmentTypeLBL" name="investmentTypeLBL"></label>                   
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Sector Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Sector Focus" tabindex="4" 
                                        name="sectorFocus[]" id="multiSector">
                                                <option value="">---Select Sector---</option>
                                                <option value="0">Select All</option>
                                                <?php foreach($sector as $items) { ?>
                                                    <option value="{{ $items['id'] }}">{{ $items['sectorName']}}</option>
                                                <?php } ?>
                                        </select>
                                        <label id="sectorFocusLBL" name="sectorFocusLBL"></label> 
                                      <!-- <div class="focusclass dropdown">
                                            <button class="btn  dropdown-toggle multiselect" id="menu1" type="button" data-toggle="dropdown"> <small class="label" for="input">Sector Focus</small>
                                                <span class="caret"></span>
                                                <div class="sectorfocus-result"></div>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                
                                            </ul>
                                      </div> -->
                                  </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <div class="form-group inner-label-holder multiselect">
                                          <small class="label smallLabel" for="input">Industry Focus</small>
                                        <select class="chosen-select" id="industry" 
                                        multiple placeholder="Select Industry Focus" 
                                        tabindex="4" name="industryFocus[]" id="industry">
                                                <option value="-1">---Select Industry---</option>
                                                <option value="0">Select All</option>
                                                <?php /*foreach($industry as $ind) { ?>
                                                    <option value="{{ $ind['id'] }}">{{ $ind['industryName']}}</option>
                                                <?php } */?>
                                        </select> 
                                        <label id="industryFocusLBL" name="industryFocusLBL"></label>
                                        <!-- <div class="focusclass dropdown">
                                            <button class="btn  dropdown-toggle multiselect" id="menu2" type="button" data-toggle="dropdown"> <small class="label" for="input">Industry Focus</small>
                                                <span class="caret"></span>
                                                <div class="industryfocus-result"></div>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                @foreach($industry as $ind)
                                                    <li role="presentation">
                                                        <label class="check_container">{{ $ind['industryName']}}
                                                            <input type="checkbox" data-name="{{ $ind['industryName']}}" class="industryFocus dform" name="industryFocus[]" value="{{$ind['id']}}">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder multiselect">
                                         <small class="label smallLabel" for="input">Region Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Region Focus" tabindex="4" name="regionFocus[]">
                                                <option value="">---Select Regions---</option>
                                                <option value="0">Select All</option>
                                                <?php foreach($region as $reg) { ?>
                                                    <option value="{{ $reg['id'] }}">{{ $reg['regionName']}}</option>
                                                <?php } ?>
                                        </select> 
                                        <label id="regionFocusLBL" name="regionFocusLBL"></label>
                                        <!-- <div class="focusclass dropdown">
                                                <button class="btn  dropdown-toggle multiselect" id="menu3" type="button" data-toggle="dropdown"> <small class="label" for="input">Region Focus</small>
                                                    <span class="caret"></span>
                                                    <div class="regionfocus-result"></div>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    @foreach($region as $reg)
                                                        <li role="presentation">
                                                            <label class="check_container">{{ $reg['regionName']}}
                                                                <input type="checkbox" data-name="{{ $reg['regionName']}}" name="regionFocus[]" class="regionFocus dform" value="{{$reg['id']}}">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                          </div> -->
                                  </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <div class="form-group inner-label-holder multiselect">
                                        <small class="label smallLabel" for="input">Country Focus</small>
                                        <select class="chosen-select" multiple placeholder="Select Country Focus" tabindex="4" name="countryFocus[]">
                                                <option value="">---Select Country---</option>
                                                <option value="0">Select All</option>
                                                <?php foreach($country as $items) { ?>
                                                    <option value="{{ $items['id'] }}">{{ $items['country_name']}}</option>
                                                <?php } ?>
                                        </select>
                                        <label id="countryFocusLBL" name="countryFocusLBL"></label> 
                                            <!-- <div class="focusclass dropdown">
                                                <button class="btn  dropdown-toggle multiselect" id="menu4" type="button" data-toggle="dropdown"> <small class="label" for="input">Country Focus</small>
                                                    <span class="caret"></span>
                                                    <div class="countryfocus-result"></div>
                                                </button>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                    @foreach($country as $items)
                                                        <li role="presentation">
                                                            <label class="check_container">{{ $items['country_name']}}
                                                                <input type="checkbox" name="countryFocus[]" data-name="{{ $items['country_name']}}" class="countryFocus dform" value="{{$items['id']}}">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div> -->
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Assets Under Management $</small>

                                       <input type="text" class="form-control" name="assetUndermgmt" id="assetUndermgmt">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investment Range From $</small>

                                        <input type="text" class="form-control" id="investmentRangefrm" name="investmentRangefrm">
                                    </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Investment Range to $</small>
                                        <input type="text" class="form-control" name="investmentRangeto" id="investmentRangeto">
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
                        <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                   <h3>Video</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                  <iframe width="100%" height="500px" src="https://www.youtube.com/embed/voF1plqqZJA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                </div>
                         
                                

                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">
                       <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
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
                                  <small class="label smallLabel" for="input">LinkedIn URL</small>
                                  <input type="text" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" name="linkedinUrl">
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                  </div>
                                  <small class="label smallLabel" for="input">Facebook URL</small>
                                  <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="fbUrl" >
                                </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                  </div>
                                  <small class="label smallLabel" for="input">Twitter URL</small>
                                  <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="twitterUrl">
                                </div>
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
                              <div class=" signup_btn"><a id="save" class="nav-link" href="javascript:;">Save</a></div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                              <!-- <div class="signup_btn"><a  class="nav-link" id="publish" href="javascript:;">Publish</a></div>
                                </div>   -->           
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </section>
{{Form::close()}}
<script src="{{ url('js/jquery.validate.min.js')}}"></script>
<script>
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
           /* $("input[name='photo']").change(function(input) {
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

            $("#msg").hide();
            $(".addInvestorData").validate({
                //errorLabelContainer: "#msg",
                //wrapper: "li",
                ignore: [],
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "investorType") {    
                        error.insertAfter($('#investorTypeLBL'));
                    }else if (element.attr("name") == "investmentType") {    
                        error.insertAfter($('#investmentTypeLBL'));
                    }else if (element.attr("name") == "sectorFocus[]") {  
                        error.insertAfter($('#sectorFocusLBL'));
                    }else if (element.attr("name") == "regionFocus[]") {  
                        error.insertAfter($('#regionFocusLBL'));
                    }else if (element.attr("name") == "countryFocus[]") {  
                        error.insertAfter($('#countryFocusLBL'));
                    }else if (element.attr("name") == "industryFocus[]") {  
                        error.insertAfter($('#industryFocusLBL'));
                    }else if (element.attr("name") == "industryFocus") {  
                        error.insertAfter($('#industryFocusLBL'));
                    }
                    else {
                        console.log(element);
                        error.insertAfter(element);
                    }
                   
                },
                errorClass: "my-error-class",
                rules: {
                        firmName: { required: true},
                        jobTitle: { required: true},
                        cp_url: { required: true},
                        investmentType: { required: true},
                        firmTagline: { required: true},
                        investorType: { required: true},
                        cp_type: { required: true},
                        profileText: { required: true},
                        sector: { required: true},
                        industry: { required: true},
                        amt_raised: { required: true},
                        fd_goal: { required: true},
                        phoneno: { required: true},
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
                        firmName: 'Firm name should not be empty!',
                        jobTitle: 'Job title should not be empty!',
                        cp_url: 'Company url should not be empty!',
                        investorType: 'Investor type Should Not be Empty!',
                        firmTagline: 'Firm tagline should not be empty!',
                        investmentType: 'Investment type should Not be empty!',
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
                submitHandler: function() {
                    $(".addInvestorData").submit();
                    $("#save").attr("disabled",true);
                }
           });

    $(document).ready(function(){
        $('input.form-control,select,#country_chosen,#city_chosen,textarea,.chosen-choices').css({
                   'box-shadow' : '0 0 5px rgba(81, 203, 238, 1)',
                   'border' : '1px solid rgba(81, 203, 238, 1)'
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
                        //alert('Data published successfully');
                        /*window.location.href="{{ url('User/index') }}";*/
                        swal({
                            title: "Your profile has been saved successfully",
                            text: "",
                            type: "success",
                            showCancelButton: true,
                            showConfirmButton : false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ok!",
                            },function(){
                        });
                    
                    }else{
                        alert('Data already published');
                    }
                }
            });
        });

        $("#save").on('click',function(e){
            if($(".addInvestorData").valid()){
                var formData = new FormData($('.addInvestorData')[0]);
                e.preventDefault();
                
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/investorProfileAdd') }}",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                  
                    success:function(response){
                        var res = JSON.parse(response);
                        if(res.msg=="success")
                        {
                            $(".addInvestorData").scrollTop();
                            $('input,select').css({
                                    'box-shadow' : 'none',
                                    'border-color' : '#d3dae2'
                                })
                                $('.chosen-choices').css({
                                    'box-shadow' : 'none',
                                    'border-color' : '#d3dae2'
                                })
                            alert('Your profile is pending to be approved, once approved it will become discoverable')
                            window.location.href="{{ url('User/browse-investors')}}";
                        }else{
                            alert(response.msg);
                        }
                    }
                })
            }else{
                alert('Please fill all necessary fields');
                window.scrollTo(0,200);
                return false;
            }
        })
        //$("#country").select2();
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



    })
    </script>
    <?php if(isset($countrySelected)){ ?>
    <script>
        $.ajax({
            method:"POST",
            url:"{{ url('User/getcityList')}}",
            data:{"_token":"{{csrf_token()}}",cid:{{$countrySelected}}},
            success:function(response)
            {
                $('#city').html('').trigger('chosen:updated');
                var appenddata;
                var data = JSON.parse(response);
                var currentCity = "{{ trim($UserDetails['city']) }}"
                 $.each(data, function (key, value) {
                    if(currentCity == value.city_name){
                        appenddata += "<option value = '" + value.id + " ' selected>" + value.city_name + " </option>";                        
                    }else{
                        appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                    }
                 });
                 $('#city').html(appenddata).trigger('chosen:updated');
            }
        })
    </script>
    <?php } ?>
    <script>
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

            $('.sectorFocus').on('click',function(){
                var result = "";
                $(".sectorFocus.dform:checked").each(function (key,value) {
                    var fundtype = $($(".sectorFocus.dform:checked")[key]).data('name');
                result+='<ul><li class="sector_li">'+fundtype+' <span aria-hidden="true" class="sectorremove ">×</span>, </li></ul>';
            });
            $('.sectorfocus-result').html(result);
        });

            $('.regionFocus').on('click',function(){
                var result = "";
                $(".regionFocus.dform:checked").each(function (key,value) {
                    var regionFocus = $($(".regionFocus.dform:checked")[key]).data('name');
                result+='<ul><li>'+regionFocus+' <span aria-hidden="true" id="regionremove">×</span>, </li></ul>';
            });
            $('.regionfocus-result').html(result);
        });
            $('.industryFocus').on('click',function(){
                var result = "";
                $(".industryFocus.dform:checked").each(function (key,value) {
                    var industryFocus = $($(".industryFocus.dform:checked")[key]).data('name');
                result+='<ul><li>'+industryFocus+' <span aria-hidden="true" id="industryremove">×</span>, </li></ul>';
            });
            $('.industryfocus-result').html(result);
        });
            $('.countryFocus').on('click',function(){
                var result = "";
                $(".countryFocus.dform:checked").each(function (key,value) {
                    var countryf = $($(".countryFocus.dform:checked")[key]).data('name');
                result+='<ul><li>'+countryf+' <span aria-hidden="true" id="countryremove">×</span>, </li></ul>';
            });
            $('.countryfocus-result').html(result);
        });

         $('body').on('click','.sector_li>li',function(){
            debugger;
            $(this).parents().find('ul').remove();
        });
         $(".chosen-select").chosen();


       

            $('#multiSector').change(function(){
                    var sectorId = $("#multiSector").val();
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('getSectorIndustry?sector_id=')}}"+sectorId,
                        success: function (result) {
                            $("#industry").empty();
                            if(result){
                                var result = JSON.parse(result);
                                $.each(result, function (i, industry) {
                                    $("#industry").append('<option value="'+industry.id+'">'+
                                        industry.industryName+'</option>');
                                });
                            }else{ $("#industry").empty(); }
                            $('#industry').trigger("chosen:updated");
                            
                        }
                    });
                });

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
                                <div id="imgContainer" style="height:250px;">
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

            <link rel="stylesheet" type="text/css" href="{{ asset('/js/croppie.css')}}" />
            <script type="text/javascript" src="{{ asset('/js/croppie.js')}}"></script>
            <script type="text/javascript" src="{{ asset('/js/SMS.js')}}"></script>
    @endsection
