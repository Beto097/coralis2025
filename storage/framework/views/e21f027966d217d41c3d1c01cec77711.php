<?php $__env->startSection('titulo'); ?>
    Usuario
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>    
    <?php echo $__env->make('scripts.validaciones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los usuario en el sistema</p>
        </div>
        <div class="col-sm-2">
            <?php if(Auth::user()->accesoRuta('/usuario/create')): ?>  
                <button class="btn btn-primary btn-lable-wrap left-label" id="addNewusuario" data-toggle="modal" data-target="#addNewUsuarioModal">
                    <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">
                        Agregar Usuario
                    </span>
                </button>
                <?php echo $__env->make('modals.UsuarioModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                        <h6 class="panel-title txt-dark">Usuarios</h6>
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
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Sucursal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="font-size: 90%;">
                                                <td scope="row"><?php echo e($fila->id); ?></td>
                                                <td><?php echo e($fila->nombre_usuario); ?></td>
                                                <td><?php echo e($fila->email_usuario); ?></td>
                                                <td><?php echo e($fila->rol->nombre_rol); ?></td>
                                                <td>
                                                    <?php if(isset($fila->sucursal)): ?>
                                                        <?php echo e($fila->sucursal->nombre_sucursal); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(Auth::user()->accesoRuta('/usuario/update')): ?>  
                                                        <button type="button" class="btn btn-success btn-sm" id="editUsuario"                
                                                            data-toggle="modal" data-target="#editarUsuarioModal<?php echo e($fila->id); ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <?php echo $__env->make('modals.editarUsuarioModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                    <?php endif; ?>
                                                    <?php if(Auth::user()->accesoRuta('/usuario/delete')): ?>  
                                                        
                                                        <?php if($fila->estado_usuario == 1): ?>                                        
                                                            <a class="btn btn-danger btn-sm"title="Eliminar el usuario" href="<?php echo e(route('usuario.delete', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea eliminar este usuario del sistema?')"><i class="fa fa-trash-o"></i></a> 
                                                        <?php else: ?>
                                                            <a class="btn btn-warning btn-sm" title="Desbloquear el usuario" href="<?php echo e(route('usuario.desbloquear', ['id' => $fila->id])); ?>" onclick="
                                                                return confirm('Desea desbloquear este usuario del sistema?')"><i class="fa fa-unlock-alt"></i></a> 
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
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Sucursal</th>
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
<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/usuario/index.blade.php ENDPATH**/ ?>