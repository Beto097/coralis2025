<?php $__env->startSection('titulo'); ?>
    Crear Sucursal
<?php $__env->stopSection(); ?>



<?php $__env->startSection('contenido'); ?>
<br>
<br>

<!--muestro el error-->
<?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- fin del error-->
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Crear Sucursal</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <form action="<?php echo e(route('sucursal.insert')); ?>" method="POST" role="form" autocomplete="off">
                <?php echo csrf_field(); ?>
                
                <?php if (isset($component)) { $__componentOriginal13b8343912a33124beb6409c03b0ed93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13b8343912a33124beb6409c03b0ed93 = $attributes; } ?>
<?php $component = App\View\Components\CrearSucursal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('crear-sucursal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CrearSucursal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13b8343912a33124beb6409c03b0ed93)): ?>
<?php $attributes = $__attributesOriginal13b8343912a33124beb6409c03b0ed93; ?>
<?php unset($__attributesOriginal13b8343912a33124beb6409c03b0ed93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13b8343912a33124beb6409c03b0ed93)): ?>
<?php $component = $__componentOriginal13b8343912a33124beb6409c03b0ed93; ?>
<?php unset($__componentOriginal13b8343912a33124beb6409c03b0ed93); ?>
<?php endif; ?>
                
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/sucursal/create.blade.php ENDPATH**/ ?>