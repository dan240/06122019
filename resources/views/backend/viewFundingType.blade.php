@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Users List</span>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/AddFundingTypeForm')}}">Add Funding Type</a>
        </div>
     	</div>
     <div class="err-msg"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
            <tr>
				<th>#</th>
				<th>Type Funding</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data as $row) { ?>
			<tr>
				<td>{{ $i }}</td>
				<td>{{ @$row['typeFunding'] }}</td>
				<?php if(@$row['status']=='1') { ?>
				<td>Active</td>
				<?php } ?>
				<td>{{ @$row['created_at'] }}</td>
				<td>
					<?php $id=base64_encode($row['id']);?>
					<a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="DeleteFundingType('{{$id}}')"> 
                  <i class="fa fa-times-circle-o"></i>
                </a>
                <a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="EditFundingType('{{$id}}')"> 
                  <i class="fa fa-edit"></i> 
                </a>
	           </td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
            <tr>
               	<th>#</th>
				<th>Type Funding</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
	function DeleteFundingType(id)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/DeleteFundingType')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.err-msg').html('<div class="alert alert-success">Funding type removed successfully.</div>');
				}else{
					$('.err-msg').html('<div class="alert alert-danger">Funding type not removed .</div>')
				}
			}
		})

	}
	function EditFundingType(id)
	{
		window.location.href="{{ url('Admin/EditFundingType/') }}/"+id;
	}
	
	</script>
@endsection