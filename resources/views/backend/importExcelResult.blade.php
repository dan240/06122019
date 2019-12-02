@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="jumbotron mt-4 bg-white">
        <h1 class="display-4 mb-4">Import Data Results</h1>

        @isset($results["success"])
            <div class="alert alert-success" role="alert">
                {{ $results["success"] }}
            </div>
        @endisset

        @isset($results["error"])
        <div class="alert alert-danger" role="alert">
        {{ $results["error"] }}
        </div>
        @endisset

        <div class="mt-4">
            <a class="btn btn-primary" href="{{ url('Admin/importExcelForm') }}" role="button">Back To Import Data</a>
        </div>
        
    </div>
</div>	
@endsection