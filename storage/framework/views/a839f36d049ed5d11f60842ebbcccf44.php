<?php $__env->startSection('titulo'); ?>
    Crear Usuario
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
                    <h6 class="panel-title txt-dark">Crear Usuario</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('usuario.create')); ?>" method="POST" role="form" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <?php if (isset($component)) { $__componentOriginalced70e01ae9abd2468e8768bc64b5f44 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalced70e01ae9abd2468e8768bc64b5f44 = $attributes; } ?>
<?php $component = App\View\Components\CrearUsuario::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('crear-usuario'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CrearUsuario::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalced70e01ae9abd2468e8768bc64b5f44)): ?>
<?php $attributes = $__attributesOriginalced70e01ae9abd2468e8768bc64b5f44; ?>
<?php unset($__attributesOriginalced70e01ae9abd2468e8768bc64b5f44); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalced70e01ae9abd2468e8768bc64b5f44)): ?>
<?php $component = $__componentOriginalced70e01ae9abd2468e8768bc64b5f44; ?>
<?php unset($__componentOriginalced70e01ae9abd2468e8768bc64b5f44); ?>
<?php endif; ?>                    
    
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/usuario/create.blade.php ENDPATH**/ ?>