@extends('layouts.home')
@section('content')
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
                                         $Ftype = array();
                                    if(isset($queryString['fundtype']) && !empty($queryString['fundtype'])){
                                         $Comlss = array_keys($queryString['fundtype']);
                                        $Ftype =explode(",", @$Comlss[0]);
                                        foreach ($Ftype as $key => $value) {
                                            if(strtolower($value) != '"select all"'){
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
                                    <button class="dropbtn">Type Companies<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($companyTypes as $items) { ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="company"  class="company1 dform"   value="{{ $items }}" <?php echo in_array('"'.$items.'"', $Comlist) ? 'checked' : ''; ?>>{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="company" class="company1 dform" <?php echo in_array("Select All", $Comlist) ? 'checked' : ''; ?> value="Select All">Select All</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                                <div class="dropdown">
                                    <button class="dropbtn">Funding Type<i class="fa fa-caret-down"></i></button>
                                    <div class="dropdown-content">
                                        <form>
                                            <?php foreach($fundType as $items) { ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="fundtype"  class="fundtype  dform" value="{{ $items }}" <?php echo in_array('"'.$items.'"', $Ftype) ? 'checked' : ''; ?>>{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="fundtype" class="fundtype  dform" value="Select All" <?php echo in_array("Select All", $Ftype) ? 'checked' : ''; ?>>Select All</label>
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
                                                <label><input type="checkbox" name="industry"  class="industry  dform" value="{{ $items }}" <?php echo in_array('"'.$items.'"', $IndType) ? 'checked' : ''; ?> >{{ $items }}</label>
                                            </div>
                                            <?php } ?>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="industry" class="industry  dform" value="Select All" <?php echo in_array("Select All", $IndType) ? 'checked' : ''; ?> >Select All</label>
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
                                                <label><input type="checkbox" name="country" class="country  dform" <?php echo in_array('"Australia"', $CountryType) ? 'checked' : ''; ?> value="Australia">Australia</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="country"  <?php echo in_array('"Bahamas"', $CountryType) ? 'checked' : ''; ?> class="country dform" value="Bahamas">Bahamas</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="country"   <?php echo in_array('"Belgium"', $CountryType) ? 'checked' : ''; ?> class="country dform" value="Belgium">Belgium</label>
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
                                                <label><input type="checkbox" name="city" class="city dform"  <?php echo in_array('"Bago City"', $CityType) ? 'checked' : ''; ?> value="Bago City">Bago City</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="city" class="city dform"  <?php echo in_array('"Cabimas"', $CityType) ? 'checked' : ''; ?> value="Cabimas">Cabimas</label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" name="city" class="city dform"  <?php echo in_array('"Caracas"', $CityType) ? 'checked' : ''; ?> value="Caracas">Caracas</label>
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
                <div class="row databind" id="companyDetails">
                    @foreach($companyData as $items)
                    <?php $id = $items['id']; ?>
                    <a href="#" id="companyProfile" onclick="viewCompanyProfile('{{ $id }}')">
                        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " >
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('images/41608_823802.png')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $items['fname'] }} {{ $items['lname'] }}</h5>
                                    <p class="sub-title">{{ $items['jobTitle'] }} at {{ $items['companyName'] }}</p>
                                    <p class="sub-title">{{ $items['country'] }}, {{ $items['city'] }}</p>
                                    <hr class="tag-hr">
                                    <p class="sub-title">{{ $items['companyTagline'] }}</p>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <p class="sub-title">{{ $items['industry'] }}</p>
                                    <hr class="tag-hr">
                                    <div class="card-amount clearfix">
                                        <div class="card-amount-raised"><em>Raised</em><strong>$100,000</strong> of $300K</div>
                                        <p><input type="range" min="1" max="100" value="80" class="slider-color" id="id1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end pull-right">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
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
              //  print_r(@$queryString['industry']);
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
            /*console.log(window.location)*/
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
                    url: "{{ url('User/searchCompanyRelevance') }}",
                    data: {"_token":"{{ csrf_token() }}", data:data},
                    success:function(response)
                    {
                        if(response.msg=='success'){
                            var html = "";
                            var data = "";
                            data = response.data;
                            $.each(data,function(key,value){
                                html+='<a href="#" id="companyProfile" onclick="viewCompanyProfile('+value["id"]+')"><div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " ><div class="card"><img class="card-img-top" src="" alt="Card image cap">';
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
                            html+='</div></div></div></a>';
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
                                    html+='<a href="#" onclick="viewCompanyProfile('+value["id"]+')"><div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " ><div class="card"><img class="card-img-top" src="" alt="Card image cap">';
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
                                html+='</div></div></div></a>';
                                });
                                /*console.log(html);*/
                                $("#companyDetails").html(html);                                
                            }else{
                                $("#companyDetails").html('<div class="alert-danger">Data NOt Found</div>');
                            }
                        }
                });
            });

            $("#company1remove").click(function(){

            });
            $('.company1').on('click',function(){
                 var result = "";
                
                    $(".company1.dform:checked").each(function (key, value) {
                        
                        var company = $($(".company1.dform:checked")[key]).val();
                        result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="company1remove">×</span></button>'+company+'</div>';
                       
                    });
                     $('.one').html(result);
                });
            $('.fundtype').on('click',function(){
                var result = "";
                var data = "";
                $(".fundtype.dform:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var fundtype = $($(".fundtype.dform:checked")[key]).val();
                result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="fundtyperemove">×</span></button>'+fundtype+'</div>';
            });
                $('.two').html(result);
            });
             $('.industry').on('click',function(){
                var result = "";
                data = "";
                $(".industry.dform:checked").each(function (key,value) {
                data+= $('.filterdata ul li').find('#menu').text();
                var industry = $($(".industry.dform:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="industryremove">×</span></button>'+industry+'</div>';
            });
                $('.three').html(result);
               
            })

             $('.country').on('click',function(){
                var result = "";
                var data = "";
                $(".country.dform:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var country = $($(".country.dform:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="countryremove">×</span></button>'+country+'</div>';
            });
                $('.four').html(result);
               
            })
              $('.city').on('click',function(){
                var result = "";
                var data = "";
                $(".city.dform:checked").each(function (key,value) {
                    data+= $('.filterdata ul li').find('#menu').text();
                    var city = $($(".city.dform:checked")[key]).val();
                    result+='<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="cityremove">×</span></button>'+city+'</div>';
            });
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
                        html+='<a href="#" id="companyProfile" onclick="viewCompanyProfile('+value["id"]+')"><div class="col-md-3 col-lg-3 col-sm-3 col-xs-12 " ><div class="card"><img class="card-img-top" src="" alt="Card image cap">';
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
                    html+='</div></div></div></a>';
                    });
                    $("#companyDetails").html(html);                                
                }else{
                    $("#companyDetails").html('<div class="alert-danger">Data NOt Found</div>');

                }
            }
        });
   
    }
    </script>
@endsection