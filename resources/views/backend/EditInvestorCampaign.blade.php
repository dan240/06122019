@extends('layouts.admin')
@section('content')
     <div class="container-fluid">
    <div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Edit Investor Campaigns</span>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/ViewInvestorCampaign')}}">View Investor Campaign</a>
        </div>
        </div>
    <section class="content-box admin-style company-info">
        <div class="container">
            <div class="col-md-12" id="error-msg"></div>
            {{ Form::open(['method'=>'post','class'=>'SaveEditInvestorCampaign'])}}
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">First Name </small>
                                        <input type="text" class="form-control" name="firstname" value="{{$data['firstname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last Name</small>
                                        <input type="text" class="form-control" name="lastname" value="{{$data['lastname']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Job Title</small>
                                    <input type="text" class="form-control" name="jobTitle" value="{{$data['jobTitle']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Firm Name</small>

                                        <input type="text" class="form-control" name="firmName" value="{{$data['firmName']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>
                                        <input type="email" class="form-control" name="email" value="{{$data['email']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>
                                        <input type="text" class="form-control" name="phoneno" value="{{$data['phoneno']}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>
                                        <input type="text" class="form-control" name="country" value="{{$data['country']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>
                                        <input type="text" class="form-control" name="city" value="{{$data['city']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor url</small>

                                        <input type="email" class="form-control" name="investorfirmUrl" value="{{$data['investorfirmUrl']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Fundraising URL</small>

                                        <input type="text" class="form-control" name="fundraisUrl" value="{{$data['fundraisUrl']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>

                                        <input type="email" class="form-control" name="slideshareUrl" value="{{$data['slideshareUrl']}}">
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor Firm Tagline</small>
                                        <input type="text" class="form-control" name="firmTagline" value="{{$data['firmTagline']}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Investor Firm Profile</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="profileText" rows="4">{{$data['profileText']}}</textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Short Investor Biography</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="bioData" rows="4">{{$data['bioData']}}</textarea>
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investor Type</small>
                                        <select name="investorType" class="form-control">
                                            <option value="0">--Select Investor Type--</option>
                                            @foreach($investortype as $investor)
                                            <option value="{{ $investor['id'] }}" <?php if(@$data['investorType'] == @$investor['id']) echo "selected"; ?>>{{ @$investor['typeInvestor'] }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Type</small>
                                        <select name="investmentType" class="form-control">
                                            <option value="0">--Select Investment Type--</option>
                                            @foreach($investmentType as $investment)
                                            <option value="{{ $investment['id'] }}" <?php if(@$data['investmentType'] == @$investment['id']) echo "selected"; ?>>{{  @$investment['typeInvestment'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Sector Focus</small>
                                        <select name="sectorFocus" class="form-control">
                                            <option value="">--Select Sector Type--</option>
                                            @foreach($sector as $sectors)
                                            <option value="{{ $sectors['id'] }}" <?php if(@$data['sectorFocus'] == @$sectors['id']) echo "selected"; ?>>{{  @$sectors['sectorName'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Industry Focus</small>
                                        <select name="industryFocus" class="form-control">
                                            <option value="">--Select Industry Type--</option>
                                            @foreach($industry as $indusries)
                                            <option value="{{ $indusries['id'] }}" <?php if(@$data['industry']['id'] == @$indusries['id']) echo "selected"; ?>>{{  @$indusries['industryName'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Region Focus</small>
                                        <select name="regionFocus" class="form-control">
                                            <option value="">--Select Region Type--</option>
                                            @foreach($region as $regions)
                                            <option value="{{ $regions['id'] }}" <?php if(@$data['regionFocus'] == @$regions['id']) echo "selected"; ?>>{{  @$regions['regionName'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country Focus</small>
                                        <select name="countryFocus" class="form-control">
                                            <option value="">--Country Focus Type--</option>
                                            @foreach($country as $countries)
                                            <option value="{{ $indusries['id'] }}" <?php if(@$data['countryFocus'] == @$countries['id']) echo "selected"; ?>>{{  @$countries['country_name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Assets Under Management $</small>

                                       <input type="text" class="form-control" name="assetUndermgmt">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range From $</small>

                                       <!-- <input type="text" class="form-control" placeholder="Select Range ">-->
                                        <select name="investmentRangefrm">
                                          <option value="">Select Range</option>
                                          <option value="saab">1090$</option>
                                          <option value="mercedes">1200$</option>
                                          <option value="audi">1050$</option>
                                        </select>
                                    </div>
                                </div>
                                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Investment Range to $</small>
                                        <select name="investmentRangeto">
                                          <option value="">Select Range</option>
                                          <option value="saab">1090$</option>
                                          <option value="mercedes">1200$</option>
                                          <option value="audi">1050$</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$data['id']}}">
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
                                <div class=" signup_btn"><a id="save" class="btn btn-primary nav-link" href="javascript:;">Save</a></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{Form::close()}}
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $("#error-msg").hide();
            $("#save").on('click',function(e){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('Admin/SaveEditInvestorCampaign') }}",
                    data:$('.SaveEditInvestorCampaign').serialize(),
                    sucess:function(response)
                    {
                        console.log(response.msg);
                        if(response.msg=='success')
                        {
                            $("#error-msg").html('<div class="alert alert-success">Data updated successfully .</div>');
                        }else{
                            $("#error-msg").html('<div class="alert alert-danger">Data not updated .</div>');
                        }
                        $("#error-msg").show();
                    }
                })
            })
        })
    </script>
@endsection