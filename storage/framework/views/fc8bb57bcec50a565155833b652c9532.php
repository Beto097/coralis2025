

<?php $__env->startSection('titulo'); ?>
    Pantallas
<?php $__env->stopSection(); ?>


<?php $__env->startSection('contenido'); ?>
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los pantallas que estan registrados en el sistema.</p>
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
                        <h6 class="panel-title txt-dark">Pantallas</h6>
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
                                        <th>URL</th>       
                                        <th>Acciones</th>
                                      </tr>
                                      
                                    </thead>
                                    
                                    <tbody>
                                      <?php $__currentLoopData = $resultado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="font-size: 100%;">
                                          <td><?php echo e($fila->id); ?></td>
                                          <td><?php echo e($fila->nombre_pantalla); ?></td> 
                                          <td><?php echo e($fila->url_pantalla); ?></td>                        
                                          <td>
                                            
                                            
              
                                            <?php if(Auth::user()->accesoRuta('/pantalla/update')): ?>
                                            
                                              <button type="button" class="btn btn-success btn-sm" id="editPantalla"                
                                                  data-toggle="modal" data-target="#editarPantallaModal<?php echo e($fila->id); ?>">
                                                  <i class="fa fa-edit"></i>
                                              </button>
                                              <?php echo $__env->make('modals.editarPantallaModals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            <?php endif; ?>
                                            
              
                                            <?php if(Auth::user()->accesoRuta('/pantalla/delete')): ?>    
                                                                                  
                                              <a class="btn btn-danger btn-sm"title="Eliminar el pantalla" href="<?php echo e(route('pantalla.delete', ['id' => $fila->id])); ?>" onclick="
                                                  return confirm('Desea eliminar este pantalla del sistema?')"><i class="fa fa-trash-o"></i></a> 

                                            <?php endif; ?>
                                            
                                          </td>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       
                                    </tbody>
                                
                                    <tfoot>
                                      <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>URL</th>       
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







<?php echo $__env->make('plantilla.plantillaDT', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/pantalla/index.blade.php ENDPATH**/ ?>