<?php $__env->startSection('titulo'); ?>
    Pacientes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>    
    <?php echo $__env->make('scripts.validaciones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los pacientes que estan registrados en el sistema.</p>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-lable-wrap left-label" id="addNewPaciente" data-toggle="modal" data-target="#addNewPacienteModal"> <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">Agregar Paciente</span></button>
            <?php echo $__env->make('modals.PacienteModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <br>
        <br>
        <br>
        <?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Pacientes</h6>
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
                                            <th>ID</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="font-size: 90%;">
                                            <td><?php echo e($fila->id); ?></td>
                                            <td><?php echo e($fila->identificacion_paciente); ?></td>
                                            <td><?php echo e($fila->nombre_paciente); ?> <?php echo e($fila->apellido_paciente); ?></td>
                                            <td><?php if($fila->sexo_paciente=="m"): ?><span class="label label-primary">Masculino</span><?php else: ?><span class="label label-info">Femenino</span><?php endif; ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($fila->fecha_nacimiento_paciente)->age); ?></td>
                                            <td><?php echo e($fila->telefono_paciente); ?></td>
                                            <td><p style="font-size: 90%;"><?php echo e($fila->email_paciente); ?></p></td>
                                            <td>
                                                <?php if(Auth::user()->accesoRuta('/consulta/create')): ?>  
                                                    <?php if(\Carbon\Carbon::parse($fila->fecha_nacimiento_paciente)->age>=18): ?>

                                                        <a class="btn btn-primary btn-sm btnIcono <?php if($fila->consultaActiva()): ?> disabled <?php endif; ?>" title="Crear Orden" href="<?php echo e(route('consulta.create2', ['id'=> $fila->id] )); ?>" class=""><i id="iconoBoton" class="fa fa-file"></i></a>

                                                    <?php else: ?>
                                                        <button type="button" title="Crear Consulta" class="btn btn-primary btn-sm btnIcono" id="crearConsulta"                
                                                            data-toggle="modal" data-target="#crearConsultaMenorModal<?php echo e($fila->id); ?>" <?php if($fila->consultaActiva()): ?> disabled <?php endif; ?>>
                                                            <i id="iconoBoton" class="fa fa-file"></i>
                                                        </button>
                                                        <?php echo $__env->make('modals.CrearConsultaMenorModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                    <?php endif; ?>
                                                <?php endif; ?> 

                                                <?php if(Auth::user()->accesoRuta('/orden_laboratorio/create')): ?>  

                                                    
                                                    <a class="btn btn-primary btn-sm btnIcono" title="Crear Orden" href="" class=""><i id="iconoBoton" class="fa fa-file"></i></a>

                                                <?php endif; ?>     
                                                <a class="btn btn-info btn-sm btnIcono" title="ver Historial" href="<?php echo e(route('paciente.verHistorial', ['id'=> $fila->id] )); ?>" class=""><i id="iconoBoton" class="fa fa-files-o"></i></a>
                                                <?php if(Auth::user()->accesoRuta('/paciente/update')): ?> 
                                                    
                                                    <button type="button" class="btn btn-success btn-sm btnIcono " id="editPaciente"                
                                                        data-toggle="modal" data-target="#editarPacienteModal<?php echo e($fila->id); ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <?php echo $__env->make('modals.editarPacienteModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                <?php endif; ?>
                                                
                                                <?php if(Auth::user()->accesoRuta('/paciente/delete')): ?> 
                                                    <?php if($fila->estado_paciente == 1): ?>

                                                        <a class="btn btn-danger btn-sm btnIcono" title="Eliminar paciente" href="<?php echo e(route('paciente.delete', ['id'=> $fila->id] )); ?>" onclick="
                                                        return confirm('Desea eliminar este paciente del sistema?')"><i class="fa fa-trash-o"></i></a>
                                                    
                                                    <?php else: ?>
                                                        
                                                        <a class="btn btn-warning btn-sm btnIcono" title="Desbloquear paciente" href="<?php echo e(route('paciente.desbloquear', ['id'=> $fila->id] )); ?>" onclick="
                                                        return confirm('Desea desbloquear este paciente del sistema?')"><i class="fa fa-unlock-alt"></i></a>
                                                    
                                                    <?php endif; ?> 
                                                <?php endif; ?>
                                                
                                                
                                            </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                    </tbody>
                                
                                    <tfoot>
                                        <tr>                                                                                   
                                            <th>ID</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
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
      null,
      null,
      { "width": "20%" }
    ],
    "pageLength": 15,
    lengthMenu: [15, 30, 50, 100],
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/paciente/index.blade.php ENDPATH**/ ?>