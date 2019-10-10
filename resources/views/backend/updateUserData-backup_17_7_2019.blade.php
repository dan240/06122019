@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">User Info</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/User')}}">User List</a>
        </div>
     	</div>
     	<div class="error-msg col-md-12"></div>
     	{{Form::open(['method'=>'post','class'=>'updateUserData'])}}
     	<div class="company-info">
			<div class="row">
	          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">First Name</label>
	          		<input type="text" id="firstname" name="firstname" value="{{@$data['firstname']}}">
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="cname">Last Name</label>
					<input type="text" id="lastname" name="lastname" value="{{@$data['lastname']}}">
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="cname">Email</label>
					<input type="text" id="email" name="email" value="{{@$data['email']}}">
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="cname">Location</label>
					<input type="text" id="location" name="location" value="{{@$data['location']}}">
				</div>
				<input type="hidden" name="id" value="{{@$data['id']}}">
			</div>
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<a class="btn btn-primary" href="javascript:;" id="save" style="margin:20px 0px">Save</a>
				</div>
			</div>
		</div>
	{{Form::close()}}
</div>
<script>
	$(document).ready(function(){
		$('.error-msg').hide();
		$('#save').on('click',function(e){
			e.preventDefault();
			$.ajax({
				method:"POST",
				url:"{{ url('Admin/SaveUser')}}",
				data:$('.updateUserData').serialize(),
				success:function(response)
				{
					if(response.msg=='success')
					{
						$('.error-msg').html('<div class="alert alert-success">Data updated successfully.</div>');
						$('.error-msg').show();
					}else{
						$('.error-msg').html('<div class="alert alert-danger">Data not updated.</div>');
						$('.error-msg').show();
					}
				}
			})
		})
	})
	</script>
@endsection