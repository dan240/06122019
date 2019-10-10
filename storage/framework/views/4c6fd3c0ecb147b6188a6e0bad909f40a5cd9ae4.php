
<?php $__env->startSection('content'); ?>
   <div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Add Company Campaign</span>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="<?php echo e(url('Admin/ViewCompanyCampaign')); ?>">View Company Campaign</a>
        </div>
    </div>
    <section class="content-box admin-style company-info">
        <div class="container">
            <div class="col-md-12" id="error-msg"></div>
            <?php echo e(Form::open(['method'=>'post','class'=>'AddCompanyCompaign'])); ?>

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
                                        <input type="text" class="form-control" name="firstname" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Last Name</small>
                                        <input type="text" class="form-control" name="lastname" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Job Title</small>
                                    <input type="text" class="form-control" name="jobTitle">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Name</small>
                                        <input type="text" class="form-control" name="companyName">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Email</small>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Phone Number</small>
                                        <input type="text" class="form-control" name="phoneno">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Country</small>
                                        <select name="country" id="country" class="form-control">
                                            <option value="0">--Select Country--</option>
                                            <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($countries['id']); ?>"><?php echo e(@$countries['country_name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">City</small>
                                        <select name="city" id="city" class="form-control">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company url</small>
                                        <input type="email" class="form-control" name="companyUrl" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Fundraising URL</small>
                                        <input type="text" class="form-control" name="fundraisUrl" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Slideshare URL</small>
                                        <input type="email" class="form-control" name="slideshareUrl">
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Company Tagline</small>
                                        <input type="text" class="form-control" name="companyTagline">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Company Profile</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="profileText" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <p>Personal Biography</p>
                                    <div class="form-group inner-label-holder textarea">
                                        <textarea class="form-control" name="personalBio" rows="4"></textarea>
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
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Type Company</small>
                                        <select name="companyType" class="form-control">
                                            <option value="0">--Select Company Type--</option>
                                            <?php $__currentLoopData = $companyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($comtype['id']); ?>"><?php echo e(@$comtype['typeCompanies']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Funding Type</small>
                                        <select name="fundingType" class="form-control">
                                            <option value="0">--Select Funding Type--</option>
                                            <?php $__currentLoopData = $fundType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ftype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($ftype['id']); ?>"><?php echo e(@$ftype['typeFunding']); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Sector Type</small>
                                        <select name="sector" class="form-control">
                                            <option value="0">--Select Funding Type--</option>
                                            <?php $__currentLoopData = $sector; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sectors['id']); ?>"><?php echo e(@$sectors['sectorName']); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Industry</small>
                                        <select name="industry" class="form-control">
                                            <option value="0">--Select Funding Type--</option>
                                            <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indusries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($indusries['id']); ?>" ><?php echo e(@$indusries['industryName']); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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
                                        <input type="text" class="form-control" name="ammountRaised" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Funding Goal $</small>
                                        <input type="text" class="form-control" name="fundingGoal">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Minimum Reservation $</small>

                                        <input type="text" class="form-control" name="minReservation">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Maximum Reservation $</small>
                                        <input type="text" class="form-control" name="maxReservation">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">% Equity</small>
                                        <input type="text" class="form-control" name="equity">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Open Date</small>
                                        <input type="text" class="form-control" name="openDate">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group inner-label-holder"> <small class="label" for="input">Closing Date</small>
                                        <input type="text" class="form-control" name="closingDate">
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <?php echo e(Form::close()); ?>

        </div>
    </section>
    <script>
        $(document).ready(function(){
            $("#country").on('change',function(){
                var country = $(this).val();
                $.ajax({
                    method:"POST",
                    url:"<?php echo e(url('Admin/GetCityList')); ?>",
                    data:{"_token":"<?php echo e(csrf_token()); ?>",cid:country},
                    success:function(response)
                    {
                        var appenddata;
                        var data = JSON.parse(response);
                            appenddata +="<option value=''>---Select City---</option>";
                         $.each(data, function (key, value) {
                             appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                         });
                        $('#city').html(appenddata);
                    }
                })
            });


            $("#error-msg").hide();
            $("#save").on('click',function(e){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"<?php echo e(url('Admin/AddCompanyCompaign')); ?>",
                    data:$('.AddCompanyCompaign').serialize(),
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/AddCompanyCampaignForm.blade.php ENDPATH**/ ?>