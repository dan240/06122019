@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Add City</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/viewCity')}}">View Investor Type</a>
        </div>
     	</div>
     	{{Form::open(['method'=>'post','class'=>'AddCity'])}}
	     	<div class="company-info">
	     			<div class="col-md-12 err-message"></div>
				<div class="row">
		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="fname">Company Name</label>
						<select name="country_id" id="country_id">
							<option value="">---Select Country---</option>
							@foreach($data as $country)
							<option value="{{$country['id']}}">{{$country['country_name']}}</option>
							@endforeach
						</select>
		          	</div>
		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="fname">City Name</label>
						<input type="text" id="city_name" name="city_name">
		          	</div>		          	
		            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="status">Status</label>
						<select name="status" id="status">
							<option value=''>---Select Status---</option>
							<option value='1'>ACTIVE</option>
							<option value='2'>INACTIVE</option>
						</select>
		          	</div>
				</div>
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<a class="btn btn-primary" id="save" href="javascript:;" style="margin:20px 0px">Save</a>
					</div>
				</div>
			</div>
		{{Form::close()}}
	</div>
<script>
	$(document).ready(function(){
		$(".err-message").hide();
               $(".AddCity").validate({
               	errorClass: "my-error-class",
                validClass: "my-valid-class",
                  rules: {
                        typeInvestor: {required:true},
                        status: {required:true},
                    },
                    
                    messages: {
                        typeInvestor:'City should not be empty!',
                        status: 'Status should not be empty',
                    },
                submitHandler: function() {
                    $(".AddCity").submit();
                }
           });
		$("#save").on('click',function(e){
			if($(".AddCity").valid()){
				e.preventDefault();
				$.ajax({
					method:"POST",
					url:"{{ url('Admin/AddCity')}}",
					data:$('.AddCity').serialize(),
					success:function(response)
					{
						if(response.msg=='success')
						{
							$('.err-message').html('<div class="alert alert-success">City added successfully</div>');
							$(".err-message").show();
						}else{
							$('.err-message').html('<div class="alert alert-danger">'+response.msg+'</div>');
							$(".err-message").show();
						}
					}
				});
			}
		})
	})	
</script>
@endsection