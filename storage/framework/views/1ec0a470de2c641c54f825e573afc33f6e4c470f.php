
<?php $__env->startSection('content'); ?>

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
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($i); ?></td>
				<td><?php echo e(@$row['sender']['firstname']); ?> <?php echo e(@$row['sender']['lastname']); ?></td>
				<td><?php echo e(@$row['reciever']['firstname']); ?> <?php echo e(@$row['reciever']['lastname']); ?></td>
				<td><?php echo e(wordwrap( @$row['message'], 50, " ", true)); ?></td>
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
				<td id="status_<?php echo e($row['id']); ?>">
					<?php if(@$row['status']=='1'){?>
						Active
					<?php } elseif(@$row['status']=='2'){ ?>
						Inactive
					<?php } else if(@$row['status']=='3'){ ?>
						Pending
					<?php } ?>
				</td>
				<td><?php echo e(@$row['created_at']); ?></td>
				<td>
					<span id="show_inactive_btn_<?php echo e($row['id']); ?>" style="<?php if(@$row['status']=='1'): ?> display:block; <?php else: ?> display: none; <?php endif; ?>">
						<a class="btn btn-danger btn-sm" data-original-title="Unapprove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="InactiveMeeting('<?php echo e($row['id']); ?>',this)"> 
                  			<i class="fa fa-ban"></i> 
                		</a>
                	</span>
					<span id="show_active_btn_<?php echo e($row['id']); ?>"  style="<?php if(@$row['status']=='2'): ?> display:block; <?php else: ?> display: none; <?php endif; ?>">
						<a class="btn btn-success btn-sm" data-original-title="Approve" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="ApprovedMeeting('<?php echo e($row['id']); ?>',this)"> 
                  			<i class="fa fa-check"></i> 
                		</a>
                	</span>
            	</td>
			</tr>
			<?php $i++;  ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    			url:"<?php echo e(url('Admin/approveAllMeetings')); ?>",
    			data:{"_token":"<?php echo e(csrf_token()); ?>"},
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
    		window.location.href = "<?php echo e(url('Admin/CreateMessage')); ?>"
    	});

	});
	function InactiveMeeting(id,obj)
	{
		$.ajax({
			method:"POST",
			url:"<?php echo e(url('Admin/InactiveMeeting')); ?>",
			data:{"_token":"<?php echo e(csrf_token()); ?>",id:id},
			success:function(response)
			{
				if(response.msg=='success')
    				{
    					$(".dis-msg").html('<div class="alert alert-success">Meeting inactive successfully</div>');
    					$(".dis-msg").show();
    					
    					$('#status_'+id).html("Inactive");
    					$('#show_active_btn_'+id).show();
    					$('#show_inactive_btn_'+id).hide();
    				}else{
    					$(".dis-msg").html('<div class="alert alert-danger">Meeting already inactive</div>');
    					$(".dis-msg").show();    					
    				}
			}
		})
	}
	function ApprovedMeeting(id,obj)
	{
		$.ajax({
			method:"POST",
			url:"<?php echo e(url('Admin/ApprovedMeeting')); ?>",
			data:{"_token":"<?php echo e(csrf_token()); ?>",id:id},
			success:function(response)
			{
				if(response.msg=='success')
    				{
    					debugger;
    					$(".dis-msg").html('<div class="alert alert-success">Meeting approved successfully</div>');
    					$(".dis-msg").show();
    					$('#status_'+id).html("Active");
    					$('#show_active_btn_'+id).hide();
    					$('#show_inactive_btn_'+id).show();
    					/*$(obj).parents('td').sibling().find('.notok').text('Active');*/
    				}else{
    					$(".dis-msg").html('<div class="alert alert-danger">Meeting already approved</div>');
    					$(".dis-msg").show();    					
    				}
			}
		})
	}



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/meeting_lists.blade.php ENDPATH**/ ?>