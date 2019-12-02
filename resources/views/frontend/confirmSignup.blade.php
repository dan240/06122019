@extends('layouts.home')
@section('content')
    <!--  -->
    <script src="{{ url('js/recaptcha.api.js')}}" async defer></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
    <style type="text/css">
        #ui-id-1 {
            max-height: 250px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .custom-combobox {
            position: relative;
            display: inline-block;
            font-size: 12px !important;
        }
        .custom-combobox-toggle {
            position: absolute;
            top: 0;
            bottom: 0;
            margin-left: -1px;
            padding: 0;
        }
        .custom-combobox-input {
            margin: 0;
            padding: 5px 10px;
        }
    </style>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <section class="inner-pages">
        <div class="container">
            <div class="row centered-container clearfix">
                {{ Form::open(["method" => "post", "id" => "confirm-signup", "autocomplete" => "off"]) }}
                    <h5 class="text-center">Sign Up Details</h5>
                    <hr style="border-top: 2px dotted #eee;">
                    <p> Hi, {{ Session::get('User')['firstname'] }} {{ Session::get('User')['lastname'] }}. Please verify your status:</p>
                    <div class="error-note alert alert-warning mt-2" style="display: none"></div>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group">
                        <select name="country" id="country" autocomplete="off" required>
                            <option value="">--Select Country--</option>
                            @foreach($countries as $con)
                                <option value="{{ $con['id'] }}" <?php if(@$data['country'] == @$con['id']) echo "selected"; ?>>{{ @$con['country_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group">
                        <select name="city" id="city" disabled autocomplete="off">
                            <option value="">--Select City--</option>
                        </select>
                    </div>
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group">
                        <input type="radio" id="test1" name="is_professional" value="1">
                        <label for="test1">I certify that I am an experienced fundraiser or investor</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" id="test2" name="is_professional" value="0">
                        <label for="test2">I’m not an experienced fundraiser or investor</label>
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
                                <p>I have read, understand, and agree to the Legal Information in the <a target="_blank" href="{{ url('User/terms-of-use') }}">Terms of Use.</a></p>
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
                                <p>I confirm that the information I have provided is accurate.</p>
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
                                <p>I give permission to LondCap's team to verify my professional status.</p>
                            </div>
                        </div>
                    </form-group>
                    
                    <hr style="border-top: 2px dotted #eee;">
                    <div class="form-group">
                        <button type="submit" id="second" class="btn btn-primary">Update & Continue</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
    <script src="{{ url('js/jquery.validate.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.widget( "custom.combobox", {
                _create: function() {
                    this.wrapper = $( "<span>" )
                    .addClass( "custom-combobox" )
                    .insertAfter( this.element );
            
                    this.element.hide();
                    this._createAutocomplete();
                    this._createShowAllButton();
                },
            
                _createAutocomplete: function() {
                    var selected = this.element.children( ":selected" ),
                    value = selected.val() ? selected.text() : "";
            
                    this.input = $( "<input>" )
                    .appendTo( this.wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .attr("placeholder", "Enter " + this.element.attr("name"))
                    .attr("data-id", this.element.attr("id"))
                    .attr("name", this.element.attr("name"))
                    .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        autoFocus: true,
                        source: $.proxy( this, "_source" ),
                        select: function( event, ui ) {
                            // Selected an item, nothing to do
                            var $option = ui.item.option;
                            var select_id = event.currentTarget.getAttribute("data-id");

                            getAssociatedCities($option, select_id);
                        }
                    })
                    .tooltip({
                        classes: {
                        "ui-tooltip": "ui-state-highlight"
                        }
                    });
            
                    this._on( this.input, {
                    autocompleteselect: function( event, ui ) {
                        ui.item.option.selected = true;
                        this._trigger( "select", event, {
                        item: ui.item.option
                        });
                    },
            
                    autocompletechange: "_removeIfInvalid"
                    });
                },
            
                _createShowAllButton: function() {
                    var input = this.input,
                    wasOpen = false;
            
                    $( "<a>" )
                    .attr( "tabIndex", -1 )
                    .attr( "title", "Show All Items" )
                    .tooltip()
                    .appendTo( this.wrapper )
                    .button({
                        icons: {
                        primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass( "ui-corner-all" )
                    .addClass( "custom-combobox-toggle ui-corner-right" )
                    .on( "mousedown", function() {
                        wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                    })
                    .on( "click", function() {
                        input.trigger( "focus" );
            
                        // Close if already visible
                        if ( wasOpen ) {
                        return;
                        }
            
                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete( "search", "" );
                    });
                },
            
                _source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                    response( this.element.children( "option" ).map(function() {
                    var text = $( this ).text();
                    if ( this.value && ( !request.term || matcher.test(text) ) )
                        return {
                        label: text,
                        value: text,
                        option: this
                        };
                    }) );
                },
            
                _removeIfInvalid: function( event, ui ) {
                    if ( ui.item ) {
                        return;
                    }
            
                    // Search for a match (case-insensitive)
                    var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                    this.element.children( "option" ).each(function() {
                    if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                        this.selected = valid = true;
                        return false;
                    }
                    });
            
                    // Found a match, nothing to do
                    if ( valid ) {
                        return;
                    }
            
                    // Remove invalid value
                    this.input
                    .val( "" )
                    .attr( "title", value + " didn't match any item" )
                    .tooltip( "open" );
                    this.element.val( "" );
                    this._delay(function() {
                    this.input.tooltip( "close" ).attr( "title", "" );
                    }, 2500 );
                    this.input.autocomplete( "instance" ).term = "";
                },
            
                _destroy: function() {
                    this.wrapper.remove();
                    this.element.show();
                }

            });
            
            $("#country").combobox();

            function getAssociatedCities($option, select_id) {
                if (select_id != "country") {
                    return;
                }

                var country_id = $option.value;

                $.ajax({
                    method:"POST",
                    url: "{{ url('User/getcityList')}}",
                    data:{
                        "_token": "{{csrf_token()}}",
                        cid: country_id
                    },
                    success:function(response) {
                        var appenddata;
                        var data = JSON.parse(response);

                        $.each(data, function (key, value) {
                            appenddata += "<option value = '" + value.id + "'>" + value.city_name + "</option>";                        
                        });

                        $('#city').prop("disabled", false).html(appenddata);

                        $('[data-id=city]').val('');
                    }
                });
            }

            $("#city").combobox();
           
            $(".error-note").hide();
               $("#confirm-signup").validate({
                    rules: {  
                        country: {required:true},
                        is_professional: {required:true},
                        age:{required:true},
                        termsuse:{required:true},
                        responsiblity:{required:true},
                        accredited:{required:true},
                    },
                    errorPlacement: function(error, element) {
                        if (element.attr('name') == "age") {
                            $(".error-note").append('Please confirm that you over 18 years old.<br>');
                        } else if (element.attr("name") == "termsuse") {
                            $(".error-note").append('Please accept the terms of use.<br>');

                        } else if (element.attr("name") == "Investment") {
                            $(".error-note").append('Accept Investment risk.<br>');

                        } else if (element.attr("name") == "responsiblity") {
                            $(".error-note").append('Please confirm that the information you have provided is accurate.<br>');

                        } else if (element.attr("name") == "accredited") {
                            $(".error-note").append('Please confirm that you allow LondCap to verify your professional status.<br>');

                        } else if (element.attr('name') == "is_professional") {
                            $(".error-note").append('Please select whether you are an experienced fundraiser/investor.<br>');
                        } else if (element.attr('name') == "country") {
                            $(".error-note").append('Please enter your country.<br>');
                        } else {
                            error.insertAfter(element);
                        }
                    },
                submitHandler: function() {
                    $("#confirm-signup").submit();
                }
           });

            $("#second").on('click',function(e){
                $(".error-note").html('');
                e.preventDefault();

                if ($("#confirm-signup").valid()) {
                    $.ajax({
                        method:"POST",
                        url:"{{ url('User/successSignup') }}",
                        data:$("#confirm-signup").serialize(),
                        success:function(data){
                            if (data.msg=='Success') {
                                location.href="{{ url('User/emailnotverified') }}";
                            }
                        }
                    });
                }else{
                    $(".error-note").show();
                    $(window).scrollTop($("#confirm-signup .error-note").first().offset().top);
                }
            });

            $("#location").autocomplete({
                source: "{{ url('User/findCityList') }}",
                minLength: 2,
                scroll: true
            });

        });
    </script>
   @endsection
