
    <div class="col-lg-7"><label for="">Seleccione una Sucursal</label> </div>                                                                          
    <div class="col-lg-5">
        <select class="form-control" name="selectSucursal" id="">
            <option value='null' selected>Sin Sucursal</option>
            <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                
                <?php if(isset(Auth::user()->sucursal)): ?>
                    <?php if($sucursal->id == Auth::user()->sucursal->id): ?>
                        <option value="<?php echo e($sucursal->id); ?>" selected><?php echo e($sucursal->nombre_sucursal); ?> </option>
                    <?php else: ?>
                        <option value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre_sucursal); ?></option>
                    <?php endif; ?>
                <?php else: ?>  
                    <option value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre_sucursal); ?></option>
                   

                <?php endif; ?>
                    
                   
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
        </select>
    </div>
<?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/components/lista-sucursales.blade.php ENDPATH**/ ?>