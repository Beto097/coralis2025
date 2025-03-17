<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $__env->yieldContent('titulo'); ?></title>
	<?php echo $__env->yieldContent('css'); ?>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
	<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">

	<!-- Data table CSS -->
	<link href="<?php echo e(asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
	
	<!-- Custom CSS -->
	<link href="<?php echo e(asset('dist/css/style.css')); ?>" rel="stylesheet" type="text/css">
	
</head>
<body>
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
			<?php echo $__env->yieldContent('contenido'); ?>
			<!-- Footer -->
			<?php echo $__env->make('plantilla.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<!-- /Footer -->
			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
    <!-- jQuery -->
    <script src="<?php echo e(asset('vendors/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo e(asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    
	<!-- Data table JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('dist/js/dataTables-data.js')); ?>"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="<?php echo e(asset('dist/js/jquery.slimscroll.js')); ?>"></script>
	
	<!-- Owl JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>
	
	<!-- Switchery JavaScript -->
	<script src="<?php echo e(asset('vendors/bower_components/switchery/dist/switchery.min.js')); ?>"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="<?php echo e(asset('dist/js/dropdown-bootstrap-extended.js')); ?>"></script>
	
	<!-- Init JavaScript -->
	<script src="<?php echo e(asset('dist/js/init.js')); ?>"></script>
	<script>
		$('#datable_1').DataTable( {
			 
			"language": {
				
				"processing": "Procesando...",
				"lengthMenu": "Mostrar _MENU_ Registros",
				"zeroRecords": "No se encontraron resultados",
				"emptyTable": "Ningún dato disponible en esta tabla",
				"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"infoFiltered": "(filtrado de un total de _MAX_ registros)",
				"search": "Buscar:",
				"infoThousands": ",",
				"loadingRecords": "Cargando...",
				"paginate": {
					"first": "Primero",
					"last": "Último",
					"next": ">>",
					"previous": "<<"
				},
				"aria": {
					"sortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sortDescending": ": Activar para ordenar la columna de manera descendente"
				},
				"buttons": {
					"copy": "Copiar",
					"colvis": "Visibilidad",
					"collection": "Colección",
					"colvisRestore": "Restaurar visibilidad",
					"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
					"copySuccess": {
						"1": "Copiada 1 fila al portapapeles",
						"_": "Copiadas %d fila al portapapeles"
					},
					"copyTitle": "Copiar al portapapeles",
					"csv": "CSV",
					"excel": "Excel",
					"pageLength": {
						"-1": "Mostrar todas las filas",
						"1": "Mostrar 1 fila",
						"_": "Mostrar %d filas"
					},
					"pdf": "PDF",
					"print": "Imprimir"
				},
				"autoFill": {
					"cancel": "Cancelar",
					"fill": "Rellene todas las celdas con <i>%d<\/i>",
					"fillHorizontal": "Rellenar celdas horizontalmente",
					"fillVertical": "Rellenar celdas verticalmentemente"
				},
				"decimal": ",",
				"searchBuilder": {
					"add": "Añadir condición",
					"button": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"clearAll": "Borrar todo",
					"condition": "Condición",
					"conditions": {
						"date": {
							"after": "Despues",
							"before": "Antes",
							"between": "Entre",
							"empty": "Vacío",
							"equals": "Igual a",
							"not": "No",
							"notBetween": "No entre",
							"notEmpty": "No Vacio"
						},
						"moment": {
							"after": "Despues",
							"before": "Antes",
							"between": "Entre",
							"empty": "Vacío",
							"equals": "Igual a",
							"not": "No",
							"notBetween": "No entre",
							"notEmpty": "No vacio"
						},
						"number": {
							"between": "Entre",
							"empty": "Vacio",
							"equals": "Igual a",
							"gt": "Mayor a",
							"gte": "Mayor o igual a",
							"lt": "Menor que",
							"lte": "Menor o igual que",
							"not": "No",
							"notBetween": "No entre",
							"notEmpty": "No vacío"
						},
						"string": {
							"contains": "Contiene",
							"empty": "Vacío",
							"endsWith": "Termina en",
							"equals": "Igual a",
							"not": "No",
							"notEmpty": "No Vacio",
							"startsWith": "Empieza con"
						}
					},
					"data": "Data",
					"deleteTitle": "Eliminar regla de filtrado",
					"leftTitle": "Criterios anulados",
					"logicAnd": "Y",
					"logicOr": "O",
					"rightTitle": "Criterios de sangría",
					"title": {
						"0": "Constructor de búsqueda",
						"_": "Constructor de búsqueda (%d)"
					},
					"value": "Valor"
				},
				"searchPanes": {
					"clearMessage": "Borrar todo",
					"collapse": {
						"0": "Paneles de búsqueda",
						"_": "Paneles de búsqueda (%d)"
					},
					"count": "{total}",
					"countFiltered": "{shown} ({total})",
					"emptyPanes": "Sin paneles de búsqueda",
					"loadMessage": "Cargando paneles de búsqueda",
					"title": "Filtros Activos - %d"
				},
				"select": {
					"1": "%d fila seleccionada",
					"_": "%d filas seleccionadas",
					"cells": {
						"1": "1 celda seleccionada",
						"_": "$d celdas seleccionadas"
					},
					"columns": {
						"1": "1 columna seleccionada",
						"_": "%d columnas seleccionadas"
					}
				},
				"thousands": "."
			
			}
			<?php echo $__env->yieldContent('ordenarTabla'); ?>
		} );
	</script>
</body>

</html>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/plantilla/plantillaDT.blade.php ENDPATH**/ ?>