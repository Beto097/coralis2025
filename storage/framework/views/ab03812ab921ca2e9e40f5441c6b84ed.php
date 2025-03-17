<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewRolModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Agregar Rol</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
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
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/RolModals.blade.php ENDPATH**/ ?>