<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="actualizarSucursalModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Actualizar Sucursal</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="<?php echo e(route('sucursal.actualizar')); ?>" method="POST" role="form" autocomplete="off">
                                <?php echo csrf_field(); ?>
                                <div class="form-group col-md-2 col-sm-12 col-xs-12"> 

                                </div>
                                <div class="form-group col-md-8 col-sm-12 col-xs-12">                                        
                                    
                                        
                                    <?php if (isset($component)) { $__componentOriginal41e782990bcfa856e8845e5f79bde2e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41e782990bcfa856e8845e5f79bde2e2 = $attributes; } ?>
<?php $component = App\View\Components\ListaSucursales::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('lista-sucursales'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ListaSucursales::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41e782990bcfa856e8845e5f79bde2e2)): ?>
<?php $attributes = $__attributesOriginal41e782990bcfa856e8845e5f79bde2e2; ?>
<?php unset($__attributesOriginal41e782990bcfa856e8845e5f79bde2e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41e782990bcfa856e8845e5f79bde2e2)): ?>
<?php $component = $__componentOriginal41e782990bcfa856e8845e5f79bde2e2; ?>
<?php unset($__componentOriginal41e782990bcfa856e8845e5f79bde2e2); ?>
<?php endif; ?>

                                </div>
                                <div class="modal-footer">                                        
                                    <button type="submit" id="btnCrearMedicoModal"  class="btn btn-primary text-left">Guardar</button>
                                </div>
                                
                
                            </form>
                        </div>
                    </div>
                </div>              

            </div>

        </div>

    </div>

</div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/actualizarSucursalModals.blade.php ENDPATH**/ ?>