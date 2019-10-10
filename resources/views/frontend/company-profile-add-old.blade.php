@extends('layouts.home')
@section('content')
    <!-----------------nav-end------------------------------>
    <section class="company_profile">
        <div class="container">
            {{ Form::open(array('method'=>'post','class'=>'form-horizontal')) }}
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="avatar"> <img src="{{ asset('images/avatar.png')}}" class="img-responsive img-circle"></div>
                                <button type="button" class="btn" style="width: 100%">Create account</button>
                            </div>
                            <div class="col-md-7">
                                <div class="company_propic">
                                    <img src="{{ asset('images/company_profile.jpg')}}" class="img-responsive">
                                </div>
                                <button data-toggle="modal" data-target="#requestModal" type="button" class="btn" style="width: 100%">Request Meeting/Call</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-card">
                                    <div class="card-content">
                                        <!--   <form class="form-horizontal">-->
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Company Tagline</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="c_tagline" placeholder="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Profile Text</label>
                                            <div class="col-sm-8">
                                                <textarea rows="4" class="form-control" name="cp_text"></textarea>
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
                                        <h4 class="title"> Please Fill Personal details:</h4>
                                    </div>
                                    <div class="card-content">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="f_name" value="{{ Session::get('fname') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="l_name" value="{{ Session::get('lname') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Job Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="job_title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="dcp_name" id="dcp_name" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control"  name="email" value="{{ Session::get('email') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Country</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="country">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="city">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Company URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cp_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Fundraising URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="fr_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">LinkedIn URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="ld_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Facebook in URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="fb_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Twitter URL</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tw_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Slideshare Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="sd_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Investor Firm Video</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="fv_url">
                                            </div>
                                        </div>

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
                                        </div>

                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Company Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="cp_name" id="cp_name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Type Company</label>
                                                    <div class="col-sm-9">
                                                         <select name="cp_type">
                                                            <option value="Select All">Select All</option>
                                                            <?php foreach($cp_type as $items) { ?>

                                                            <option value="{{ $items }}">{{ $items}}</option>
                                                            <?php } ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Funding Type</label>
                                                    <div class="col-sm-9">
                                                        <select name="fd_type">
                                                            <option value="Select All">Select All</option>
                                                            <?php foreach($fundType as $items) { ?>
                                                            
                                                            <option value="{{ $items }}">{{ $items}}</option>
                                                            <?php } ?>
                                                        </select>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Indutry</label>
                                                    <div class="col-sm-9">
                                                        <select name="industry">
                                                            <option value="Select All">Select All</option>
                                                            <?php foreach($industry as $items) { ?>
                                                            
                                                            <option value="{{ $items }}">{{ $items}}</option>
                                                            <?php } ?>
                                                        </select>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Sector</label>
                                                    <div class="col-sm-9">
                                                        <select name="sector">
                                                            <option value="Select All">Select All</option>
                                                            <?php foreach($sector as $items) { ?>
                                                            
                                                            <option value="{{ $items }}">{{ $items}}</option>
                                                            <?php } ?>
                                                        </select>                                                                                                        </div>
                                                </div>



                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">


                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Amount Raised $</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="amt_raised">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Funding Goal $</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="fd_goal">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Minimum Reservation $</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="min_reserve">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Maximim Reservation $</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="max_reserve">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">% Equity</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="equity">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Open Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="open_date">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Closing Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="close_date">
                                                    </div>
                                                </div>
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
            {{ Form::close() }}
        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="open_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'dd/mm/yyyy',
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

   @endsection