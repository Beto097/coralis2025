<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $__env->yieldContent('titulo'); ?></title>
	<?php echo $__env->yieldContent('css'); ?>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo e(asset('public/favicon.ico')); ?>">
	<link rel="icon" href="<?php echo e(asset('public/favicon.ico')); ?>" type="image/x-icon">

	<!-- Data table CSS -->
	<link href="<?php echo e(asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
	
	
	<!-- Toast CSS -->
	<link href="<?php echo e(asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')); ?>" rel="stylesheet" type="text/css"/>
	
	<!-- bootstrap-select CSS -->
	<link href="<?php echo e(asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>" rel="stylesheet" type="text/css"/>	
	
	<!-- Calendar CSS -->
	<link href="<?php echo e(asset('vendors/bower_components/fullcalendar/dist/fullcalendar.css')); ?>" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="<?php echo e(asset('dist/css/style.css')); ?>" rel="stylesheet" type="text/css"/>

	
</head>
<body <?php echo $__env->yieldContent('bodyJs'); ?>>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper theme-4-active pimary-color-blue">
		<!-- Top Menu Items -->
		<?php echo $__env->make('plantilla.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<?php echo $__env->make('plantilla.sidebarleft', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
		<!-- /Left Sidebar Menu -->
		
		

        <!-- Main Content -->
		<div class="page-wrapper">
            <!--añadir dashboard-->
			<?php if(Auth::user()->accesoRuta('/sucursal/actualizar')): ?>  			
				
				<?php echo $__env->make('modals.actualizarSucursalModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<?php endif; ?>		
			<?php echo $__env->yieldContent('contenido'); ?>
			<!-- Footer -->
			<?php echo $__env->make('plantilla.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	<?php echo $__env->yieldContent('javaScript2'); ?>
    <!-- jQuery -->
    <script src="<?php echo e(asset('vendors/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    
	<!-- Data table JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="<?php echo e(asset('dist/js/jquery.slimscroll.js')); ?>"></script>
	
	<!-- EChartJS JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/echarts/dist/echarts-en.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/echarts-liquidfill.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/ecStat.min.js')); ?>"></script>
	
	<!-- Toast JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')); ?>"></script>
		
	<!-- Progressbar Animation JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="<?php echo e(asset('dist/js/dropdown-bootstrap-extended.js')); ?>"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="<?php echo e(asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>
	
	<!-- Calender JavaScripts -->
	<script src="<?php echo e(asset('vendors/bower_components/moment/min/moment.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/jquery-ui.min.js')); ?>"></script>
	<script src="<?php echo e(asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
	<script src="<?php echo e(asset('dist/js/fullcalendar-data.js')); ?>"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
	
	<!-- Bootstrap Select JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
	
	<!-- Init JavaScript -->
	<script src="<?php echo e(asset('dist/js/init.js')); ?>"></script>
	
	<script src="<?php echo e(asset('dist/js/dashboard4-data.js')); ?>"></script>

	<script src="../vendors/bower_components/Flot/excanvas.min.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.pie.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.resize.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.time.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.stack.js"></script>
	<script src="../vendors/bower_components/Flot/jquery.flot.crosshair.js"></script>
	<script src="../vendors/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
	<?php echo $__env->yieldContent('javaScript'); ?>
	
</body>

</html>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/plantilla/plantilla.blade.php ENDPATH**/ ?>