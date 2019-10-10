@extends('layouts.admin')
@section('content')
<section class="inner-pages">
    <div class="container">
    	<div class="row" style="padding:10px;">
	        <div class="col-md-6">
	          <span style="font-size: 20px;">Contact Query</span>
	        </div>
	        <div class="col-md-6 text-right">
	          <a class="btn btn-primary" href="{{ url('Admin/contactus')}}">Go Back</a>
	        </div>
     	</div>
        <table class="table table-bordered" id="myTable">
			<tbody>
				<tr>
					<th>Enquiry Date</th>
					<td>{{ date('m-d-Y H:i:s' , strtotime(@$data['created_at'])) }}</td>
				</tr>
				<tr>
					<th>Full Name</th>
					<td>{{ @$data['fname'] }} {{ @$data['lname'] }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ @$data['email'] }}</td>
				</tr>

				<tr>
					<th>Phone</th>
					<td>{{ @$data['phone'] }}</td>
				</tr>

				<tr>
					<th>Address</th>
					<td>{{ @$data['address'] }}</td>
				</tr>

				<tr>
					<th>Message Query</th>
					<td>{{ @$data['text'] }}</td>
				</tr>
			</tbody>
		</table>
    </div>
</section>
@endsection