@extends('layouts.home')
@section('content')
    <section class="inner-pages">
        <div class="container">
         	 <div class="row contact_div">
         	 	<div class="col col-12">
         	 		<div class="text-center">
		         		<h3>{{ $data['page_name'] }}</h3>
		         	</div>
		         	<div class="page_content">
		         		<?php echo $data['content']['page_content']; ?>
		         	</div>
         	 	</div>	
         	 </div>
         	
        </div>
    </section>
@endsection