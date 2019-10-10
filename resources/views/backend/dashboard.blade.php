@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="animated fadeIn" style="padding-top: 20px;">
    <div class="row">
      
      <div class="col-sm-6 col-lg-3">
        
          <div class="card text-white bg-primary">
            <div class="card-body pb-0">
              <div class="btn-group float-right">
                <!-- <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-settings"></i>
                </button> -->
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ url('Admin/User?u=1&t=1') }}">Professional</a>
                  <a class="dropdown-item" href="{{ url('Admin/User?u=1&t=0') }}">Non Professional</a>
                  
                </div>
              </div>
              <div class="text-value">{{ $c_user}}</div>
              <div>
                Registered User As Comapny
                
              </div>
            </div>
            <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
              <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
                <div class="text-right">
                  <a href="{{ url('Admin/User?u=1') }}" title="Registered User As Comapny" class="btn btn-success btn-sm">View</a>                  
                </div>
            </div>
          </div>
        
        
      </div>


      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
          <div class="card-body pb-0">
            <!-- <button class="btn btn-transparent p-0 float-right" type="button">
              <i class="icon-location-pin"></i>
            </button> -->
            <div class="text-value">{{ $i_user}}</div>
            <div>Registered User As Investor</div>
          </div>
          <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
            <!-- <canvas class="chart" id="card-chart2" height="70"></canvas> -->
            <div class="text-right">
              <a href="{{ url('Admin/User?u=2') }}" title="Registered User As Comapny" class="btn btn-success btn-sm">View</a>                  
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-warning">
          <div class="card-body pb-0">
            <div class="btn-group float-right">
              <!-- <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-settings"></i>
              </button> -->
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
            <div class="text-value">{{ $prof }}</div>
            <div>Professional User</div>
          </div>
          <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
            <!-- <canvas class="chart" id="card-chart3" height="70"></canvas> -->
            <div class="text-right">
              <a href="{{ url('Admin/User?t=1') }}" title="Registered User As Comapny" class="btn btn-success btn-sm">View</a>                  
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-danger">
          <div class="card-body pb-0">
            <div class="btn-group float-right">
              <!-- <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-settings"></i>
              </button> -->
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
            <div class="text-value">{{ $unprof }}</div>
            <div>Not Professional User</div>
          </div>
          <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
            <!-- <canvas class="chart" id="card-chart4" height="70"></canvas> -->
            <div class="text-right">
              <a href="{{ url('Admin/User?t=0') }}" title="Registered User As Comapny" class="btn btn-success btn-sm">View</a>                  
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-danger">
          <div class="card-body pb-0">
            <div class="btn-group float-right">
              
            </div>
            <div class="text-value">{{ $pending }}</div>
            <div>Pending Users</div>
          </div>
          <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
            <!-- <canvas class="chart" id="card-chart4" height="70"></canvas> -->
            <div class="text-right">
              <a href="{{ url('Admin/User?p=0') }}" title="Registered User As Comapny" class="btn btn-success btn-sm">View</a>                  
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->


    </div>
  </div>
</div>
@endsection