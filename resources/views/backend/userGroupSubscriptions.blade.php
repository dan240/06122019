@extends('layouts.admin')
@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<style type="text/css">
	td.action {
	    width: 100px;
	}
</style>

<div class="container-fluid">
	<div class="row" style="padding:10px;">
		<div class="col-md-6">
			<span style="font-size: 20px;">User Group Subscriptions</span>
		</div>
	</div>
	<div class="error-msg"></div>
	
	<div class="row">
		<div class="col-sm-12">
			<form class="form-group">
				

				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Group</label>
							<select id="select_group" class="form-control">
								<option value="0" selected disabled>-- Select Group --</option>
								<option value="1">Company - Professional</option>}
								<option value="2">Company - Non Professional</option>}
								<option value="3">Investor - Professional</option>}
								<option value="4">Investor - Non Professional</option>}
								option
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<label>Date</label>
						<input type="text" id="select_date" class="form-control datepicker" >
					</div>
					<div class="col-sm-4">
						<label>&nbsp;</label>
						<input type="submit" id="submit" class="btn btn-primary btn-block">
					</div>
				</div>


			</form>
		</div>
	</div>

</div>
<script>
	$('#submit').click(function(event){
		 event.preventDefault();
		var group = $('#select_group').val();
		var date = $('#select_date').val();
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/updateGroupSubscriptions')}}",
			data:{"_token":"{{ csrf_token()}}","group":group,"date" : date},
			success:function(response){
				$(".se-pre-con").fadeOut("slow");
				console.log(response);
				//var response = JSON.parse(response);

				if(response.status=='success') {
					$('.error-msg').html('<div class="alert alert-success"><i class="fa fa-check"></i> '+response.msg+'</div>');
				}else{
					$('.error-msg').html('<div class="alert alert-danger"><i class="fa fa-close"></i> '+response.msg+'</div>');
				}
			}
		});
	});
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayHighlight : true,
		todayBtn : true
	});
</script>
@endsection