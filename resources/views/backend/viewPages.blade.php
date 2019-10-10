@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Static Pages</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <!-- <a class="btn btn-primary" href="{{ url('Admin/viewCompanyType')}}">List Of Pages</a> -->
        </div>
        </div>
        <div class="error-msg"></div>
        {{Form::open(['method'=>'post','class'=>'StaticPageslist'])}}
        <div class="company-info">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                    <label for="fname">Page Name</label>
                    <select name="pageId" id="pageId">
                        <option value="">---Select Page---</option>
                        @foreach($data as $page)
                        <option value="{{base64_encode($page['id'])}}">{{$page['page_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <a class="btn btn-primary" href="javascript:;" id="save" style="margin:20px 0px">Edit</a>
                </div>
            </div>
        </div>
    {{Form::close()}}
</div>
<script>
    $(document).ready(function(){
        $('#save').on('click',function(){
            var id=$("#pageId").val();
            window.location.href="{{ url('Admin/StaticPageData/') }}/"+id;
        })
    })
    </script>
@endsection