
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">Users List</span>
        </div>
        <!-- <div id="success" class="alert alert-success"></div>
        <div id="failed" class="alert alert-danger"></div> -->
        <div class="col-md-6 text-right">
          <a class="btn btn-primary" href="<?php echo e(url('Admin/AddCompanyTypeForm')); ?>">Add Company Type</a>
        </div>
     	</div>
     	<div class="err-msg"></div>
	<table id="example" class="display" style="width:100%">
		<thead>
            <tr>
				<th>#</th>
				<th>Type Companies</th>
				<th>Created_At</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
        </thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach($data as $row) { ?>
			<tr>
				<td><?php echo e($i); ?></td>
				<td><?php echo e(@$row['typeCompanies']); ?></td>
				<td><?php echo e(@$row['created_at']); ?></td>
				<?php if($row['status']=='1') { ?>
				<td>Active</td>
				<?php }elseif($row['status']=='2') {?>
				<td>Inactive</td>
				<?php } ?>
				<td>
					<?php $id=base64_encode($row['id']);?>
                <a class="btn btn-danger btn-xs" data-original-title="Remove" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="DeleteCompanyType('<?php echo e($id); ?>')"> 
                  <i class="fa fa-times-circle-o"></i>
                </a>
                <a class="btn btn-info btn-xs" data-original-title="Edit" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="EditCompanyType('<?php echo e($id); ?>')"> 
                  <i class="fa fa-edit"></i> 
                </a></td>
			</tr>
			<?php $i++;} ?>
		</tbody>
		<tfoot>
            <tr>
				<th>#</th>
				<th>Type Companies</th>
				<th>Created_At</th>
				<th>Status</th>
				<th>Action</th>
            </tr>
        </tfoot>
	</table>
</div>
<script>
	$(document).ready(function(){
    $('#example').DataTable();
	});
	function DeleteCompanyType(id)
	{
		$.ajax({
			method:"POST",
			url:"<?php echo e(url('Admin/DeleteCompanyType')); ?>",
			data:{"_token":"<?php echo e(csrf_token()); ?>",id:id},
			success:function(response)
			{
				if(response.msg=='success')
				{
					$('.err-msg').html('<div class="alert alert-success">Company type removed successfully.</div>');
				}else{
					$('.err-msg').html('<div class="alert alert-danger">Company type not removed .</div>')
				}
			}
		})

	}
	function EditCompanyType(id)
	{
		window.location.href="<?php echo e(url('Admin/EditCompanyType/')); ?>/"+id;
	}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/backend/typeCompanies.blade.php ENDPATH**/ ?>