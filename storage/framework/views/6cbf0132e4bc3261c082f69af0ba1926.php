



<?php $__env->startSection('titulo'); ?>
    Seleccionar Pantallas
<?php $__env->stopSection(); ?>





<?php $__env->startSection('contenido'); ?>
<br>
<br>

<!--muestro el error-->
<?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- fin del error-->
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Seleccionar Pantallas</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('rolPantalla.save')); ?>" method="POST" role="form" class="form-horizontal" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-3">
                            <label for="">Seleccione un Rol</label>
                        </div>
                        <div class="col-lg-6">
                            
                            <div class="input-group mb-3">                                    
                                <div class="col-sm-12">
                                    <select class="form-control" name="selectRol" id="" onchange="top.location.href = this.options[this.selectedIndex].value">
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila_rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                            <?php if($rol!=''): ?>
                                                
                                                <?php if($fila_rol->id == $rol->id): ?>
                                                    <option value="<?php echo e($fila_rol->id); ?>" selected><?php echo e($fila_rol->nombre_rol); ?> </option>
                                                <?php else: ?>  
                                                    <option value="<?php echo e($fila_rol->id); ?>"><?php echo e($fila_rol->nombre_rol); ?></option>
                                                <?php endif; ?>
                                            <?php else: ?> 
                                                <option value="<?php echo e($fila_rol->id); ?>"><?php echo e($fila_rol->nombre_rol); ?></option>
                                            <?php endif; ?>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-lg-12">
                            <table class="table table-striped table-inverse table-responsive">
                                <tbody>
                                    
                                    <?php $__currentLoopData = $pantallas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pantalla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                        <tr>  
                                            <td scope="row"> 
                                                <div class="row ">               
                                                
                                                                    
                                                    <div class="col-md-4">
                                                        <div class="checkbox my-2">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" name="pantallas_id[]" id="pantalla<?php echo e($pantalla->id); ?>" value="<?php echo e($pantalla->id); ?>"
                                                                <?php if(in_array($pantalla->id, $lista_pantallas)): ?>  checked <?php endif; ?>
                                                                    data-parsley-multiple="groups"
                                                                    data-parsley-mincheck="2">
                                                                <label class="form-check-label"
                                                                    for="pantalla<?php echo e($pantalla->id); ?>"><?php echo e($pantalla->nombre_pantalla); ?></label>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                
                                                    <?php $__currentLoopData = $pantalla->sub_pantallas(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_pantalla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-4">
                                                            <div class="checkbox my-2">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" name="pantallas_id[]" id="pantalla<?php echo e($sub_pantalla->id); ?>" value="<?php echo e($sub_pantalla->id); ?>"
                                                                    <?php if(in_array($sub_pantalla->id, $lista_pantallas)): ?>  checked <?php endif; ?>
                                                                        data-parsley-multiple="groups"
                                                                        data-parsley-mincheck="2">
                                                                    <label class="form-check-label"
                                                                        for="pantalla<?php echo e($sub_pantalla->id); ?>"><?php echo e($sub_pantalla->nombre_pantalla); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div> 
                                            </td>
                                        </tr>
                                   
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
    
                        </div>
                    </div>
                    <?php if($rol != '' ): ?>
                        <input type="hidden" name="txtid" id="inputtxtid" class="form-control" value="<?php echo e($rol->id); ?>">
                    <?php endif; ?>
                    <div class="modal-footer">                                        
                        <button type="submit" id="btnCrearModal"  class="btn btn-primary text-left">Guardar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/pantalla/selectPantallaId.blade.php ENDPATH**/ ?>