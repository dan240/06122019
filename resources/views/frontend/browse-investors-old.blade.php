@extends('layouts.investor')
@section('content')
    <!-------------------------nav-end------------------------------>
    <section class="filter_div">
        <div class="container">
            <div class="filter_div_in">
                <div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 filterdata">
                        <ul>
                            <li class="one">
                                 <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            if(strtolower($value) != '"select all"'){

                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
                                            }
                                        }
                                    }
                                ?>
                                
                            </li>
                            <li class="two">
                                 <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            if(strtolower($value) != '"select all"'){

                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="three">
                                 <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            if(strtolower($value) != '"select all"'){

                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="four">
                                 <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            if(strtolower($value) != '"select all"'){

                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="five">
                                 <?php 
                                    $Comlist =array();
                                    if(isset($queryString['company']) && !empty($queryString['company'])) {
                                        $Comls = array_keys($queryString['company']);
                                        
                                        $Comlist =explode(",", @$Comls[0]);
                                        foreach ($Comlist as  $value) {
                                            if(strtolower($value) != '"select all"'){

                                                echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$value.'</div>';
                                            }
                                        }
                                    }
                                ?>
                            </li>                            
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-right">
                        <div class="browse-sort-filter-controls">
                            <div class="browse-deals-alert">
                                <a class="create-alert-signin">Create Alert</a>
                            </div><!-- .browse-deals-alert -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="filter_div filter_options">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="filter_menu">
                        <div class="row ten-columns">
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">Investor Type<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($investortype as $items) { ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="investor"  class="investor dform" value="{{ $items }}">{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="investor" class="investor dform" value="Select All">Select All</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">Investment Type<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($investmentType as $items) { ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="investment" class="investment dform" value="{{ $items }}">{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="investment" class="investment dform" value="Select All">Select All</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">Industry<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($industry as $items) { ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="industry"  class="industry dform" value="{{ $items }}">{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="industry" class="industry dform" value="Select All">Select All</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">Country<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Australia</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Bahamas</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Belgium</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Canada</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Cuba</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Denmark</label>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">City<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Bago City</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Cabimas</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Caracas</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Dabgram</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Egypt</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="">Etawah</label>
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
    </section>

    <!-- Container (cards) -->

    <section class="badges">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="browse-name-search">
                        <input type="text" placeholder="Search by company name" maxlength="40" id="browse-name-search" value="" autocomplete="off">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
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
            </div>
            <div class="cards">
                <div class="row" id="companyDetails">
                     @foreach($investorData as $items)
                     <?php $id = $items['id']; ?>
                    <a href="#" id="companyProfile" onclick="viewInvestorProfile('{{ $id }}')">
                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
                       
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/41608_823802.png')}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ @$items['user']['firstname'] }} {{ @$items['user']['lastname']}}</h5>
                                <p class="sub-title">{{ $items['jobTitle'] }} at {{ $items['firmName'] }}</p>
                                <p class="sub-title">{{ $items['country'] }}</p>
                                <hr class="tag-hr">
                                <p class="sub-title">{{ $items['regionFocus'] }}</p>
                                <p class="sub-title">{{ $items['countryFocus'] }}</p>
                                <p class="sub-title">{{ $items['industryFocus'] }}</p>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div></a>
                    @endforeach
                </div>
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
              //  print_r(@$queryString['industry']);
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
            console.log(window.location)
            <?php if (!empty($Ftype)){

                echo "var paramArrayIndustry = ".json_encode($Ftype).";"; 
            } ?>
            $( '.dform').on('change', function(){
                debugger;
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
                                html+='<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " ><div class="card"><img class="card-img-top" src="" alt="Card image cap">';
                                html+='<div class="card-body">';
                                html+='<h5 class="card-title">'+ value["fname"] + value["lname"]+'</h5>';
                                html+='<p class="sub-title">'+ value["jobTitle"] +' at '+ value["companyName"]+'</p>';
                                html+='<p class="sub-title">'+ value["country"] +', '+ value["city"]+'</p>';
                                html+='<hr class="tag-hr">';
                                html+='<p class="sub-title">'+ value["companyTagline"] +'</p>';
                                html+='<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card`s content.</p>';
                                html+='<p class="sub-title">'+ value["industry"] +'</p>';
                                html+='<hr class="tag-hr">';
                                html+='<div class="card-amount clearfix">';
                                html+='<div class="card-amount-raised"><em>Raised</em><strong>$100,000</strong> of $300K</div>';
                                html+='<p><input type="range" min="1" max="100" value="80" class="slider-color" id="id1"></p>';
                                html+='</div>';
                            html+='</div></div></div>';
                            });
                            /*console.log(html);*/
                            $("#companyDetails").html(html);                                
                        }else{
                            $("#companyDetails").html('<div class="alert-danger">Data NOt Found</div>');
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
                                        html+='<div class="card"><img class="card-img-top" src="" alt="Card image cap">';
                                        html+='<div class="card-body">';
                                        html+='<h5 class="card-title">'+ value["fname"] + value["lname"]+'</h5>';
                                        html+='<p class="sub-title">'+ value["jobTitle"] +' at '+ value["companyName"]+'</p>';
                                        html+='<p class="sub-title">'+ value["country"] +', '+ value["city"]+'</p>';
                                        html+='<hr class="tag-hr">';
                                        html+='<p class="sub-title">'+ value["companyTagline"] +'</p>';
                                        html+='<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card`s content.</p>';
                                        html+='<p class="sub-title">'+ value["industry"] +'</p>';
                                        html+='<hr class="tag-hr">';
                                        html+='<div class="card-amount clearfix">';
                                        html+='<div class="card-amount-raised"><em>Raised</em><strong>$100,000</strong> of $300K</div>';
                                        html+='<p><input type="range" min="1" max="100" value="80" class="slider-color" id="id1"></p>';
                                        html+='</div>';
                                    html+='</div></div>';
                                    });
                                    /*console.log(html);*/
                                    $("#companyDetails").html(html);                                
                                }else{
                                    $("#companyDetails").html('<div class="alert-danger">Data NOt Found</div>');
                                }

                        }
                });
            });


             $('.investor').on('click',function(){
                 var result = "";
                 var data = "";
                 $("input:checkbox[class=investor]:checked").each(function (key, value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var investor = $($("input:checkbox[class=investor]:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investor+'</div>';
                });
               $('.one').html(result);
               getResult(data);
            });

            $('.investment').on('click',function(){
                var result = "";
                var data = "";
                $("input:checkbox[class=investment]:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var investment = $($("input:checkbox[class=investment]:checked")[key]).val();
                result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investment+'</div>';
                
            });
                $('.two').html(result);
                getResult(data);
               
            })
             $('.industry').on('click',function(){
                var result = "";
                var data = "";
                $("input:checkbox[class=industry]:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                var industry = $($("input:checkbox[class=industry]:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+industry+'</div>';
                
            });
                $('.three').html(result);
                getResult(data);
               
            })

             $('.country').on('click',function(){
                var result = "";
                var data = "";
                $("input:checkbox[class=country]:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                var country = $($("input:checkbox[class=country]:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+country+'</div>';
            });
                $('.four').html(result);
                getResult(data);
               
            })
              $('.city').on('click',function(){
                var result = "";
                var data = "";
                $("input:checkbox[class=city]:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                var city = $($("input:checkbox[class=city]:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+city+'</div>';
            });
                $('.five').html(result);
                getResult(data);
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
                        html+='<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " ><div class="card"><img class="card-img-top" src="" alt="Card image cap">';
                        html+='<div class="card-body">';
                        html+='<h5 class="card-title">'+ value["fname"] + value["lname"]+'</h5>';
                        html+='<p class="sub-title">'+ value["jobTitle"] +' at '+ value["companyName"]+'</p>';
                        html+='<p class="sub-title">'+ value["country"] +', '+ value["city"]+'</p>';
                        html+='<hr class="tag-hr">';
                        html+='<p class="sub-title">'+ value["companyTagline"] +'</p>';
                        html+='<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card`s content.</p>';
                        html+='<p class="sub-title">'+ value["industry"] +'</p>';
                        html+='<hr class="tag-hr">';
                        html+='<div class="card-amount clearfix">';
                        html+='<div class="card-amount-raised"><em>Raised</em><strong>$100,000</strong> of $300K</div>';
                        html+='<p><input type="range" min="1" max="100" value="80" class="slider-color" id="id1"></p>';
                        html+='</div>';
                    html+='</div></div></div>';
                    });
                    /*console.log(html);*/
                    $("#companyDetails").html(html);                                
                }else{
                    $("#companyDetails").html('<div class="alert-danger">Data NOt Found</div>');

                }
            }
        });
    }
    </script>
@endsection