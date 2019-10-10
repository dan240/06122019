
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo asset('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.css'); ?>">
<script src="<?php echo url('sweetalert/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js'); ?>"></script>
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
    .details-div{
        min-height: 60px;
        padding: 16px 0px 0px 16px;
        border: 1px solid #d3dae2;
        border-radius: 5px;
        font-size: 16px;
    }
</style>
    <!-- -->
    <section class="content-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($data['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('<?php echo e(asset('uploads/images/'.$data['banner_name'])); ?>');"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('<?php echo e(asset('images/profile_banner.jpg')); ?>')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="#">
                                <?php if(!empty($data['image_name'])){?>
                                <img id="displayimage" src="<?php echo e(asset('uploads/images/'.$data['image_name'])); ?>" alt="" title="">
                                <?php } else{ ?>
                                    <img id="displayimage" src="<?php echo e(asset('images/user.png')); ?>" alt="" title="">
                                <?php } ?>

                            </a>
                        </div>
                        <div class="profile-name">
                            <h2><?php echo e(@$data['user']['firstname']." ".@$data['user']['lastname']); ?></h2>
                            <h3><?php echo e(@$data['jobTitle']); ?></h3>
                           <h4><?php echo e(@$data['companyName']); ?></h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i> <?php echo e($data['country_data']['country_name'] .", ". $data['city_data']['city_name']); ?></h4>
                        </div>
                        <?php if(session()->has('User')){?>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#requestModal1">
                            <i class="fa fa-phone fa-flip-horizontal pull-left"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#requestModal2">
                            <i class="fas fa-comments pull-left"></i>
                            <span class="pull-left">Message</span></button>
                        <?php } else { ?>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fa fa-phone fa-flip-horizontal pull-left"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                            <button class="btn btn-meeting float-right" type="button" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fas fa-comments pull-left"></i>
                            <span class="pull-left">Message</span></button>

                        <?php } ?>
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

    <!-- -->
    <section>
        <div class="container">
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">FIRST NAME </small>

                                        <input type="text" class="form-control" name="fname" value = "<?php echo e(@$data['user']['firstname']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last NAME</small>

                                        <input type="text" class="form-control"  name="lname" value="<?php echo e(@$data['user']['lastname']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Job Title</small>

                                        <input type="text" class="form-control"  name="job_title" value="<?php echo e($data['jobTitle']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Name</small>

                                        <input type="text" class="form-control"  name="cp_name" value="<?php echo e($data['companyName']); ?>" readonly>
                                    </div>
                                </div>
                                <?php if($see_contacts=='yes'){?>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>
                                        <input type="email" class="form-control" name="email" value="<?php echo e($data['email']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>

                                        <input type="text" class="form-control" name="phoneno" value="<?php echo e($data['phoneno']); ?>" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>

                                        <input type="text" class="form-control" name="country" value="<?php echo e($data['country_data']['country_name']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>

                                        <input type="text" class="form-control" name="city" value="<?php echo e($data['city_data']['city_name']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company url</small>

                                        <input type="email" class="form-control" name="cp_url" value="<?php echo e($data['companyUrl']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Fundraising URL</small>

                                        <input type="email" class="form-control" name="fr_url" value="<?php echo e(@$data['fundraisUrl']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Video</small>

                                        <input type="email" class="form-control" name="fv_url" value="<?php echo e(@$data['investorFirmvideo']); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>

                                        <input type="email" class="form-control" name="sd_url"  value="<?php echo e($data['slideshareUrl']); ?>" readonly>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="form-card">

                        <div class="card-content">
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Company Profile</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <p>Company Tagline</p>
                                    <input type="text" class="form-control" value="<?php echo e($data['companyTagline']); ?>" readonly disabled />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    <p>Company Profile</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" style="resize:none" placeholder="" rows="4" readonly disabled><?php echo e(@$data['profileText']); ?></textarea>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Personal Biography</p>
                                    <div class="form-group inner-label-holder textarea">

                                        <textarea class="form-control" style="resize:none" placeholder="" rows="4" readonly disabled><?php echo e(@$data['personalBio']); ?></textarea>

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
                                    <h3>Company Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                        <?php $comType = explode(",",@$data['companyType']); $cmp = [];?>
                                        <?php $__currentLoopData = $ctype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($comtype['id'], $comType)){
                                                $cmp[] =  $comtype['typeCompanies'];
                                            }?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="form-group inner-label-holder"> 
                                        <small class="label" for="input">Company Type</small>

                                        <div class="details-div"><?php echo e(implode(', ',$cmp)); ?></div>
                                        </div>

                                            
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                     <?php print_r(@$data['type_funding']); ?>
                                    <div class="form-group inner-label-holder" style="height: auto!important;">
                                    
                                    <?php $funType = explode(",",@$data['fundingType']);  $f_typ = [];?>
                                    <?php $__currentLoopData = $tfunding; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ftype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php if(in_array($ftype['id'], $funType)){
                                           $f_typ[] = $ftype['typeFunding'];
                                       }?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <small class="label" for="input">Funding Type</small>

                                    <div class="details-div"><?php echo e(implode(', ',$f_typ)); ?></div>
                                    

                                    

                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                       <!--  <input type="email" class="form-control" name="sd_url"  value="<?php echo e(@$data['sector']['sectorName']); ?>" readonly> -->
                                       <?php $secType = explode(",",@$data['sector']); $sec = [];?>
                                          <?php $__currentLoopData = $stype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($sector['id'], $secType)){
                                                $sec[] = $sector['sectorName'];
                                            }?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <small class="label" for="input">Sector Type</small>

                                        <div class="details-div"><?php echo e(implode(', ',$sec)); ?></div>
                                    

                                       
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder" style="height: auto!important;"> 
                                        <!-- <input type="email" class="form-control" name="sd_url"  value="<?php echo e(@$data['industry']['industryName']); ?>" readonly>  -->
                                    
                                    <small class="label" for="input">Industry</small>
                                    <?php $indType = explode(",",@$data['industry']); $inds = []; ?>
                                        <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($ind['id'], $indType)){
                                                $inds[] = $ind['industryName'];
                                            }?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="details-div"><?php echo e(implode(', ',$inds)); ?></div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="form-card">

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Fundraising Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Amount Raised $</small>

                                        <input type="text" class="form-control" name="amt_raised" value="<?php echo e(@$data['ammountRaised']); ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Funding Goal $</small>

                                        <input type="text" class="form-control" name="fd_goal" value="<?php echo e(@$data['fundingGoal']); ?> $" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Minimum Reservation $</small>

                                        <input type="text" class="form-control" name="min_reserve" value="<?php echo e(@$data['minReservation']); ?> $" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Maximum Reservation $</small>

                                        <input type="text" class="form-control" name="max_reserve" value="<?php echo e(@$data['maxReservation']); ?> $" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">% Equity</small>

                                        <input type="text" class="form-control" name="equity" value="<?php echo e(@$data['equity']); ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Open Date</small>
                                        <input type="text" class="form-control" name="open_date" value="<?php echo e(@$data['openDate']); ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Closing Date</small>
                                        <input type="text" class="form-control" name="close_date" value="<?php echo e(@$data['closingDate']); ?>" readonly>

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

                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <h3>Video</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <?php $t = preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "//www.youtube.com/embed/$2",
            $data['investorFirmvideo']
        ); ?>
                                    <iframe width="100%" height="500px" src="<?php echo e(@$t); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-card">

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
                                  <small class="label" for="input">LinkedIn URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e(@$data['linkedinUrl']); ?>" readonly>
                                </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f navy"></i></span>
                                  </div>
                                  <small class="label" for="input">Facebook URL</small>
                                  <input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e(@$data['fbUrl']); ?>" readonly>
                                </div>
                                </div>
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                              <div class="input-group form-group inner-label-holder">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter skyblue"></i></span>
                                  </div>
                                  <small class="label" for="input">Twitter URL</small><input type="text" class="form-control" placeholder="Enter link here" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo e(@$data['twitterUrl']); ?>" readonly>
                                </div>
                                </div>


                      
                            </div>

                            <div class="card-content social">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3>Share</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>

                            </div>
                            <div class="card-content social">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h3>Report</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        
                                        <?php if(session()->has('User')){?>
                                            <button class="btn btn-warning btn-sm" type="button" data-toggle="modal" data-target="#requestModal3">
                                            <span class="pull-left">Report/Abuse</span></button>

                                        <?php } else { ?>
                                            <button class="btn btn-warning btn-sm " type="button" data-toggle="modal" data-target="#exampleModalLong">
                                                <span class="pull-left">Report/Abuse</span>
                                            </button>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                
                
            </div>
        </div>
          
  </section>
           <!---------------------------------------request meeting/call
 -------------->
    <!-- Modal -->
  <div class="modal fade" id="requestModal1" role="dialog">
    <div class="modal-dialog">
    <?php echo e(Form::open(['class'=>'submitRequest','method'=>'post'])); ?>

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">THANK YOU FOR YOUR INTEREST
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 meeting-error"></div>
        <div class="modal-body">
        <div class="form-group">
            <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">$</span>
    </div>
    <input type="text" class="form-control" name="reserved_amount" id="reserved_amount" placeholder="Maximum Reservation $6,000,000">
  </div>
         </div>    
        <div class="form-group"> <label>Add Comments</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="<?php echo e($data['userid']); ?>">
        <textarea class="form-control" name="message" placeholder="Add you comments here..." rows="4"></textarea>

        </div>
        </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <input type="radio" id="test1" name="meeting" value="1">
                    <label for="test1">Meet During Conference</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test3" name="meeting" value="3">
                    <label for="test3">Meet in Investors Office</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test2" name="meeting" value="2">
                    <label for="test2">Conference Call</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test4" name="meeting" value="4">
                    <label for="test4">Meet in Fundraiser Office</label>
                    </div>
                </div>
            </div>
        <div class="form-group">
        <button type="submit" id="post1" class="login-btn">Submit</button>
        </div>


        </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
  <div class="modal fade" id="requestModal2" role="dialog">
    <div class="modal-dialog">
    <?php echo e(Form::open(['class'=>'submitMessage','method'=>'post'])); ?>

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">THANK YOU FOR YOUR INTEREST
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 message-error"></div>
        <div class="modal-body">
             <!-- <div class="form-group">
            <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">$</span>
    </div>
    <input type="text" class="form-control" placeholder="Maximum Reservation $6,000,000">
  </div>
         </div> -->
        <div class="form-group"> <label>Add Comments</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="<?php echo e($data['userid']); ?>">
        <textarea class="form-control" name="message" placeholder="Add you comments here..." rows="4"></textarea>

        </div>
        </div>

           <!--  <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                    <input type="radio" id="test5" name="meeting" value="1">
                    <label for="test5">Meet During Conference</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test6" name="meeting" value="2">
                    <label for="test6">Conference Call</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test7" name="meeting" value="3">
                    <label for="test7">Meet in Investors Office</label>
                    </div>
                    <div class="col-md-6">
                    <input type="radio" id="test8" name="meeting" value="4">
                    <label for="test8">Meet in Fundraiser Office</label>
                    </div>
                </div>
            </div> -->
        <div class="form-group">
        <button type="submit" id="post2" class="login-btn">Submit</button>
        </div>


        </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>



    <div class="modal fade" id="requestModal3" role="dialog">
    <div class="modal-dialog">
    <?php echo e(Form::open(['class'=>'submitAbuse','method'=>'post'])); ?>

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLongTitle">Report user as abuse
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert alert-danger col-md-12 message-error"></div>
        <div class="modal-body">
        <div class="form-group"> <label>Description</label>
        <div class="form-group inner-label-holder textarea">
        <input type="hidden" name="reciever_id" value="<?php echo e($data['userid']); ?>">
        <textarea class="form-control" name="message" placeholder="Add you description here..." rows="4"></textarea>

        </div>
        </div>
        <div class="form-group">
        <button type="submit" id="report" class="login-btn">Report</button>
        </div>


        </div>
        </div>
      <?php echo e(Form::close()); ?>

    </div>
  </div>
  
    <script>
        $(document).ready(function(){
            

            $(".chosen-select").chosen();
            $(".meeting-error").hide();
            $(".message-error").hide();
            $(".submitRequest").validate({
                errorLabelContainer: ".meeting-error",
                wrapper: "li",
                  rules: {
                        message: {required:true},
                        meeting: {required:true},
                    },
                    
                    messages: {
                        message:'Message should not be empty!!',
                        meeting: 'Please select an option',
                    },
                submitHandler: function() {
                    $(".submitRequest").submit();
                }
           });

            $(".submitMessage").validate({
                errorLabelContainer: ".message-error",
                wrapper: "li",
                  rules: {
                        message: {required:true},
                        meeting: {required:true},
                    },
                    
                    messages: {
                        message:'Message should not be empty!!',
                        meeting: 'Please select an option',
                    },
                submitHandler: function() {
                    $(".submitMessage").submit();
                }
           });
            $("#post1").on('click',function(e){
                if($(".submitRequest").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/requestMeeting')); ?>",
                        data:$(".submitRequest").serialize(),
                        success:function(response){
                            $(".se-pre-con").fadeOut("slow");
                            //var response = JSON.parse(response);
                            if(response.msg == "success"){
                                $(".meeting-error").text('Your request sent successfully');
                                $('.meeting-error').show();
                                
                                $('#requestModal1').modal("toggle");
                                swal({
                                    title: "Thank you for your meeting.",
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });

                            }
                            // else if(response.msg=="meetinglimit"){
                            //         alert();
                            //         window.location.href = "<?php echo e(url('User/MessageLimits')); ?>";
                            // }
                            else if(response.code == 2 && response.msg == 'meetinglimit'){
                                
                                $('#requestModal1').modal("toggle");
                                swal({
                                    title: "Your free trail meeting limit has been exceeded. Please renew your account to get unlimited access.",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                        setTimeout(() => {
                                            window.location = "<?php echo e(url('/User/fundraising')); ?>";
                                        }, 1);
                                });

                            }else if(response.code == 2 && response.msg == 'notApproved'){
                                swal({
                                    title: "You can send messages / meeting requests once account is approved",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });
                            }
                             else {
                                $(".meeting-error").text(response.msg);
                                $('.meeting-error').show();
                            }
                            
                            $('#requestModal1').modal('toggle');
                        }
                    });
                }
            })

            $("#post2").on('click',function(e){
                if($(".submitMessage").valid()){
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/requestMessage')); ?>",
                        data:$(".submitMessage").serialize(),
                        success:function(response){
                            $('#requestModal2').modal('toggle');
                            if(response.msg == "success"){
                                $(".message-error").text('Your message sent successfully');
                                $(".message-error").show();

                                $('#requestModal2').modal("toggle");
                                swal({
                                    title: "Thank you for your message.",
                                    text: "",
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });

                            }else if(response.code == 2 && response.msg == 'msglimit'){
                                $('#requestModal2').modal("toggle");
                                swal({
                                    title: "Your free trail message limit has been exceeded. Please renew your account to get unlimited access.",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                        setTimeout(() => {
                                            window.location = "<?php echo e(url('/User/fundraising')); ?>";
                                        }, 1);
                                });
                            }else if(response.code == 2 && response.msg == 'notApproved'){
                                swal({
                                    title: "You can send messages / meeting requests once account is approved",
                                    text: "",
                                    type: "warning",
                                    showCancelButton: false,
                                    showConfirmButton : true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ok!",
                                    },function(){
                                });
                            }
                            $('#requestModal2').modal('toggle');
                        }
                    });
                }
            });
            $("#report").on('click',function(e){
                
                    e.preventDefault();
                    $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/reportAbuse')); ?>",
                        data:$(".submitAbuse").serialize(),
                        success:function(response){
                            if(response.msg == "success"){
                                $(".message-error").text('Your message sent successfully');
                                $(".message-error").show();
                            }else {
                                $(".meeting-error").text(response.msg);
                                $('.meeting-error').show();
                            }
                            $('#requestModal3').modal('toggle');
                        }
                    });
                
            });
        });
          $('input#reserved_amount').keyup(function(e) {

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
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/ec2-35-177-235-3.eu-west-2.compute.amazonaws.com/public_html/resources/views/frontend/company-profile-view.blade.php ENDPATH**/ ?>