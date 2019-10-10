@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Company Type Info</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/viewCompanyType')}}">View Company Type</a>
        </div>
     	</div>
     	<div class="error-msg"></div>
     	{{Form::open(['method'=>'post','class'=>'saveCompanyType'])}}
     	<div class="company-info">
			<div class="row">
	          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
	          		<label for="fname">Company Type</label>
					<input type="text" id="companytype" name="companytype" value="{{@$data['typeCompanies']}}">
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
				url:"{{ url('Admin/SaveCompanyType')}}",
				data:$('.saveCompanyType').serialize(),
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