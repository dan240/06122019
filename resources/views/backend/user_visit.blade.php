@extends('layouts.admin')
@section('content')
<style type="text/css">
	td.action {
	    width: 100px;
	}
</style>
<div class="container-fluid">
	<div class="row" style="padding:10px;">
		<div class="col-md-6">
			<span style="font-size: 20px;">Contact Us Messages</span>
		</div>
	</div>
	<div class="error-msg"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Visitor</th>
				<th>Profile Visit</th>
				<th>Url Visit</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($visits as $visit) { ?>
			<tr>
				<td>{{ $i }}</td>
				<td>{{ @$visit['user']['firstname'].' '.@$visit['user']['lastname'] }} @if(@$visit['user']['usertype'] == '1') - Company @else - Investor @endif <br> {{ @$visit['user']['email'] }}</td>
				<td>
					@if(!empty($visit['investor_detail']))
						{{ @$visit['investor_detail']['firstname'].' '.@$visit['investor_detail']['lastname'] }} <br> {{ @$visit['investor_detail']['email'] }}
					@else
						{{ @$visit['company_detail']['fname'].' '.@$visit['company_detail']['lname'] }} <br> {{ @$visit['company_detail']['email'] }}
					@endif
				</td>
				
				<td>
					
					<a href="{{ $visit['visit_url'] }}" target="_blank">{{ $visit['visit_url'] }}</a>
				</td>
				<td>
					{{ date('d-m-Y',strtotime($visit['created_at'])) }}
				</td>
				
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
		<tr>
			<th>#</th>
			<th>Name</th>
			
		</tr>
		</tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});
	function deleteContactMessage(id)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/deleteContactMessage')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.error-msg').html('<div class="alert alert-success">Message deleted successfully.</div>');
				}else{
					$('.error-msg').html('<div class="alert alert-danger">Message not deleted .</div>');
				}
			}
		})
		//window.location.href="{{ url('Admin/InactiveUser/') }}/"+id;
	}
	function viewContactMessage(id){
		window.location.href = "{{ url('Admin/viewContactMessage')}}/"+id;
	}
	
</script>
@endsection