<?php $__env->startSection('titulo'); ?>
    Medico
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>    
    <?php echo $__env->make('scripts.validaciones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los medicos que solicitaron examenes en el sistema</p>
        </div>
        <div class="col-sm-2">
            <?php if(Auth::user()->accesoRuta('/medico/create')): ?>  
                <button class="btn btn-primary btn-lable-wrap left-label" id="addNewMedico" data-toggle="modal" data-target="#addNewMedicoModal">
                    <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">
                        Agregar Medico
                    </span>
                </button>
                <?php echo $__env->make('modals.MedicoModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                        <h6 class="panel-title txt-dark">Medicos</h6>
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
                                            <th>Numero de Registro</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Telefono</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="font-size: 90%;">
                                                <td scope="row"><?php echo e($fila->id); ?></td>
                                                <td><?php echo e($fila->numero_registro); ?></td>
                                                <td><?php echo e($fila->nombre_medico); ?></td>
                                                <td><?php echo e($fila->email_medico); ?></td>
                                                <td><?php echo e($fila->telefono_medico); ?></td>
                                                <td>
                                                    <?php if(Auth::user()->accesoRuta('/medico/update')): ?>  
                                                        <button type="button" class="btn btn-success btn-sm" id="editMedico"                
                                                            data-toggle="modal" data-target="#editarMedicoModal<?php echo e($fila->id); ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <?php echo $__env->make('modals.editarMedicoModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->accesoRuta('/medico/delete')): ?>  
                                                        
                                                        <?php if($fila->estado_medico == 1): ?>                                        
                                                            <a class="btn btn-danger btn-sm"title="Eliminar el medico" href="<?php echo e(route('medico.delete', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea eliminar este medico del sistema?')"><i class="fa fa-trash-o"></i></a> 
                                                        <?php else: ?>
                                                            <a class="btn btn-warning btn-sm" title="Desbloquear el medico" href="<?php echo e(route('medico.desbloquear', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea desbloquear este medico del sistema?')"><i class="fa fa-unlock-alt"></i></a> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>                                                        
                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                    </tbody>
                                
                                    <tfoot>
                                        <tr>                                                                                   
                                            <th>Id</th>
                                            <th>Numero de Registro</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
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
      null,
      null,
      { "width": "20%" }
    ],
    "pageLength": 15,
    lengthMenu: [15, 30, 50, 100],
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/medico/index.blade.php ENDPATH**/ ?>