<?php $__env->startSection('titulo'); ?>
    Crear Rol
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
                    <h6 class="panel-title txt-dark">Crear Roles</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <form action="<?php echo e(route('rol.insert')); ?>" method="POST" role="form" autocomplete="off">
                <?php echo csrf_field(); ?>
                
                <?php if (isset($component)) { $__componentOriginald244df3c55f19080f00bec9fd3390de0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald244df3c55f19080f00bec9fd3390de0 = $attributes; } ?>
<?php $component = App\View\Components\CrearRol::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('crear-rol'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CrearRol::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald244df3c55f19080f00bec9fd3390de0)): ?>
<?php $attributes = $__attributesOriginald244df3c55f19080f00bec9fd3390de0; ?>
<?php unset($__attributesOriginald244df3c55f19080f00bec9fd3390de0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald244df3c55f19080f00bec9fd3390de0)): ?>
<?php $component = $__componentOriginald244df3c55f19080f00bec9fd3390de0; ?>
<?php unset($__componentOriginald244df3c55f19080f00bec9fd3390de0); ?>
<?php endif; ?>
                
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/rol/create.blade.php ENDPATH**/ ?>