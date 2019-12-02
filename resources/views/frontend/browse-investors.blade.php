@extends('layouts.investor')
@section('content')
    <section class="content-box">
        <div class="container">
            <div class="filter_div">
                <div class="row">

                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <form autocomplete="off" id="firm_search_form">
                            <div class="input-group mt-1 ml-2 border-0">
                                <input type="text" name="firm_name" id="firm_name" placeholder="Search by investor firm name" class="form-control border-light" data-placement="top" title="Please enter more than 2 characters." data-trigger="manual">
                                <div class="input-group-append">
                                    <button type="submit" id="button-addon2" class="btn btn-outline-light bg-info text-white">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-md-6 col-lg-6 col-sm-6 col-12">
                        <ul>
                            <li class="nav-item dropdown">
                                <div class="dropdown">
                                    <button class="dropbtn">Investor Type <i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <form autocomplete="off">
                                            <?php foreach ($investortype as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="investor"  class="investor dform" data-name="{{ $items['typeInvestor'] }}" value="{{ $items['id'] }}">{{ $items['typeInvestor'] }}<span class="checkmark"></span></label>
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
                                        <form autocomplete="off">
                                            <?php foreach ($investmentType as $items) { ?>
                                            <div class="checkbox">
                                                <label class="check_container"><input type="checkbox" name="investment" class="investment dform" data-name="{{ $items['typeInvestment'] }}" value="{{ $items['id'] }}">{{ $items['typeInvestment'] }}<span class="checkmark"></span></label>
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
                                        <select id='industry' multiple="" class="selectpicker select-search-options show-tick form-control industry dform" name="industry" data-live-search="true" autocomplete="off">      
                                        @foreach($industry as $key12 => $val)
                                            <option value="{{$key12}}" data-name="{{$val}}">{{$val}}</option>  
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">Country<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCountry' multiple="" class="selectpicker select-search-options show-tick form-control country dform" name="country" data-live-search="true" autocomplete="off">      
                                        @foreach($countrylist as $key => $value)
                                            <option value="{{$key}}" data-name="{{$value}}">{{$value}}</option>  
                                        @endforeach
                                    </select> 
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <div class="dropdown select-options">
                                    <button class="dropbtn">City<i class="fas fa-chevron-down"></i></button>
                                    <div class="dropdown-content">
                                        <select id='selectCity' multiple="" name="city" class="selectpicker select-search-options show-tick form-control city dform" data-live-search="true" autocomplete="off">
                                            @foreach($citylist as $city)
                                                <option value="{{$city['id']}}" data-name="{{$city['city_name']}}">{{$city['city_name'].', '.$city['country']['country_name']}}</option>
                                            @endforeach
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
                                    $Comlist = [];

                                    if (isset($queryString['investortype']) && !empty($queryString['investortype'])) {
                                        $Comls = array_keys($queryString['investortype']);
                                        $Comlist = explode(',', @$Comls[0]);

                                        foreach ($Comlist as  $value) {
                                            foreach ($investortype as $items) {
                                                $id = str_replace('"', '', $value);

                                                if (('"select all"' != strtolower($value)) && $id == $items['id']) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items['typeInvestor'].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="two">
                                <?php
                                         $Ftype = [];
                                         //print_r($queryString); exit;
                                    if (isset($queryString['investmenttype']) && !empty($queryString['investmenttype'])) {
                                        $Comlss = array_keys($queryString['investmenttype']);
                                        $Ftype = explode(',', @$Comlss[0]);

                                        foreach ($Ftype as $key => $value) {
                                            foreach ($investmentType as $items) {
                                                $id = str_replace('"', '', $value);

                                                if (('"select all"' != strtolower($value)) && $id == $items['id']) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items['typeInvestment'].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="three">
                                <?php
                                        $IndType = [];

                                    if (isset($queryString['industry']) && !empty($queryString['industry'])) {
                                        $Comlindl = array_keys($queryString['industry']);
                                        $IndType = explode(',', @$Comlindl[0]);

                                        foreach ($IndType as $key => $value) {
                                            foreach ($industry as $key11 => $items) {
                                                $id = str_replace('"', '', $value);

                                                if (('"select all"' != strtolower($value)) && $id == $key11) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$items.'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="four">
                                <?php
                                    $CountryType = [];

                                    if (isset($queryString['country']) && !empty($queryString['country'])) {
                                        $CountryType = array_keys($queryString['country']);

                                        foreach ($CountryType as $key => $value) {
                                            foreach ($country as $co) {
                                                $id = str_replace('"', '', $value);

                                                if (('"select all"' != strtolower($value)) && $id == $co['id']) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$co['country_name'].'</div>';
                                                }
                                            }
                                        }
                                    }
                                ?>
                            </li>
                            <li class="five">
                                <?php
                                    $CityType = [];

                                    if (isset($queryString['city']) && !empty($queryString['city'])) {
                                        $CityType = array_keys($queryString['city']);

                                        foreach ($CityType as $key => $value) {
                                            foreach ($city as $ci) {
                                                $id = str_replace('"', '', $value);

                                                if (('"select all"' != strtolower($value)) && $id == $ci['id']) {
                                                    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'.$ci['city_name'].'</div>';
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
                            <!-- <div class="browse-deals-alert">
                                <a class="create-alert-signin">Create Alert</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="sorting">
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        <div class="browse-sort">
                            <div class="dropdown">
                                <select class="dropbtn" autocomplete="off" id="sortBy"><i class="fa fa-caret-down" style="margin-left: 5px"></i>
                                    <option href="#" value="Relevance">Sort by Relevance</option>
                                    <option href="#" value="Newest">Sort by Newest</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-12">
                        
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
                    <?php $id = @$row['id']; ?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">
                        <a href="{{ url('User/viewInvestorProfile') }}/{{ $id }}" target="_blank">
                        <div class="card-content">
                            <?php if (!empty($row['banner_name'])) {
                                    ?>
                            <div class="card-img-top" style="background-image: url('{{asset('public/uploads/images/'.@$row['banner_name']) }}')"></div>
                            <?php
                                } else {
                                    ?>
                                <div class="card-img-top" style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                            <?php
                                } ?>
                            
                            <div class="card-body">
                                <p class="company-location">
                                    {{ @$row['city_data']['city_name'].", ".@$row['country_data']['country_name']}} </p>
                                <h5 class="card-title">{{ @$row['jobTitle'] ." At ".@$row['firmName'] }}</h5>
                                <div class="card-lead-investor ">

                                    <div class="card-lead-investor-image">
                                       <?php if (!empty($row['image_name'])) {
                                    ?>
                                            <img src="{{ asset('public/uploads/images/'.$row['image_name'])}}" alt="">
                                        <?php
                                } else {
                                    ?>
                                            <img src="{{ asset('images/user.png') }}" alt="">
                                        <?php
                                } ?>
                                    </div><!-- .card-lead-investor-image -->
                                    <div class="card-lead-investor-name">
                                        <h2>{{ @$row['user']['firstname'] ." ".@$row['user']['lastname'] }}</h2>
                                    </div>
                                </div>
                                <div class="row region_div">
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p class="focus-value"><?php
                                                    if (!empty($row['regionFocus'])) {
                                                        $tmp = explode(',', $row['regionFocus']);
                                                        $tmpList = [];

                                                        foreach ($tmp as $key => $value) {
                                                            if (isset($regionlist[$value])) {
                                                                array_push($tmpList, $regionlist[$value]);
                                                            }
                                                        }
                                                        echo  implode(',<br>', $tmpList);
                                                    }
                                                       // echo $row['country_data']['country_name'];
                                                     ?></p>
                                            <p class="focus-caption">Region Focus</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                        <div class="region_div_text">
                                            <p class="focus-value">
                                                <?php
                                                    if (!empty($row['countryFocus'])) {
                                                        $tmp = explode(',', $row['countryFocus']);
                                                        $tmpList = [];

                                                        foreach ($tmp as $key => $value) {
                                                            if (isset($countrylist[$value])) {
                                                                array_push($tmpList, $countrylist[$value]);
                                                            }
                                                        }
                                                        echo  implode(',<br>', $tmpList);
                                                    } else {
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
                                               <?php if (0 != @$row['investorType']) {
                                                    echo @$row['investor_type']['typeInvestor'];
                                                } else {
                                                    $int = '';

                                                    foreach ($investortype as $key => $value) {
                                                        $int .= $value['typeInvestor'].', ';
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
                                                    if (!empty($row['sectorFocus'])) {
                                                        $tmp = explode(',', $row['sectorFocus']);
                                                        $tmpList = [];

                                                        foreach ($tmp as $key => $value) {
                                                            if (isset($sectorlist[$value])) {
                                                                array_push($tmpList, $sectorlist[$value]);
                                                            }
                                                        }
                                                        echo  implode(',<br>', $tmpList);
                                                    }
                                                 ?>
                                            </p>
                                            <p class="focus-caption">Sector Focus</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="card-text">{{ @$row['profileText']}}</p> -->
                                <p class="card-text company-content">
                                    <?php
                                        //print_r($industry);
                                        $indlist = explode(',', $row['industryFocus']);
                                        $tmpind = [];

                                        foreach ($indlist  as $indvalue) {
                                            if (isset($industry[$indvalue])) {
                                                array_push($tmpind, $industry[$indvalue]);
                                            }
                                        }
                                        echo  implode(', ', $tmpind);
                                    ?>
                                </p>
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
                    <button id="load_more_results" type="button" class="d-none btn btn-primary btn-lg btn-block">Load More Results</button>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 col-xl-4"></div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var baseurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?';

            <?php
            if (!empty($getFullQueryString)) {
                if (!empty(@$queryString['investortype'])) {
                    $tt = array_keys(@$queryString['investortype']);
                    echo 'var paramArrayInvestorType = ['.@$tt[0].'];';
                } else {
                    echo 'var paramArrayInvestorType = [];';
                }

                if (!empty(@$queryString['investmentType'])) {
                    $tt = array_keys(@$queryString['investmentType']);
                    echo 'var paramArrayInvestmentType = ['.@$tt[0].'];';
                } else {
                    echo 'var paramArrayInvestmentType = [];';
                }

                if (!empty(@$queryString['industry'])) {
                    $tt = array_keys(@$queryString['industry']);
                    echo 'var paramArrayIndustry = ['.@$tt[0].'];';
                } else {
                    echo 'var paramArrayIndustry = [];';
                }

                if (!empty(@$queryString['country'])) {
                    $tt = array_keys(@$queryString['country']);
                    echo 'var paramArrayCountry = ['.@$tt[0].'];';
                } else {
                    echo 'var paramArrayCountry = [];';
                }

                if (!empty(@$queryString['city'])) {
                    $tt = array_keys(@$queryString['city']);
                    echo 'var paramArrayCity = ['.@$tt[0].'];';
                } else {
                    echo 'var paramArrayCity = [];';
                }
            } else {
                ?>

                var paramFirmName = "";
                var paramArrayInvestorType = []; 
                var paramArrayInvestmentType = []; 
                var paramArrayIndustry = []; 
                var paramArrayCountry = []; 
                var paramArrayCity = [];
                var paramSortBy = "";

            <?php
            } ?>;
            
            <?php
                if (!empty($Ftype)) {
                    echo 'var paramArrayIndustry = '.json_encode($Ftype).';';
                }
            ?>

            function buildParams() {
                paramFirmName = "";
                paramArrayInvestorType = []; 
                paramArrayInvestmentType = []; 
                paramArrayIndustry = []; 
                paramArrayCountry = []; 
                paramArrayCity = [];
                paramSortBy = "";

                param = '';

                paramFirmName = $("#firm_name").val();

                $("input.investor:checked").each(function () {
                    paramArrayInvestorType.push($(this).val());
                });

                $("input.dform:checked").each(function () {
                    paramArrayInvestmentType.push($(this).val());
                });

                paramArrayIndustry = $("#industry").val();

                paramArrayCountry = $("#selectCountry").val();

                paramArrayCity = $("#selectCity").val();
                
                paramSortBy = $("#sortBy").val();

                param = 'firm_name=' + JSON.stringify(paramFirmName) + '&investortype=' + JSON.stringify(paramArrayInvestorType) + '&investmenttype=' + JSON.stringify(paramArrayInvestmentType) + '&industry=' + JSON.stringify(paramArrayIndustry) + '&country=' + JSON.stringify(paramArrayCountry) + '&city=' + JSON.stringify(paramArrayCity)  + '&sort_by='+JSON.stringify(paramSortBy);

                getResult(param);
            }

            $("#sortBy").on('change',function(e) {
                e.preventDefault();

                buildParams();
            });

            $('#firm_name').tooltip();

            $("#firm_search_form").submit(function(event) {
                event.preventDefault();

                var firm_name = $("#firm_name").val();

                if (firm_name.length == 0 || firm_name.length > 2) {
                    $('#firm_name').tooltip('hide');

                    buildParams();
                } else {
                    $('#firm_name').tooltip('show');
                }
            });

             $('.investor').on('click',function() {
                var result = "";

                $(".investor.dform:checked").each(function (key, value) {
                    var investor = $($(".investor.dform:checked")[key]).data('name');
                    result += '<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="investorType" role="alert" id="menu"><button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>'+investor+'</div>';
                });

               $('.one').html(result);

               buildParams();
            });

            $('.investment').on('click',function(){
                var result = "";

                $(".investment.dform:checked").each(function (key,value) {
                    var investment = $($(".investment.dform:checked")[key]).data('name');
                    result+='<div class="alert alert-warning alert-dismissible topParent" data-index="'+key+'" data-type="investmentType" role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+investment+'</div>';
                });

                $('.two').html(result);

                buildParams();
            });

            $('#industry').on('change',function(){
                var result = "";

                [].forEach.call(document.querySelectorAll('#industry :checked'), function(elm) {
                    result += '<div class="alert alert-warning alert-dismissible topParent" data-index="' + elm.value + '" data-type="industryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + elm.innerText + '</div>';
                });

                $('.three').html(result);

                buildParams();
            });

            $('#selectCountry').on('change',function() {
                var result = "";

                [].forEach.call(document.querySelectorAll('#selectCountry :checked'), function(elm) {
                    result += '<div class="alert alert-warning alert-dismissible topParent" data-index="' + elm.value + '" data-type="countryType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + elm.innerText + '</div>';
                });

                $('.four').html(result);

                //update cities
                var country = $(this).val();

                $.ajax({
                    method: "POST",
                    url: "{{ url('User/getcityList')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cid: country
                    },
                    success:function(response) {
                        $('#selectCity').html('');

                        var data = JSON.parse(response);
                        var appenddata = '';

                        $.each(data, function (key, value) {
                            appenddata += "<option value='" + value.id + "' data-name='" + value.city_name + "'>" + value.city_name + ", " + value.country.country_name + " </option>";
                        });

                        $('#selectCity').html(appenddata);
                        $('#selectCity').selectpicker('refresh');

                        $('.five').html('');
                    }
                });

                buildParams();
            });

            $('#selectCity').on('change',function() {
                var result = "";
                
                var selected = $(this).val();

                [].forEach.call(document.querySelectorAll('#selectCity :checked'), function(elm) {
                    result += '<div class="alert alert-warning alert-dismissible topParent" data-index="' + elm.value + '" data-type="cityType"  role="alert" id="menu"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' + elm.innerText + '</div>';
                });
                
                $('.five').html(result);

                buildParams();
            });

            $('body').on('click','.topParent',function(){
                var obj = $(this);

                if ($(this).data('type') == "investorType") {
                    var index = $(this).data('index');

                    $(".investor.dform:checked").each(function (key, value) {
                        if (key == index) {
                            $($(".investor.dform:checked")[key]).prop('checked', false);

                            obj.remove();

                            buildParams();
                        }
                    });
                }

                if ($(this).data('type') == "investmentType") {
                    var index = $(this).data('index');

                    $(".investment.dform:checked").each(function (key, value) {
                        if (key == index) {
                            $($(".investment.dform:checked")[key]).prop('checked', false);

                            obj.remove();

                            buildParams();
                        }
                    });
                }

                if ($(this).data('type') == "industryType") {
                    var index = $(this).data('index');

                    [].forEach.call(document.querySelectorAll('#industry :checked'), function(elm) {
                        if (elm.value == index) {
                            elm.selected = false;

                            $("#industry").selectpicker('refresh');
                        }
                    });

                    buildParams();
                }

                if($(this).data('type') =="countryType"){
                    var index = $(this).data('index');

                    [].forEach.call(document.querySelectorAll('#selectCountry :checked'), function(elm) {
                        if (elm.value == index) {
                            elm.selected = false;

                            $("#selectCountry").selectpicker('refresh');
                        }
                    });

                    buildParams();
                }

                if ($(this).data('type') == "cityType") {
                    var index = $(this).data('index');

                    [].forEach.call(document.querySelectorAll('#selectCity :checked'), function(elm) {
                        if (elm.value == index) {
                            elm.selected = false;

                            $("#selectCity").selectpicker('refresh');
                        }
                    });

                    buildParams();
                }
            });

            $('#load_more_results').on('click', function() {
                $(".se-pre-con").fadeIn("slow");

                $.ajax({
                    method: "GET",
                    dataType: "json",
                    url: $(this).attr("data-next-page-url"),
                    complete: function() {
                        $(".se-pre-con").fadeOut("slow");
                    },
                    success: function (response) {
                        processAjaxResponse(response);
                        $(window).scrollTop(0);
                    }
                });
            });

        });

        function getResult(data) {
            $(".se-pre-con").fadeIn("slow");
            
            $.ajax({
                method: "GET",
                url: "{{url('User/getSearchDatainvestor')}}",
                dataType: "json",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data
                },
                complete: function() {
                    $(".se-pre-con").fadeOut("slow");
                },
                success: function(response) {
                    processAjaxResponse(response);
                }
            });
        }

        function processAjaxResponse(response) {
            if (response.next_page_url) {
                $("#load_more_results").attr("data-next-page-url", response.next_page_url);
                $("#load_more_results").removeClass("d-none");
            } else {
                $("#load_more_results").attr("data-next-page-url", "");
                $("#load_more_results").addClass("d-none");
            }

            if (response.total > 0) {
                var html = "";
                var data = "";

                data = response.data;

                $.each(data,function(key,value) {
                    if (value['city_name'] != null) { 
                        var city = value["city_name"];
                    } else {
                        var city ='';
                    }

                    if(value["country_name"] != null) {
                        var country = value["country_name"];
                    } else {
                        var country = '';
                    }

                    if(value['profileText']!= null){
                        var profileText = value['profileText'];
                    } else {
                        var profileText = '';
                    }
                    
                    if(value["typeInvestor"] != null){
                        var investor = value["typeInvestor"];
                    } else {
                        var investor ='';
                    }
                    
                    if (value["grouped_regions"]) {
                        var region = value["grouped_regions"];
                    } else {
                        var region = '';
                    }

                    if (value["grouped_countries"]) {
                        var country_focus = value["grouped_countries"];
                    } else {
                        var country_focus = '';
                    }

                    if (value["grouped_sectors"]) {
                        var sector = value["grouped_sectors"];
                    } else {
                        var sector = '';
                    }

                    if (value["grouped_industries"]){
                        var industryF = value["grouped_industries"];
                    } else {
                        var industryF = '';
                    }

                    if (value["banner_name"] == null || value["banner_name"] == '' ){
                        var bannerimg = '{{ asset("images/profile_banner.jpg") }}' ;
                    } else {
                        var bannerimg = '{{ asset("public/uploads/images/") }}/' + value["banner_name"];
                    }

                    if (value["image_name"] == null || value["image_name"] == '' ){
                        var profileimg = '{{ asset("images/user.png") }}' ;
                    } else {
                        var profileimg = '{{ asset("public/uploads/images/") }}/' + value["image_name"];
                    }

                    html+='<div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">';
                    html+='<a href="{{ url('User/viewInvestorProfile') }}/'+value["id"]+'" target="_blank">';
                        html+='<div class="card-content">';
                            html+='<div class="card-img-top" style="background-image: url('+bannerimg+')"></div>';
                            html+='<div class="card-body">';
                                html+='<p class="company-location">'+city+', '+country+'</p>';
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
                                        html+='<p class="focus-value">'+ country_focus+'</p>';
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

                $("#investorProfile").html(html);
                $(".sorting").show();
            } else {
                @if(Session::has('User'))
                    $("#investorProfile").html('<div class="alert-danger">No investors were found with the selected criteria.</div>');
                @else
                    $("#investorProfile").html('<div class="alert-danger"><p>No featured investors were found with the selected criteria.</p><p>Sign up to view all investors.</p></div>'); 
                @endif
                
                $(".sorting").hide();
            }
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
        $(document).ready(function() {
            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
            
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
@endsection