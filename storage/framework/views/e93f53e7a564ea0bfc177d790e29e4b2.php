<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Menú</span> 
            <i class="zmdi zmdi-more"></i>
        </li>

    

        <?php $__currentLoopData = Auth::user()->rol->menu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pantalla_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <li>
                <a  
                    <?php if(Request::is($pantalla_menu->request_pantalla)): ?>
                        class="active"
                    <?php endif; ?>  
                    href="javascript:void(0);" data-toggle="collapse" data-target="#collapse<?php echo e($pantalla_menu->titulo_pantalla); ?>">
                    <div class="pull-left"><i class="<?php echo e($pantalla_menu->icono_pantalla); ?>"></i>
                        <span class="right-nav-text">
                            <?php echo e($pantalla_menu->nombre_pantalla); ?>

                        </span>
                    </div>
                    <div class="pull-right">
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                    <div class="clearfix"></div>
                </a>
                <ul id="collapse<?php echo e($pantalla_menu->titulo_pantalla); ?>" class="collapse collapse-level-1">
                    <?php if($pantalla_menu->url_pantalla != "#"): ?>
                        <?php if($pantalla_menu->nombre_pantalla=='Orden de Laboratorio'): ?>
                            <li>
                                <a href="<?php echo e($pantalla_menu->url_pantalla); ?>">Lista de Ordenes</a>
                            </li>                                
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e($pantalla_menu->url_pantalla); ?>">Lista de <?php echo e($pantalla_menu->nombre_pantalla); ?></a>
                            </li>                                 
                        <?php endif; ?>
                        
                    <?php endif; ?>
                    <?php $__currentLoopData = $pantalla_menu->subMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($pantalla_menu->id == $sub_menu->padre and $sub_menu->estado_pantalla==1 ): ?>   
                            <li>
                                <a href="<?php echo e($sub_menu->url_pantalla); ?>"><?php echo e($sub_menu->nombre_pantalla); ?></a>
                            </li>                             
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        
                    
                </ul>
            </li>     

                
                
                       
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        
    </ul>
</div><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/plantilla/sidebarleft.blade.php ENDPATH**/ ?>