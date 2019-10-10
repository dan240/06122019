@extends('layouts.admin')
@section('content')
<script src="{{ url('js/jquery.validate.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/chosen.min.css')}}">
<script src="{{ asset('js/chosen.jquery.js')}}"></script>
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
   .hide{
   height: 0;
   width: 0;
   overflow: hidden;
   }
   
   .chosen-container{
   width: 100%!important;
   }
</style>
<style type="text/css">
   fieldset.scheduler-border {
   border: 1px groove #ddd !important;
   padding: 0 1.4em 1.4em 1.4em !important;
   margin: 0 0 1.5em 0 !important;
   -webkit-box-shadow:  0px 0px 0px 0px #000;
   box-shadow:  0px 0px 0px 0px #000;
   }
   legend.scheduler-border {
   font-size: 1.2em !important;
   font-weight: bold !important;
   text-align: left !important;
   width:auto;
   padding:0 10px;
   border-bottom:none;
   }
</style>
<section class="inner-pages">
   <div class="container">
      <div>
         <h5 class="text-center">Add New User</h5>
         <hr style="border-top: 2px dotted #eee;">
         <div  class="col-md-12 error-note"></div>
         <?php if(!empty($response)):?>
         <div class="alert alert-<?php echo ($response['code'] == 1)?'success':'danger';?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-<?php echo ($response['code'] == 1)?'check':'ban';?>"></i>
            <?php echo $response['msg'];?>
         </div>
         <?php endif; ?>
         <form-group>
            <div class="row">
               <div class="col-md-4">
                  <p class="text-center">I am</p>
               </div>
               <div class="col-md-4">
                  <input type="radio" id="test1" name="radio" class="userType" value="1" checked>
                  <label for="test1" name="company">Company</label>
               </div>
               <div class="col-md-4">
                  <input type="radio" id="test2" name="radio" class="userType" value="2">
                  <label for="test2">Investor</label>
               </div>
            </div>
         </form-group>
         <hr style="border-top: 2px dotted #eee;">
         <div class="choose text-center">
            <h3>Please choose user type</h3>
         </div>
      </div>
      <div class="company">
         {{ Form::open(array('method' => 'post','class' => 'addUserForm')) }}
         <div class="text-center">
            <h3>Add Company</h3>
         </div>
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
               <input type="hidden" name="userType" value="1">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Personal and Company Information</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firstname">First Name :</label>
                           <div class="controls ">
                              <input type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="lastname">Last Name :</label>
                           <div class="controls ">
                              <input type="text" id="lastname" name="lastname" placeholder="Last Name" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="jobTitle">Job Title :</label>
                           <div class="controls ">
                              <input type="text" id="jobTitle" name="jobTitle" placeholder="Job Title"  class="form-control"/>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="companyName">Company Name :</label>
                           <div class="controls ">
                              <input type="text" id="companyName" name="companyName" placeholder="Company Name" class="form-control"/>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="email">Email :</label>
                           <div class="controls ">
                              <input type="text" id="email" name="email" placeholder="Email"  class="form-control"/>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="phone">Phone :</label>
                           <div class="controls ">
                              <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control"/>
                           </div>
                        </div>
                     </div>



                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="password">Password :</label>
                           <div class="controls ">
                              <input type="password" id="password" name="password" placeholder="Password" class="form-control"/>
                           </div>
                        </div>
                     </div>


                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="c_password">Confirm Password :</label>
                           <div class="controls ">
                              <input type="password" id="c_password" name="c_password" placeholder="Confirm Password" class="form-control"/>
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Country :</label>
                           <div class="controls ">
                              <select name="country" id="country" class="form-control">
                                 <option value="0">--Select Company Type--</option>
                                 @foreach($country as $con)
                                 <option value="{{ $con['id'] }}">{{ @$con['country_name'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="city">City :</label>
                           <div class="controls ">
                              <select id="city" name="city" class="form-control">
                                 @foreach($city as $con)
                                 <option value="{{ $con['id'] }}" >{{ $con['city_name'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="cp_url">Investor Company Url :</label>
                           <div class="controls ">
                              <input type="url" class="form-control" name="cp_url" id="cp_url">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="fr_url">Fundraising Url :</label>
                           <div class="controls ">
                              <input type="email" class="form-control" name="fr_url" id="fr_url">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="fv_url">Investor Company Video :</label>
                           <div class="controls ">
                              <input type="url" class="form-control" name="fv_url" id="fv_url" >
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="slideshare_url">Slideshare Url :</label>
                           <div class="controls ">
                              <input type="url" class="form-control" name="sd_url" id="sd_url">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Company Profile</legend>
                  <div class="row">
                     <div class="col col-12">
                        <div class="form-group">
                           <label class="control-label input-label" for="c_tagline">Company Tagline :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="c_tagline" name="c_tagline" placeholder="First Name" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <label class="control-label input-label" for="c_tagline">Company Profile :</label>
                        <div class="controls ">
                           <textarea class="form-control" rows="4" id="cp_text" name="cp_text"></textarea>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <label class="control-label input-label" for="c_tagline">Company Biography :</label>
                        <div class="controls ">
                           <textarea class="form-control"rows="4" name="personalBio" id="personalBio"></textarea>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Company Details</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Type Company :</label>
                           <div class="controls ">
                              <select name="cp_type[]" class="chosen-select form-control" multiple>
                                 <option value="">--Select Company Type--</option>
                                 <option value="0">Select All</option>
                                 @foreach($ctype as $comtype)
                                 <option value="{{ $comtype['id'] }}" >{{ $comtype['typeCompanies'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Funding Type :</label>
                           <div class="controls ">
                              <select name="fd_type[]" id="fd_type" class="chosen-select form-control" multiple>
                                 <option value="">--Select Funding Type--</option>
                                 <option value="0">Select All</option>
                                 @foreach($tfunding as $ftype)
                                 <option value="{{ $ftype['id'] }}" >{{ $ftype['typeFunding'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Sector Type :</label>
                           <div class="controls ">
                              <select name="sector[]" id="sector" class="chosen-select form-control" multiple>
                                 <option value="">--Select Sector Type--</option>
                                 <option value="0">--Select All--</option>
                                 @foreach($stype as $sector)
                                 <option value="{{ $sector['id'] }}" >{{ $sector['sectorName'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Industry :</label>
                           <div class="controls ">
                              <select name="industry[]" id="industry" class="form-control chosen-select" multiple>
                                 <option value="">--Select Industry --</option>
                                 <option value="0">--Select All--</option>
                                 @foreach($industry as $ind)
                                 <option value="{{ $ind['id'] }}">{{ $ind['industryName'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Fundraising Details</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="amt_raised">Amount Raised $ :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="amt_raised" name="amt_raised" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="fd_goal">Funding Goal $ :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="fd_goal" name="fd_goal" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="min_reserve">Minimum Reservation $ :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="min_reserve" name="min_reserve" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="max_reserve">Maximum Reservation $ :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="max_reserve" name="max_reserve" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="equity">% Equity :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="equity" name="equity" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="open_date">Open Date :</label>
                           <div class="controls ">
                              <input type="date" class="form-control" id="open_date" name="open_date" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="close_date">Closing Date :</label>
                           <div class="controls ">
                              <input type="date" class="form-control" id="close_date" name="close_date" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Social Media</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="linkedinUrl">LinkedIn Url :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="linkedinUrl" name="linkedinUrl" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="fbUrl">Fabebook Url :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="fbUrl" name="fbUrl" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="twitterUrl">Twitter Url :</label>
                           <div class="controls ">
                              <input type="text" class="form-control" id="twitterUrl" name="twitterUrl" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <a class="btn btn-primary" href="javascript:;" id="add" style="margin:20px 0px">Add</a>
            </div>
         </div>
         {{ Form::close() }}
      </div>
      <div class="investor hide">
         {{ Form::open(array('method' => 'post','class' => 'addInvestorForm')) }}
         <div class="text-center">
            <h3>Add Investor</h3>
         </div>
         <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Personal and Investor Information</legend>
                  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                  <input type="hidden" name="userType" value="2">
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firstname">First Name :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="lastname">Last Name :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="lastname" name="lastname" placeholder="Last Name" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="email">Email :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="email" name="email" placeholder="Email" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="phone">Phone :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="phone" name="phone" placeholder="Phone"  class="form-control" />
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="password">Password :</label>
                           <div class="controls ">
                              <input type="password" id="password" name="password" placeholder="Password"  class="form-control" />
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="c_password">Confirm Password :</label>
                           <div class="controls ">
                              <input type="password" id="c_password" name="c_password" placeholder="Confirm Password"  class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="jobTitle">Job Title :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="jobTitle" name="jobTitle" placeholder="Job Title"  class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firm_name">Investor Firm Name :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="firm_name" name="firm_name" placeholder="Firm Name"  class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country">Country :</label>
                           <div class="controls ">
                              <select name="country" class="form-control"  id="country">
                                 <option value="0">--Select Company Type--</option>
                                 @foreach($country as $con)
                                 <option value="{{ $con['id'] }}">{{ @$con['country_name'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="city">City :</label>
                           <div class="controls ">
                              <select id="city" class="form-control"  name="city">
                                 @foreach($city as $con)
                                 <option value="{{ $con['id'] }}">{{ @$con['city_name'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firm_url">Investor Firm Url :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="firm_url" name="firm_url" placeholder="Firm Url" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="fundraising_url">Investor Firm Fundraising Url :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="fundraising_url" name="fundraising_url" placeholder="Fundraising Url" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firm_video">Investor Firm Video :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="firm_video" name="firm_video" placeholder="Firm Video" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="slideshare_url">Slideshare Url :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="slideshare_url" name="slideshare_url" placeholder="Slideshare Url"  class="form-control" />
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Investor Details</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="investor_type">Investor Type : </label>
                           <div class="controls ">
                              <select name="investorType[]" class="chosen-select" multiple>
                                 <option value="">--Select Investor Type--</option>
                                 <option value="0">Select All</option>
                                 @foreach($investor as $in)
                                 <option value="{{ $in['id'] }}" >{{ $in['typeInvestor'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="investment_type">Investment Type :</label>
                           <div class="controls">
                              <select name="investmentType[]" class="chosen-select" multiple>
                                 <option value="">--Select Investment Type--</option>
                                 <option value="0">Select All</option>
                                 @foreach($investment as $in)
                                 <option value="{{ $in['id'] }}" >{{ $in['typeInvestment'] }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="sector_focus">Sector Focus :</label>
                           <div class="controls ">
                              <select class="chosen-select" multiple placeholder="Select Sector Focus" tabindex="4" name="sectorFocus[]" id="multiSector">
                                 <option value="">---Select Sector---</option>
                                 <option value="0">Select All</option>
                                 <?php 
                                    foreach($sector as $se) {   
                                    ?>
                                 <option value="{{ $se['id'] }}">{{ $se['sectorName']}}</option>
                                 <?php  } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="industry_focus">Industry Focus :</label>
                           <div class="controls ">
                              <select class="chosen-select" multiple placeholder="Select Industry Focus" tabindex="4" name="industryFocus[]">
                                 <option value="">---Select Industry---</option>
                                 <option value="0">Select All</option>
                                 <?php  
                                    foreach ($industry as $in) { ?>
                                 <option value="{{ $in['id'] }}">{{ $in['industryName']}}</option>
                                 <?php }  ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="region_focus">Region Focus :</label>
                           <div class="controls ">
                              <select class="chosen-select" multiple placeholder="Select Region Focus" tabindex="4" name="regionFocus[]">
                                 <option value="">---Select Region---</option>
                                 <option value="0">Select All</option>
                                 <?php 
                                    foreach ($region as $re) { ?>
                                        <option value="{{ $re['id'] }}" >{{ $re['regionName']}}</option>
                                 <?php  } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="country_focus">Country Focus :</label>
                           <div class="controls ">
                              <select class="chosen-select" multiple placeholder="Select Country Focus" tabindex="4" name="countryFocus[]">
                                 <option value="">---Select Country---</option>
                                 <option value="0">Select All</option>
                                 <?php  
                                    foreach ($country as $co) { ?>
                                 <option value="{{ $co['id'] }}" >{{ $co["country_name"]}}</option>
                                 <?php  } ?>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="assets">Assets Under Management :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="assets" name="assets" placeholder="Assets Under Management" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="range_from">Investment Range From $ :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="range_from" name="range_from" placeholder="Investment Range From $" class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="range_to">Investment Range To $ :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="range_to" name="range_to" placeholder="Investment Range To $" class="form-control" />
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Investor Profile</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firm_tagline">Investor Firm Tagline :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="firm_tagline" name="firm_tagline" placeholder="Investor Firm Tagline " class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="firm_profile">Investment Firm Profile :</label>
                           <div class="controls ">
                              <textarea class="form-control" rows="5" id="firm_profile" name="firm_profile" placeholder="Investment Firm Profile"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="bio_data">Short Investor Biography :</label>
                           <div class="controls ">
                              <textarea class="form-control" rows="5" id="bio_data" name="bio_data" placeholder="Short Investor Biography"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
               <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Social Media</legend>
                  <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="linkedin">Linkedin :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="linkedin" name="linkedin" placeholder="Linkedin"  class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="facebook">Facebook :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="facebook" name="facebook" placeholder="Facebook"  class="form-control" />
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label class="control-label input-label" for="twitter">Twitter :</label>
                           <div class="controls ">
                              <input type="text"  type="text" id="twitter" name="twitter" placeholder="Twitter" class="form-control" />
                           </div>
                        </div>
                     </div>
                  </div>
               </fieldset>
            </div>
         </div>
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <a class="btn btn-primary" href="javascript:;" id="addInvestor" style="margin:20px 0px">Add Investor</a>
         </div>
         {{ Form::close() }}
      </div>
   </div>
</section>
<script src="{{ url('js/jquery.validate.min.js')}}"></script>
<script>
   $(document).ready(function(){
       $('.error-note').hide();
       
       $(".chosen-select").chosen();
   
       $('.userType').change(function() {
           $('.choose').hide();
           $('.company').addClass('hide');
           $('.investor').addClass('hide');
           var val = $(".userType:checked").val();
           if(val == 1){
               $('.company').removeClass('hide');
           }else if(val == 2){
               $('.investor').removeClass('hide');
           }else{
               $('.choose').show();
           }
       })
   
          $(".addUserForm").validate({
           errorLabelContainer: ".error-note",
           wrapper: "li",
             rules: {
                   firstname: {required:true},
                   lastname: {required:true},
                   email: {
                           required: true,
                           email: true,//add an email rule that will ensure the value entered is valid email id.
                           maxlength: 255,
                        },
                   password:{
                               required:true,
                               maxlength:10,
                               minlength:6
                           },
                    c_password:{
                        required:true,
                        maxlength:10,
                        minlength:6
                    },
                   userType:{required:true},

               },
               messages: {
                   userType:'Please Select type either Company or Investor',
                   firstname: 'Please Enter Your First Name',
                   lastname: 'Plase Enter Your Last Name',
                   email: 'Please Enter you Email-Id',
                   password:'Password should be minimun length 6 and maximum length 10',
                   c_password:'Please confirm your password'
               },
           submitHandler: function(form) {
              form.submit();
           }
      });
          $(".addInvestorForm").validate({
           errorLabelContainer: ".error-note",
           wrapper: "li",
             rules: {
                   firstname: {required:true},
                   lastname: {required:true},
                   email: {
                           required: true,
                           email: true,//add an email rule that will ensure the value entered is valid email id.
                           maxlength: 255,
                        },
                   password:{
                               required:true,
                               maxlength:10,
                               minlength:6
                           },
                    c_password:{
                        required:true,
                        maxlength:10,
                        minlength:6
                    },
                   userType:{required:true},

               },
               messages: {
                   userType:'Please Select type either Company or Investor',
                   firstname: 'Please Enter Your First Name',
                   lastname: 'Plase Enter Your Last Name',
                   email: 'Please Enter you Email-Id',
                   password:'Password should be minimun length 6 and maximum length 10',
                   c_password:'Please confirm your password'
               },
           submitHandler: function(form) {
              form.submit();
           }
      });
       $("#add").on('click',function(e){
           
           //if($('.addUserForm').valid()){
               e.preventDefault();
               $.ajax({
                   method:"post",
                   url:"{{ url('Admin/addNewUser')}}",
                   data: $('.addUserForm').serialize() ,
                   
                   success:function(data){
                       if(data.msg=='success'){
                           alert('User added successfully');
                           $('.error-note').show();
                           $('.error-note').html('User added successfully');
                       }else if(data.msg=='failed'){
                           alert('User not successfully');
                           $('.error-note').show();
                           $('.error-note').html('User not added');
                       }else{
                            $('.error-note').show();
                            $('.error-note').html(data.msg);
                       }
                   }
               });
           //}
       });


       $("#addInvestor").on('click',function(e){
           
           if($('.addInvestorForm').valid()){
               e.preventDefault();
               $.ajax({
                   method:"post",
                   url:"{{ url('Admin/addNewUser')}}",
                   data: $('.addInvestorForm').serialize() ,
                   
                   success:function(data){
                       if(data.msg=='success'){
                           alert('User added successfully');
                           $('.error-note').show();
                           $('.error-note').html('User added successfully');
                       }else if(data.msg=='failed'){
                           alert('User not successfully');
                           $('.error-note').show();
                           $('.error-note').html('User not added');
                       }else{
                            $('.error-note').show();
                            $('.error-note').html(data.msg);
                       }
                   }
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
                   var appenddata;
                   var data = JSON.parse(response);
                   $.each(data, function (key, value) {
                       appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                   });
                   $('#city').html(appenddata);
               }
           })
       })
   $('input#assets').keyup(function(e) {
   
       // skip for arrow keys
       if(e.which >= 37 && e.which <= 40 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return;
   
       // format number
       $(this).val(function(index, value) {
           return value
               .replace(/\D/g, "")
               .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       });
   }); 
   $('input#range_from').keyup(function(e) {
   
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
   $('input#range_to').keyup(function(e) {
   
       // skip for arrow keys
       if(e.which >= 37 && e.which <= 40 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) return;
   
       // format number
       $(this).val(function(index, value) {
           return value
               .replace(/\D/g, "")
               .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       });
   });
   $("#phone").keypress(function (e) {
       //if the letter is not digit then display error and don't type anything
       if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           //display error message
           return false;
       }
   });
   });
</script>
@endsection