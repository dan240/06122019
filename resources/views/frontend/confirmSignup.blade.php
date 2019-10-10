@extends('layouts.home')
@section('content')
    <!--  -->
    <script src="{{ url('js/recaptcha.api.js')}}" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.min.css" />
    <style type="text/css">
        #ui-id-1{

        max-height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
        }
    </style>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                {{ Form::open(["method" => "post","class" => "login-container"]) }}
                    <h5 class="text-center">Accreditation Type</h5>
                    <hr style="border-top: 2px dotted #eee;">
                    <p> Hi, {{ Session::get('fname')}} {{ Session::get('lname')}}. To access our VC-backed deal flow, simply verify your <?php if(Session::get('utype')==1){ echo "company"; } elseif(Session::get('utype')==2){ echo "investor"; } ?> status:</p>
                    <div class="error-note alert alert-danger" style="display: none"></div>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group inner-label-holder"> <small class="label" for="input">Please enter your location</small>
                        <input type="text" class="form-control" name="location" id="location" autocomplete="off" placeholder="">
                    </div>
                    <div class="form-group">
                        <input type="radio" id="test1" name="radio">
                        <label for="test1">I certify that I am an accredited investor because
                        </label>
                    </div>
                      <div class="form-group">
                        <input type="radio" id="test2" name="radio">
                        <label for="test2">I'm not an accredited investor
                        </label>
                    </div>
                    <hr style="border-top: 2px dotted #eee;">
                    
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="age" id="age">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>I am over 18.</p>
                            </div>
                        </div>
                    </form-group>
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="termsuse" id="termsuse">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>I have read, understand, and agree to the Legal Information above the Terms of Use. Including but not limited to Lond Cap's indemnification.</p>
                            </div>
                        </div>
                    </form-group>
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="Investment" id="Investment">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>I understand that most startups fail. I can bear a 100% loss on my Investments.</p>
                            </div>
                        </div>
                    </form-group>
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="responsiblity" id="responsiblity">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>I understand that I am responsible for my own due diligence.</p>
                            </div>
                        </div>
                    </form-group>
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="accredited">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>I give permission to Lond Cap's to verify my accredited status.</p>
                            </div>
                        </div>
                    </form-group>
                    <form-group>
                        <div class="row"> 
                           <div class="col-sm-2">  <label class="switch">
                                <input type="checkbox" name="is_professional" value="1">
                                <span class="slider round"></span>
                               </label></div>
                            <div class="col-sm-10">
                                <p>Are you professional investor or company ?.</p>
                            </div>
                        </div>
                    </form-group>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group">
                        <button type="submit" id="second" class="btn">Update & Continue</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
    <script src="{{ url('js/jquery.validate.min.js')}}"></script>
    <script>
        $(document).ready(function(){
           $(".error-note").hide();
               $(".login-container").validate({
                  rules: {  
                    location: {required:true},
                        radio: {required:true},
                        age:{required:true},
                        termsuse:{required:true},
                        Investment:{required:true},
                        responsiblity:{required:true},
                        accredited:{required:true},
                    },
                    /*groups: {
                    age: "age termsuse Investment responsiblity accredited"
                    },*/
                errorPlacement: function(error, element) {
                    if ( element.attr('name')=="age" ){
                        $(".error-note").append('Accept age limit.<br>');
                    } else if (  element.attr("name") == "termsuse" ){
                        $(".error-note").append('Accept Terms of Use.<br>');

                    }else if (  element.attr("name") == "Investment"  ){
                        $(".error-note").append('Accept Investment risk.<br>');

                    } else if (   element.attr("name") == "responsiblity"  ){
                        $(".error-note").append('Accept Responsibility.<br>');

                    }else if (   element.attr("name") == "accredited" ){
                        $(".error-note").append('Accept accredited.<br>');

                    } else if(element.attr('name')=="radio"){
                        $(".error-note").append('Please choose one of the following investor statuses.<br>');               
                    } else if(element.attr('name')=="location"){
                        $(".error-note").append('Enter your location.<br>');     
                    }
                    else {error.insertAfter(element);}
                },
                    /*messages: {
                        location:"Enter your location",
                        radio: 'Please choose one of the following investor statuses',
                        age:'All the fields have to be checked',
                        termsofuse:'All the fields have to be checked',
                        Investment:'All the fields have to be checked',
                        responsiblity:'All the fields have to be checked',
                        accredited:'All the fields have to be checked',
                    },*/
                submitHandler: function() {
                    $(".login-container").submit();
                }
           });
        $("#second").on('click',function(e){
            $(".error-note").html('');
                e.preventDefault();
            if($(".login-container").valid()){
                $.ajax({
                    method:"POST",
                    url:"{{ url('User/successSignup') }}",
                    data:$(".login-container").serialize(),
                    success:function(data){
                        if(data.msg=='Success'){
                            location.href="{{ url('User/emailnotverified') }}";
                        }
                        
                        // //debugger;
                        // if(data.msg=='Success' && data.utype == 1){
                        //     //debugger;
                        //     location.href="{{ url('User/addcompanyProfile') }}";
                        // }
                        // else if(data.msg=='Success' && data.utype == 2){
                        //     //debugger;
                        //     location.href="{{ url('User/addinvestorProfile') }}";
                        // }

                    }
                });
            }else{
                $(".error-note").show();
            }
        });
        BindControls();
        });
    
    function BindControls(){
        $.ajax({
            method:"POST",
            url:"{{url('User/findCityList')}}",
            data:{"_token":"{{csrf_token()}}"},
            success:function(response)
            {
                //debugger;
                var cityList = [];
                var cities = JSON.parse(response);
                $.each(cities,function(key,value){
                    cityList.push(value['city_name']+', '+value['country']['country_name']);
                })
                //debugger;
                $("#location").autocomplete({
                    source: cityList,
                    minLength: 0,
                    scroll: true
                    }).focus(function() {
                        $(this).autocomplete("search", "");
                    });
            }
        });
    }
    </script>
   @endsection
