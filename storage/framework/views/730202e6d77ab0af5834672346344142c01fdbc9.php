
<?php $__env->startSection('content'); ?>
<style type="text/css">
	td.action {
	    width: 100px;
	}
</style>
<div class="container-fluid">
	<div class="row" style="padding:10px;">
		<div class="col-md-6">
			<span style="font-size: 20px;">Report/Abuse</span>
		</div>
	</div>
	<div class="error-msg"></div>
	
	<table id="example" class="display" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>From</th>
				<th>Abuse To</th>
				<th>Description</th>
				
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data as $row) { ?>
			<tr id="tr_<?php echo e($row['id']); ?>">
				<td><?php echo e($i); ?></td>
				
				<td><?php echo e(@$row['user']['firstname']); ?> <?php echo e(@$row['user']['lastname']); ?>  <?php if(!empty($row['user']['usertype']) && $row['user']['usertype'] == 1): ?> - <b>Company</b> <?php else: ?> - <b>Investor</b> <?php endif; ?>  <br> <?php echo e(@$row['user']['email']); ?></td>
				
				<?php if(!empty($row['company_detail'])): ?>
					
					<td><?php echo e(@$row['company_detail']['firstname']); ?> <?php echo e(@$row['company_detail']['lastname']); ?> ( Company ) <br> <?php echo e(@$row['company_detail']['email']); ?></td>
				<?php else: ?>
					
					<td><?php echo e(@$row['investor_detail']['firstname']); ?> <?php echo e(@$row['investor_detail']['lastname']); ?> ( Investor ) <br> <?php echo e(@$row['investor_detail']['email']); ?></td>
				<?php endif; ?>
				
				<td><?php echo e(@$row['description']); ?></td>
				
				<td><?php echo e(date('m-d-Y H:i:s', strtotime(@$row['created_at']))); ?></td>
				<td class="action">
					<!-- <a class="btn btn-success btn-xs" data-original-title="View" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="viewContactMessage('<?php echo e($row['id']); ?>')">
						<i class="fa fa-check"></i>
					</a> -->
					<a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="deleteReportAbuse('<?php echo e($row['id']); ?>')">
						<i class="fa fa-remove"></i>
					</a>
				</td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone No</th>
			<th>Address</th>
			<th>Action</th>
		</tr>
		</tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
$('#example').DataTable();
} );
	function deleteReportAbuse(id)
	{
		$.ajax({
			method:"POST",
			url:"<?php echo e(url('Admin/deleteReportAbuse')); ?>",
			data:{"_token":"<?php echo e(csrf_token()); ?>",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('#tr_'+id).fadeOut('slow');
					$('.error-msg').html('<div class="alert alert-success">Report / Abuse deleted successfully.</div>');
				}else{
					$('.error-msg').html('<div class="alert alert-danger">Report / Abuse not deleted .</div>');
				}
			}
		})
		//window.location.href="<?php echo e(url('Admin/InactiveUser/')); ?>/"+id;
	}
	function viewContactMessage(id){
		window.location.href = "<?php echo e(url('Admin/viewContactMessage')); ?>/"+id;
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/report.blade.php ENDPATH**/ ?>