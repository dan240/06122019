@extends('layouts.home')
@section('content')
    <!-----------------nav-end------------------------------>
    <section class="detail-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <div class="card-content">
                                    <h2>{{ @$data['companyName'] }}<span class="location"> Location</span></h2>
                                    <p>{{ @$data['companyTagline'] }}</p>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <img src="{{ asset('images/company_profile_detail.jpg') }}" class="img-responsive" style="width: 100%" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                               
                                <div class="card-content">
                                    <form class="form-horizontal">
                                        <div class="row form-group">

                                            <div class="col-sm-11">
                                                <textarea rows="7" cols="70" placeholder="Profile Text" readonly>{{ @$data['profileText'] }}</textarea>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="video_link"><iframe width="100%" height="500px" src="https://www.youtube.com/embed/voF1plqqZJA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <div class="card-header">
                                    <h3 class="title">Team</h3>
                                </div>
                                <div class="card-content">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">First Name</label>

                                            <label class="col-sm-5 desc">
                                                <h5>{{ @$data['user']['firstname'] }}</h5>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Last Name</label>

                                            <label class="col-sm-5 desc">
                                                <h5>{{ @$data['user']['lastname'] }}</h5>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Job Title</label>

                                            <label class="col-sm-5 desc">
                                                <h5>{{ @$data['jobTitle'] }}</h5>
                                            </label>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <div class="card-content">
                                    <div class="row" style="margin-bottom: 12px">
                                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <button type="submit" class="btn">Message
                                            </button>
                                        </div>

                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                            <button type="submit" class="btn">Request Meeting/Call
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <div class="card-content">
                                    <form class="form-horizontal">
                                        <p class="verify-status-note"><a href="/user/create">Verify Investor Status</a> to make a reservation</p>
                                        <p>&nbsp;</p>
                                        <!--  <button type="submit" class="btn" style="margin: 10px 0px">I'm Interested
                                    </button>-->
                                        <div class="location-link clearfix">
                                            <p class="company-location">
                                                {{ @$data['city'] }} , {{ @$data['country'] }} </p><!-- end .company-location -->
                                            <div class="company-links">
                                                <a href="#" target="_blank"><img src="{{ asset('images/icon-company-facebook-gray.png')}}" /></a>
                                                <a href="#" target="_blank"><img src="{{ asset('images/icon-company-linkedin-gray.png')}}" /></a>
                                                <a href="#" target="_blank"><img src="{{ asset('images/icon-company-twitter-gray.png')}}" /></a>
                                            </div><!-- .company-links -->
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-9 desc">
                                                <h5>Amount Raised $</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['ammountRaised'] }}</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-9 desc">
                                                <h5>Funding Goal $</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['fundingGoal'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Minimum Reservation $</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['minReservation'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Maximum Reservation $</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['maxReservation'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>% Equity</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['equity'] }}</label>
                                        </div>
                                        <div class="form-group">
                                       

                                                <label class="col-sm-9 desc">
                                                    <h5>Open Date</h5>
                                                </label>
                                          
                                            <label class="col-sm-3 control-label">{{ @$data['openDate'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Closing Date</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['closingDate'] }}</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-card">
                                <div class="card-content">
                                    <form class="form-horizontal">
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Company URL</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['companyUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Fundraising URL</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['fundraisUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Linked In URL</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['linkedinUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Facebook in URL</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['fbUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Twitter URL</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['twitterUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Slideshare Link</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['slideshareUrl'] }}</label>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-sm-9 desc">
                                                <h5>Company Firm Video</h5>
                                            </label>
                                            <label class="col-sm-3 control-label">{{ @$data['investorfirmVideo'] }}</label>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @endsection