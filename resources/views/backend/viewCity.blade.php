@extends('layouts.admin')
@section('content')

<div class="container-fluid bg-white">
	<div class="row" style="padding:10px;">
        <div class="col-md-4">
          <span style="font-size: 20px;">City List</span>
		</div>
		<div class="col-md-4 text-right">
            <form class="form-inline" method="get" action="{{ url('Admin/viewCity') }}">
				<div class="form-group mb-2">
					<input type="text" class="form-control" name="query" placeholder="Find City">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Search</button>
			</form>
        </div>
        <div class="col-md-4 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/AddCityForm')}}">Add City</a>
        </div>
     	</div>
	 <div class="err-msg"></div>
	 
	<table class="table table-striped" style="width:100%">
		<thead class="thead-light">
            <tr>
				<th>#</th>
				<th>City Name</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data["data"] as $row) { ?>
			<tr>
				<td>{{ $i }}</td>
				<td>{{ @$row['city_name'] }}</td>
				<?php if(@$row['status']=='1') { ?>
				<td>Active</td>
				<?php } ?>
				<td>{{ @$row['created_at'] }}</td>
				<td>
					<?php $id=base64_encode($row['id']);?>
					<a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="DeleteCity('{{$id}}')"> 
                  <i class="fa fa-times-circle-o"></i>
                </a>
                <a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="EditCity('{{$id}}')"> 
                  <i class="fa fa-edit"></i> 
                </a>
	           </td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot class="thead-light">
            <tr>
                <th>#</th>
				<th>City Name</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </tfoot>
	</table>

	<div class="row">
		<div class="col">
			Showing {{ $data['from'] }} to {{ $data['to'] }} of {{ $data['total'] }} entries
		</div>
		<div class="col">
			<nav>
				<ul class="pagination justify-content-end">
					@if ($data['current_page'] != 1)
						<li class="page-item">
							<a class="page-link" href="{{ $data['first_page_url'] }}">&laquo; First</a>
						</li>
					@endif
					@if ($data['prev_page_url'])
						<li class="page-item">
							<a class="page-link" href="{{ $data['prev_page_url'] }}">&lsaquo; Previous</a>
						</li>
					@endif
					
					@if ($data['next_page_url'])
						<li class="page-item">
							<a class="page-link" href="{{ $data['next_page_url'] }}">&rsaquo; Next</a>
						</li>
					@endif
					@if ($data['current_page'] != $data['last_page'])
						<li class="page-item">
							<a class="page-link" href="{{ $data['last_page_url'] }}">&raquo; Last</a>
						</li>
					@endif
				</ul>
			</nav>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
   
	});

	function DeleteCity(id) {
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/DeleteCity')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response) {
				if(response.msg=='success') {
					$('.err-msg').html('<div class="alert alert-success">City removed successfully.</div>');
				} else {
					$('.err-msg').html('<div class="alert alert-danger">City not removed .</div>')
				}
			}
		})

	}

	function EditCity(id) {
		window.location.href="{{ url('Admin/EditCity/') }}/"+id;
	}	
</script>
@endsection