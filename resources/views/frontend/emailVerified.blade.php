@extends('layouts.home')
@section('content')
<style type="text/css">
  .padding{
    padding: 100px ; 
  }
</style>
    <section class="inner_pages">
        <div class="container">
            <div class="row">
                <div class="col col-12 text-center padding">
                   <h3>Your email has successfully verified. Please login to your account.</h3>
                   <div class="text-center">
                       <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Login</button>
                   </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection