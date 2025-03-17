<div class="row" style="padding-top: 15px"> 
    <div class="form-group col-md-6">
        <label for="inputEmail4">Nombre del Usuario</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Ejemplo:Juan" name="txtUsuario"
            value="<?php echo e(old('txtUsuario')); ?>" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="txtPassword" placeholder="" 
            value="<?php echo e(old('txtPassword')); ?>" name="txtPassword" required>                            
    </div>
    <div class="form-group col-md-6 col-sm-12 col-xs-12">
        <label class="control-label mb-10">Correo</label>
        <div class="input-group mb-15"> <span class="input-group-addon">@</span>
            <input type="email" value="<?php echo e(old('txtEmail')); ?>" placeholder="Ejemplo:juan@gmail.com" name="txtEmail" class="form-control">
        </div>
    </div>
    <div class="form-group mb-30 col-md-6 col-sm-12 col-xs-12">
        <label class="control-label mb-10 text-left">Estado</label>
            
        <div class="radio radio-primary">
            <input type="radio" name="txtEstado" id="radio1" value="1" checked >
            <label for="radio1">
                Activado
            </label>
        </div>
        <div class="radio radio-info">
            <input type="radio" name="txtEstado" id="radio2" value="0"  <?php if(old('txtEstado')=='0'): ?> checked <?php endif; ?>>
            <label for="radio2">
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

                        <option value="<?php echo e($fila_rol->id); ?>" <?php if(old('selectRol')==$fila_rol->id): ?>selected <?php endif; ?>><?php echo e($fila_rol->nombre_rol); ?> </option>
                    
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
                       
                        <option value="<?php echo e($sucursal->id); ?>" <?php if(old('selectSucursal')==$sucursal->id): ?> selected <?php endif; ?>><?php echo e($sucursal->nombre_sucursal); ?></option>                                               
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                </select>
            </div>
        </div>
            
        
    </div>
</div>

<div class="modal-footer">                                        
    <button type="submit" id="btnCrearMedicoModal"  class="btn btn-primary text-left">Agregar Usuario</button>
</div><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/components/crear-usuario.blade.php ENDPATH**/ ?>