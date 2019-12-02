@extends('layouts.admin')
@section('content')
<style type="text/css">
.featuredTd .featuredAction{
	margin-left:35px;cursor:pointer
}
</style>
<div class="container-fluid">
	<div class="row" style="padding:10px;">
		<div class="col-md-4">
			<span style="font-size: 20px;">Users Search Results</span>
		</div>
		<div class="col-md-4">
			<form class="form-inline" method="get" action="{{ url('Admin/findUser') }}">
				<div class="form-group mb-2">
					<input type="text" class="form-control" name="query" placeholder="Find User" value="{{ app('request')->input('query') }}">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Search</button>
			</form>
		</div>
		<div class="col-md-4 text-right">
			<a class="btn btn-link" href="{{ url('Admin/User')}}">&lsaquo; Back to All Users</a>
		</div>
	</div>

	<div class="col-md-12 alert alert-danger er-msg" style="display: none"></div>

	@if ($userData['total'] == 0)
	<div class="alert alert-info" role="alert">
		No Users were found for the search term <strong>"{{ app('request')->input('query') }}"</strong>.
	</div>
	@else
	<div class="table-responsive bg-white">
		<table class="table table-striped" style="width:100%">
			<thead class="thead-light">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>HomePage Featured</th>
					<th>Can See Email/Phone</th>
					<th>Plan</th>
					<th>Message / Meetings / Profile Seen</th>
					<th>Default Message / Meeting Approved</th>
					<th>IP</th>
					<th>Created_At</th>
					<th>Status</th>
					<th>Type</th>
					<th>Public</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach($userData['data'] as $row) { ?>
				<tr>
					<td>{{ $i }}</td>
					<td>
						{{ @$row['firstname'] }} {{ @$row['lastname'] }} 
						<?php if($row['usertype']=='1') { ?>
							<b> - Company</b>
						<?php }elseif($row['usertype']=='2') {?>
							<b> - Investor</b>
						<?php } ?>
						<br> {{ @$row['email'] }}
					</td>
					
					
					<td class="featuredTd">
					<?php if($row['usertype']=='1') {
							if(!empty($row['company_detail'])){
								if($row['company_detail']['is_featured']==1){
									echo 'Yes';
									echo '<span  class="featuredAction" data-action="0" data-type="1" data-id="'.$row['id'].'" >Hide</span>';
								}else{
									echo "No";
									echo '<span class="featuredAction" data-action="1" data-type="1"  data-id="'.$row['id'].'" >Show</span>';
								}
							}else{
								echo  'Not Applicable';
							}
						}elseif($row['usertype']=='2') {
							if(!empty($row['investor_detail'])){
								if($row['investor_detail']['is_featured']==1){
									echo 'Yes';
									echo '<span class="featuredAction" data-action="0" data-type="2"  data-id="'.$row['id'].'" >Hide</span>';
								}else{
									echo "No";
									echo '<span class="featuredAction" data-action="1" data-type="2"  data-id="'.$row['id'].'" >Show</span>';
								}
							}else{
								echo  'Not Applicable';
							}
						} ?>
					</td>
					<td>
						<?php $u_id = $row['id']; $current = $row['see_contacts']; ?>
						<span id="see_status_{{ $u_id }}"><?= ucfirst(@$row['see_contacts']) ?></span>
						
						<button class="btn btn-success btn-sm" id="chng_see_{{ $u_id }}"
							onclick='changeContactVisablity("{{ $u_id }}")' data-current="{{ $current }}">
							<i class="fa fa-repeat"></i>
						</button>
					</td>
					<td>
						{{ @ucfirst($row['subscription_plan']) }}
						<?php
							if($row['subscription_plan'] == 'trial'){
								$curr_date = date('Y-m-d');
								$date1 = strtotime($curr_date);
								$date = @$row['activation'];
								$date2 = strtotime($date);
								$days = $date2 - $date1;
								$count_days = $days / (60 * 60 * 24);
								
								if($count_days > 0){
									echo '<span class="text-success">('.$count_days.' Days Remains )</span>';
								}else if($count_days < 0){
									echo '<span class="text-danger">('.abs($count_days).' Days Exceed )</span>';
								}
							} 
							
						?>
					</td>
					<td>Send Message - {{ @$row['msg_sent'] }} <br> Meeting Request - {{ @$row['meeting_req'] }} <br> Profile Card Visits - {{ $row['visit_count'] }}</td>
					<td>
						
							
						<?php $message_meeting_approval = $row['message_meeting_approval']; ?>
						<span id="message_meeting_approval_{{ $u_id }}">
							<?php if($message_meeting_approval == 'no' ){ ?>
								Not Approved
							<?php }else{ ?>
								Approved
							<?php } ?>
						</span>

						<?php $_u_id = $row['id']; $_current_message_meeting_approval = $message_meeting_approval; ?>
						
						<button class="btn btn-success btn-sm" id="chng_message_meeting_approval_{{ $u_id }}"
							onclick='changeMessageMeetingApproval("{{ $_u_id }}")' data-current="{{ $_current_message_meeting_approval }}">
							<i class="fa fa-repeat"></i>
						</button>
					
					</td>
					<td>{{ @$row['userip'] }}</td>
					<td>{{ @$row['created_at'] }}</td>
					<?php if($row['status']==1){ ?>
						<td class="ok">ACTIVE</td>
					<?php }elseif($row['status']==3){ ?>
						<td class="notok">SUSPENDED</td>
					<?php } ?>


					<td>
						
						<?php $is_Professional = $row['is_Professional']; ?>
						<span id="prof_status_{{ $u_id }}">
							<?php if($is_Professional == '1' ){ ?>
								Professional
							<?php }else{ ?>
								Not Professional
							<?php } ?>
						</span>

						<?php $_u_id = $row['id']; $_current_prof = $is_Professional; ?>
						
						<button class="btn btn-success btn-sm" id="chng_prof_{{ $u_id }}"
							onclick='changeProfessionalStatus("{{ $_u_id }}")' data-current="{{ $_current_prof }}">
							<i class="fa fa-repeat"></i>
						</button>
					
						
					</td>


					<td>
						<?php if($row['usertype'] == '1'){
							$approve = $row['company_detail']['is_Public'];
						}else{
							$approve = $row['investor_detail']['is_Public'];
						} ?>
						<span id="public_status_{{ $u_id }}">
							<?php if($approve == '1' ){ ?>
								Public
							<?php }else{ ?>
								Not Public
							<?php } ?>
						</span>

						<?php $_u_id = $row['id']; $_userType = $row['usertype']; $_current = $approve; ?>
						
						<button class="btn btn-success btn-sm" id="chng_public_{{ $u_id }}"
							onclick='changePublicStatus("{{ $_u_id }}","{{ $_userType }}")' data-current="{{ $_current }}">
							<i class="fa fa-repeat"></i>
						</button>
					</td>
					
					<td>
					<?php if($row['status']==2 || $row['status']==3){ ?>
						<a class="btn btn-success btn-xs" data-original-title="Approve" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="ApprovedProfile('{{$row['id']}}',this)"> 
						<i class="fa fa-check"></i> 
						</a>
					<?php }elseif($row['status']==1){ ?>
						<!-- <a class="btn btn-warning btn-xs" data-original-title="Suspend" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="InactiveUser('{{$row['id']}}',this)"> 
						<i class="fa fa-times-circle-o"></i> 
						</a> -->
					<?php } ?>
						<a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="DeleteUser('{{$row['id']}}')"> 
						<i class="fa fa-ban"></i> 
						</a>
						<a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="editUser('{{$row['id']}}')"> 
						<i class="fa fa-edit"></i> 
						</a>
					</td>
				</tr>
				<?php $i++;} ?>
			</tbody>
			<tfoot class="thead-light">
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>HomePage Featured</th>
					<th>Can See Email/Phone</th>
					<th>Plan</th>
					<th>Message / Meetings / Profile Seen</th>
					<th>Default Message / Meeting Approved</th>
					<th>IP</th>
					<th>Created_At</th>
					<th>Status</th>
					<th>Type</th>
					<th>Public</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>

		<div class="container-fluid">
			<div class="row">
				<div class="col">
					Showing {{ $userData['from'] }} to {{ $userData['to'] }} of {{ $userData['total'] }} entries
				</div>
				<div class="col">
					<nav>
						<ul class="pagination justify-content-end">
							@if ($userData['current_page'] != 1)
								<li class="page-item">
									<a class="page-link" href="{{ $userData['first_page_url'] }}">&laquo; First</a>
								</li>
							@endif
							@if ($userData['prev_page_url'])
								<li class="page-item">
									<a class="page-link" href="{{ $userData['prev_page_url'] }}">&lsaquo; Previous</a>
								</li>
							@endif
							
							@if ($userData['next_page_url'])
								<li class="page-item">
									<a class="page-link" href="{{ $userData['next_page_url'] }}">&rsaquo; Next</a>
								</li>
							@endif
							@if ($userData['current_page'] != $userData['last_page'])
								<li class="page-item">
									<a class="page-link" href="{{ $userData['last_page_url'] }}">&raquo; Last</a>
								</li>
							@endif
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
<script>
	$(document).ready(function(){
		$('.er-msg').hide();
    	
		$('body').on('click','.featuredAction', function (){
			var obj = $(this);
			var action = $(this).attr('data-action'); //0: hide , 1:show
			var userId = $(this).attr('data-id');
			var UserType = $(this).attr('data-type'); //1:cpm 2: inv
			$.ajax({
				method:"POST",
				url:"{{ url('Admin/ChangeFeatured')}}",
				data:{"_token":"{{ csrf_token()}}",userId:userId, action: action, userType: UserType},
				success:function(response)
				{
					if(response.code==1)
					{
						$(obj).closest('.featuredTd').html(response.data);
					}
				}
			})
		})
	});
	function InactiveUser(id,obj)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/InactiveUser')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.er-msg').show();
					$(".er-msg").text('User blocked successfully');
					$(obj).parent().parent('tr').find('.ok').html("SUSPENDED");
				}else{
					$('.er-msg').show();
					$(".er-msg").text('User not blocked');
				}
			}
		})
		//window.location.href="{{ url('Admin/InactiveUser/') }}/"+id;
	}

	function changeContactVisablity(id){
		
		var current = $('#chng_see_'+id).data('current');
		
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/changeVisablity')}}",
			data:{"_token":"{{ csrf_token()}}",id:id,current : current},
			success:function(response)
			{
				if(current == "not"){
					$('#see_status_'+id).html('Yes');
					$('#chng_see_'+id).data('current','yes');
				}else{
					$('#see_status_'+id).html('Not');
					$('#chng_see_'+id).data('current','not');
				}
			}
		})
	}

	function changePublicStatus(userId,userType){
		
		var current = $('#chng_public_'+userId).data('current');
		
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/changePublicStatus')}}",
			data:{"_token":"{{ csrf_token()}}", userid : userId, usertype : userType,current : current},
			success:function(response)
			{
				if(current == "1"){
					$('#public_status_'+userId).html('Not Public');
					$('#chng_public_'+userId).data('current','0');
				}else{
					$('#public_status_'+userId).html('Public');
					$('#chng_public_'+userId).data('current','1');
				}
			}
		})
	}

	

	function changeProfessionalStatus(userId){
		
		var current = $('#chng_prof_'+userId).data('current');
		
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/changeProfStatus')}}",
			data:{"_token":"{{ csrf_token()}}", userid : userId, current : current},
			success:function(response)
			{
				if(current == "1"){
					$('#prof_status_'+userId).html('Not Professional');
					$('#chng_prof_'+userId).data('current','0');
				}else{
					$('#prof_status_'+userId).html('Professional');
					$('#chng_prof_'+userId).data('current','1');
				}
			}
		})
	}

	function changeMessageMeetingApproval(userId){
		
		var current = $('#chng_message_meeting_approval_'+userId).data('current');
		
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/changeMessageMeetingApproval_')}}",
			data:{"_token":"{{ csrf_token()}}", userid : userId, current : current},
			success:function(response){
				if(current == "no"){
					$('#message_meeting_approval_'+userId).html('Approved');
					$('#chng_message_meeting_approval_'+userId).data('current','yes');
				}else{
					$('#message_meeting_approval_'+userId).html('Not Approved');
					$('#chng_message_meeting_approval_'+userId).data('current','no');
				}
			}
		})
	}


	function ApprovedProfile(id,obj){
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/ApprovedProfile')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				console.log(response);
				if(response.msg=='success')
				{
					$('.er-msg').show();
					$(obj).parent().parent('tr').find('.notok').html("ACTIVE");
					$(".er-msg").text('User approved successfully');
				}else{
					$('.er-msg').show();
					$(".er-msg").text('User not approved');
				}
			}
		})

	}
	function DeleteUser(id,obj)
	{
		$.ajax({
			method:"POST",
			url:"{{ url('Admin/DeleteUser')}}",
			data:{"_token":"{{ csrf_token()}}",id:id},
			success:function(response)
			{
				
				if(response.msg=='success')
				{
					$(obj).parent().parent('tr').remove();
					$('.er-msg').show();
					$(".er-msg").text('User removed successfully');
				}else{
					$('.er-msg').show();
					$(".er-msg").text('User not removed');
				}
			}
		})

	}
	function editUser(id)
	{
		window.location.href="{{ url('Admin/editUser/') }}/"+id;

	}
	</script>
	
@endsection