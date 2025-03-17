<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Nombre del Usuario</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Ejemplo:Juan" name="txtUsuario"
            value="<?php echo e($fila->nombre_usuario); ?>" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="txtPassword" placeholder="Ejemplo:1538540" 
            value="<?php echo e($fila->password_usuario); ?>" name="txtPassword" required>                            
    </div>
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
        <label class="control-label mb-10">Correo</label>
        <div class="input-group mb-15"> <span class="input-group-addon">@</span>
            <input type="email" value="<?php echo e($fila->email_usuario); ?>" placeholder="Ejemplo:juan@gmail.com" name="txtEmail" class="form-control">
        </div>
    </div>
    <div class="form-group mb-30 col-md-6 col-sm-12 col-xs-12">
        <label class="control-label mb-10 text-left">Estado</label>
            
        <div class="radio radio-primary">
            <input type="radio" name="txtEstado" id="radio1-<?php echo e($fila->id); ?>" value="1" <?php if($fila->estado_usuario=="1"): ?> checked <?php endif; ?> >
            <label for="radio1-<?php echo e($fila->id); ?>">
                Activado
            </label>
        </div>
        <div class="radio radio-info">
            <input type="radio" name="txtEstado" id="radio2-<?php echo e($fila->id); ?>" value="0" <?php if($fila->estado_usuario=="0"): ?> checked <?php endif; ?>  >
            <label for="radio2-<?php echo e($fila->id); ?>">
                Bloqueado
            </label>
        </div>	
    </div>  
    <div class="form-group col-md-6 col-sm-6 col-xs-12">                                        
        <div class="input-group mb-3">
            <label for="">Seleccione un Rol</label>                                                                           
            <div class="col-sm-12">
                <select class="form-control" name="selectRol" id="">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila_rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                
                       
                            
                            <?php if($fila_rol->id == $fila->rol->id): ?>
                                <option value="<?php echo e($fila_rol->id); ?>" selected><?php echo e($fila_rol->nombre_rol); ?> </option>
                            <?php else: ?>  
                                <option value="<?php echo e($fila_rol->id); ?>"><?php echo e($fila_rol->nombre_rol); ?></option>
                            <?php endif; ?>
                       
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                </select>
            </div>
        </div>
            
        
    </div>
    <div class="form-group col-md-6 col-sm-6 col-xs-12">                                        
        <div class="input-group mb-3">
            <label for="">Seleccione una Sucursal</label>                                                                           
            <div class="col-sm-12">
                <select class="form-control" name="selectSucursal" id="">
                    <option value='null' selected>Sin Sucursal</option>
                    <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                
                        <?php if(isset($fila->sucursal)): ?>
                            <?php if($sucursal->id == $fila->sucursal->id): ?>
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
        </div>
            
        
    </div>
</div>                               


<input type="hidden" name="txtId" id="txtId" class="form-control form-control-sm" value="<?php echo e($fila->id); ?>">

<div class="modal-footer">                                        
    <button type="submit" id="btnCrearMedicoModal"  class="btn btn-primary text-left">Guardar</button>
</div><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/components/editar-usuario.blade.php ENDPATH**/ ?>