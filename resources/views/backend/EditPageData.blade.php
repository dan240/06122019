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
          <a class="btn btn-primary" href="{{ url('Admin/viewCity')}}">View Static Pages</a>
        </div>
        </div>
        {{Form::open(['method'=>'post','class'=>'SaveStaticPage'])}}
            <div class="company-info">
                <div class="col-md-12 err-message"></div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-6">
                        <label for="fname">Page Name</label>
                        <input type="text" id="page_name" name="page_name"  value="{{@$data['pageInfo']['page_name']}}">
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label for="fname">Page Content</label>
                         <textarea name="editor1">{{$data['page_content']}}</textarea>
                    </div>
                    <input type="hidden" id="id" name="id" value="{{$data['id']}}">
                    <input type="hidden" id="page_id" name="page_id" value="{{$data['page_id']}}">             
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
               $(".SaveStaticPage").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                  rules: {
                        page_name: {required:true},
                        editor1: {required:true},
                    },
                    
                    messages: {
                        page_name:'Page name should not be empty!',
                        editor1: 'Page content should not be empty',
                    },
                submitHandler: function() {
                    $(".SaveStaticPage").submit();
                }
           });
        $("#save").on('click',function(e){
            var art_body = CKEDITOR.instances.editor1.getData();
            var originalData=art_body;
            var id = $("#id").val();
            var page_id = $("#page_id").val();
            var page_name = $("#page_name").val();

            if($(".SaveStaticPage").valid()){
                e.preventDefault();
                $.ajax({
                    method:"POST",
                    url:"{{ url('Admin/SaveStaticPageData')}}",
                    data:{"_token":"{{csrf_token()}}",data:originalData,id:id,page_id : page_id, page_name : page_name},
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