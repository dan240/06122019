@extends('layouts.admin')
@section('content')
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
<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">User Info</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/User')}}">User List</a>
        </div>
     	</div>
     	<div class="error-msg col-md-12"></div>
     	{{Form::open(['method'=>'post','class'=>'updateUserData'])}}
     	<?php $dataResult = $data->toArray();
     	if($dataResult['usertype']==2){
     	?>
     	<div class="company-info">
			<div class="row">
	          	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			     	<fieldset class="scheduler-border">
					    <legend class="scheduler-border">Personal and Investor Information</legend>
					    
					    <input type="hidden" name="id" value="{{ $InvestorData['userid'] }}">
					<input type="hidden" name="userType" value="{{ $dataResult['usertype'] }}">
	          			<div class="row">
		          			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firstname">First Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="firstname" name="firstname" placeholder="First Name" value="{{@$InvestorData['firstname']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="lastname">Last Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="lastname" name="lastname" placeholder="Last Name" value="{{@$InvestorData['lastname']}}"/>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="email">Email :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="email" name="email" placeholder="Email" value="{{@$InvestorData['email']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="phone">Phone :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="phone" name="phone" placeholder="Phone" value="{{@$InvestorData['phoneno']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="jobTitle">Job Title :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="jobTitle" name="jobTitle" placeholder="Job Title" value="{{@$InvestorData['jobTitle']}}"/>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firm_name">Investor Firm Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="firm_name" name="firm_name" placeholder="Firm Name" value="{{@$InvestorData['firmName']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="country">Country :</label>
							        <div class="controls ">
							            <select name="country" id="country">
                                            <option value="0">--Select Company Type--</option>
                                            @foreach($country as $con)
                                                <option value="{{ $con['id'] }}" <?php if(@$InvestorData['country'] == @$con['id']) echo "selected"; ?>>{{ @$con['country_name'] }}</option>
                                            @endforeach
                                        </select>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="city">City :</label>
							        <div class="controls ">
							            <select id="city" name="city">
                                            @foreach($city as $con)
                                                <option value="{{ $con['id'] }}" <?php if(@$InvestorData['city'] == @$con['id']) echo "selected"; ?>>{{ @$con['city_name'] }}</option>
                                            @endforeach
                                        </select>
							        </div>
							    </div>
							</div>
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firm_url">Investor Firm Url :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="firm_url" name="firm_url" placeholder="Firm Url" value="{{@$InvestorData['investorfirmUrl']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="fundraising_url">Investor Firm Fundraising Url :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="fundraising_url" name="fundraising_url" placeholder="Fundraising Url" value="{{@$InvestorData['fundraisUrl']}}" />
							        </div>
							    </div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firm_video">Investor Firm Video :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="firm_video" name="firm_video" placeholder="Firm Video" value="{{@$InvestorData['investorFirmvideo']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="slideshare_url">Slideshare Url :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="slideshare_url" name="slideshare_url" placeholder="Slideshare Url" value="{{@$InvestorData['slideshareUrl']}}" />
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
                                            <?php $invtrType = explode(",",$InvestorData['investorType']); ?>
                                            @foreach($investor as $in)
                                                <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $invtrType)) echo "selected"; ?>>{{ $in['typeInvestor'] }}</option>
                                            @endforeach
                                        </select>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="investment_type">Investment Type :</label>
							        <div class="controls ">
							            <select name="investmentType[]" class="chosen-select" multiple>
                                            <option value="">--Select Investment Type--</option>
                                            <option value="0">Select All</option>
                                            <?php $invType = explode(",",$InvestorData['investmentType']); ?>
                                            @foreach($investment as $in)
                                                <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $invType)){echo "selected";}?>>{{ $in['typeInvestment'] }}</option>
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
                                                <?php $sec = explode(",",$InvestorData['sectorFocus']);
                                                foreach($sector as $se) {   
                                                ?>
                                                        <option value="{{ $se['id'] }}" <?php if(in_array($se['id'], $sec)){echo "selected";}?>>{{ $se['sectorName']}}</option>
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
                                                <?php  $ind = explode(",",$InvestorData['industryFocus']);
                                                        foreach ($industry as $in) { ?>
                                                        <option value="{{ $in['id'] }}" <?php if(in_array($in['id'], $ind)){ echo "selected"; }?>>{{ $in['industryName']}}</option>
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
                                            <?php $in = explode(",",@$InvestorData['regionFocus']);
                                                
                                                    foreach ($region as $re) { ?>
                                                    <option value="{{ $re['id'] }}" <?php if(in_array($re['id'] , $in)){ echo "selected"; } ?>>{{ $re['regionName']}}</option>
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
                                                <?php  $cont = explode(",",$InvestorData['countryFocus']);
                                                    foreach ($country as $co) { ?>
                                                        <option value="{{ $co['id'] }}" <?php if(in_array($co['id'] , $cont)){ echo "selected"; } ?>>{{ $co["country_name"]}}</option>
                                                <?php  } ?>
                                        </select>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="assets">Assets Under Management :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="assets" name="assets" placeholder="Assets Under Management"  value="{{@$InvestorData['assetUndermgmt']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="range_from">Investment Range From $ :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="range_from" name="range_from" placeholder="Investment Range From $"  value="{{@$InvestorData['investmentRangefrm']}}" />
							        </div>
							    </div>
							</div>
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="range_to">Investment Range To $ :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="range_to" name="range_to" placeholder="Investment Range To $"  value="{{@$InvestorData['investmentRangeto']}}" />
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
							            <input type="text"  type="text" id="firm_tagline" name="firm_tagline" placeholder="Investor Firm Tagline " value="{{@$InvestorData['firmTagline']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firm_profile">Investment Firm Profile :</label>
							        <div class="controls ">
							            <textarea class="form-control" rows="5" id="firm_profile" name="firm_profile" placeholder="Investment Firm Profile">{{@$InvestorData['profileText']}}</textarea>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="bio_data">Short Investor Biography :</label>
							        <div class="controls ">
							        	<textarea class="form-control" rows="5" id="bio_data" name="bio_data" placeholder="Short Investor Biography">{{@$InvestorData['bioData']}}</textarea>
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
							            <input type="text"  type="text" id="linkedin" name="linkedin" placeholder="Linkedin" value="{{@$InvestorData['linkedinUrl']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="facebook">Facebook :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="facebook" name="facebook" placeholder="Facebook" value="{{@$InvestorData['fbUrl']}}" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="twitter">Twitter :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="twitter" name="twitter" placeholder="Twitter" value="{{@$InvestorData['twitterUrl']}}" />
							        </div>
							    </div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
     	<div class="company-info">
			
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<a class="btn btn-primary" href="javascript:;" id="save" style="margin:20px 0px">Save</a>
				</div>
			</div>
		</div>
		<?php }else if($dataResult['usertype']==1){ ?>
			
			

			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

					<input type="hidden" name="id" value="{{ $CompanyData['userid'] }}">
					<input type="hidden" name="userType" value="{{ $dataResult['usertype'] }}">

			     	<fieldset class="scheduler-border">
					    <legend class="scheduler-border">Personal and Company Information</legend>
	          			<div class="row">
		          			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="firstname">First Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="firstname" name="firstname" placeholder="First Name" value="{{ @$CompanyData['fname']}}" class="form-control" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="lastname">Last Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="lastname" name="lastname" placeholder="Last Name" value="{{@$CompanyData['lname']}}" class="form-control" />
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="jobTitle">Job Title :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="jobTitle" name="jobTitle" placeholder="Job Title" value="{{@$CompanyData['jobTitle']}}" class="form-control"/>
							        </div>
							    </div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="companyName">Company Name :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="companyName" name="companyName" placeholder="Company Name" value="{{@$CompanyData['companyName']}}" class="form-control"/>
							        </div>
							    </div>
							</div>

	                        


							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="email">Email :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="email" name="email" placeholder="Email" value="{{@$CompanyData['email']}}" class="form-control"/>
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="phone">Phone :</label>
							        <div class="controls ">
							            <input type="text"  type="text" id="phone" name="phone" placeholder="Phone" value="{{@$CompanyData['phoneno']}}" class="form-control"/>
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
                                                <option value="{{ $con['id'] }}" <?php if(@$CompanyData['country'] == @$con['id']) echo "selected"; ?>>{{ @$con['country_name'] }}</option>
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
                                                <option value="{{ $con['id'] }}" <?php if(@$CompanyData['city'] == @$con['id']) echo "selected"; ?>>{{ @$con['city_name'] }}</option>
                                            @endforeach
                                        </select>
							        </div>
							    </div>
							</div>
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="cp_url">Investor Company Url :</label>
							        <div class="controls ">
							            <input type="url" class="form-control" name="cp_url" id="cp_url" value="{{ $CompanyData['companyUrl']}}">
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="fr_url">Fundraising Url :</label>
							        <div class="controls ">
							            <input type="email" class="form-control" name="fr_url" id="fr_url" value="{{ @$CompanyData['fundraisUrl']}}">
							        </div>
							    </div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="fv_url">Investor Company Video :</label>
							        <div class="controls ">
							            <input type="url" class="form-control" name="fv_url" id="fv_url" value="{{ @$CompanyData['investorFirmvideo']}}">
							        </div>
							    </div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
							    <div class="form-group">
							        <label class="control-label input-label" for="slideshare_url">Slideshare Url :</label>
							        <div class="controls ">
							            <input type="url" class="form-control" name="sd_url" id="sd_url" value="{{ $CompanyData['slideshareUrl']}}">
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
							            <input type="text"  type="text" id="c_tagline" name="c_tagline" placeholder="First Name" value="{{ @$CompanyData['companyTagline']}}" class="form-control" />
							        </div>
							    </div>

                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                
                                <label class="control-label input-label" for="c_tagline">Company Profile :</label>
                                <div class="controls ">
                                    <textarea class="form-control" rows="4" id="cp_text" name="cp_text">{{ @$CompanyData['profileText']}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                               

                                <label class="control-label input-label" for="c_tagline">Company Biography :</label>
                                <div class="controls ">
                                    <textarea class="form-control"rows="4" name="personalBio" id="personalBio">{{ @$CompanyData['personalBio']}}</textarea>
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
                                            <?php $comType = explode(",",@$CompanyData['companyType']); ?>
                                            @foreach($ctype as $comtype)
                                                <option value="{{ $comtype['id'] }}" <?php if(in_array($comtype['id'], $comType)){echo "selected";}?>>{{ $comtype['typeCompanies'] }}</option>
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
                                            <?php $funType = explode(",",@$CompanyData['fundingType']); ?>
                                           @foreach($tfunding as $ftype)
		                                        <option value="{{ $ftype['id'] }}" <?php if(in_array($ftype['id'], $funType)){echo "selected";}?>>{{ $ftype['typeFunding'] }}</option>
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
                                            <?php $secType = explode(",",@$CompanyData['sector']); ?>
                                          @foreach($stype as $sector)

                                            

                                            <option value="{{ $sector['id'] }}" <?php if(in_array($sector['id'], $secType)){echo "selected";}?>>{{ $sector['sectorName'] }}</option>
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
                                            <?php $indType = explode(",",@$CompanyData['industry']); ?>
                                          @foreach($industry as $ind)

                                          <option value="{{ $ind['id'] }}" <?php if(in_array($ind['id'], $indType)){echo "selected";}?>>{{ $ind['industryName'] }}</option>


	                                            
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
                                    	<input type="text" class="form-control" id="amt_raised" value="{{ @$CompanyData['ammountRaised']}}" name="amt_raised" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="fd_goal">Funding Goal $ :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="fd_goal" value="{{ @$CompanyData['fundingGoal']}}" name="fd_goal" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="min_reserve">Minimum Reservation $ :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="min_reserve" value="{{ @$CompanyData['minReservation']}}" name="min_reserve" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="max_reserve">Maximum Reservation $ :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="max_reserve" value="{{ @$CompanyData['maxReservation']}}" name="max_reserve" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="equity">% Equity :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="equity" value="{{ @$CompanyData['equity']}}" name="equity" class="form-control">
                                    </div>

                                </div>
                            </div>


                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="open_date">Open Date :</label>
                                	<div class="controls ">
                                    	<input type="date" class="form-control" id="open_date" value="{{ @$CompanyData['openDate']}}" name="open_date" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="close_date">Closing Date :</label>
                                	<div class="controls ">
                                    	<input type="date" class="form-control" id="close_date" value="{{ @$CompanyData['closingDates']}}" name="close_date" class="form-control">
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
                                    	<input type="text" class="form-control" id="linkedinUrl" value="{{ @$CompanyData['linkedinUrl']}}" name="linkedinUrl" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="fbUrl">Fabebook Url :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="fbUrl" value="{{ @$CompanyData['fbUrl']}}" name="fbUrl" class="form-control">
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group"> 
                                	<label class="control-label input-label" for="twitterUrl">Twitter Url :</label>
                                	<div class="controls ">
                                    	<input type="text" class="form-control" id="twitterUrl" value="{{ @$CompanyData['twitterUrl']}}" name="twitterUrl" class="form-control">
                                    </div>

                                </div>
                            </div>

						</div>
					</fieldset>
                </div>

			</div>

			<div class="company-info">
			
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<a class="btn btn-primary" href="javascript:;" id="save" style="margin:20px 0px">Save</a>
					</div>
				</div>
			</div>
                
            </div>

        </div>
		<?php } ?>
	{{Form::close()}}
</div>
<script>
	$(document).ready(function(){

		
		$('.error-msg').hide();
		$(".se-pre-con").fadeOut("slow");
		$(".chosen-select").chosen();
		$('#save').on('click',function(e){
			e.preventDefault();
			
			
			$('.error-msg').hide();
			$.ajax({
				method:"POST",
				url:"{{ url('Admin/SaveUser')}}",
				data:$('.updateUserData').serialize(),
				success:function(response)
				{
					

					if(response.msg=='success')
					{
						$('.error-msg').html('<div class="alert alert-success">Data updated successfully.</div>');
						$('.error-msg').show();
					}else{
						$('.error-msg').html('<div class="alert alert-danger">Data not updated.</div>');
						$('.error-msg').show();
					}
				}
			})
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
	})
	</script>
@endsection