
<?php $__env->startSection('content'); ?>
<style type="text/css">
	td.action {
	    width: 100px;
	}
</style>
<div class="container-fluid">
	<div class="row" style="padding:10px;">
		<div class="col-md-6">
			<span style="font-size: 20px;">Website Configuration</span>
		</div>
	</div>
	<div class="error-msg"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Value</th>
				<th>identifier</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($configs as $config) { ?>
			<tr>
				<td><?php echo e($i); ?></td>
				<td><?php echo e(@$config['name']); ?></td>
				<td>
					<textarea name="vlaue" id="value_<?php echo e($config['id']); ?>" class="form-control"><?php echo e(@$config['value']); ?></textarea>
				</td>
				<td><?php echo e(@$config['variable']); ?></td>
				
				<td class="action">
					
					<a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="updateConfig('<?php echo e($config['id']); ?>')">
						Update
					</a>
					&nbsp; &nbsp; <span id="susicon_<?php echo e($config['id']); ?>"></span>
				</td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Value</th>
			<th>Identifire</th>
			<th>Action</th>
		</tr>
		</tfoot>
	</table>
</div>
<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});
	function updateConfig(id)
	{
		var value = $('#value_'+id).val();
		$.ajax({
			method:"POST",
			url:"<?php echo e(url('Admin/updateConfig')); ?>",
			data:{"_token":"<?php echo e(csrf_token()); ?>","id":id,"value" : value},
			success:function(response)
			{
				var response = JSON.parse(response);
				
				if(response.status=='success') {
					$('.error-msg').html('<div class="alert alert-success"><i class="fa fa-check"></i> '+response.msg+'</div>');
					$('#susicon_'+id).html('<i class="fa fa-check text-success"></i>');
				}else{
					$('.error-msg').html('<div class="alert alert-danger"><i class="fa fa-close"></i> '+response.msg+'</div>');
					$('#susicon_'+id).html('<i class="fa fa-close text-danger"></i>');
				}
			}
		})
		//window.location.href="<?php echo e(url('Admin/InactiveUser/')); ?>/"+id;
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/config.blade.php ENDPATH**/ ?>