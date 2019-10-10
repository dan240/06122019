
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
                                        <img src="{{ asset('images/company_profile.jpg') }}" class="img-responsive">
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
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Profile Text</label>
                                                    <div class="col-sm-8">
                                                        <textarea rows="4" class="form-control"></textarea>
                                                    </div>
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
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Job Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
               <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                      <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">LinkedIn URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                       <div class="form-group">
                                    <label class="col-sm-3 control-label">Facebook in URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">Twitter URL</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                       <div class="form-group">
                                    <label class="col-sm-3 control-label">Slideshare Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                         <div class="form-group">
                                    <label class="col-sm-3 control-label">Investor Firm Video</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" >
                                    </div>
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
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investment Type</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                             <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Sector Focus</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Industry Focus</label>
                                                    <div class="col-sm-9">
                                                       <textarea rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                           <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Region Focus</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Country Focus</label>
                                                    <div class="col-sm-9">
                                                       <textarea rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Assets under Management $</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                               <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Investment Range from $</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <label class="col-sm-3 control-label">​Investment Range to $</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
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