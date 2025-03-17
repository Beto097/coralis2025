

<?php $__env->startSection('titulo'); ?>
    Consultas
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los consultas que estan registrados en el sistema.</p>
        </div>
        <div class="col-sm-2">
          <?php if(Auth::user()->accesoRuta('/pantalla/create')): ?>
            <button class="btn btn-primary btn-lable-wrap left-label" id="addNewPantalla" data-toggle="modal" data-target="#addNewPantallaModal"> 
              <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">
                Agregar Pantalla
              </span>
            </button>
            <?php echo $__env->make('modals.PantallaModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>  
             
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
                        <h6 class="panel-title txt-dark">Consultas</h6>
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
                                        <th>Tiempo</th>                            
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                      </tr>
                                      
                                    </thead>
                                    
                                    <tbody>
                                      <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="font-size: 100%;">
                                          <td><?php echo e($key+1); ?></td>
                                          <td><?php echo e($fila->paciente->identificacion_paciente); ?></td>
                                          <td><?php echo e($fila->paciente->nombre_paciente); ?> <?php echo e($fila->paciente->apellido_paciente); ?></td>
                                          <td><?php if($fila->paciente->sexo_paciente=="m"): ?>M <?php else: ?> F <?php endif; ?></td>
                                          <td><?php echo e(\Carbon\Carbon::parse($fila->paciente->fecha_nacimiento_paciente)->age); ?></td> 
                                          <td><?php echo e(\Carbon\Carbon::parse($fila->created_at)->diffForHumans()); ?></td>                             
                                          <td><p><?php echo e($fila->estado_consulta); ?></p></td>
                                          <td>
                                            
                
                                            
                                            <?php if(Auth::user()->accesoRuta('/consulta/update')): ?>                        
                                              <a class="btn btn-info btn-sm btnIcono" title="Atender Consulta" href="<?php echo e(route('consulta.iniciar', ['id'=> $fila->id] )); ?>" class=""><i id="iconoBoton" class="fa fa-plus-square"></i></a>
                                              
                                            <?php endif; ?>  

                                            <?php if(Auth::user()->accesoRuta('/consulta/delete')): ?>
                                                <a class="btn btn-danger btn-sm btnIcono" title="Eliminar consulta" href="<?php echo e(route('consulta.delete', ['id'=> $fila->id] )); ?>" onclick="
                                                  return confirm('Desea eliminar este consulta del sistema?')"><i class="fa fa-trash-o"></i></a> 
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
                                        <th>Tiempo</th>                            
                                        <th>Estado</th>
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







<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/consulta/index.blade.php ENDPATH**/ ?>