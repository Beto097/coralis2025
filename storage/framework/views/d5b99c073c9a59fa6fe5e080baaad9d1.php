<?php $__env->startSection('titulo'); ?>
    Consulta
<?php $__env->stopSection(); ?>



<?php $__env->startSection('contenido'); ?>
<br>
<br>

<!--muestro el error-->
<?php echo $__env->make('plantilla.errores', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- fin del error-->
<div class="col-sm-12">
  <div class="panel panel-default card-view">
      <div class="panel-heading">
          <div class="pull-left">
              <h6 class="panel-title txt-dark"><?php echo e($paciente->nombre_paciente); ?> <?php echo e($paciente->apellido_paciente); ?> </h6>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-3">
              <div class="card">
                  <div class="card-body">
                      <h3 class="card-title mb-3 text-center"></h3>
                      <ul class="list-unstyled mb-0">
                          <li class="" style="font-size: 130%"><i class="mdi mdi-card-account-details me-2 text-success font-size-18"></i> <b>
                          Cédula</b> : <?php echo e($paciente->identificacion_paciente); ?></li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-account me-2 text-success font-size-18"></i> <b>
                            Nombre</b> : <?php echo e($paciente->nombre_paciente); ?> <?php echo e($paciente->apellido_paciente); ?> </li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-gender-male-female me-2 text-success font-size-18"></i> <b>
                                  Sexo </b> : <?php if($paciente->sexo_paciente=='m'): ?>
                                      Masculino
                                  <?php else: ?>
                                      Femenino
                                  <?php endif; ?></li>
                          <li class="" style="font-size: 130%"><i
                                  class="mdi mdi-cake-variant text-success font-size-18 mt-2 me-2"></i>
                              <b> Edad </b> : <?php echo e(\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age); ?>

                          </li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-phone me-2 text-success font-size-18"></i> <b>
                            Telefono</b> : <?php echo e($paciente->telefono_paciente); ?></li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-human-male-female me-2 text-success font-size-18"></i> <b>
                              Estado Civil</b> : <?php echo e($paciente->estado_civil_paciente); ?></li>
                          <li class="" style="font-size: 130%"><i
                                class="mdi mdi-city text-success font-size-18 mt-2 me-2"></i>
                            <b>Lugar de Trabajo</b> : <?php echo e($paciente->lugar_trabajo); ?>

                        </li>
                          <li class="" style="font-size: 130%"><i
                                  class="mdi mdi-map-marker text-success font-size-18 mt-2 me-2"></i>
                              <b>Direccion</b> : <?php echo e($paciente->direccion_paciente); ?>

                          </li>
                          <?php if(\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age<18): ?>
                                        <li class="" style="font-size: 130%"><i
                                          class="mdi mdi-account-multiple text-success font-size-18 mt-2 me-2"></i>
                                      
                                  </li>
                                  <li class="" style="font-size: 130%"><i
                                    class="mdi mdi-account-multiple text-success font-size-18 mt-2 me-2"></i>
                                <b>Parentesco</b> : <?php echo e($consulta->parentesco_menor); ?>

                            </li>
                          <?php endif; ?>
                          
                      </ul>
                  </div>
                </div>  
              </div>
             
          </div>
      </div>
  </div>	
</div>
<div class="row">
    <div class="col-md-3">     
  
              
                
  
               
  
                
                
    </div>
  
    <div class="col-md-9">
      <div class="row" style="padding: 1rem;">
        <div class="col-md-10">
  
        </div>
        <div class="col-md-2">
  
          <?php if(isset($consulta)): ?>
            <?php if($consulta->estado_consulta != 'TERMINADA'): ?>
              <button type="button" class="btn btn-primary waves-effect waves-light"
                data-bs-toggle="modal" data-animation="bounce"
                data-bs-target=".addNewRegistroModal">
                Llenar Historial
              </button>
              <?php echo $__env->make('modals.RegistroModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>  
            <?php endif; ?>
              
          <?php endif; ?>
          
            
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                      <th>ID</th>                    
                      <th>Fecha</th>                    
                      <th>Diagnistico</th>
                      <th>Medico</th> 
                      <th>Acciones</th>
                    </tr>
                </thead>
  
  
                <tbody>
                  <?php $__currentLoopData = $paciente->consultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($fila->estado_consulta =='TERMINADA' ): ?>
                    <tr style="font-size: 100%;">
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e(\Carbon\Carbon::parse($fila->fecha_consulta)->format('Y-m-d')); ?></td>
                      <td><?php echo e($fila->diagnostico); ?></td>   
                      <td><?php echo e($fila->nombre_medico); ?></td>                 
                      <td>
                        
                        <?php if(Auth::user()->accesoRuta('/paciente/historia/clinica')): ?>
                                                
                          <button type="button" class="btn btn-primary waves-effect waves-light"
                            data-bs-toggle="modal" data-animation="bounce"
                            data-bs-target=".editarRegistroModal<?php echo e($fila->id); ?>">
                            Ver Historia
                          </button>
                          <?php echo $__env->make('modals.editarRegistroModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>  
                            
                        <?php endif; ?>
                        
                    </tr>
                    <?php endif; ?>
                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  
                </tbody> 
            </table>
          </div>
        </div>
      </div>
    </div>
        
    <!-- end col -->
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla.plantilla', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/consulta/iniciar.blade.php ENDPATH**/ ?>