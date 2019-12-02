@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
        	<span style="font-size: 20px;">Country Info</span>
        </div>
        <div class="col-md-6 text-right">
        	<a class="btn btn-link" href="{{ url('Admin/viewCountry')}}">&lsaquo; Back to Countries</a>
        </div>
    </div>
     	<div class="error-msg"></div>
     	{{Form::open(['method'=>'post','class'=>'saveCountry'])}}
		<input type="hidden" name="id" value="{{@$data['id']}}">
     	<div class="company-info">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">Region</label>
					<select id="region_id" name="region_id">
						@foreach($regions as $region)
							<option value="{{$region['id']}}" <?php if($region['id']==$data['region_id']) echo "selected";?>>{{$region['regionName']}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-4">
	          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">Company Name</label>
					<input type="text" id="country_name" name="country_name" value="{{@$data['country_name']}}">
				</div>
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
		$('#save').on('click',function(e){
			e.preventDefault();
			$.ajax({
				method:"POST",
				url:"{{ url('Admin/SaveCountry')}}",
				data:$('.saveCountry').serialize(),
				success:function(response)
				{
					if(response.msg=='success')
					{
						$('.error-msg').html('<div class="alert alert-success">Data updated successfully.</div>');
					}else{
						$('.error-msg').html('<div class="alert alert-danger">Data not updated.</div>')
					}
				}
			})
		})
	})
	</script>
@endsection