    @extends('layouts.home')
@section('content')
    <section class="content-box">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="fb-profile-block">
                        <?php if(!empty($comInfo['banner_name'])){?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('uploads/images/'.$comInfo['banner_name']) }}')"></div>
                        <?php } else{?>
                        <div id="bg-image" class="fb-profile-block-thumb " style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
                        <?php } ?>
                        <div class="profile-img">
                            <a href="#">
                                <?php if(!empty($comInfo['image_name'])){?>
                                <img id="displayimage" src="{{ asset('uploads/images/'.$comInfo['image_name'])}}" alt="" title="">
                                <?php } else{ ?>
                                    <img id="displayimage" src="{{ asset('images/user.png')}}" alt="" title="">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="profile-name">
                            <h2>{{ @$comInfo['user']['firstname']." ".@$comInfo['user']['lastname']}}</h2>
                            <h3>{{ @$comInfo['jobTitle'] }}</h3>
                           <h4>{{ @$comInfo['companyName'] }}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i> {{ @$comInfo['country_data']['country_name'] .", ". @$comInfo['city_data']['city_name']  }}</h4>
                        </div>
                        <div class="change-cover">
                            <div class="btn btn-edit btn-change">
                                <label for="upload-photo"><i class="fa fa-pen"></i></label>
                                <input type="file" name="photo" id="upload-photo"></div>
                        </div>
                        <!-- <button class="btn btn-meeting float-right" type="button">
                            <i class="fa fa-phone fa-flip-horizontal pull-right"></i>
                            <span class="pull-left">Request Meeting / Call</span></button>
                        <button class="btn btn-meeting float-right" type="button" style="margin-right: 5px">
                            <i class="fas fa-comments pull-right"></i>
                            <span class="pull-left">Message</span></button>	 -->	
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <?php $id = Session::get('User.id'); $usertype = Session::get('User.usertype');?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:;" onclick="editCompanyProfile('{{$id}}')">Company Profile</a></li>
							 <li class="breadcrumb-item">Expressed Interested (Follower) {{ app('App\Http\Controllers\UserController')->MeExpressedIn() }}</li>
                             <li class="breadcrumb-item "><a href="#" onclick="userCompanyExpressed('{{$id}}')"> Interest In (Following) {{ app('App\Http\Controllers\UserController')->MeInterestedIn() }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
			<div class="row">
                @foreach($expressedInterest as $row)
                            <?php $id=@$row['id'];?>
                            <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">
                                <a href="#"  onclick="viewInvestorProfile('{{ $id }}')">
                                <div class="card-content">
                                    <?php if(!empty($row['banner_name'])) { ?>
                                    <div class="card-img-top" style="background-image: url('{{asset('uploads/images/'.@$row['banner_name']) }}')"></div>
                                    <?php } else{?>
                                        <div class="card-img-top" style="background-image: url('{{asset('images/profile_banner.jpg') }}')"></div>
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
                                                <h2>{{ @$row['user']['firstname'] ." ".@$row['user']['lastname'] }}</h2>
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
                                                                if(isset( $regionList[$value])){
                                                                    array_push($tmpList, $regionList[$value]);
                                                                }
                                                            }
                                                            echo  implode(",<br>", $tmpList);
                                                        } 
                                                    ?></p>
                                                    <p class="r_head">Region Focus</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                                <div class="region_div_text">
                                                    <p class="focus-value"><?php 
                                                    if(!empty($row['countryFocus'])){ 
                                                        $tmp = explode(",", $row['countryFocus']);
                                                        $tmpList = array();
                                                        foreach($tmp as $key => $value){
                                                            if(isset( $countryList[$value])){
                                                                array_push($tmpList, $countryList[$value]);
                                                            }
                                                        }
                                                        echo  implode(",<br>", $tmpList);
                                                    }else{
                                                        echo $row['country_data']['country_name']; 
                                                    }
                                                    ?></p>
                                                    <p class="r_head">Country Focus</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-lg-4 col-sm-4 col-4">
                                                <div class="region_div_text">
                                                    <p class="focus-value"><?php 
                                                    if(!empty($row['sectorFocus'])){ 
                                                        $tmp = explode(",", $row['sectorFocus']);
                                                        $tmpList = array();

                                                        foreach($tmp as $key => $value){
                                                            if(isset( $sectorList[$value])){
                                                                array_push($tmpList, $sectorList[$value]);
                                                            }
                                                        }
                                                        echo  implode(",<br>", $tmpList);
                                                    }
                                                 ?></p>
                                                    <p class="r_head">Sector Focus</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text company-content"><?php 
                                        $indlist = explode(",", $row['industryFocus']);
                                        $tmpind = array();
                                        foreach ($indlist  as $indvalue) {
                                             if(isset($industryList[$indvalue])){
                                                array_push($tmpind, $industryList[$indvalue]);
                                             }
                                        } 
                                        echo  implode(", ", $tmpind);
                                    ?></p>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @endforeach
                </div>
    <script>
        function viewCompanyProfile(id){

                    window.location.href="{{ url('User/viewcProfile/') }}/"+id;
                }

             function viewInvestorProfile(id){

                window.location.href="{{ url('User/viewiProfile/') }}/"+id;
            }
            function editCompanyProfile(id)
            {
                window.location.href="{{ url('User/editCompanyProfile/') }}/"+id;
            }

            function editInvestorProfile(id)
            {
                window.location.href="{{ url('User/editInvestorProfile/') }}/"+id;
            }
            function userCompanyExpressed(id){

                    window.location.href="{{ url('User/userProfileCompany/') }}/"+id;
                }
    </script>
       @endsection