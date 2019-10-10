
<?php $__env->startSection('content'); ?>
    <!--  -->
    <section class="content-box">
        <div class="container">
            <div class="filter_div">
                <div class="row">

                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="browse-name-search">
                            <input type="text" placeholder="Search by investor name" maxlength="40" id="browse-name-search" value="" autocomplete="off">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <ul>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Investor Type <i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($investortype as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="investor"  class="investor dform" data-name="<?php echo e($items['typeInvestor']); ?>" value="<?php echo e($items['id']); ?>"><?php echo e($items['typeInvestor']); ?><span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox " style="display:none">
                                                <label class="check_container"><input type="checkbox" name="investor" class="investor dform" data-name="Select All" value="0">Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Investment Type<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($investmentType as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="investment" class="investment dform" data-name="<?php echo e($items['typeInvestment']); ?>" value="<?php echo e($items['id']); ?>"><?php echo e($items['typeInvestment']); ?><span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox"  style="display:none">
                                                <label class="check_container"><input type="checkbox" name="investment" class="investment dform" data-name="Select All" value="0">Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">Industry<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='industry' multiple="" class="selectpicker select-search-options show-tick form-control industry dform" name="industry" data-live-search="true">
                                            <option value='0'>-- Select Industry --</option>          
                                        <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key12 => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key12); ?>" data-name="<?php echo e($val); ?>"><?php echo e($val); ?></option>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                        <?php /* 
                                        <!-- <form>
                                            <?php foreach($industry as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="industry"  class="industry dform" data-name="{{ $items['industryName'] }}" value="{{ $items['id'] }}">{{ $items['industryName'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" data-name="Select All" name="industry" class="industry dform" value="0">Select All<span class="checkmark"></span></label>
                                            </div>

                                        </form> -->
                                        */?>
    
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">Country<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCountry' multiple="" class="selectpicker select-search-options show-tick form-control country dform" name="country" data-live-search="true">
                                            <option value=''>-- Select Country --</option>          
                                        <?php $__currentLoopData = $countrylist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" data-name="<?php echo e($value); ?>"><?php echo e($value); ?></option>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select> 
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">City<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCity' multiple="" name="city" class="selectpicker select-search-options show-tick form-control city dform" data-live-search="true">
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
                                    if(isset($queryString['investortype']) && !empty($queryString['investortype'])) {
                                        $Comls = array_keys($queryString['investortype']);
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            foreach($investortype as $items){
                                                $id = str_replace('"', '', $value);
                                                if((strtolower($value) != '"select all"') && $id==$items['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items["typeInvestor"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="two">
                                <?php 
                                         $Ftype = array();
                                         //print_r($queryString); exit;
                                    if(isset($queryString['investmenttype']) && !empty($queryString['investmenttype'])){
                                         $Comlss = array_keys($queryString['investmenttype']);
                                        $Ftype =explode(",", @$Comlss[0]);
                                        foreach ($Ftype as $key => $value) {
                                            foreach($investmentType as $items){
                                                $id = str_replace('"', '', $value);
                                                if((strtolower($value) != '"select all"') && $id == $items['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items["typeInvestment"].'</div>';
                                                }
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
                                            foreach($industry as $key11 => $items){
                                                $id = str_replace('"', '', $value);
                                                if((strtolower($value) != '"select all"') && $id == $key11){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items.'</div>';
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
                                                if((strtolower($value) != '"select all"') && $id == $co['id']){
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
                                            foreach($city as $ci){
                                                $id = str_replace('"', '', $value);
                                                if((strtolower($value) != '"select all"') && $id == $ci['id']){
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$ci["city_name"].'</div>';
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
                                    <!-- <option href="#" value="EndDate">End Date</option> -->
                                    <option href="#" value="Funding Goal">Funding Goal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <!-- <nav aria-label="...">
                            <ul class="pagination">
                                <ul class="pagination pagination-sm">
                                    <li class="page-item disabled">Showing<span class="blue"> 1-9 of 203</span> Total Results</li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" tabindex="-1">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                </ul>
                            </ul>
                        </nav> -->
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <div class="float-right">
                            <div class="btn-group">
                                <button class="btn" id="grid">
                                    <img src="<?php echo e(asset('images/grid.png')); ?>" />
                                </button>
                                <button class="btn" id="list">
                                    <img src="<?php echo e(asset('images/list.png')); ?>" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards view-group">
                <div class="row" id="investorProfile">
                    <?php $__currentLoopData = $investorData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $id=@$row['id'];?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">
                        <a href="#"  onclick="viewInvestorProfile('<?php echo e($id); ?>')">
                        <div class="card-content">
                            <?php if(!empty($row['banner_name'])) { ?>
                            <div class="card-img-top" style="background-image: url('<?php echo e(asset('uploads/images/'.@$row['banner_name'])); ?>')"></div>
                            <?php } else{?>
                                <div class="card-img-top" style="background-image: url('<?php echo e(asset('images/profile_banner.jpg')); ?>')"></div>
                            <?php } ?>
                            
                            <div class="card-body">
                                <p class="company-location">
                                    <?php echo e(@$row['city_data']['city_name'].", ".@$row['country_data']['country_name']); ?> </p>
                                <h5 class="card-title"><?php echo e(@$row['jobTitle'] ." At ".@$row['firmName']); ?></h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                       <?php if(!empty($row['image_name'])){?>
                                            <img src="<?php echo e(asset('uploads/images/'.$row['image_name'])); ?>" alt="">
                                        <?php } else {?>
                                            <img src="<?php echo e(asset('images/user.png')); ?>" alt="">
                                        <?php } ?>
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2><?php echo e(@$row['user']['firstname'] ." ".@$row['user']['lastname']); ?></h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p class="focus-value"><?php 
                                                    if(!empty($row['regionFocus'])){ 
                                                        $tmp = explode(",", $row['regionFocus']);
                                                        $tmpList = array();

                                                        foreach($tmp as $key => $value){
                                                            if(isset( $regionlist[$value])){
                                                                array_push($tmpList, $regionlist[$value]);
                                                            }
                                                        }
                                                        echo  implode(",<br>", $tmpList);
                                                    }else{
                                                       // echo $row['country_data']['country_name']; 
                                                    } ?></p>
                                            <p class="focus-caption">Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p class="focus-value">
                                                <?php 
                                                    if(!empty($row['countryFocus'])){ 
                                                        $tmp = explode(",", $row['countryFocus']);
                                                        $tmpList = array();

                                                        foreach($tmp as $key => $value){
                                                            if(isset( $countrylist[$value])){
                                                                array_push($tmpList, $countrylist[$value]);
                                                            }
                                                        }
                                                        echo  implode(",<br>", $tmpList);
                                                    }else{
                                                        echo $row['country_data']['country_name']; 
                                                    }
                                                ?>
                                                </p>
                                            <p class="focus-caption">Country Focus</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p>
                                               <?php if(@$row['investorType'] !=0){ 
                                                    echo @$row['investor_type']['typeInvestor'] ;
                                                }else{
                                                    $int = '';
                                                    foreach ($investortype as $key => $value) {
                                                        $int .= $value['typeInvestor'].", ";
                                                    }
                                                    echo rtrim($int, ', ');
                                                } ?>
                                            </p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div> -->
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p class="focus-value">
                                                <?php 
                                                    if(!empty($row['sectorFocus'])){ 
                                                        $tmp = explode(",", $row['sectorFocus']);
                                                        $tmpList = array();

                                                        foreach($tmp as $key => $value){
                                                            if(isset( $sectorlist[$value])){
                                                                array_push($tmpList, $sectorlist[$value]);
                                                            }
                                                        }
                                                        echo  implode(",<br>", $tmpList);
                                                    }
                                                 ?>
                                            </p>
                                            <p class="focus-caption">Sector Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="card-text"><?php echo e(@$row['profileText']); ?></p> -->
                                <p class="card-text company-content">
                                    <?php 
                                        //print_r($industry);
                                        $indlist = explode(",", $row['industryFocus']);
                                        $tmpind = array();
                                        foreach ($indlist  as $indvalue) {
                                             if(isset($industry[$indvalue])){
                                                array_push($tmpind, $industry[$indvalue]);
                                             }
                                        } 
                                        echo  implode(", ", $tmpind);
                                    ?>
                                </p>
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
                   <!--  <nav aria-label="...">
                        <ul class="pagination">
                            <ul class="pagination pagination-sm">
                                <li class="page-item disabled">Showing<span class="blue"> 1-9 of 203</span> Total Results</li>
                                <li class="page-item">
                                    <a class="page-link" href="#" tabindex="-1">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                            </ul>
                        </ul>
                    </nav> -->
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4"></div>
            </div>
        </div>
    </section>


<script>
        function viewInvestorProfile(id){

            window.location.href="<?php echo e(url('User/viewInvestorProfile/')); ?>/"+id;
        }
        $(document).ready(function(){


            var baseurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?';
            <?php
            if(!empty($getFullQueryString)){ 
               //print_r(@$queryString); exit;
                if(!empty(@$queryString['investortype'])){
                    $tt =   array_keys(@$queryString['investortype']);
                    echo "var paramArrayInvestorType = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayInvestorType = [];";
                }
                if(!empty(@$queryString['investmentType'])){
                    $tt =   array_keys(@$queryString['investmentType']);
                    echo "var paramArrayInvestmentType = [".@$tt[0]."];";
                }else{
                    echo "var paramArrayInvestmentType = [];";
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
            var paramArrayInvestorType = []; 
            var paramArrayInvestmentType = []; 
            var paramArrayIndustry = []; 
            var paramArrayCountry = []; 
            var paramArrayCity = []; 
            <?php } ?>;
            <?php if (!empty($Ftype)){

                echo "var paramArrayIndustry = ".json_encode($Ftype).";"; 
            } ?>
            $( '.dform').on('change', function(){
                
                param ='';
                /*if(paramArrayInvestorType.length > 0){ 
                    param = 'investortype'+encodeURIComponent(JSON.stringify(paramArrayInvestorType));
                }
                if(paramArrayInvestmentType.length > 0){ 
                    if(param !=""){
                        param += '&investmenttype'+encodeURIComponent(JSON.stringify(paramArrayInvestmentType));
                    }else{
                        param += 'investmenttype'+encodeURIComponent(JSON.stringify(paramArrayInvestmentType));
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

                if($(this)[0].name == 'investor'){
                    if($(this)[0].checked==true){
                        paramArrayInvestorType.push($(this).val());
                    }else{
                        var ind = paramArrayInvestorType.indexOf($(this)[0].value);
                        paramArrayInvestorType.splice(ind,1);
                    }
                    if(paramArrayInvestorType.length >0){
                        param = 'investortype'+encodeURIComponent(JSON.stringify(paramArrayInvestorType));
                    }
                }
                if($(this)[0].name == 'investment'){
                    if($(this)[0].checked==true){
                        paramArrayInvestmentType.push($(this).val());
                    }else{
                        var ind = paramArrayInvestmentType.indexOf($(this)[0].value);
                        paramArrayInvestmentType.splice(ind,1);
                    }
                    if(paramArrayInvestmentType.length >0){
                        param += '&investmenttype'+encodeURIComponent(JSON.stringify(paramArrayInvestmentType));
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
                            paramArrayCountry = $(this).val();
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
                        paramArrayCity = $(this).val();
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
                 param = 'investortype'+JSON.stringify(paramArrayInvestorType)+ '&investmenttype='+JSON.stringify(paramArrayInvestmentType)+'&industry='+JSON.stringify(paramArrayIndustry)+'&country='+JSON.stringify(paramArrayCountry)+'&city='+JSON.stringify(paramArrayCity);
               // window.history.pushState({path:baseurl + param},'',baseurl+param);
                getResult(param)
            })


             $(".dropbtn").on('change',function(e){
                e.preventDefault();
                var data = $(this).val();
                $.ajax({
                    method:"POST",
                    url: "<?php echo e(url('User/searchInvestorRelevance')); ?>",
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
                                        var city ='';
                                    }
                                    if(value["country_data"] != null)
                                    {
                                        var country = value["country_data"]["country_name"];
                                    }else{
                                        var country = '';
                                    }
                                    if(value['profileText']!= null){
                                        var profileText = value['profileText'];
                                    }else{
                                        var profileText = '';
                                    }
                                    if(value["investor_type"] != null){
                                        var investor = value["investor_type"]["typeInvestor"];
                                    }else{
                                        var investor ='';
                                    }
                                    
                                    /*if(value["region_focus"] != null){
                                        var region = value["region_focus"]["regionName"];
                                    }else{
                                        var region = '';
                                    }*/
                                    if(value["sectorFocus"] != null && value["sectorFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpsector = [];
                                        var cont = <?php echo json_encode($sectorlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["sectorFocus"] != 'undefined'){
                                                if(value["sectorFocus"].split(",").indexOf(key1) > -1){
                                                    tmpsector.push(value1);
                                                }
                                            }
                                        });
                                        var sector = tmpsector.join(',<br>');
                                    }else{
                                        var sector = '';
                                    }
                                    if(value["industryFocus"] != null && value["industryFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$industry) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["industryFocus"] != 'undefined'){
                                                if(value["industryFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var industryF = tmpindustry.join(', ');
                                    }else{
                                        var industryF = '';
                                    }
                                    if(value["regionFocus"] != null && value["regionFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$regionlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["regionFocus"] != 'undefined'){
                                                if(value["regionFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var region = tmpindustry.join(', ');
                                    }else{
                                        var region = '';
                                    }
                                if(value["banner_name"] == null && value["banner_name"] == '' ){
                                    var bannerimg = '<?php echo e(asset("images/profile_banner.jpg")); ?>' ;
                                }else{
                                    var bannerimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["banner_name"];
                                }

                                if(value["image_name"] == null && value["image_name"] == '' ){
                                    var profileimg = '<?php echo e(asset("images/user.png")); ?>' ;
                                }else{
                                    var profileimg = '<?php echo e(asset("uploads/images/")); ?>/' + value["image_name"];
                                }
                                html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+city+','+country+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+profileimg+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+ region+ '</p>';
                                                    html+='<p class="focus-caption">Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+ country+'</p>';
                                                        html+='<p class="focus-caption">Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+sector+'</p>';
                                                        html+='<p class="focus-caption">Sector Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text company-content">'+ industryF+'.</p>';
                                        html+='</div>';
                                    html+='</div>';
                                html+='</a></div>';
                                      });
                            /*console.log(html);*/
                            $("#investorProfile").html(html);                                
                        }else{
                            $("#investorProfile").html('<div class="alert-danger">Data NOt Found</div>');
                        }
                    }
                })
            })

            
             $("#browse-name-search").on('keyup',function(e){
                e.preventDefault();
                var investorName = $(this).val();
                $.ajax({
                        method:"POST",
                        url:"<?php echo e(url('User/searchInvestors')); ?>",
                        data:{"_token": "<?php echo e(csrf_token()); ?>",data:investorName},
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
                                        var city ='';
                                    }

                                    if(value["country_data"] != null)
                                    {
                                        var usercountry = value["country_data"]["country_name"];
                                    }else{
                                        var usercountry = '';
                                    }
                                    
                                    if(value["countryFocus"] != null && value["countryFocus"] != 'undefined'){
                                        
                                         //var country = value["country_data"]["country_name"];
                                        var  tmpcountry = [];
                                        var cont = <?php echo json_encode($countrylist) ?>;// don't use quotes
                                        
                                        $.each(cont, function(key1, value1) {
                                            
                                            if(value["countryFocus"] != 'undefined' && value["countryFocus"] != ''){
                                                if(value["countryFocus"].split(",").indexOf(key1) > -1){
                                                    tmpcountry.push(value1);
                                                }
                                            }
                                        });
                                        var country = tmpcountry.join(',<br>');
                                        
                                    }else{
                                        var country = '';
                                       
                                    }

                                    if(value["sectorFocus"] != null && value["sectorFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpsector = [];
                                        var cont = <?php echo json_encode($sectorlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["sectorFocus"] != 'undefined'){
                                                if(value["sectorFocus"].split(",").indexOf(key1) > -1){
                                                    tmpsector.push(value1);
                                                }
                                            }
                                        });
                                        var sector = tmpsector.join(',<br>');
                                    }else{
                                        var sector = '';
                                    }
                                    if(value["industryFocus"] != null && value["industryFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$industry) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["industryFocus"] != 'undefined'){
                                                if(value["industryFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var industryF = tmpindustry.join(', ');
                                    }else{
                                        var industryF = '';
                                    }


                                    if(value['profileText']!= null){
                                        var profileText = value['profileText'];
                                    }else{
                                        var profileText = '';
                                    }if(value["investor_type"] != null){
                                        var investor = value["investor_type"]["typeInvestor"];
                                    }else{
                                        var investor ='';
                                    }
                                    if(value["regionFocus"] != null && value["regionFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$regionlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["regionFocus"] != 'undefined'){
                                                if(value["regionFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var region = tmpindustry.join(',<br>');
                                    }else{
                                        var region = '';
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
                                html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+city+','+usercountry+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+profileimg+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+ value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+ region+ '</p>';
                                                        html+='<p class="focus-caption">Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+ country+'</p>';
                                                        html+='<p class="focus-caption">Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                       html+='<p class="focus-value">'+ sector+'</p>';
                                                        html+='<p class="focus-caption">Sector Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text company-content">'+industryF+'.</p>';
                                        html+='</div>';
                                    html+='</div>';
                                html+='</a></div>';
                                    });
                                    /*console.log(html);*/
                                    $("#investorProfile").html(html);                                
                                }else{
                                    $("#investorProfile").html('<div class="alert-danger">Data NOt Found</div>');
                                }

                        }
                });
            });


             $('.investor').on('click',function(){
                 var result = "";
                 $(".investor.dform:checked").each(function (key, value) {
                    var investor = $($(".investor.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="investorType" role="alert" id="menu"><button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>'+investor+'</div>';
                });
               $('.one').html(result);
            });

            $('.investment').on('click',function(){
                var result = "";
                $(".investment.dform:checked").each(function (key,value) {
                    var investment = $($(".investment.dform:checked")[key]).data('name');
                result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="investmentType" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investment+'</div>';
                
            });
                $('.two').html(result);
               
            })
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
                if($(this).data('type') =="investorType"){
                    var index = $(this).data('index');
                    $(".investor.dform:checked").each(function (key, value) {
                        if(key == index){
                            $($(".investor.dform:checked")[key]).prop('checked', false);
                            obj.remove();
                            $( ".investor" ).trigger( "change" );
                        }
                    });
                }
                if($(this).data('type') =="investmentType"){
                    var index = $(this).data('index');
                    $(".investment.dform:checked").each(function (key, value) {
                        if(key == index){
                            $($(".investment.dform:checked")[key]).prop('checked', false);
                            obj.remove();
                            $( ".investment" ).trigger( "change" );
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
           url: "<?php echo e(url('User/getSearchDatainvestor')); ?>",
           data:{"_token": "<?php echo e(csrf_token()); ?>",data:data},
           success: function(response) {
                if(response.msg=='Success'){

                     var html = "";
                    var data = "";
                    data = response.data;
                    $.each(data,function(key,value){
                        if(value['city_name'] != null)
                        { 
                            var city = value["city_name"];
                        }else{
                            var city ='';
                        }
                        if(value["country_name"] != null)
                        {
                            var country = value["country_name"];
                        }else{
                            var country = '';
                        }
                            if(value['profileText']!= null){
                                var profileText = value['profileText'];
                            }else{
                                var profileText = '';
                            }if(value["typeInvestor"] != null){
                                var investor = value["typeInvestor"];
                            }else{
                                var investor ='';
                            }
                            /*if(value["regionName"] != null){
                                var region = value["regionName"];
                            }else{
                                var region = '';
                            }*/
                            if(value["regionFocus"] != null || value["regionFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$regionlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["regionFocus"] != 'undefined'){
                                                if(value["regionFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var region = tmpindustry.join(',<br>');
                                    }else{
                                        var region = '';
                                    }
                            if(value["sectorFocus"] != null || value["sectorFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpsector = [];
                                        var cont = <?php echo json_encode($sectorlist) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["sectorFocus"] != 'undefined'){
                                                if(value["sectorFocus"].split(",").indexOf(key1) > -1){
                                                    tmpsector.push(value1);
                                                }
                                            }
                                        });
                                        var sector = tmpsector.join(',<br>');
                                    }else{
                                        var sector = '';
                                    }
                                    if(value["industryFocus"] != null || value["industryFocus"] != 'undefined' )
                                    {
                                        
                                        //var country = value["country_data"]["country_name"];
                                        var  tmpindustry = [];
                                        var cont = <?php echo json_encode(@$industry) ?>;// don't use quotes
                                        $.each(cont, function(key1, value1) {
                                            if(value["industryFocus"] != 'undefined'){
                                                if(value["industryFocus"].split(",").indexOf(key1) > -1){
                                                    tmpindustry.push(value1);
                                                }
                                            }
                                        });
                                        var industryF = tmpindustry.join(', ');
                                    }else{
                                        var industryF = '';
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
                                 html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+city+','+country+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+profileimg+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+region+ '</p>';
                                                        html+='<p class="focus-caption">Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                       html+='<p class="focus-value">'+ country+'</p>';
                                                        html+='<p class="focus-caption">Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p class="focus-value">'+ sector+'</p>';
                                                        html+='<p class="focus-caption">Sector Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text company-content">'+industryF+'.</p>';
                                        html+='</div>';
                                    html+='</div>';
                                html+='</a></div>';
                 });
                    /*console.log(html);*/
                    $("#investorProfile").html(html);                                
                }else{
                    $("#investorProfile").html('<div class="alert-danger">Data NOt Found</div>');

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
            /*$("#selectCountry").select2();
            $("#industry").select2();*/

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
            // Initialize select2
           /* $("#selectCity").select2();
            $("#selectindustry").select2();*/
            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
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
<?php echo $__env->make('layouts.investor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/ec2-35-177-235-3.eu-west-2.compute.amazonaws.com/public_html/resources/views/frontend/browse-investors.blade.php ENDPATH**/ ?>