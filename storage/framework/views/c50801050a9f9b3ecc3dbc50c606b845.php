<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="editarUsuarioModal<?php echo e($fila->id); ?>"  aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="<?php echo e(route('usuario.save')); ?>" method="POST" role="form" autocomplete="off">
                                <?php echo csrf_field(); ?>
                                
                                <?php if (isset($component)) { $__componentOriginald835080fbfb83500a52c909df9ffc7d5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald835080fbfb83500a52c909df9ffc7d5 = $attributes; } ?>
<?php $component = App\View\Components\EditarUsuario::resolve(['resultado' => $fila] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('editar-usuario'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\EditarUsuario::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald835080fbfb83500a52c909df9ffc7d5)): ?>
<?php $attributes = $__attributesOriginald835080fbfb83500a52c909df9ffc7d5; ?>
<?php unset($__attributesOriginald835080fbfb83500a52c909df9ffc7d5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald835080fbfb83500a52c909df9ffc7d5)): ?>
<?php $component = $__componentOriginald835080fbfb83500a52c909df9ffc7d5; ?>
<?php unset($__componentOriginald835080fbfb83500a52c909df9ffc7d5); ?>
<?php endif; ?>
                                
                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/editarUsuarioModals.blade.php ENDPATH**/ ?>