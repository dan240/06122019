@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Update Subscription Data</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/userTrail')}}">View Management</a>
        </div>
     	</div>
     	{{Form::open(['method'=>'post','class'=>'updateSubscriptionDate'])}}
	     	<div class="company-info">
	     			<div class="col-md-12 err-message"></div>
				<div class="row">
		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="fname">First Name</label>
		          		<input type="hidden" value="{{@$data['id']}}" name="id" >
						<input type="text" id="firstname" name="firstname" value="{{@$data['firstname']}}" readonly>
		          	</div>
		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="fname">Last Name</label>
						<input type="text" value="{{@$data['lastname']}}" name="lastname" readonly>
		          	</div>		          	
		            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="status">Status</label>
						<input type="text" value="{{@$data['email']}}" name="email" readonly>
		          	</div>

		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="status">Subscription</label>
		          		<select name="subscription_plan" class="form-control">
		          			<option value="0" disabled>Please Select</option>
		          			<option value="trial" @if($data['subscription_plan'] == 'trial') selected @endif>Trial</option>
		          			<option value="unlimited" @if($data['subscription_plan'] == 'unlimited') selected @endif>Unlimited</option>
		          			
		          		</select>
		          	</div>

		           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="status">Subscription Date</label>
						<input type="text" value="{{@$data['activation']}}" name="activation" >
		          	</div>
		          	<!--  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="status">Message Restriction</label>
		          		<select name="message_restraction" class="form-control">
		          			<option value="0" disabled>Please Select</option>
		          			<option value="yes" @if($data['message_restriction'] == 'yes') selected @endif>Yes</option>
		          			<option value="no" @if($data['message_restriction'] == 'no') selected @endif>No</option>
		          			
		          		</select>
		          	</div> -->
				</div>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<a class="btn btn-primary" id="save" href="javascript:;" style="margin:20px 0px">Save</a>
					</div>
				</div>
			</div>
		{{Form::close()}}
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<script>
	$(document).ready(function(){
		var date_input=$('input[name="activation"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

		$(".err-message").hide();
               $(".updateSubscriptionDate").validate({
                  rules: {
                        activation: {required:true},
                    },
                    
                    messages: {
                        activation:'Subscription date should not be empty!',
                    },
                submitHandler: function() {
                    $(".updateSubscriptionDate").submit();
                }
           });
		$("#save").on('click',function(e){
			if($(".updateSubscriptionDate").valid()){
				e.preventDefault();
				$.ajax({
					method:"POST",
					url:"{{ url('Admin/submitSubscriptonDate')}}",
					data:$('.updateSubscriptionDate').serialize(),
					success:function(response)
					{
						if(response.msg=='success')
						{
							$('.err-message').html('<div class="alert alert-success">Subscription date updated successfully</div>');
							$(".err-message").show();
						}else{
							$('.err-message').html('<div class="alert alert-danger">Date not updated</div>');
							$(".err-message").show();
						}
					}
				});
			}
		})
	})	
</script>
@endsection