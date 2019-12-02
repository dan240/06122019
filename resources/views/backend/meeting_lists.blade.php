@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Users Meeting Requests</span>
        </div>
        <div class="col-md-3 text-right">
          <a class="btn btn-primary" id="createMeeting" href="javascript:;">Create Meetings</a>
        </div>
        <div class="col-md-3 text-right">
          <a class="btn btn-primary" id="approvemeetings" href="javascript:;">Approve all meetings</a>
        </div>
     	</div>
     	<div class="dis-msg col-md-12"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
            <tr>
				<th>#</th>
				<th>Sender Name</th>
				<th>Receiver Name</th>
				<th>Messages</th>
				<th>Data type</th>
				<th>Meeting Details</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </thead>
		<tbody>
				<?php $i=1;  ?>
			@foreach($data as $row)
			<tr>
				<td>{{ $i }}</td>
				<td>{{ @$row['sender']['firstname'] }} {{ @$row['sender']['lastname'] }}</td>
				<td>{{ @$row['reciever']['firstname'] }} {{ @$row['reciever']['lastname'] }}</td>
				<td>{{ wordwrap( @$row['message'], 50, " ", true) }}</td>
				<?php if(@$row['type']=='1'){?>
					<td>Request Meeting</td>
				<?php } else {?>
					<td>Message</td>
				<?php } ?>
				<td>
					<?php if(@$row['type']=='1'){
						if($row['meeting_at'] == '1'){
							echo "<b>Type : </b>Meet During Conference";
						}else if($row['meeting_at'] == '2'){
							echo "<b>Type : </b>Conference Call";
						}else if($row['meeting_at'] == '3'){
							echo "<b>Type : </b>Meet in Investors Office";
						}else if($row['meeting_at'] == '4'){
							echo "<b>Type : </b>Meet in Fundraiser Office";
						}

						echo '<br><b>Reserve Amount : </b>'.$row['reserve_amount'];

					} ?>
				</td>
				<td id="status_{{$row['id']}}">
					<?php if(@$row['status']=='1'){?>
						<h4><span class="badge badge-success">Active</span></h4>
					<?php } elseif(@$row['status']=='2'){ ?>
						<h4><span class="badge badge-danger">Inactive</span></h4>
					<?php } else if(@$row['status']=='3'){ ?>
						Pending
					<?php } ?>
				</td>
				<td>{{ @$row['created_at']}}</td>
				<td>
					<span id="show_inactive_btn_{{$row['id']}}" style="@if(@$row['status']=='1') display:block; @else display: none; @endif">
						<a class="btn btn-info btn-sm" data-original-title="Unapprove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="InactiveMeeting('{{$row['id']}}',this)"> 
                  			<i class="fa fa-ban"></i> 
                		</a>
                	</span>
					<span id="show_active_btn_{{$row['id']}}"  style="@if(@$row['status']=='2') display:block; @else display: none; @endif">
						<a class="btn btn-info btn-sm" data-original-title="Approve" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="ApprovedMeeting('{{$row['id']}}',this)"> 
                  			<i class="fa fa-check"></i> 
                		</a>
                	</span>
            	</td>
			</tr>
			<?php $i++;  ?>
			@endforeach
		</tbody>
		<tfoot>
            <tr>
               	<th>#</th>
				<th>Sender Name</th>
				<th>Receiver Name</th>
				<th>Messages</th>
				<th>Status</th>
				<th>Created_At</th>
				<th>Action</th>
            </tr>
        </tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
		$(".dis-msg").hide();
    	$('#example').DataTable();
    	$('#approvemeetings').on('click',function(){
    		$.ajax({
    			method:"post",
    			url:"{{ url('Admin/approveAllMeetings')}}",
    			data:{"_token":"{{csrf_token()}}"},
    			success:function(response)
    			{
    				if(response.msg=='success')
    				{
    					$(".dis-msg").html('<div class="alert alert-success">All meetings approved successfully</div>');
    					$(".dis-msg").show();
    				}else{
    					$(".dis-msg").html('<div class="alert alert-danger">Meetings not approved</div>');
    					$(".dis-msg").show();    					
    				}
    			}
    		})
    	});

    	$("#createMeeting").click(function(){
    		window.location.href = "{{ url('Admin/CreateMessage')}}"
    	});

	});
	function InactiveMeeting(id,obj)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/InactiveMeeting')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
    				{
    					$(".dis-msg").html('<div class="alert alert-success">Meeting set to Inactive successfully</div>');
    					$(".dis-msg").show();
    					
    					$('#status_'+id).html('<h4><span class="badge badge-danger">Inactive</span></h4>');
    					$('#show_active_btn_'+id).show();
    					$('#show_inactive_btn_'+id).hide();
    				}else{
    					$(".dis-msg").html('<div class="alert alert-danger">Meeting already inactive</div>');
    					$(".dis-msg").show();    					
    				}
			}
		})
	}
	function ApprovedMeeting(id,obj) {
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/ApprovedMeeting')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response) {
				if (response.msg=='success') {
					$(".dis-msg").html('<div class="alert alert-success">Meeting approved successfully.</div>');
					$(".dis-msg").show();
					$('#status_'+id).html('<h4><span class="badge badge-success">Active</span></h4>');
					$('#show_active_btn_'+id).hide();
					$('#show_inactive_btn_'+id).show();
				} else {
					$(".dis-msg").html('<div class="alert alert-danger">Meeting already approved</div>');
					$(".dis-msg").show();    					
				}
			}
		})
	}
</script>
@endsection