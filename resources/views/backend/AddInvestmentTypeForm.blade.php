@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Add Investment Type</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/viewInvestmentType')}}">View Investment Type</a>
        </div>
     	</div>
     	{{Form::open(['method'=>'post','class'=>'AddInvestmentType'])}}
	     	<div class="company-info">
	     			<div class="col-md-12 err-message"></div>
				<div class="row">
		          	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
		          		<label for="fname">Investment Type Name</label>
						<input type="text" id="typeInvestment" name="typeInvestment">
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
               $(".AddInvestmentType").validate({
               	errorClass: "my-error-class",
                validClass: "my-valid-class",
                  rules: {
                        typeInvestor: {required:true},
                        status: {required:true},
                    },
                    
                    messages: {
                        typeInvestor:'Investment type should not be empty!',
                        status: 'Status should not be empty',
                    },
                submitHandler: function() {
                    $(".AddInvestmentType").submit();
                }
           });
		$("#save").on('click',function(e){
			if($(".AddInvestmentType").valid()){
				e.preventDefault();
				$.ajax({
					method:"POST",
					url:"{{ url('Admin/AddInvestmentType')}}",
					data:$('.AddInvestmentType').serialize(),
					success:function(response)
					{
						if(response.msg=='success')
						{
							$('.err-message').html('<div class="alert alert-success">Investment Type added successfully</div>');
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