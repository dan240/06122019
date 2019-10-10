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
                             <h2>{{ @$comInfo['user']['firstname'].' '.@$comInfo['user']['lastname']}}</h2>
                            <h3>{{ @$comInfo['jobTitle'] }}</h3>
                            <h4>{{ @$comInfo['firmName'] }}</h4>
                            <h4 class="web-address"><i class="fa fa-map-marker-alt"></i>{{ @$comInfo['country_data']['country_name'] .", ". @$comInfo['city_data']['city_name'] }}</h4>
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
    <section class="content-box">
        <?php $id = Session::get('User.id'); $usertype = Session::get('User.usertype');?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:;" onclick="editInvestorProfile('{{$id}}')">Investor Profile</a></li>
							<li class="breadcrumb-item">Express Interested (Follower)  {{ app('App\Http\Controllers\UserController')->MeExpressedIn() }}</li>
                            <li class="breadcrumb-item "><a href="#" onclick="userInvestorExpressed('{{$id}}')">Interested In (Following) {{ app('App\Http\Controllers\UserController')->MeInterestedIn() }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
			<div class="row">
                @foreach($compData as $items)
                    <?php $id = $items['userid']; ?>
                    <div class="card col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12 grid-group-item">
                        <a href="#"  onclick="viewCompanyProfile('{{ $id }}')">
                        <div class="card-content">
                            <?php if(!empty($items['banner_name'])){?>
                                <div class="card-img-top" style="background-image: url('{{asset('uploads/images/'.@$items['banner_name']) }}')"></div>
                                <?php } else{ ?>
                                    <div class="card-img-top" style="background-image: url( '{{asset('images/profile_banner.jpg') }}')"></div>
                                <?php } ?>
                            
                            
                            <div class="card-body">
                                <div class="card-lead-investor ">
                                    <div class="card-lead-investor-image">
                                        <?php if(!empty($items['image_name'])){?>
                                            <img src="{{ asset('uploads/images/'.$items['image_name'])}}" alt="">
                                        <?php } else {?>
                                            <img  src="{{ asset('images/user.png')}}" alt="" title="">
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
                                <p class="card-text company-content">{{@$items['profileText']}}.</p>
                                <p class="sub-title">{{@$items['industry']['industryName']}}</p>
                                <?php if(!empty(@$items['fundingGoal']) && !empty(@$items['ammountRaised'])){?>
                                <div class="card-amount clearfix">
                                    <?php if(@$items['fundingGoal']<1000000){
                                        @$items['fundingGoal'] = str_replace(",", "", @$items['fundingGoal']);
                                        $target = number_format((@$items['fundingGoal']/1000),2)."K";
                                    }elseif(!empty(@$items['fundingGoal']) && @$items['fundingGoal']>=1000000){
                                        @$items['fundingGoal'] = str_replace(",", "", @$items['fundingGoal']);
                                        $target = number_format((@$items['fundingGoal']/1000000),2)."M";
                                    }
                                    @$items['ammountRaised'] = str_replace(",", "", @$items['ammountRaised']); 
                                    if( @$items['ammountRaised']<1000000){
                                        $amtraised = number_format((@$items['ammountRaised']/1000),2)."K";
                                    }elseif(!empty(@$items['ammountRaised']) && @$items['ammountRaised']>=1000000){
                                        $amtraised = number_format((@$items['ammountRaised']/1000000),2)."M";
                                    }
                                    ?>
                                    <div class="card-amount-raised" id="dataVal"><strong>{{$amtraised}} of {{$target}}</strong></div>
                                    <p><input type="range" min="1" max="{{@$target}}" value="{{$amtraised}}" class="slider-color" id="id"></p>
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
                    @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">

                </div>
			 </div>
        </div>
    </section>
    <script>
            function viewInvestorProfile(id)
            {
                window.location.href="{{ url('User/viewiProfile/') }}/"+id;
            }

            function editInvestorProfile(id)
            {
                window.location.href="{{ url('User/editInvestorProfile/') }}/"+id;
            }
            function viewCompanyProfile(id){

window.location.href="{{ url('User/viewCompanyProfile/') }}/"+id;
}
       function userInvestorExpressed(id){

window.location.href="{{ url('User/userProfileInvestor/') }}/"+id;
}
    </script>
@endsection