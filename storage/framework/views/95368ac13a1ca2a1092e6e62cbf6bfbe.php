<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="editarRolModal<?php echo e($fila->id); ?>" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Editar Rol</h5>
            </div>
            <div class="modal-body">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="<?php echo e(route('rol.save')); ?>" method="POST" role="form" autocomplete="off">  
                                <?php echo csrf_field(); ?>                            
                                <?php if (isset($component)) { $__componentOriginal9deb8747ecec31f419a1d48d4937d558 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9deb8747ecec31f419a1d48d4937d558 = $attributes; } ?>
<?php $component = App\View\Components\EditarRol::resolve(['resultado' => $fila] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('editar-rol'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\EditarRol::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9deb8747ecec31f419a1d48d4937d558)): ?>
<?php $attributes = $__attributesOriginal9deb8747ecec31f419a1d48d4937d558; ?>
<?php unset($__attributesOriginal9deb8747ecec31f419a1d48d4937d558); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9deb8747ecec31f419a1d48d4937d558)): ?>
<?php $component = $__componentOriginal9deb8747ecec31f419a1d48d4937d558; ?>
<?php unset($__componentOriginal9deb8747ecec31f419a1d48d4937d558); ?>
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
</div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/modals/editarRolModals.blade.php ENDPATH**/ ?>