@extends('layouts.home')
@section('content')
<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: 15px; color:#495057 !important; font-size: 1rem; }
    .smallLabel{ z-index: 111; }

    button#menu1 { border-color: #d3dae2; width: 100%; border-radius: 5px; text-align: left; height: 60px; color: #afb9c5; }
    .focusclass .dropdown-toggle::after {
        display: inline-block; vertical-align: .255em; border-top: .3em solid; 
        border-right: .3em solid transparent; border-left: .3em solid transparent; position: absolute; 
        right: 10px; top: 15px; }
    .focusclass small.label {
        padding-left: 12px; padding-top: 10px; position: absolute; color: #afb9c5; font-size: 10px;
        text-transform: uppercase; top: 0; left: 0px; }
    .focusclass ul.dropdown-menu { width: 100% !important; padding:5px; }
    .dropdown-menu.show { display: block; max-height: 200px; overflow-y: scroll; border: none;
        box-shadow: 0px 0px 10px 0px rgba(183, 181, 181, 0.46); }
    .inner-label-holder > textarea.disData { height: auto; white-space: normal; }
    #country_chosen,#city_chosen{ height: 60px; padding : 10px; border: 1px solid #d3dae2; }
    #country_chosen > .chosen-single,#city_chosen > .chosen-single{ margin-top: 16px!important; }
</style>
     {{ Form::open(['class'=>'addComapny','method'=>'post','enctype' => 'multipart/form-data'])}}
    <section class="content-box">
        <div class="container">
           <div id="msg"></div>
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}') ">
                            <!-- <input type="file" name="profile_banner" id="profile_banner"> --></div>
                      
                        <div class="profile-img">
                            <a href="#">
                                <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <div class="changeprofile">
                                    <label for="upload-photo">
                                        <i id="uploadimage" class="fas fa-camera">
                                            <input type="file" name="photo" id="upload-photo">
                                        </i>
                                    </label>
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
                            <li class="breadcrumb-item active">Company Profile</li>
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
                                    <h3>Personal and Company Information</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">FIRST NAME </small>
                                        <input type="text" class="form-control" name="fname" value="{{ Session::get('User.firstname') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">LAST NAME</small>

                                        <input type="text" class="form-control" name="lname" value="{{ Session::get('User.lastname') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Job Title</small>

                                        <input type="text" class="form-control" name="job_title" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Company Name</small>

                                        <input type="text" class="form-control" name="cp_name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Email</small>

                                        <input type="email" class="form-control" name="email" value="{{ Session::get('User.email') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Phone Number</small>

                                        <input type="text" class="form-control" id="phoneno" name="phoneno">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder custom-select2 multiselect"> <small class="label smallLabel" for="input">Country </small>
                                        <select name="country" id="country" class="chosen-select">
                                            <option value="">--Select Country---</option>
                                            <?php foreach($country as $items) { ?>
                                            <option value="{{ $items['id'] }}" <?php if($items['country_name'] == trim($UserDetails['country']) ){ echo 'selected'; $countrySelected = $items['id']; }  ?>>{{ $items['country_name']}}</option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder multiselect"> 
                                        <small class="label" for="input">City</small>

                                        <select name="city" id="city" class="chosen-select">
                                        </select>            
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Company url</small>

                                        <input type="text" class="form-control" name="cp_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Fundraising URL</small>

                                        <input type="text" class="form-control" name="fr_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Company Video</small>

                                        <input type="text" class="form-control" name="fv_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Slideshare URL</small>

                                        <input type="text" class="form-control" name="sd_url" placeholder="">
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
                                    <h3>Company Profile</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <p>Company Tagline</p>
                                    <h6><input type="text" class="form-control" id="textlimit" name="c_tagline"></h6>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    <p>Company Profile</p>
                                    <div class="form-group inner-label-holder textarea">

                                       <textarea rows="4" class="form-control" name="cp_text"></textarea>

                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Personal Biography</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea rows="4" class="form-control" name="personalBio"></textarea>

                                    </div>
                                </div>



                            </div>


                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card custom-editbtn">
                        <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Type Company</small>
                                        <select name="cp_type[]" id="cp_type" class="chosen-select" multiple="true" >
                                            <option value="">--Select Company Type--</option>
                                            <option value="0">All Types</option>
                                            
                                            @foreach($cp_type as $comtype)
                                                <option value="{{ $comtype['id'] }}">{{ $comtype['typeCompanies'] }}</option>

                                                
                                            @endforeach
                                        </select> 

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Funding Type</small>

                                       

                                        <select name="fd_type[]" id="fd_type" class="chosen-select" multiple="true" >
                                            <option value="">--Select Funding Type--</option>
                                            <option value="0">All Types</option>
                                        
                                           @foreach($fundType as $ftype)
                                                <option value="{{ $ftype['id'] }}" >{{ $ftype['typeFunding'] }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Sector Type</small>
                                        
                                        <select name="sector[]" id="sector" class="chosen-select" multiple="true" >
                                            <option value="">-- Select Sector --</option>
                                            <option value="0">All Types</option>
                                        
                                            @foreach($sector as $sector)
                                                <option value="{{ $sector['id'] }}" >{{ $sector['sectorName'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Industry</small>
                                        
                                        <select name="industry[]" id="industry" class="chosen-select" multiple="true">
                                            <option value="">-- Select Industry Type --</option>
                                            <option value="0">All Types</option>
                                          
                                        </select>
                                        <!-- @foreach($industry as $ind)
                                            <option value="{{ $ind['id'] }}">{{ $ind['industryName'] }}</option>   
                                            @endforeach -->
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
                                    <h3>Fundraising Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Amount Raised $</small>
                                        <input type="text" class="form-control" id="amt_raised" name="amt_raised">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Funding Goal $</small>
                                    <input type="text" class="form-control" placeholder="" id="fd_goal" name="fd_goal">
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Minimum Reservation $</small>
                                    <input type="text" class="form-control" name="min_reserve" id="min_reserve">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Maximum Reservation $</small>
                                        <input type="text" class="form-control" placeholder="" name="max_reserve" id="max_reserve">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">% Equity</small>
                                        <input type="text" class="form-control" placeholder="" name="equity">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Open Date</small>
                                    <input type="text" class="form-control" placeholder=""  value="<?php echo date('Y-m-d');?>" name="open_date">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label smallLabel" for="input">Closing Date</small>
                                    <input type="text" class="form-control" placeholder="" name="close_date" readonly>
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
                        <!-- <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a> -->
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
                    <div class="form-card custom-editbtn">
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
                                        <input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" name="ld_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group form-group inner-label-holder">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                        </div>
                                        <small class="label smallLabel" for="input">Facebook URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" name="fb_url">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="input-group form-group inner-label-holder">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                        </div>
                                        <small class="label smallLabel" for="input">Twitter URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" name="tw_url">
                                    </div>
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
                                <div class=" signup_btn"><a id="save" class="nav-link" href="javascript:;">Save</a></div>
                            </div>
                            <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="signup_btn"><a id="publish" class="nav-link" href="javascript:;">Publish</a></div>
                            </div> -->
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
    $(document).ready(function(){
        var date_input=$('input[name="open_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-dd-mm',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
        var date_input=$('input[name="close_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

        $("#cp_name").keyup(function(){
            var c_name = $(this).val();
            $("#dcp_name").val(c_name);
        })
    })

</script>
<script src="{{ url('js/jquery.validate.min.js')}}"></script>
<script>
    
    $(document).ready(function(){
       // $("#country").select2();
       $('.chosen-select').chosen();

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

            $("#msg").hide();
               $(".addComapny").validate({
                //errorLabelContainer: "#msg",
                //wrapper: "li",
                errorClass: "my-error-class",
                  rules: {
                        cp_name: { required: true},
                        job_title: { required: true},
                        cp_url: { required: true},
                        /*fr_url: { required: true},*/
                        c_tagline: { required: true},
                        /*cp_text: { required: true},*/
                        cp_type: { required: true},
                        fd_type: { required: true},
                        sector: { required: true},
                        industry: { required: true},
                        phoneno: { required: true},
                        // city: { required: true},
                        // country: { required: true},
                        open_date: { required: true},
                        
                    },
                    
                    messages: {
                        cp_name: 'Company name should not be empty!',
                        job_title: 'Job title should not be empty!',
                        cp_url: 'Company url should not be empty!',
                        /*fr_url: 'Fundraising Url Should Not be Empty!',*/
                        c_tagline: 'Company tagline should not be empty!',
                        /*cp_text: 'Company description should Not be empty!',*/
                        cp_type: 'Company type should not be empty!',
                        fd_type: 'FundType should not be empty!',
                        sector: 'Sector should not be empty!',
                        industry: 'Indusrty should not be empty!',
                        phoneno: 'Phone number should not be empty!',
                        // city: 'City should not be empty!',
                        // country: 'Country name should not be empty!',
                        open_date: 'Open date should not be empty!',

                    },
                submitHandler: function() {
                    $(".addComapny").submit();
                    
                }
           });
        $("#save").on('click',function(e){
           if($(".addComapny").valid()){
            var formData = new FormData($('.addComapny')[0]);
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/comapnyProfileAdd') }}",
                    data: formData,
                    cache: false,
                    processData: false, 
                    contentType: false,
                    success:function(response){
                        var res = JSON.parse(response);
                        if(res.msg =='success'){
                            alert('Your profile is pending to be approved, once approved it will become discoverable');
                            window.location.href="{{ url('User/index') }}";
                        }else{
                            alert(res.msg);
                        }
                    }
                });
            }else{
                
                window.scrollTo(0,200);
                return false;
            }
        });
        $("#publish").on('click',function(e){
            if($(".addComapny").valid()){
                var formData = new FormData($('.addComapny')[0]);
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/comapnyPublishData') }}",
                    data: formData,
                    cache: false,
                    processData: false, 
                    contentType: false,
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
                           //alert('Data already published'); 
                        }
                    }
                });
            } else{
                window.scrollTo(0,200);
                return false;                
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
                        console.log(data);
                         $.each(data, function (key, value) {
                            appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                         });
                         $('#city').html(appenddata).trigger('chosen:updated');
                    }
                })
            })
    });
</script>
<?php if(isset($countrySelected)){ ?>
    <script>
        $.ajax({
            method:"POST",
            url:"{{ url('User/getcityList')}}",
            data:{"_token":"{{csrf_token()}}",cid:{{$countrySelected}}},
            success:function(response){
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

                $('#sector').change(function(){
                    var sectorId = $("#sector").val();
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
                            <div style="padding: 10px;margin: 10px;">
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