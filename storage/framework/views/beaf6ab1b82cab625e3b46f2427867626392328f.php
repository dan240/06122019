<?php $__env->startSection('content'); ?>
    <!-- -->
    <section class="content-box">
        <div class="container">
            <div class="filter_div">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="browse-name-search">
                            <input type="text" placeholder="Search by company name" maxlength="40" id="browse-name-search" value="" autocomplete="off">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <ul>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Types of Companies<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php $Comlist =array(); foreach($companyTypes as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="company"  class="company1 dform" data-name="<?php echo e($items['typeCompanies']); ?>"   value="<?php echo e($items['id']); ?>" <?php echo in_array('"'.$items.'"', $Comlist) ? 'checked' : ''; ?>><?php echo e($items['typeCompanies']); ?><span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox"  style="display:none">
                                                <label class="check_container"><input type="checkbox" name="company" class="company1 dform" data-name="Select All" <?php echo in_array("Select All", $Comlist) ? 'checked' : ''; ?> value="0">Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Funding Type<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php $Ftype = array(); foreach($fundType as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="fundtype"  class="fundtype  dform" data-name="<?php echo e($items['typeFunding']); ?>" value="<?php echo e($items['id']); ?>" <?php echo in_array('"'.$items.'"', $Ftype) ? 'checked' : ''; ?>><?php echo e($items['typeFunding']); ?><span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox"  style="display:none">
                                                <label class="check_container"><input type="checkbox" name="fundtype" class="fundtype  dform" data-name="Select All" value="0" <?php echo in_array("Select All", $Ftype) ? 'checked' : ''; ?>>Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">Industry<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                       <select id='industry' multiple name="industry" class="selectpicker select-search-options show-tick form-control  industry dform" data-live-search="true">
                                            <option value=''>-- Select Industry --</option>          
                                            <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($indust['id']); ?>" data-name="<?php echo e($indust['industryName']); ?>"><?php echo e($indust['industryName']); ?></option>  
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>  
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">Country<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                       <select id='selectCountry' multiple name="country" class=" selectpicker select-search-options show-tick form-control country dform" data-live-search="true">
                                            <option value=''>-- Select Country --</option>          
                                            <?php $__currentLoopData = $countrylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country['id']); ?>" data-name="<?php echo e($country['country_name']); ?>"><?php echo e($country['country_name']); ?></option>  
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>  

                                    </div>
                                </div>
                            </li>
                            <?php /* ?>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">City<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCity' name="city" class="city dform" style='width: 200px;'>
                                            <option value='0'>-- Select City --</option>

                                            @foreach($citylist as $city)

                                            <option value="{{$city['id']}}" data-name="{{$city['city_name']}}">{{$city['city_name'].', '.$city['country']['country_name'] }}</option>
                                            @endforeach
                                        </select>  
                                    </div>
                                </div>
                            </li> <?php */ ?>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">City<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                   <select id='selectCity' multiple name="city" class="selectpicker select-search-options show-tick form-control city dform" data-live-search="true">
                                            <option value=''>-- Select City --</option>

                                            <?php $__currentLoopData = $citylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($city['id']); ?>" data-name="<?php echo e($city['city_name']); ?>"><?php echo e($city['city_name'].', '.$city['country']['country_name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select> 
                                   
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="filter_div_in">
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 filterdata">
                        <ul>
                            <li class="one">
                                <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            foreach($companyTypes as $comtype){
                                                $id = str_replace('"', '', $value);
                                                if((strtolower($value) != '"select all"') && $id == $comtype['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$comtype["typeCompanies"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="two">
                                <?php 
                                         $Ftype = array();
                                    if(isset($queryString['fundtype']) && !empty($queryString['fundtype'])){
                                         $Comlss = array_keys($queryString['fundtype']);
                                        $Ftype =explode(",", @$Comlss[0]);
                                        foreach ($Ftype as $key => $value) {
                                            foreach($fundType as $futype)
                                            $id = str_replace('"', '', $value);
                                            if(strtolower($value) != '"select all"' && $id == $futype['id']){
                                                str_replace('"'," ",$value);
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$futype["typeFunding"].'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="three">
                                <?php 
                                        $IndType = array();
                                    if(isset($queryString['industry']) && !empty($queryString['industry'])){
                                        $Comlindl = array_keys( $queryString['industry']);
                                        $IndType =explode(",", @$Comlindl[0]);
                                        foreach ($IndType as $key => $value) {
                                            foreach($industry as $indu){
                                                $id = str_replace('"', '', $value);
                                                if(strtolower($value) != '"select all"' && $id == $indu['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$indu["industryName"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="four">
                                <?php 
                                        $CountryType = array( );
                                    if(isset($queryString['country'])&& !empty($queryString['country'])){
                                        $CountryType = array_keys( $queryString['country']);
                                        foreach ($CountryType as $key => $value) {
                                            foreach($country as $co){
                                                $id = str_replace('"', '', $value);
                                                if(strtolower($value) != '"select all"' && $id = $co['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$co["country_name"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="five">
                                <?php 
                                        $CityType = array( );
                                    if(isset($queryString['city']) && !empty($queryString['city'])){
                                        $CityType = array_keys( $queryString['city']);
                                        foreach ($CityType as $key => $value) {
                                            foreach($city as $ct){
                                                $id = str_replace('"', '', $value);
                                                if(strtolower($value) != '"select all"' && $id == $ct['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$ct["city_name"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                        <div class="browse-sort-filter-controls">
                            <div class="browse-deals-alert">
                                <a class="create-alert-signin">Create Alert</a>
                            </div><!-- .browse-deals-alert -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="sorting">
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <div class="browse-sort">
                            <div class="dropdown">
                                <select class="dropbtn"><i class="fa fa-caret-down" style="margin-left: 5px"></i>
                                    <option href="#" value="#">Sorted by Relevance</option>
                                    <option href="#" value="Newest">Newest</option>
                                    <option href="#" value="EndDate">End Date</option>
                                    <option href="#" value="Funding Goal">Funding Goal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <nav aria-label="...">
                            <!-- <ul class="pagination">
                                <ul class="pagination pagination-sm">
                                    <li class="page-item disabled">Showing<span class="blue"> 1-9 of 203</span> Total Results</li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" tabindex="-1">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                </ul>
                            </ul> -->
                        </nav>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <div class="float-right">
                            <div class="btn-group">
                                <button class="btn" id="grid">
                                    <img src="<?php echo e(asset('images/grid.png')); ?>">
                                </button>
                                <button class="btn" id="list">
                                    <img src="<?php echo e(asset('images/list.png')); ?>">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards view-group">
                <div class="row" id="companyProfile">
                     <?php $__currentLoopData = $companyData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     
                    <?php $id = $items['userid']; ?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12 grid-group-item">
                        <a href="#"  onclick="viewCompanyProfile('<?php echo e($id); ?>')">
                        <div class="card-content">
                            <?php if(!empty($items['banner_name'])){?>
                                <div class="card-img-top" style="background-image: url('<?php echo e(asset('uploads/images/'.@$items['banner_name'])); ?>')"></div>
                                <?php } else{ ?>
                                    <div class="card-img-top" style="background-image: url( '<?php echo e(asset('images/profile_banner.jpg')); ?>')"></div>
                                <?php } ?>
                            
                            
                            <div class="card-body">
                                <div class="card-lead-investor ">
                                    <div class="card-lead-investor-image">
                                        <?php if(!empty($items['image_name'])){?>
                                            <img src="<?php echo e(asset('uploads/images/'.$items['image_name'])); ?>" alt="">
                                        <?php } else {?>
                                            <img src="<?php echo e(asset('images/user.png')); ?>" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="card-lead-investor-name">
                                        <h2><?php echo e($items['fname']); ?> <?php echo e($items['lname']); ?></h2>
                                    </div>
                                </div>
                                <h5 class="card-title"><?php echo e($items['jobTitle']); ?> at <?php echo e($items['companyName']); ?></h5>
                                <p class="company-location">
                                   <?php echo e(@$items['city_data']['city_name'].", ".@$items['country_data']['country_name']); ?> </p>
                                <div class="row region_div">
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">
                                        <ul class="choosen_list">
                                            
                                            
                                                <?php 
                                                    $ctypes = explode(',',$items['companyType']); 
                                                    
                                                ?>

                                                <?php $__currentLoopData = $ctypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $companyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($type['id'] == $ctype): ?>
                                                            <li class="gray"><?php echo e($type['typeCompanies']); ?></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <?php 
                                                    $ftypes = explode(',',$items['fundingType']); 
                                                    
                                                ?>
                                                <?php $__currentLoopData = $ftypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $fundType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ftype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($ftype['id'] == $item): ?>
                                                            <li class="skyblue"><?php echo e($ftype['typeFunding']); ?> </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php 
                                                    $stypes = explode(',',$items['sector']); 
                                                ?>
                                                <?php $__currentLoopData = $stypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($sector['id'] == $item): ?>
                                                            <li class="gray"><?php echo e($sector['sectorName']); ?> </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                

                                            
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text company-content"><?php echo e(@$items['profileText']); ?>.</p>
                                <p class="sub-title"><?php echo e(@$items['industry']['industryName']); ?></p>
                                <?php if(!empty(@$items['fundingGoal']) && !empty(@$items['ammountRaised'])){?>
                                <div class="card-amount clearfix">
                                    <?php 
                                    @$items['fundingGoal'] = str_replace(",", "", @$items['fundingGoal']);
                                    if(@$items['fundingGoal'] < 1000){
                                        $target = $items['fundingGoal'];
                                    }else if(@$items['fundingGoal'] < 1000000){

                                        $target = number_format(@$items['fundingGoal']/1000,2)."K";
                                    }elseif(!empty(@$items['fundingGoal']) && @$items['fundingGoal']>=1000000){
                                        $target = number_format((@$items['fundingGoal']/1000000),2)."Mn";
                                    }
                                    @$items['ammountRaised'] = str_replace(",", "", @$items['ammountRaised']);
                                    if( @$items['ammountRaised']<1000){
                                        $amtraised = @$items['ammountRaised'];
                                    }else if( @$items['ammountRaised']<1000000){
                                        $amtraised = number_format((@$items['ammountRaised']/1000),2)."K";
                                    }else if(!empty(@$items['ammountRaised']) && @$items['ammountRaised']>=1000000){
                                        $amtraised = number_format((@$items['ammountRaised']/1000000),2)."Mn";
                                    }
                                    ?>
                                    <div class="card-amount-raised" id="dataVal"><strong><?php echo e(@$amtraised); ?> of <?php echo e($target); ?></strong></div>
                                    <p><input type="range" min="1" max="<?php echo e(@$items['fundingGoal']); ?>" value="<?php echo e(@$items['ammountRaised']); ?>" class="slider-color" id="id"></p>
                                </div>
                            <?php } else { ?>
                                <div class="card-amount clearfix">
                                    <input type="range1">
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        </a> 
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4"></div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4">
                    <nav aria-label="...">
                        <!-- <ul class="pagination">
                            <ul class="pagination pagination-sm">
                                <li class="page-item disabled">Showing<span class="blue"> 1-9 of 203</span> Total Results</li>
                                <li class="page-item">
                                    <a class="page-link" href="#" tabindex="-1">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                            </ul>
                        </ul> -->
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4"></div>
            </div>
        </div>
    </section>
      <script>
        function viewCompanyProfile(id){

                window.location.href="<?php echo e(url('User/viewCompanyProfile/')); ?>/"+id;
            }
        $(document).ready(function(){
            var baseurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?';
            <?php
            if(!empty($getFullQueryString)){ 
                //print_r(@$queryString['industry']);exit;
                if(!empty(@$queryString['company'])){
                    $tt =   array_keys(@$queryString['company']);
                    echo "var paramArrayCType = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayCType = [];";
                }
                if(!empty(@$queryString['fundtype'])){
                    $tt =   array_keys(@$queryString['fundtype']);
                    echo "var paramArrayFType = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayFType = [];";
                }
                if(!empty(@$queryString['industry'])){
                    $tt =   array_keys(@$queryString['industry']);
                    echo "var paramArrayIndustry = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayIndustry = [];";
                }
                if(!empty(@$queryString['country'])){
                    $tt =   array_keys(@$queryString['country']);
                    echo "var paramArrayCountry = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayCountry = [];";
                }
                if(!empty(@$queryString['city'])){
                    $tt =   array_keys(@$queryString['city']);
                    echo "var paramArrayCity = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayCity = [];";
                }
                 
            }else{?>
            var paramArrayCType = [];
            var paramArrayFType = []; 
            var paramArrayIndustry = []; 
            var paramArrayCountry = []; 
            var paramArrayCity = []; 
            <?php } ?>;
            console.log(window.location)
            <?php if (!empty($Ftype)){

                echo "var paramArrayIndustry = ".json_encode($Ftype).";"; 
            } ?>
            $( '.dform').on('change', function(){
                
                param ='';
               /* if(paramArrayCType.length > 0){ 
                    param = 'company'+encodeURIComponent(JSON.stringify(paramArrayCType));
                }
                if(paramArrayFType.length > 0){ 
                    if(param !=""){
                        param += '&fundtype'+encodeURIComponent(JSON.stringify(paramArrayFType));
                    }else{
                        param += 'fundtype'+encodeURIComponent(JSON.stringify(paramArrayFType));
                    }
                }
               /* if(paramArrayIndustry.length > 0){ 
                    if(param !=""){
                        param += '&industry'+encodeURIComponent(JSON.stringify(paramArrayIndustry));
                    }else{
                        param += 'industry'+encodeURIComponent(JSON.stringify(paramArrayIndustry));
                    }
                }

                if(paramArrayCountry.length > 0){ 
                    if(param !=""){
                        param += '&country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                    }else{
                        param += 'country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                    }
                }

                if(paramArrayCity.length > 0){ 
                    if(param !=""){
                        param += '&city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                    }else{
                        param += 'city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                    }
                }*/

              //  param ='';
                if($(this)[0].name == 'company'){
                    if($(this)[0].checked==true){
                        paramArrayCType.push($(this).val());
                    }else{
                        var ind = paramArrayCType.indexOf($(this)[0].value);
                        paramArrayCType.splice(ind,1);
                    }
                    if(paramArrayCType.length >0){
                        param = 'company'+encodeURIComponent(JSON.stringify(paramArrayCType));
                    }
                }
                if($(this)[0].name == 'fundtype'){
                    if($(this)[0].checked==true){
                        paramArrayFType.push($(this).val());
                    }else{
                        var ind = paramArrayFType.indexOf($(this)[0].value);
                        paramArrayFType.splice(ind,1);
                    }
                    if(paramArrayFType.length >0){
                        param += '&fundtype'+encodeURIComponent(JSON.stringify(paramArrayFType));
                    }
                }
                 if($(this)[0].name == 'industry'){
                        if($(this).val() != "0" && $(this).val() != 'null' && $(this).val() != null){
                            paramArrayIndustry = $(this).val();
                            if(param != ''){
                                param += '&industry'+encodeURIComponent(JSON.stringify(paramArrayIndustry));
                            }else{
                                param += 'industry'+encodeURIComponent(JSON.stringify(paramArrayIndustry));
                            }
                        }else{
                            paramArrayIndustry =[];
                        }
                        //var ind = paramArrayIndustry.indexOf($(this)[0].value);
                        //paramArrayIndustry.splice(ind,1);
                }
                if($(this)[0].name == 'country'){
                        if($(this).val() != "0" && $(this).val() != 'null' && $(this).val() != null){
                            paramArrayCountry= $(this).val();
                            if(param != ''){
                                param += '&country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                            }else{
                                param += 'country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                                
                            }
                        }else{
                            paramArrayCountry =[];
                        }
                        //var country = paramArrayCountry.indexOf($(this)[0].value);
                       // paramArrayCountry.splice(country,1);
                }
                if($(this)[0].name == 'city'){
                    if($(this).val() != "0" && $(this).val() != 'null' && $(this).val() != null){
                        paramArrayCity= $(this).val();
                        if(param != ''){
                            param += '&city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                        }else{
                            param += 'city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                            
                        }
                    }else{
                        paramArrayCity =[];
                    }
                  //  param += '&city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                    
                }
                    <?php /*if(isset($queryString['company'])){
                        print_r($queryString);
                    }*/ ?>
                    param = 'company'+JSON.stringify(paramArrayCType)+ '&fundtype='+JSON.stringify(paramArrayFType)+'&industry='+JSON.stringify(paramArrayIndustry)+'&country='+JSON.stringify(paramArrayCountry)+'&city='+JSON.stringify(paramArrayCity);
                //window.history.pushState({path:baseurl + param},'',baseurl+param);
                getResult(param)
            })



            $(".dropbtn").on('change',function(e){
                e.preventDefault();
                var data = $(this).val();
                $.ajax({
                    method:"POST",
                    url: "<?php echo e(url('User/searchCompanyRelevance')); ?>",
                    data: {"_token":"<?php echo e(csrf_token()); ?>", data:data},
                    success:function(response)
                    {
                        if(response.msg=='success'){
                            var html = "";
                            var data = "";
                            data = response.data;
                            $.each(data,function(key,value){
                                 if(value['city_data'] != null)
                                    { 
                                        var city = value["city_data"]["city_name"];
                                    }else{
                                        var city = '';
                                    }
                                    if(value["country_data"] != null)
                                    {
                                        var country = value["country_data"]["country_name"];
                                    }else{
                                        var country = '';
                                    }if(value['company_type'] != null){
                                        var companyType = value["company_type"]["typeCompanies"];
                                    }else{
                                        var companyType ='';
                                    }if(value["type_funding"] != null){
                                        var typeFunding = value["type_funding"]["typeFunding"];
                                    }else{
                                            var typeFunding ='';
                                    }if(value["sector"] != null){
                                            var sectorType = value["sector"]["sectorName"];
                                    }else{
                                        var sectorType ='';
                                    }if(value["industry"] != null){
                                        var industry = value["industry"]["industryName"];
                                    }else{
                                        var industry = '';
                                    }if(value["profileText"] != null){
                                        var profiledata = value["profileText"];
                                    }else{
                                        var profiledata ='';
                                    }
                                if(value["banner_name"] == null || value["banner_name"] == '' ){
                                        var bannerimg = '<?php echo e(asset("images/profile_banner.jpg")); ?>' ;
                                    }else{
                                        var bannerimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["banner_name"];
                                    }

                                    if(value["image_name"] == null || value["image_name"] == '' ){
                                        var profileimg = '<?php echo e(asset("images/user.png")); ?>' ;
                                    }else{
                                        var profileimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["image_name"];
                                    }
                               html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image:url('+bannerimg+') "></div>';
                                        html+='<div class="card-body">';
                                            html+='<div class="card-lead-investor ">';
                                                html+='<div class="card-lead-investor-image">';
                                                   html+='<img src="'+profileimg+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name">';
                                                    html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' at '+value["companyName"]+'</h5>';
                                            html+='<p class="company-location">'+city+','+country+'</p>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                    html+='<ul class="choosen_list">';
                                                       html+='<li class="gray">'+companyType+'</li>';
                                                        html+='<li class="skyblue">'+typeFunding+'</li>';
                                                        html+='<li class="gray">'+sectorType+'</li>';
                                                    html+='</ul>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text company-content">'+profiledata+'</p>';
                                            html+='<p class="sub-title">'+industry+'</p>';
                                            if(value["fundingGoal"] != '' && value["ammountRaised"] != '' && value["fundingGoal"] != null && value["ammountRaised"] != null)
                                            {
                                                html+='<div class="card-amount clearfix">';
                                                    var tempfgoal = value["fundingGoal"].replace(/,/g , '');
                                                if(tempfgoal < 1000){
                                                    var targetData = tempfgoal ;
                                                }
                                                if(tempfgoal < 1000000){
                                                    var num = tempfgoal/1000;
                                                    var targetData = num.toFixed(2)+'K';
                                                }else if(tempfgoal >= 1000000){
                                                    var num = tempfgoal/1000000;
                                                    var targetData = num.toFixed(2)+'Mn';
                                                }
                                                var tempamtraised = value["ammountRaised"].replace(/,/g , '');
                                                if(tempamtraised < 1000000){
                                                    var num = tempamtraised/1000;
                                                    var amtData = num.toFixed(2)+'K';
                                                }else if(tempamtraised >= 1000000){
                                                    var num = tempamtraised/1000000;
                                                    var amtData = num.toFixed(2)+'Mn';
                                                }

                                                    html+='<div class="card-amount-raised"><strong>'+amtData+' of '+targetData+'</strong></div>';
                                                    html+='<p><input type="range" min="1" max="'+tempfgoal+'" value="'+tempamtraised+'" class="slider-color" id="id1"></p>';
                                                html+='</div>';
                                            } else {
                                                html+='<div class="card-amount clearfix">';
                                                    html+='<input type="range1">';
                                                html+='</div>';
                                            }
                                        html+='</div>';
                                    html+='</div>';
                                    html+='</a></div>'; 
                            });
                            /*console.log(html);*/
                            $("#companyProfile").html(html);                                
                        }else{
                            $("#companyProfile").html('<div class="alert-danger">Data NOt Found</div>');
                        }
                    }
                })
            })




            $("#browse-name-search").on('keyup',function(e){
                e.preventDefault();
                var companyName = $(this).val();
                $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/searchCompanyName')); ?>",
                        data:{"_token": "<?php echo e(csrf_token()); ?>",data:companyName},
                        success:function(response)
                        {
                            if(response.msg=='success'){
                                var html = "";
                                var data = "";
                                data = response.data;


                                $.each(data,function(key,value){
                                    if(value['city_data'] != null)
                                    { 
                                        var city = value["city_data"]["city_name"];
                                    }else{
                                        var city = '';
                                    }
                                    if(value["country_data"] != null)
                                    {
                                        var country = value["country_data"]["country_name"];
                                    }else{
                                        var country = '';
                                    }



                                    // if(value['comp_type'] != null){
                                    //     var companyType = value["comp_type"];
                                    // }else{
                                    //     var companyType ='';
                                    // }
                                    // if(value["type_funding"] != null){
                                    //     var typeFunding = value["type_funding"]["typeFunding"];
                                    // }else{
                                    //         var typeFunding ='';
                                    // }if(value["sector"] != null){
                                    //         var sectorType = value["sector"]["sectorName"];
                                    // }else{
                                    //     var sectorType ='';
                                    // }
                                    if(value["industry"] != null){
                                        var industry = value["industry"]["industryName"];
                                    }else{
                                        var industry = '';
                                    }if(value["profileText"] != null){
                                        var profiledata = value["profileText"];
                                    }else{
                                        var profiledata ='';
                                    }
                                  
                                    if(value["banner_name"] == null || value["banner_name"] == '' ){
                                        var bannerimg = '<?php echo e(asset("images/profile_banner.jpg")); ?>' ;
                                    }else{
                                        var bannerimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["banner_name"];
                                    }

                                    if(value["image_name"] == null || value["image_name"] == '' ){
                                        var profileimg = '<?php echo e(asset("images/user.png")); ?>' ;
                                    }else{
                                        var profileimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["image_name"];
                                    }

                                   html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                        html+='<div class="card-content">';
                                            html+='<div class="card-img-top" style="background-image: url('+bannerimg+') "></div>';
                                            html+='<div class="card-body">';
                                                html+='<div class="card-lead-investor ">';
                                                    html+='<div class="card-lead-investor-image">';
                                                       html+='<img src="'+profileimg+'" alt="">';
                                                    html+='</div>';
                                                    html+='<div class="card-lead-investor-name">';
                                                        html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<h5 class="card-title">'+value["jobTitle"]+' at '+value["companyName"]+'</h5>';
                                                html+='<p class="company-location">'+city+','+country+'</p>';
                                                html+='<div class="row region_div">';
                                                    html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                        html+='<ul class="choosen_list">';

                                                            $.each(value['comp_type'],function(key,value){
                                                                html+='<li class="gray">'+value+'</li>';
                                                            });

                                                            $.each(value['fund_type'],function(key,value){
                                                                html+='<li class="skyblue">'+value+'</li>';
                                                            });

                                                            $.each(value['sec_type'],function(key,value){
                                                                html+='<li class="gray">'+value+'</li>';
                                                            });
                                                        html+='</ul>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<p class="card-text company-content">'+profiledata+'</p>';
                                                html+='<p class="sub-title">'+industry+'</p>';

                                            if(value["fundingGoal"] != '' && value["ammountRaised"] != '' && value["fundingGoal"] != null && value["ammountRaised"] != null)
                                            {
                                            html+='<div class="card-amount clearfix">';
                                               var tempfgoal = value["fundingGoal"].replace(/,/g , '');
                                            if(tempfgoal < 1000){
                                                var targetData = tempfgoal ;
                                            }
                                            if(tempfgoal < 1000000){
                                                var num = tempfgoal/1000;
                                                var targetData = num.toFixed(2)+'K';
                                            }else if(tempfgoal >= 1000000){
                                                var num = tempfgoal/1000000;
                                                var targetData = num.toFixed(2)+'Mn';
                                            }
                                            var tempamtraised = value["ammountRaised"].replace(/,/g , '');
                                            if(tempamtraised < 1000000){
                                                var num = tempamtraised/1000;
                                                var amtData = num.toFixed(2)+'K';
                                            }else if(tempamtraised >= 1000000){
                                                var num = tempamtraised/1000000;
                                                var amtData = num.toFixed(2)+'Mn';
                                            }

                                                html+='<div class="card-amount-raised"><strong>'+amtData+' of '+targetData+'</strong></div>';
                                                html+='<p><input type="range" min="1" max="'+tempfgoal+'" value="'+tempamtraised+'" class="slider-color" id="id1"></p>';
                                            html+='</div>';
                                            } else {
                                                html+='<div class="card-amount clearfix">';
                                                    html+='<input type="range1">';
                                                html+='</div>';
                                            }
                                            html+='</div>';
                                        html+='</div>';
                                        html+='</a></div>'; 
                                });
                                /*console.log(html);*/
                                $("#companyProfile").html(html);                                
                            }else{
                                $("#companyProfile").html('<div class="alert-danger">Data Not Found</div>');
                            }
                        }
                });
            });

            $("#company1remove").click(function(){

            });
            $('.company1').on('click',function(){
                 var result = "";
                
                    $(".company1.dform:checked").each(function (key, value) {
                        var company = $($(".company1.dform:checked")[key]).data('name');
                        result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="typeOfCompany" role="alert" id="menu"><button type="button" class="close"  aria-label="Close"><span aria-hidden="true" id="company1remove">×</span></button>'+company+'</div>';
                       
                    });
                     $('.one').html(result);
                });
            $('.fundtype').on('click',function(){
                var result = "";
                var data = "";
                $(".fundtype.dform:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var fundtype = $($(".fundtype.dform:checked")[key]).data('name');
                result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="fundType" role="alert" id="menu"><button type="button" class="close"  aria-label="Close"><span aria-hidden="true" id="fundtyperemove">×</span></button>'+fundtype+'</div>';
            });
                $('.two').html(result);
            });
             $('#industry').on('change',function(){
                var result = "";
                data = "";
                /*var industry = $('#industry option:selected').text();
                var v = $('#industry option:selected').val();
                 if(v != undefined && v !='0'){
                    result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+v+'" data-type="industryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="industryremove">×</span></button>'+industry+'</div>';
                    $('.three').html(result);
                 }*/
                $.each($("#industry option:selected"), function(){ 

                    result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+$(this).val()+'" data-type="industryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="industryremove">×</span></button>'+$(this).text()+'</div>';
                });
                $('.three').html(result);
               
            })

             $('#selectCountry').on('change',function(){
                var result = "";
                var data = "";

                  /*var country = $('#selectCountry option:selected').text();
                    var v = $('#selectCountry option:selected').val();
                    if(v != undefined && v !='0'){
                        result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+v+'" data-type="countryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="countryremove">×</span></button>'+country+'</div>';
                        $('.four').html(result);
                    }*/
                    $.each($("#selectCountry option:selected"), function(){ 

                        result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+$(this).val()+'" data-type="countryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="countryremove">×</span></button>'+$(this).text()+'</div>';
                    });
                    $('.four').html(result);
               
            })
              $('#selectCity').on('change',function(){
                    var result = "";
                    var data = "";
                    /*var city = $('#selectCity option:selected').text();
                     var v = $('#selectCity option:selected').val();
                if(v != undefined && v !='0'){
                        result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+v+'" data-type="cityType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="cityremove">×</span></button>'+city+'</div>';
                    $('.five').html(result);
                }*/
                $.each($("#selectCity option:selected"), function(){ 

                    result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+$(this).val()+'" data-type="cityType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="countryremove">×</span></button>'+$(this).text()+'</div>';
                });
                $('.five').html(result);

            });
              $('body').on('click','.topParent',function(){
                var obj = $(this);
                
                if($(this).data('type') =="typeOfCompany"){
                    var index = $(this).data('index');
                    $(".company1.dform:checked").each(function (key, value) {
                        if(key == index){
                            $($(".company1.dform:checked")[key]).prop('checked', false);
                            obj.remove();
                            $( ".company1" ).trigger( "change" );
                        }
                    });
                }
                if($(this).data('type') =="fundType"){
                    var index = $(this).data('index');
                    $(".fundtype.dform:checked").each(function (key, value) {
                        if(key == index){
                            $($(".fundtype.dform:checked")[key]).prop('checked', false);
                            obj.remove();
                            $( ".fundtype" ).trigger( "change" );
                        }
                    });
                }
                if($(this).data('type') =="industryType"){
                    var index = $(this).data('index');
                    /*$("#industry").val("0");
                    obj.remove();*/
                    $("#industry option:selected").each(function(){ 
                        if(this.value== index){this.selected= false;}
                    });
                    $( "#industry" ).trigger( "change" );    
                }
                if($(this).data('type') =="countryType"){
                    var index = $(this).data('index');
                    /*$("#selectCountry").val("0");
                    obj.remove();*/
                    $("#selectCountry option:selected").each(function(){ 
                        if(this.value== index){this.selected= false;}
                    });
                    $( "#selectCountry" ).trigger( "change" );    
                }
                if($(this).data('type') =="cityType"){
                    var index = $(this).data('index');
                    /*$("#selectCity").val("0");
                    obj.remove();*/
                    $("#selectCity option:selected").each(function(){ 
                        if(this.value== index){this.selected= false;}
                    });
                    $( "#selectCity" ).trigger( "change" );    
                }
              })
    });
    function getResult(data){
             $.ajax({
           method: "POST",
           url: "<?php echo e(url('User/getSearchData')); ?>",
           data:{"_token": "<?php echo e(csrf_token()); ?>",data:data},
           success: function(response) {
                if(response.msg=='Success'){

                    var html = "";
                    var data = "";
                    data = response.data;
                    $.each(data,function(key,value){
                         /*if(value['city_data'] != null)
                                    {*/ 
                                        var city = value["city_name"];
                                   /* }else{
                                        var city = '';
                                    }*/
                                    /*if(value["country_data"] != null)
                                    {*/
                                        var country = value["country_name"];
                                    /*}else{
                                        var country = '';
                                    }*/
                                    if(value["profileText"] != null){
                                        var profiledata = value["profileText"];
                                    }else{
                                        var profiledata ='';
                                    }if(value["industryName"] != null){
                                        var industry = value["industryName"];
                                    }else{
                                        var industry = '';
                                    }if(value["sectorName"]!= null){
                                        var sector =value["sectorName"];
                                    }else{
                                        var sector ='';
                                    }if(value["typeFunding"] != null){
                                        var typef = value["typeFunding"];
                                    }else{
                                        var typef = '';
                                    }if(value["typeCompanies"] !=null){
                                        var typec = value["typeCompanies"];
                                    }else{
                                        var typec = '';
                                    }
                        if(value["banner_name"] == null || value["banner_name"] == '' ){
                                        var bannerimg = '<?php echo e(asset("images/profile_banner.jpg")); ?>' ;
                                    }else{
                                        var bannerimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["banner_name"];
                                    }

                                    if(value["image_name"] == null || value["image_name"] == '' ){
                                        var profileimg = '<?php echo e(asset("images/user.png")); ?>' ;
                                    }else{
                                        var profileimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["image_name"];
                                    }
                                   html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                        html+='<div class="card-content">';
                                            html+='<div class="card-img-top" style="background-image: url('+bannerimg+') "></div>';
                                            html+='<div class="card-body">';
                                                html+='<div class="card-lead-investor ">';
                                                    html+='<div class="card-lead-investor-image">';
                                                        html+='<img src="'+profileimg+'" alt="">';
                                                    html+='</div>';
                                                    html+='<div class="card-lead-investor-name">';
                                                        html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<h5 class="card-title">'+value["jobTitle"]+' at '+value["companyName"]+'</h5>';
                                                html+='<p class="company-location">'+city+','+country+'</p>';
                                                html+='<div class="row region_div">';
                                                    html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                        html+='<ul class="choosen_list">';
                                                            html+='<li class="gray">'+typec+'</li>';
                                                            html+='<li class="skyblue">'+typef+'</li>';
                                                            html+='<li class="gray">'+sector+'</li>';
                                                        html+='</ul>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<p class="card-text company-content">'+profiledata+'</p>';
                                               html+='<p class="sub-title">'+industry+'</p>';
                                            if(value["fundingGoal"] != '' && value["ammountRaised"] != '' && value["fundingGoal"] != null && value["ammountRaised"] != null)
                                            {
                                                html+='<div class="card-amount clearfix">';
                                               var tempfgoal = value["fundingGoal"].replace(/,/g , '');
                                            if(tempfgoal < 1000){
                                                var targetData = tempfgoal ;
                                            }
                                            if(tempfgoal < 1000000){
                                                var num = tempfgoal/1000;
                                                var targetData = num.toFixed(2)+'K';
                                            }else if(tempfgoal >= 1000000){
                                                var num = tempfgoal/1000000;
                                                var targetData = num.toFixed(2)+'Mn';
                                            }
                                            var tempamtraised = value["ammountRaised"].replace(/,/g , '');
                                            if(tempamtraised < 1000000){
                                                var num = tempamtraised/1000;
                                                var amtData = num.toFixed(2)+'K';
                                            }else if(tempamtraised >= 1000000){
                                                var num = tempamtraised/1000000;
                                                var amtData = num.toFixed(2)+'Mn';
                                            }

                                                html+='<div class="card-amount-raised"><strong>'+amtData+' of '+targetData+'</strong></div>';
                                                html+='<p><input type="range" min="1" max="'+tempfgoal+'" value="'+tempamtraised+'" class="slider-color" id="id1"></p>';
                                            html+='</div>';
                                            } else {
                                                html+='<div class="card-amount clearfix">';
                                                    html+='<input type="range1">';
                                                html+='</div>';
                                            }
                                            html+='</div>';
                                        html+='</div>';
                                        html+='</a></div>'; 
                            });
                            $("#companyProfile").html(html);                                
                        }else{
                            $("#companyProfile").html('<div class="alert-danger">Data NOt Found</div>');

                        }
                    }
                });
           
            }
    </script>


     <script>
        $(document).ready(function() {
            $('#list').click(function(event) {
                event.preventDefault();
                $('.cards .card').addClass('list-group-item');
            });
            $('#grid').click(function(event) {
                event.preventDefault();
                $('.cards .card').removeClass('list-group-item');
                $('.cards .card').addClass('grid-group-item');
            });
        });
    </script>

    <script>
        $(document).ready(function(){
       
            // Initialize select2
            //$("#selectCountry").select2();
          
            /*$("#selectCountry").change(function(){
                var country=$(this).val();
                $.ajax({
                    method:"POST",
                    url:"<?php echo e(url('User/getcityList')); ?>",
                    data:{"_token":"<?php echo e(csrf_token()); ?>",cid:country},
                    success:function(response)
                    {
                        var appenddata;
                        var data = JSON.parse(response);
                         $.each(data, function (key, value) {
                             appenddata += "<option value = '" + value.id + " '>" + value.city_name + " </option>";                        
                         });
                        $('#selectCity').html(appenddata);
                    }
                })
            })*/

            /*$("#selectCity").select2();
            $("#industry").select2();*/
            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selectCountry option:selected').text();
                var country = $('#selectCountry option:selected').val();
                alert(country);
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
        function TestFunction(obj){
            setTimeout(function(){
            
                $(obj).siblings('.dropdown-menu').css("transform", "");
            },100)
        }

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Lond Capital\Site\londcapapp\resources\views/frontend/index.blade.php ENDPATH**/ ?>