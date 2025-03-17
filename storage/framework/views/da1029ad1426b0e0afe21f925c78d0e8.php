<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
        role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <i class="mdi mdi-check-circle me-2"></i><?php echo e($message); ?>

    </div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php $__errorArgs = ['danger'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-0"
        role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <i class="mdi mdi-close-circle me-2"></i><?php echo e($message); ?>        
    </div>
    
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php $__errorArgs = ['passwordRed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-0"
        role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <i class="mdi mdi-close-circle me-2"></i><?php echo e($message); ?>        
    </div>
    
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php $__errorArgs = ['passwordGreen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
        role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <i class="mdi mdi-check-circle me-2"></i><?php echo e($message); ?>

    </div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/mensajes/alertas.blade.php ENDPATH**/ ?>