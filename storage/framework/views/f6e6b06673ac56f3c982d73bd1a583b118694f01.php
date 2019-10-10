
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Fund Goal Value</span>
        </div>
        <div class="col-md-6 text-right">
          <!-- <a class="btn btn-primary" href="<?php echo e(url('Admin/AddFundingTypeForm')); ?>">Add Funding Type</a> -->
        </div>
     	</div>
     <div class="err-msg"></div>
	<table class="table table-bordered" id="myTable">
		<thead>
			<th>#</th>
			<th>Min Value</th>
			<th>Max Value</th>
			<th>Created_At</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data as $row) { ?>
			<tr>
				<td><?php echo e($i); ?></td>
				<td><?php echo e(@$row['minValue']); ?></td>
				<td><?php echo e(@$row['maxValue']); ?></td>
				<td><?php echo e(@$row['created_at']); ?></td>
				<td>
					<?php $id=base64_encode($row['id']);?>
                	<a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="EditFundGoal('<?php echo e($id); ?>')"> 
                  	<i class="fa fa-edit"></i> 
                </a>
	           </td>
			</tr>
			<?php $i++;} ?>
		</tbody>
	</table>
</div>
<script>
	function EditFundGoal(id)
	{
		window.location.href="<?php echo e(url('Admin/EditFundGoal/')); ?>/"+id;
	}
	
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/viewFundGoalValue.blade.php ENDPATH**/ ?>