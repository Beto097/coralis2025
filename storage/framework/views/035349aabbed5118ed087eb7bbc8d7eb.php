<?php $__env->startSection('titulo'); ?>
    Sucursal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>    
    <?php echo $__env->make('scripts.validaciones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos las Sucursales en el sistema</p>
        </div>
        <div class="col-sm-2">
            <?php if(Auth::user()->accesoRuta('/sucursal/create')): ?>  
                <button class="btn btn-primary btn-lable-wrap left-label" id="addNewSucursal" data-toggle="modal" data-target="#addNewSucursalModal">
                    <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">
                        Agregar Sucursal
                    </span>
                </button>
                <?php echo $__env->make('modals.SucursalModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>
        </div>
        <br>
        <br>
        <br>
        <?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Sucursales</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" cellspacing="0"  style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>                                            
                                            <th>Telefono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="font-size: 90%;">
                                                <td scope="row"><?php echo e($fila->id); ?></td>                                                
                                                <td><?php echo e($fila->nombre_sucursal); ?></td>                                                
                                                <td><?php echo e($fila->telefono_sucursal); ?></td>
                                                <td>
                                                    <?php if(Auth::user()->accesoRuta('/sucursal/update')): ?>  
                                                        <button type="button" class="btn btn-success btn-sm" id="editSucursal"                
                                                            data-toggle="modal" data-target="#editarSucursalModal<?php echo e($fila->id); ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <?php echo $__env->make('modals.editarSucursalModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->accesoRuta('/sucursal/delete')): ?>  
                                                        
                                                        <?php if($fila->estado_sucursal == 1): ?>                                        
                                                            <a class="btn btn-danger btn-sm"title="Eliminar la Sucursal" href="<?php echo e(route('sucursal.delete', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea eliminar esta Sucursal del sistema?')"><i class="fa fa-trash-o"></i></a> 
                                                        <?php else: ?>
                                                            <a class="btn btn-warning btn-sm" title="Desbloquear la Sucursal" href="<?php echo e(route('sucursal.desbloquear', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea desbloquear esta Sucursal del sistema?')"><i class="fa fa-unlock-alt"></i></a> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>                                                        
                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                    </tbody>
                                
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>                                            
                                            <th>Telefono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('ordenarTabla'); ?>

    ,"order": [[0,'desc']]
     ,"columns": [
      null,
      null,
      null,
      { "width": "20%" }
    ],
    "pageLength": 15,
    lengthMenu: [15, 30, 50, 100],
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/sucursal/index.blade.php ENDPATH**/ ?>