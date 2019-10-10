@extends('layouts.home')
@section('content')
    <!-------------------------nav-end------------------------------>
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
                            <button data-toggle="modal" data-target="#requestModal" type="submit" class="btn" style="width: 100%">Request Meeting/Call</button>
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
                                        <label class="col-sm-3 control-label">Company Tagline</label>
                                        <label class="col-sm-8 desc">
                                            <h5>{{ @$data['companyTagline']}}</h5>
                                        </label>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-3 control-label">Profile Text</label>
                                        <label class="col-sm-8 desc">
                                            <h5>{{ @$data['profileText']}}</h5>
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
                                    <h4 class="title"> Please Fill Personal details:</h4>
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
                                            <label class="col-sm-3 control-label">Company Name</label>
                                             <label class="col-sm-9 desc">
                                            <h5>{{ @$data['companyName'] }}</h5>
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
                                            <h5>{{ @$data['city']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Company URL</label>
                                           <label class="col-sm-9 desc">
                                            <h5>{{ @$data['companyUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fundraising URL</label>
                                            <label class="col-sm-9 desc">
                                            <h5>{{ @$data['fundraisUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">LinkedIn URL</label>
                                            <label class="col-sm-9 desc">
                                            <h5>{{ @$data['linkedinUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Facebook in URL</label>
                                             <label class="col-sm-9 desc">
                                            <h5>{{ @$data['fbUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Twitter URL</label>
                                          <label class="col-sm-9 desc">
                                            <h5>{{ @$data['twitterUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Slideshare Link</label>
                                           <label class="col-sm-9 desc">
                                            <h5>{{ @$data['slideshareUrl']}}</h5>
                                        </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Investor Firm Video</label>
                                         <label class="col-sm-9 desc">
                                            <h5>{{ @$data['investorFirmVideo']}}</h5>
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
                                <div class="card-header">
                                    <div class="row">
                                        <h4 class="title col-md-6 ">Please Fill Fundraising Company Details:
                                        </h4>
                                        <h4 class="title col-md-6 "> Please Fill Fundraising Details:
                                        </h4>
                                        <a href="#" class="btn-edit pull-right"><i class="fa fa-pen"></i></a>
                                    </div>

                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Company Name</label>
                                                <label class="col-sm-9 desc">
                                            <h5>{{ @$data['companyName']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Type Company</label>
                                                 <label class="col-sm-9 desc">
                                            <h5>{{ @$data['companyType']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Funding Type</label>
                                                   <label class="col-sm-9 desc">
                                            <h5>{{ @$data['fundingType']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Indutry</label>
                                                 <label class="col-sm-9 desc">
                                            <h5>{{ @$data['industry']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Sector</label>
                                               <label class="col-sm-9 desc">
                                            <h5>{{ @$data['sector']}}</h5>
                                        </label>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Amount Raised $</label>
                                                <label class="col-sm-9 desc">
                                            <h5>{{ @$data['ammountRaised']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Funding Goal $</label>
                                                <label class="col-sm-9 desc">
                                            <h5>{{ @$data['fundingGoal']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Minimum Reservation $</label>
                                                 <label class="col-sm-9 desc">
                                            <h5>{{ @$data['minReservation']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Maximim Reservation $</label>
                                                  <label class="col-sm-9 desc">
                                            <h5>{{ @$data['maxReservation']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">% Equity</label>
                                                 <label class="col-sm-9 desc">
                                            <h5>{{ @$data['equity']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Open Date</label>
                                                <label class="col-sm-9 desc">
                                            <h5>{{ @$data['profileText']}}</h5>
                                        </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Closing Date</label>
                                                <label class="col-sm-9 desc">
                                            <h5>Lorem Ipsum available</h5>
                                        </label>
                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
 <div class="modal fade" id="requestModal" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">THANK YOU FOR YOUR INTREST</h4>
                </div>
                <div class="modal-body">
                    <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p> <strong>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</strong></p>
                    <form>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group">
                            <label class="control-label">Comments or Questions (Optional)</label>
                            <textarea rows="4" cols="90" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Reserved Amount</button>
                </div>
            </div>

        </div>
    </div>
     <!---------------------------------------request meeting/call
 -------------->
    <!-- Modal -->
  <div class="modal fade" id="requestModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-content">
                <div class="modal-header">
                  <!--  <button type="button" class="close" data-dismiss="modal">×</button>-->
                    <h4 class="modal-title text-center">THANK YOU FOR YOUR INTREST</h4>
                </div>
                <div class="modal-body">
                    <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p> <strong>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</strong></p>
                    <form>
                     
                        <div class="input-group">
                            <label class="control-label">Comments or Questions (Optional)</label>
                            <textarea rows="4" cols="90" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Reserved Amount</button>
                </div>
            </div>
      </div>
      
    </div>
  </div>

   @endsection