
@extends('layouts.home')
@section('content')
    <!-----------------nav-end------------------------------>
    <section class="company_profile">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <div class="row">
                                <div class="col-md-5">
                                    <div class="avatar"> <img src="{{ asset('images/avatar.png')}}" class="img-responsive img-circle"></div>
                                    <button type="submit" class="btn" style="width: 100%">Create account</button>
                                </div>
                                <div class="col-md-7">
                                    <div class="company_propic">
                                        <img src="{{ asset('images/company_profile.jpg')}}" class="img-responsive">
                                    </div>
                                     <button type="submit" class="btn" style="width: 100%">Request Meeting/Call</button>
                                </div>
                            </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
           <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-card">
                                            <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                                        <div class="card-content">
                                            
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investor Firm Tagline</label>
                                                    <label class="col-sm-8 desc">
                                            <h5>{{ @$data['firmTagline'] }}</h5>
                                        </label>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Profile Text</label>
                                                    <label class="col-sm-8 desc">
                                            <h5>{{ @$data['profileText'] }}</h5>
                                        </label>
                                                </div>

                                            
                                        </div>

                                    </div>
                                </div>
                            </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
          <div class="row">
                    <div class="col-md-12">
                         <div class="form-card">
                        <div class="card-header">
                            <h4 class="title" style="visibility: hidden"> Please Fill Personal details:</h4>
                            <a href="#" class="btn-edit"><i class="fa fa-pen"></i></a>
                        </div>
                        <div class="card-content">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">First Name</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['user']['firstname'] }}</h5>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Last Name</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['user']['lastname'] }}</h5>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Job Title</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['jobTitle'] }}</h5>
                                    </label>
                                </div>
               <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm Name</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['firmName'] }}</h5>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['user']['email'] }}</h5>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country</label>
                                      <label class="col-sm-9 desc">
                                            <h5>{{ @$data['country'] }}</h5>
                                    </label>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">City</label>
                                      <label class="col-sm-9 desc">
                                            <h5>{{ @$data['city'] }}</h5>
                                    </label>
                                </div>
                                      <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm URL</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['investorfirmUrl'] }}</h5>
                                    </label>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">LinkedIn URL</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['linkedinUrl'] }}</h5>
                                    </label>
                                </div>
                                       <div class="form-group">
                                    <label class="col-sm-3 control-label">Facebook in URL</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['fbUrl'] }}</h5>
                                    </label>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">Twitter URL</label>
                                      <label class="col-sm-9 desc">
                                            <h5>{{ @$data['twitterUrl'] }}</h5>
                                    </label>
                                </div>
                                       <div class="form-group">
                                    <label class="col-sm-3 control-label">Slideshare Link</label>
                                       <label class="col-sm-9 desc">
                                            <h5>{{ @$data['slideshareUrl'] }}</h5>
                                    </label>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm Video</label>
                                      <label class="col-sm-9 desc">
                                            <h5>{{ @$data['investorFirmvideo'] }}</h5>
                                    </label>
                                </div>
                            </form>
                        </div>

                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                    <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-card">
                            <a href="#" class="btn-edit pull-right"><i class="fa fa-pen"></i></a>
                                                  <div class="card-content">
                                            
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investor Type</label>
                                                       <label class="col-sm-6 desc">
                                            <h5>{{ @$data['investorType'] }}</h5>
                                    </label>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investment Type</label>
                                                   <label class="col-sm-6 desc">
                                            <h5>{{ @$data['investmentType'] }}</h5>
                                    </label>
                                                </div>
                                             <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Sector Focus</label>
                                                   <label class="col-sm-9 desc">
                                            <h5>{{ @$data['sectorFocus'] }}</h5>
                                    </label>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Industry Focus</label>
                                                   <label class="col-sm-9 desc">
                                            <h5>{{ @$data['industryFocus'] }}</h5>
                                    </label>
                                                </div>
                                                           <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Region Focus</label>
                                                  <label class="col-sm-9 desc">
                                            <h5>{{ @$data['regionFocus'] }}</h5>
                                    </label>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Country Focus</label>
                                                   <label class="col-sm-9 desc">
                                            <h5>{{ @$data['countryFocus'] }}</h5>
                                    </label>
                                                </div>
                                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Assets under Management $</label>
                                                 <label class="col-sm-6 desc">
                                            <h5>{{ @$data['assetUndermgmt'] }}</h5>
                                    </label>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investment Range from $</label>
                                                    <label class="col-sm-6 desc">
                                            <h5>{{ @$data['investmentRangefrm'] }}</h5>
                                    </label>
                                                </div>
                                                 <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investment Range to $</label>
                                                    <label class="col-sm-6 desc">
                                            <h5>{{ @$data['investmentRangeto'] }}</h5>
                                    </label>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    <div class="row">
                    <div class="col-md-4"></div>
                        <div class="col-md-4"><button type="submit" class="btn" style="width: 100%">Save</button></div>
                        <div class="col-md-4"><button type="submit" class="btn" style="width: 100%">Publish</button></div>
                    </div>
           
            </div>
            </div>
            
              </div>
    </section>

   @endsection