<?php $__env->startSection('titulo'); ?>
    Crear Pantalla
<?php $__env->stopSection(); ?>



<?php $__env->startSection('contenido'); ?>
<br>
<br>

<!--muestro el error-->
<?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- fin del error-->
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Crear Pantallas</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <form action="<?php echo e(route('pantalla.insert')); ?>" method="POST" role="form" autocomplete="off">
                <?php echo csrf_field(); ?>
                
                <?php if (isset($component)) { $__componentOriginal6605136922b7cd405afdae9519e667a7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6605136922b7cd405afdae9519e667a7 = $attributes; } ?>
<?php $component = App\View\Components\CrearPantalla::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('crear-pantalla'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CrearPantalla::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6605136922b7cd405afdae9519e667a7)): ?>
<?php $attributes = $__attributesOriginal6605136922b7cd405afdae9519e667a7; ?>
<?php unset($__attributesOriginal6605136922b7cd405afdae9519e667a7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6605136922b7cd405afdae9519e667a7)): ?>
<?php $component = $__componentOriginal6605136922b7cd405afdae9519e667a7; ?>
<?php unset($__componentOriginal6605136922b7cd405afdae9519e667a7); ?>
<?php endif; ?>
                
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/pantalla/create.blade.php ENDPATH**/ ?>