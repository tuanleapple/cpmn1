<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/loginClient.css')); ?>" type="text/css">
<div class="logo"><img alt="truong bach khoa hcm" fetchpriority="high" width="487" height="282" decoding="async" data-nimg="1" class="logo-image" style="color:transparent" src="/images/logoLogin.svg"></div>
<div class="form">
	<form class="form-data">
		<div class="text">Username: </div><input class="input-name" id="email" type="text" placeholder="Nhập Username">
		<div class="text">Password: </div><input class="input-name" id="password" type="password" placeholder="Nhập Password">
		<div class="buttons"><button type="botton" id="login_submit" class="login-button">Login in</button></div>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/components/frontend/login.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/post-master/resources/views/login.blade.php ENDPATH**/ ?>