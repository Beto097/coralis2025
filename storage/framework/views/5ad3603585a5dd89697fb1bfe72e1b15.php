<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewPantallaModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Agregar Pantalla</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
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
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/PantallaModals.blade.php ENDPATH**/ ?>