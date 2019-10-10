@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Excel Data Export</span>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="{{ url('Admin/importExcelForm')}}">Click to Import Data</a>
        </div>
    </div>
    <div class="err-msg col-md-12"></div>
    <div class="col-md-12">
 			<a href="{{ url('Admin/downloadExcelUser/xls') }}"><button class="btn btn-success">Download User Excel xls</button></a>
            <!-- <a href="{{ url('Admin/downloadExcelUser/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('Admin/downloadExcelUser/csv') }}"><button class="btn btn-success">Download CSV</button></a> -->
            <!-- <a href="{{ url('Admin/downloadExcelUserCompany/xls') }}"><button class="btn btn-success">Download User Company Excel xls</button></a> -->
            <!-- <a href="{{ url('Admin/downloadExcelUserCompany/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('Admin/downloadExcelUserCompany/csv') }}"><button class="btn btn-success">Download CSV</button></a> -->
            <!-- <a href="{{ url('Admin/downloadExcelUserInvestor/xls') }}"><button class="btn btn-success">Download User Investor Excel xls</button></a> -->
            <!-- <a href="{{ url('Admin/downloadExcelUserInvestor/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('Admin/downloadExcelUserInvestor/csv') }}"><button class="btn btn-success">Download CSV</button></a> -->
    </div>


 @endsection