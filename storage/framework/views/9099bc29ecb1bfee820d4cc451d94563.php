<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewUsuarioModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Agregar Usuario</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
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

        </div>

    </div>

</div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/UsuarioModals.blade.php ENDPATH**/ ?>