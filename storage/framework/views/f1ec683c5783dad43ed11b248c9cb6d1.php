<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewSucursalModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Agregar Sucursal</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
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

            </div>

        </div>

    </div>

</div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/SucursalModals.blade.php ENDPATH**/ ?>