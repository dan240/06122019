
<?php $__env->startSection('content'); ?>
    <section class="inner-pages">
        <div class="container">
         	 <div class="row contact_div">
         	 	<div class="col col-12">
         	 		<div class="text-center">
		         		<h3><?php echo e($data['page_name']); ?></h3>
		         	</div>
		         	<div class="page_content">
		         		<?php echo $data['content']['page_content']; ?>
		         	</div>
         	 	</div>	
         	 </div>
         	
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/londcap-app.com/public_html/resources/views/frontend/page.blade.php ENDPATH**/ ?>