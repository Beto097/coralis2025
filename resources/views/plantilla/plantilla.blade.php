<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>@yield('titulo')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{asset('/favicon.ico')}}">
	<link rel="icon" href="{{asset('/favicon.ico')}}" type="image/x-icon">

	@yield('css')

	<!-- DataTables CSS -->
	<link href="{{asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet"/>

	<!-- Toast CSS -->
	<link href="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet"/>

	<!-- Bootstrap Select CSS -->
	<link href="{{asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"/>

	<!-- FullCalendar CSS -->
	<link href="{{asset('vendors/bower_components/fullcalendar/dist/fullcalendar.css')}}" rel="stylesheet"/>

	<!-- Custom CSS -->
	<link href="{{asset('dist/css/style.css')}}" rel="stylesheet"/>

</head>

<body>

<div class="wrapper theme-4-active pimary-color-blue">

	@include('plantilla.navbar')
	@include('plantilla.sidebarleft')

	<div class="page-wrapper">

		@include('modals.actualizarSucursalModals')
		@include('modals.actualizarPasswordModals')

		@if (Route::is('index'))
			<div class="col-sm-4 col-sm-offset-8">
				@include('plantilla.errores')
			</div>
		@endif

		@yield('contenido')

		@include('plantilla.footer')

	</div>

</div>

<!-- ================= SCRIPTS ================= -->

<!-- jQuery -->
<script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

<!-- Toast -->
<script src="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

<!-- Waypoints & Counter -->
<script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>

<!-- Dropdown -->
<script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

<!-- Sparkline -->
<script src="{{asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>

<!-- Owl Carousel -->
<script src="{{asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>

<!-- ========== FULLCALENDAR (VERSIÓN JQUERY V3) ========== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
<script src="{{asset('vendors/jquery-ui.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>


<!-- Bootstrap Select -->
<script src="{{asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

<!-- Init -->
<script src="{{asset('dist/js/init.js')}}"></script>

@yield('javaScript')

</body>
</html>
