@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Add Static Page</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/StaticPages')}}">View Static Pages</a>
        </div>
     	</div>
     	{{Form::open(['method'=>'post','class'=>'AddStaticPages'])}}
	     	<div class="company-info">
	     		<div class="col-md-12 err-message"></div>
				<div class="row">
		          	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		          		<label for="fname">Page Name</label>
						<input type="text" id="page_name" name="page_name">
		          	</div>
		          	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		          		<label for="fname">Page Content</label>
						 <textarea name="editor1"></textarea>
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
	<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor1' );
	$(document).ready(function(){
		$(".err-message").hide();
               $(".AddStaticPages").validate({
               	errorClass: "my-error-class",
                validClass: "my-valid-class",
                  rules: {
                        page_name: {required:true},
                        page_content: {required:true},
                    },
                    
                    messages: {
                        page_name:'Page name should not be empty!',
                        page_content: 'Page content should not be empty',
                    },
                submitHandler: function() {
                    $(".AddStaticPages").submit();
                }
           });
		$("#save").on('click',function(e){
			if($(".AddStaticPages").valid()){
				debugger;
				e.preventDefault();
				$.ajax({
					method:"POST",
					url:"{{ url('Admin/AddStaticPageData')}}",
					data:$('.AddStaticPages').serialize(),
					success:function(response)
					{
						if(response.msg=='success')
						{
							$('.err-message').html('<div class="alert alert-success">Page added successfully</div>');
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