@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Excel Data Import</span>
           
        </div>

        <div class="col-md-6 text-right">
            <a class="btn btn-link" href="{{ url('Admin/importExport')}}">Go to Export Data</a>
        </div>
    </div>
    <div class="err-msg col-md-12"></div>
    <div class="col-md-12">
        {{Form::open(['method'=>'post','action'=>'AdminController@importExcel','enctype'=>"multipart/form-data"])}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="file" name="import" id="import_file">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" name="upload" id="upload_btn" value="UPLOAD" class="btn btn-primary" disabled>
                </div>
            </div>
        {{Form::close()}}

        @if(Session::has("excel_resp"))
            <?php 
                $data = Session::get("excel_resp");

                if($data['error'] == 'error'){
                    print_r('<div class="alert alert-danger">'.$data['msg'].'</div>');
                }else{
                    echo  '<div class="alert alert-success">Excel is imported successfully</div>';
                }
            ?>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $("#import_file").change(function () {
                $("#upload_btn").prop("disabled", false);
            });
        });    
    </script>

 @endsection