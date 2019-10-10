@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Company Campaigns List</span>
        </div>
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="{{ url('Admin/AddCompanyCampaignForm')}}">Add Company Campaign</a>
        </div>
     	</div>
     <div class="err-msg"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
            <tr>
				<th>#</th>
				<th>Campaign Name</th>
				<th>Created_At</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
        </thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data as $row) { ?>
			<tr>
				<td>{{ $i }}</td>
				<td>{{ @$row['companyName'] }}</td>
				<td>{{ @$row['created_at'] }}</td>
				<?php if(@$row['status']=='1') { ?>
				<td>Active</td>
				<?php } elseif(@$row['status']=='2') {?>
				<td>Inactive</td>
				<?php } ?>
				<td>
					<?php $id=base64_encode($row['id']); if(@$row['status']=='1'){?>
						<a class="btn btn-danger btn-xs" data-original-title="Suspend" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="SuspendCompanyCampaign('{{$id}}')"> 
                  		<i class="fa fa-ban"></i>
	                	</a>
	            	<?php } elseif(@$row['status']=='2'){?>
	                	<a class="btn btn-success btn-xs" data-original-title="Active" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="ActivateCompanyCampaign('{{$id}}')"> 
	                  	<i class="fa fa-check"></i>
	                	</a>
	                <?php } ?>
					<a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="DeleteCompanyCampaign('{{$id}}')"> 
                  	<i class="fa fa-times-circle-o"></i>
	                </a>
	                <a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="EditCompanyCampaign('{{$id}}')"> 
	                  <i class="fa fa-edit"></i> 
	                </a>
	           </td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
            <tr>
                <th>#</th>
				<th>Campaign Name</th>
				<th>Created_At</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
        </tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
	function DeleteCompanyCampaign(id)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/DeleteCompanyCampaign')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.err-msg').html('<div class="alert alert-success">Campaign removed successfully.</div>');
				}else{
					$('.err-msg').html('<div class="alert alert-danger">Campaign not removed .</div>')
				}
			}
		})

	}
	function EditCompanyCampaign(id)
	{
		window.location.href="{{ url('Admin/EditCompanyCampaign/') }}/"+id;
	}
	function SuspendCompanyCampaign(id)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/SuspendCompanyCampaign')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.err-msg').html('<div class="alert alert-success">Campaign suspended successfully.</div>');
				}else{
					$('.err-msg').html('<div class="alert alert-danger">Campaign not suspended .</div>')
				}
			}
		})

	}
	function ActivateCompanyCampaign(id)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/ActivateCompanyCampaign')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.err-msg').html('<div class="alert alert-success">Campaign activated successfully.</div>');
				}else{
					$('.err-msg').html('<div class="alert alert-danger">Campaign not activated .</div>')
				}
			}
		})

	}
	</script>
@endsection