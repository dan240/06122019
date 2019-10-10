@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Fund Goal Value Info</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <!-- <a class="btn btn-primary" href="{{ url('Admin/viewCompanyType')}}">View Company Type</a> -->
        </div>
     	</div>
     	<div class="error-msg"></div>
     	{{Form::open(['method'=>'post','class'=>'saveFundGoal'])}}
     	<div class="company-info">
			<div class="row">
	          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">Minimum Value</label>
					<input type="text" id="minValue" name="minValue" value="{{@$data['minValue']}}">
				</div>
	          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">Maximum Value</label>
					<input type="text" id="maxValue" name="maxValue" value="{{@$data['maxValue']}}">
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
		$('#save').on('click',function(){
			$.ajax({
				method:"POST",
				url:"{{ url('Admin/SaveFundGoal')}}",
				data:$('.saveFundGoal').serialize(),
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