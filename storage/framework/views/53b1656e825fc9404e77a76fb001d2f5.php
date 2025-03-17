
<?php $__env->startSection('titulo'); ?>
    Buscar Paciente
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
                    <h6 class="panel-title txt-dark">Buscar Paciente</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <form action="<?php echo e(route('paciente.search')); ?>" method="POST" role="form" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="form-row" style="padding-top: 15px">
                    

                        <div class="form-group col-md-6">
                            <label for=""></label>
                            <input type="text" class="form-control" value="" id="" placeholder="Ingrese un Texto" name="txtBuscar" required>
                            
                        </div>
                        
                
                        
                    
                    
                    <div class="modal-footer">                                        
                        <button type="submit" id="btnCrearModal"  class="btn btn-primary text-left">Buscar</button>
                    </div>
                </div>
                
                
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/paciente/buscar.blade.php ENDPATH**/ ?>