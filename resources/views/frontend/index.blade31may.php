@extends('layouts.home')
@section('content')
    <!------------------------------------------------------>
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
                                                <label class="check_container"><input type="checkbox" name="company"  class="company1 dform" data-name="{{ $items['typeCompanies'] }}"   value="{{ $items['id'] }}" <?php echo in_array('"'.$items.'"', $Comlist) ? 'checked' : ''; ?>>{{ $items['typeCompanies'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
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
                                                <label class="check_container"><input type="checkbox" name="fundtype"  class="fundtype  dform" data-name="{{ $items['typeFunding'] }}" value="{{ $items['id'] }}" <?php echo in_array('"'.$items.'"', $Ftype) ? 'checked' : ''; ?>>{{ $items['typeFunding'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="fundtype" class="fundtype  dform" data-name="Select All" value="0" <?php echo in_array("Select All", $Ftype) ? 'checked' : ''; ?>>Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Industry<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                           <?php $IndType = array(); foreach($industry as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="industry"  class="industry  dform" data-name="{{ $items['industryName'] }}" value="{{ $items['id'] }}" <?php echo in_array('"'.$items.'"', $IndType) ? 'checked' : ''; ?> >{{ $items['industryName'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="industry" class="industry  dform" data-name="Select All" value="0" <?php echo in_array("Select All", $IndType) ? 'checked' : ''; ?> >Select All<span class="checkmark"></span></label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Country<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                       <select id='selectCountry' name="country" class="dform" style='width: 200px;'>
                                            <option value='0'>-- Select Country --</option>          
                                        @foreach($countrylist as $country)
                                            <option value="{{$country['id']}}" data-name="{{$country['country_name']}}">{{$country['country_name']}}</option>  
                                        @endforeach
                                    </select>  

                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">City<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCity' name="city" class="city dform" style='width: 200px;'>
                                            <!-- <option value='0'>-- Select City --</option>

                                            @foreach($citylist as $city)

                                            <option value="{{$city['id']}}" data-name="{{$city['city_name']}}">{{$city['city_name']}}</option>
                                            @endforeach -->
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
                                            if((strtolower($value) != '"select all"')){
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
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
                                            if(strtolower($value) != '"select all"'){
                                                str_replace('"'," ",$value);
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
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
                                            if(strtolower($value) != '"select all"'){
                                                str_replace('"'," ",$value);
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
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
                                            if(strtolower($value) != '"select all"'){
                                                str_replace('"'," ",$value);
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
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
                                            if(strtolower($value) != '"select all"'){
                                                str_replace('"'," ",$value);
                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
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
                                    <img src="{{ asset('images/grid.png')}}">
                                </button>
                                <button class="btn" id="list">
                                    <img src="{{ asset('images/list.png') }}">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards view-group">
                <div class="row" id="companyProfile">
                     @foreach($companyData as $items)
                    <?php $id = $items['userid']; ?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12 grid-group-item">
                        <a href="#"  onclick="viewCompanyProfile('{{ $id }}')">
                        <div class="card-content">
                            <?php if(!empty($items['banner_name'])){?>
                                <div class="card-img-top" style="background-image: url('{{asset('uploads/images/'.@$items['banner_name']) }}')"></div>
                                <?php } else{ ?>
                                    <div class="card-img-top" style="background-image: url( '{{asset('images/41608_8238021.png')}}')"></div>
                                <?php } ?>
                            
                            
                            <div class="card-body">
                                <div class="card-lead-investor ">
                                    <div class="card-lead-investor-image">
                                        <?php if(!empty($items['image_name'])){?>
                                            <img src="{{ asset('uploads/images/'.$items['image_name'])}}" alt="">
                                        <?php } else {?>
                                            <img src="{{ asset('images/user.png')}}" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="card-lead-investor-name">
                                        <h2>{{ $items['fname'] }} {{ $items['lname']}}</h2>
                                    </div>
                                </div>
                                <h5 class="card-title">{{ $items['jobTitle']}} at {{ $items['companyName']}}</h5>
                                <p class="company-location">
                                   {{ @$items['city_data']['city_name'].", ".@$items['country_data']['country_name']}} </p>
                                <div class="row region_div">
                                    <div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">
                                        <ul class="choosen_list">
                                            <li class="gray">{{@$items['company_type']['typeCompanies']}}</li>
                                            <li class="skyblue">{{@$items['type_funding']['typeFunding']}}</li>
                                            <li class="gray">{{ @$items['sector']['sectorName']}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="card-text">{{@$items['profileText']}}</p>
                                <p class="sub-title">{{@$items['industry']['industryName']}}</p>
                                <div class="card-amount clearfix">
                                    <div class="card-amount-raised" id="dataVal"><strong>1 of 50M</strong></div>
                                    <p><input type="range" min="1" max="100" value="{{@$items['ammountRaised']}}" class="slider-color" id="id"></p>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                    @endforeach
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

                window.location.href="{{ url('User/viewCompanyProfile/') }}/"+id;
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
                if(paramArrayCType.length > 0){ 
                    param = 'company'+encodeURIComponent(JSON.stringify(paramArrayCType));
                }
                if(paramArrayFType.length > 0){ 
                    if(param !=""){
                        param += '&fundtype'+encodeURIComponent(JSON.stringify(paramArrayFType));
                    }else{
                        param += 'fundtype'+encodeURIComponent(JSON.stringify(paramArrayFType));
                    }
                }
                if(paramArrayIndustry.length > 0){ 
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
                }

                param ='';
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
                    if($(this)[0].checked==true){
                        paramArrayIndustry.push($(this).val())
                    }else{
                        var ind = paramArrayIndustry.indexOf($(this)[0].value);
                        paramArrayIndustry.splice(ind,1);
                    }
                    if(paramArrayIndustry.length >0){
                        param += '&industry'+encodeURIComponent(JSON.stringify(paramArrayIndustry));
                    }
                }
                if($(this)[0].name == 'country'){
                        var ind = paramArrayCountry.indexOf($(this)[0].value);
                        paramArrayCountry.splice(ind,1);
                        param += '&country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                }
                if($(this)[0].name == 'city'){
                        var ind = paramArrayCity.indexOf($(this)[0].value);
                        paramArrayCity.splice(ind,1);
                        param += '&city'+encodeURIComponent(JSON.stringify(paramArrayCity));
                    
                }
                    <?php /*if(isset($queryString['company'])){
                        print_r($queryString);
                    }*/ ?>
                    //param = 'company'+JSON.stringify(paramArrayCType)+ 'fundtype='+JSON.stringify(paramArrayFType)+'&industry='+JSON.stringify(paramArrayIndustry)+'&country='+JSON.stringify(paramArrayCountry)+'&city='+JSON.stringify(paramArrayCity);
                window.history.pushState({path:baseurl + param},'',baseurl+param);
                getResult(param)
            })



            $(".dropbtn").on('change',function(e){
                e.preventDefault();
                var data = $(this).val();
                $.ajax({
                    method:"POST",
                    url: "{{ url('User/searchCompanyRelevance') }}",
                    data: {"_token":"{{ csrf_token() }}", data:data},
                    success:function(response)
                    {
                        if(response.msg=='success'){
                            var html = "";
                            var data = "";
                            data = response.data;
                            $.each(data,function(key,value){
                                var bannerimg = '{{ asset("uploads/images/") }}';
                               html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image:url('+bannerimg+'/'+value["banner_name"]+') "></div>';
                                        html+='<div class="card-body">';
                                            html+='<div class="card-lead-investor ">';
                                                html+='<div class="card-lead-investor-image">';
                                                   html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name">';
                                                    html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' '+value["companyName"]+'</h5>';
                                            html+='<p class="company-location">'+value["city_data"]["city_name"]+','+value["country_data"]["country_name"]+'</p>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                    html+='<ul class="choosen_list">';
                                                        html+='<li class="gray">'+value["company_type"]["typeCompanies"]+'</li>';
                                                        html+='<li class="skyblue">'+value["type_funding"]["typeFunding"]+'</li>';
                                                        html+='<li class="gray">'+value["sector"]["sectorName"]+'</li>';
                                                    html+='</ul>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text">'+value["profileText"]+'</p>';
                                            html+='<p class="sub-title">'+value["industry"]["industryName"]+'</p>';
                                            html+='<div class="card-amount clearfix">';
                                                html+='<div class="card-amount-raised"><strong>1 of 10M</strong></div>';
                                                html+='<p><input type="range" min="1" max="100" value="'+value['ammountRaised']+'" class="slider-color" id="id1"></p>';
                                            html+='</div>';
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
                        url:"{{ url('User/searchCompanyName')}}",
                        data:{"_token": "{{ csrf_token() }}",data:companyName},
                        success:function(response)
                        {
                            if(response.msg=='success'){
                                var html = "";
                                var data = "";
                                data = response.data;
                                $.each(data,function(key,value){
                                    var bannerimg = '{{ asset("uploads/images/") }}';
                                   html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                        html+='<div class="card-content">';
                                            html+='<div class="card-img-top" style="background-image: url('+bannerimg+'/'+value["banner_name"]+') "></div>';
                                            html+='<div class="card-body">';
                                                html+='<div class="card-lead-investor ">';
                                                    html+='<div class="card-lead-investor-image">';
                                                       html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                    html+='</div>';
                                                    html+='<div class="card-lead-investor-name">';
                                                        html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<h5 class="card-title">'+value["jobTitle"]+' '+value["companyName"]+'</h5>';
                                                html+='<p class="company-location">                                   '+value["city_data"]["city_name"]+','+value["country_data"]["country_name"]+'</p>';
                                                html+='<div class="row region_div">';
                                                    html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                        html+='<ul class="choosen_list">';
                                                        html+='<li class="gray">'+value["company_type"]["typeCompanies"]+'</li>';
                                                        html+='<li class="skyblue">'+value["type_funding"]["typeFunding"]+'</li>';
                                                        html+='<li class="gray">'+value["sector"]["sectorName"]+'</li>';                                                  html+='</ul>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<p class="card-text">'+value["profileText"]+'</p>';
                                                html+='<p class="sub-title">'+value["industry"]["industryName"]+'</p>';
                                            html+='<div class="card-amount clearfix">';
                                                html+='<div class="card-amount-raised"><strong>1 of 10M</strong></div>';
                                                html+='<p><input type="range" min="1" max="100" value="30" class="slider-color" id="id1"></p>';
                                                html+='</div>';
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
                        result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="company1remove">×</span></button>'+company+'</div>';
                       
                    });
                     $('.one').html(result);
                });
            $('.fundtype').on('click',function(){
                var result = "";
                var data = "";
                $(".fundtype.dform:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var fundtype = $($(".fundtype.dform:checked")[key]).data('name');
                result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="fundtyperemove">×</span></button>'+fundtype+'</div>';
            });
                $('.two').html(result);
            });
             $('.industry').on('click',function(){
                var result = "";
                data = "";
                $(".industry.dform:checked").each(function (key,value) {
                data+= $('.filterdata ul li').find('#menu').text();
                var industry = $($(".industry.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="industryremove">×</span></button>'+industry+'</div>';
            });
                $('.three').html(result);
               
            })

             $('#selectCountry').on('change',function(){
                var result = "";
                var data = "";

                    var country = $('#selectCountry option:selected').text();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="countryremove">×</span></button>'+country+'</div>';
                $('.four').html(result);
               
            })
              $('#selectCity').on('change',function(){
                var result = "";
                var data = "";
                var city = $('#selectCity option:selected').text();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="cityremove">×</span></button>'+city+'</div>';
                $('.five').html(result);

        });
    });
    function getResult(data){
             $.ajax({
           method: "POST",
           url: "{{url('User/getSearchData')}}",
           data:{"_token": "{{ csrf_token() }}",data:data},
           success: function(response) {
                if(response.msg=='Success'){

                     var html = "";
                    var data = "";
                    data = response.data;
                    $.each(data,function(key,value){
                        var bannerimg = '{{ asset("uploads/images/") }}';
                                   html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12"><a href="#"  onclick="viewCompanyProfile('+value["userid"]+')">';
                                        html+='<div class="card-content">';
                                            html+='<div class="card-img-top" style="background-image: url('+bannerimg+'/'+value["banner_name"]+') "></div>';
                                            html+='<div class="card-body">';
                                                html+='<div class="card-lead-investor ">';
                                                    html+='<div class="card-lead-investor-image">';
                                                        html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                    html+='</div>';
                                                    html+='<div class="card-lead-investor-name">';
                                                        html+='<h2>'+value["fname"]+' '+value["lname"]+'</h2>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<h5 class="card-title">'+value["jobTitle"]+' '+value["companyName"]+'</h5>';
                                                html+='<p class="company-location">'+value["city_name"]+','+value["country_name"]+'</p>';
                                                html+='<div class="row region_div">';
                                                    html+='<div class="col-md-12 col-lg-12 col-sm-12 col-12 col-xl-12">';
                                                        html+='<ul class="choosen_list">';
                                                        html+='<li class="gray">'+value["typeCompanies"]+'</li>';
                                                        html+='<li class="skyblue">'+value["typeFunding"]+'</li>';
                                                        html+='<li class="gray">'+value["sectorName"]+'</li>';                                                        html+='</ul>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<p class="card-text">'+value["profileText"]+'</p>';
                                               html+='<p class="sub-title">'+value["industryName"]+'</p>';
                                            html+='<div class="card-amount clearfix">';
                                                html+='<div class="card-amount-raised"><strong>1 of 10M</strong></div>';
                                                html+='<p><input type="range" min="1" max="100" value="'+value['ammountRaised']+'" class="slider-color" id="id1"></p>';
                                                html+='</div>';
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
            $("#selectCountry").select2();
            $("#selectCountry").change(function(){
                var country=$(this).val();
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/getcityList')}}",
                    data:{"_token":"{{csrf_token()}}",cid:country},
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
            })

            $("#selectCity").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selectCountry option:selected').text();
                var country = $('#selectCountry option:selected').val();
                alert(country);
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
    </script>

@endsection