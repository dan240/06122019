    @extends('layouts.home')
@section('content')
    <section class="content-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($comInfo['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('uploads/images/'.$data['banner_name']) }}')"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="#">
                                <?php if(!empty($comInfo['image_name'])){?>
                                <img id="displayimage" src="{{ asset('uploads/images/'.$comInfo['image_name'])}}" alt="" title="">
                                <?php } else{ ?>
                                    <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="profile-name">
                            <h2>{{ @$data['firstname']}} {{ @$data['lastname']}}</h2>
                            <h3>Finance Manager</h3>
                           <h4>Company Name</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i> United States, New York</h4>
                        </div>
                        <div class="change-cover">
                            <div class="btn btn-edit btn-change">
                                <label for="upload-photo"><i class="fa fa-pen"></i></label>
                                <input type="file" name="photo" id="upload-photo"></div>
                        </div>
                        <button class="btn btn-meeting float-right" type="button">
                            <i class="fa fa-phone fa-flip-horizontal pull-right"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                        <button class="btn btn-meeting float-right" type="button" style="margin-right: 5px">
                            <i class="fas fa-comments pull-right"></i>
                            <span class="pull-left">Message</span></button>
							
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
                            <li class="breadcrumb-item active"><a href="#">Company Profile</a></li>
							 <li class="breadcrumb-item"><a href="#">Intrested In 29</a></li>
                            <li class="breadcrumb-item active">Expressed Intrest 19</li>
                        </ol>
                    </nav>
                </div>
            </div>
			<div class="row">
       
<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
        <a href="user-full-profile.html">
            <div class="card-content">
                            <div class="card-img-top" style="background-image: url('{{asset('images/41608_8238021.png')}}')"></div>
                            <div class="card-body">
                                <p class="company-location">
                                    San Francisco, California, US </p>
                                <h5 class="card-title">Job Title at Investor Firm Name</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                        <img src="{{ asset('images/user.png')}}" alt="">
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>Lorem Ipsum</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>ABC Text</strong></p>
                                            <p>Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>United States</strong></p>
                                            <p>Country Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>Focus Text</strong></p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card's content.</p>
                            </div>
    </div></a>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
         <a href="user-full-profile.html">
             <div class="card-content">
                            <div class="card-img-top" style="background-image: url(images/41608_823802.png)"></div>
                            <div class="card-body">
                                <p class="company-location">
                                    San Francisco, California, US </p>
                                <h5 class="card-title">Job Title at Investor Firm Name</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                        <img src="images/user.png" alt="">
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>Lorem Ipsum</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>ABC Text</strong></p>
                                            <p>Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>United States</strong></p>
                                            <p>Country Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>Focus Text</strong></p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card's content.</p>
                            </div>
            </div></a>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
         <a href="user-full-profile.html">
             <div class="card-content">
                            <div class="card-img-top" style="background-image: url(images/41608_823802.png)"></div>
                            <div class="card-body">
                                <p class="company-location">
                                    San Francisco, California, US </p>
                                <h5 class="card-title">Job Title at Investor Firm Name</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                        <img src="images/user.png" alt="">
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>Lorem Ipsum</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>ABC Text</strong></p>
                                            <p>Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>United States</strong></p>
                                            <p>Country Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>Focus Text</strong></p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card's content.</p>
                            </div>
                      </div></a>
                  </div>
                  <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                  <a href="user-full-profile.html"><div class="card-content">
                            <div class="card-img-top" style="background-image: url(images/41608_823802.png)"></div>
                            <div class="card-body">
                                <p class="company-location">
                                    San Francisco, California, US </p>
                                <h5 class="card-title">Job Title at Investor Firm Name</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                        <img src="images/user.png" alt="">
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>Lorem Ipsum</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>ABC Text</strong></p>
                                            <p>Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>United States</strong></p>
                                            <p>Country Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 col-xl-4">
                                        <div class="region_div_text">
                                            <p><strong>Focus Text</strong></p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card's content.</p>
                            </div>
                        </div></a>
                    </div>
                   </div>
                    </div>
                </section>

                <!----------------------------------------->
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                                </div>
            				 </div>
                    </div>
                </section>

       @endsection