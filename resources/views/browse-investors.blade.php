@extends('layouts.investor')
@section('content')
    <!------------------------------------------------------>
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
                                                <label class="check_container"><input type="checkbox" name="investor"  class="investor dform" data-name="{{ $items['typeInvestor'] }}" value="{{ $items['id'] }}">{{ $items['typeInvestor'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
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
                                                <label class="check_container"><input type="checkbox" name="investment" class="investment dform" data-name="{{ $items['typeInvestment'] }}" value="{{ $items['id'] }}">{{ $items['typeInvestment'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="investment" class="investment dform" data-name="Select All" value="0">Select All<span class="checkmark"></span></label>
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
                                            <?php foreach($industry as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="industry"  class="industry dform" data-name="{{ $items['industryName'] }}" value="{{ $items['id'] }}">{{ $items['industryName'] }}<span class="checkmark"></span></label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" data-name="Select All" name="industry" class="industry dform" value="0">Select All<span class="checkmark"></span></label>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Country<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCountry' style='width: 200px;'>
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
                                        <select id='selectCity' style='width: 200px;'>
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
                                            if((strtolower($value) != '"select all"') && str_replace('"',' ',$value)){
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
                        </nav>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <div class="float-right">
                            <div class="btn-group">
                                <button class="btn" id="grid">
                                    <img src="{{ asset('images/grid.png')}}" />
                                </button>
                                <button class="btn" id="list">
                                    <img src="{{ asset('images/list.png')}}" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cards view-group">
                <div class="row" id="investorProfile">
                    @foreach($investorData as $row)
                    <?php $id=@$row['id'];?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">
                        <a href="#"  onclick="viewInvestorProfile('{{ $id }}')">
                        <div class="card-content">
                            <?php if(!empty($row['banner_name'])) { ?>
                            <div class="card-img-top" style="background-image: url('{{asset('uploads/images/'.@$row['banner_name']) }}')"></div>
                            <?php } else{?>
                                <div class="card-img-top" style="background-image: url( {{asset('images/41608_823802.png')}}"></div>
                            <?php } ?>
                            
                            <div class="card-body">
                                <p class="company-location">
                                    {{ @$row['city_data']['city_name'].", ".@$row['country_data']['country_name']}} </p>
                                <h5 class="card-title">{{ @$row['jobTitle'] ." At ".@$row['firmName'] }}</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                       <?php if(!empty($row['image_name'])){?>
                                            <img src="{{ asset('uploads/images/'.$row['image_name'])}}" alt="">
                                        <?php } else {?>
                                            <img src="{{ asset('images/user.png')}}" alt="">
                                        <?php } ?>
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>{{ @$row['user']['firstname'] ." ".@$row['user']['firstname'] }}</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p><strong>{{ @$row['region_focus']['regionName'] }}</strong></p>
                                            <p>Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p><strong>{{ @$row['country_data']['country_name'] }}</strong></p>
                                            <p>Country Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p><strong>{{ @$row['investor_type']['typeInvestor'] }}</strong></p>
                                            <p>Investor Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text">{{ @$row['profileText']}}</p>
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
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4"></div>
            </div>
        </div>
    </section>


<script>
        function viewInvestorProfile(id){

            window.location.href="{{ url('User/viewInvestorProfile/') }}/"+id;
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
                if(paramArrayInvestorType.length > 0){ 
                    param = 'investortype'+encodeURIComponent(JSON.stringify(paramArrayInvestorType));
                }
                if(paramArrayInvestmentType.length > 0){ 
                    if(param !=""){
                        param += '&investmenttype'+encodeURIComponent(JSON.stringify(paramArrayInvestmentType));
                    }else{
                        param += 'investmenttype'+encodeURIComponent(JSON.stringify(paramArrayInvestmentType));
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
                    if($(this)[0].checked==true){
                        paramArrayCountry.push($(this).val())
                    }else{
                        var ind = paramArrayCountry.indexOf($(this)[0].value);
                        paramArrayCountry.splice(ind,1);
                    }
                    if(paramArrayCountry.length >0){
                        param += '&country'+encodeURIComponent(JSON.stringify(paramArrayCountry));
                    }
                }
                if($(this)[0].name == 'city'){
                    if($(this)[0].checked==true){
                        paramArrayCity.push($(this).val())
                    }
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
                    url: "{{ url('User/searchInvestorRelevance') }}",
                    data: {"_token":"{{ csrf_token() }}", data:data},
                    success:function(response)
                    {
                        if(response.msg=='success'){
                            var html = "";
                            var data = "";
                            data = response.data;
                            $.each(data,function(key,value){
                                var bannerimg = '{{ asset("uploads/images/") }}';
                                html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+'/'+value["banner_name"]+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+value["city_data"]["city_name"]+','+value["country_data"]["country_name"]+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                    if(value["region_focus"] !=""){
                                                        html+='<p><strong>'+ value["region_focus"]["regionName"]+ '</strong></p>';
                                                    }else{
                                                        html+='<p><strong></strong></p>';
                                                    }
                                                    html+='<p>Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["country_data"]["country_name"]+'</strong></p>';
                                                        html+='<p>Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["investor_type"]["typeInvestor"]+'</strong></p>';
                                                        html+='<p>Investor Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card`s content.</p>';
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
                        url:"{{ url('User/searchInvestors')}}",
                        data:{"_token": "{{ csrf_token() }}",data:investorName},
                        success:function(response)
                        {
                            if(response.msg=='success'){
                                    var html = "";
                                    var data = "";
                                    data = response.data;
                                    $.each(data,function(key,value){
                                        var bannerimg = '{{ asset("uploads/images/") }}';
                                html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+'/'+value["banner_name"]+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+value["city_data"]["city_name"]+','+value["country_data"]["country_name"]+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+ value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["region_focus"]["regionName"]+ '</strong></p>';
                                                        html+='<p>Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["country_data"]["country_name"]+'</strong></p>';
                                                        html+='<p>Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                       html+='<p><strong>'+ value["investor_type"]["typeInvestor"]+'</strong></p>';
                                                        html+='<p>Investor Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card`s content.</p>';
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
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investor+'</div>';
                });
               $('.one').html(result);
            });

            $('.investment').on('click',function(){
                var result = "";
                $(".investment.dform:checked").each(function (key,value) {
                    var investment = $($(".investment.dform:checked")[key]).data('name');
                result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investment+'</div>';
                
            });
                $('.two').html(result);
               
            })
             $('.industry').on('click',function(){
                var result = "";
                $(".industry.dform:checked").each(function (key,value) {
                var industry = $($(".industry.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+industry+'</div>';
                
            });
                $('.three').html(result);
               
            })

             $('.country').on('click',function(){
                var result = "";
                $(".country.dform:checked").each(function (key,value) {
                    var country = $($(".country.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+country+'</div>';
            });
                $('.four').html(result);
               
            })
              $('.city').on('click',function(){
                var result = "";
                $(".city.dform:checked").each(function (key,value) {
                var city = $($(".city.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+city+'</div>';
            });
                $('.five').html(result);
        });
            
        });

        function getResult(data){
        $.ajax({
           method: "POST",
           url: "{{url('User/getSearchDatainvestor')}}",
           data:{"_token": "{{ csrf_token() }}",data:data},
           success: function(response) {
                if(response.msg=='Success'){

                     var html = "";
                    var data = "";
                    data = response.data;
                    $.each(data,function(key,value){
                        var bannerimg = '{{ asset("uploads/images/") }}';
                                 html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                                 html+='<a href="#"  onclick="viewInvestorProfile('+value["id"]+')">';
                                    html+='<div class="card-content">';
                                        html+='<div class="card-img-top" style="background-image: url('+bannerimg+'/'+value["banner_name"]+')"></div>';
                                        html+='<div class="card-body">';
                                            html+='<p class="company-location">'+value["city_name"]+','+value["country_name"]+'</p>';
                                            html+='<h5 class="card-title">'+value["jobTitle"]+' At '+value["firmName"]+'</h5>';
                                            html+='<div class="card-lead-investor ">';

                                                html+='<div class="card-lead-investor-image">';
                                                    html+='<img src="'+bannerimg+'/'+value["image_name"]+'" alt="">';
                                                html+='</div>';
                                                html+='<div class="card-lead-investor-name"><h2>'+value["firstname"] +' '+value["lastname"]+'</h2>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<div class="row region_div">';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["regionName"]+ '</strong></p>';
                                                        html+='<p>Region Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                       html+='<p><strong>'+ value["country_name"]+'</strong></p>';
                                                        html+='<p>Country Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                                html+='<div class="col-md-4 col-lg-4 col-sm-4 col-4 col-xl-4">';
                                                    html+='<div class="region_div_text">';
                                                        html+='<p><strong>'+ value["typeInvestor"]+'</strong></p>';
                                                        html+='<p>Investor Focus</p>';
                                                    html+='</div>';
                                                html+='</div>';
                                            html+='</div>';
                                            html+='<p class="card-text">Some quick example text to build on the card title and make of the title and make up the bulk of the card`s content.</p>';
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


            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
            // Initialize select2
            $("#selectCity").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
    </script>


       @endsection