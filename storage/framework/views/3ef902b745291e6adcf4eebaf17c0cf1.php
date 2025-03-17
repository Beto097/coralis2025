<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="<?php echo e(route('index')); ?>">
                    <img class="brand-img"  src="<?php echo e(asset('img/logo15.png')); ?>" alt="brand"/> 
                    <img class="brand-img1" src="<?php echo e(asset('img/logo11.png')); ?>"/>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        <form id="search_form" role="search" class="top-nav-search collapse pull-left">
            <div class="input-group">
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                </span>
            </div>
        </form>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li>
                <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
            </li>
            <li class="dropdown app-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
                <ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
                    <li>
                        <div class="app-nicescroll-bar">
                            <ul class="app-icon-wrap pa-10">
                                <?php $__currentLoopData = Auth::user()->rol->menu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pantalla_menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                    <?php if($pantalla_menu->url_pantalla <>'#'): ?>
                                        <li>
                                            <a href="<?php echo e($pantalla_menu->url_pantalla); ?>" class="connection-item">
                                            <i class="<?php echo e($pantalla_menu->icono_pantalla); ?> <?php echo e($pantalla_menu->color_pantalla); ?>"></i>
                                            <span class="block"><?php echo e($pantalla_menu->nombre_pantalla); ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                            </ul>
                        </div>	
                    </li>
                   
                </ul>
            </li>
            <li class="dropdown full-width-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-more-vert top-nav-icon"></i></a>
                <ul class="dropdown-menu mega-menu pa-0" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <li class="product-nicescroll-bar row">
                        <ul class="pa-20">
                            <li class="col-md-3 col-xs-6 col-menu-list">
                                <a href="javascript:void(0);"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                                <hr class="light-grey-hr ma-0"/>
                                <ul>
                                    <li>
                                        <a href="index.html">Analytical</a>
                                    </li>
                                    <li>
                                        <a href="index2.html">Demographic</a>
                                    </li>
                                    <li>
                                        <a href="index3.html">Project</a>
                                    </li>
                                    <li>
                                        <a href="index4.html">Hospital</a>
                                    </li>
                                    <li>
                                        <a href="index5.html">HRM</a>
                                    </li>
                                    <li>
                                        <a href="index6.html">Real Estate</a>
                                    </li>
                                    <li>
                                        <a href="profile.html">profile</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-xs-6 col-menu-list">
                                <a href="javascript:void(0);">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">E-Commerce</span>
                                    </div>	
                                    <div class="pull-right"><span class="label label-primary">hot</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                                <hr class="light-grey-hr ma-0"/>
                                <ul>
                                    <li>
                                        <a href="e-commerce.html">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="product.html">Products</a>
                                    </li>
                                    <li>
                                        <a href="product-detail.html">Product Detail</a>
                                    </li>
                                    <li>
                                        <a href="add-products.html">Add Product</a>
                                    </li>
                                    <li>
                                        <a href="product-orders.html">Orders</a>
                                    </li>
                                    <li>
                                        <a href="product-cart.html">Cart</a>
                                    </li>
                                    <li>
                                        <a href="product-checkout.html">Checkout</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-6 col-xs-12 preview-carousel">
                                <a href="javascript:void(0);"><div class="pull-left"><span class="right-nav-text">latest products</span></div><div class="clearfix"></div></a>
                                <hr class="light-grey-hr ma-0"/>
                                <div class="product-carousel owl-carousel owl-theme text-center">
                                    <a href="#">
                                        <img src="../img/chair.jpg" alt="chair">
                                        <span>Circle chair</span>
                                    </a>
                                    <a href="#">
                                        <img src="../img/chair2.jpg" alt="chair">
                                        <span>square chair</span>
                                    </a>
                                    <a href="#">
                                        <img src="../img/chair3.jpg" alt="chair">
                                        <span>semi circle chair</span>
                                    </a>
                                    <a href="#">
                                        <img src="../img/chair4.jpg" alt="chair">
                                        <span>wooden chair</span>
                                    </a>
                                    <a href="#">
                                        <img src="../img/chair2.jpg" alt="chair">
                                        <span>square chair</span>
                                    </a>								
                                </div>
                            </li>
                        </ul>
                    </li>	
                </ul>
            </li>
            <li class="dropdown alert-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i>
                    <span class="top-nav-icon-badge">
                        25
                    </span>
                        
                </a>
                <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">Notificaciones</span>
                            <a class="txt-danger pull-right clear-notifications inline-block" href="<?php echo e(route('notificacion.borrarTodas')); ?>"> Borrar Todas </a>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0"/>
                        </div>
                    </li>
                    <li>
                        <div class="streamline message-nicescroll-bar">
                                                     
                            
                        </div>
                    </li>
                    <li>
                        <div class="notification-box-bottom-wrap">
                            <hr class="light-grey-hr ma-0"/>
                            <a class="block text-center read-all" href="javascript:void(0)"> read all </a>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    
                        <?php echo e(Auth::user()->nombre_usuario); ?>

                    
                </a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    <?php if(Auth::user()): ?>
                        <li>
                            <a href="<?php echo e(route('usuario.update.password', ['id' => Auth::user()->id])); ?>"><i class="zmdi zmdi-lock"></i><span>Cambiar Contraseña</span></a>
                        </li>
                        <?php if(Auth::user()->sucursal): ?>
                            <li>
                                <a  data-toggle="modal" data-target="#actualizarSucursalModal"><i class="zmdi zmdi-home"></i><span><?php echo e(Auth::user()->sucursal->nombre_sucursal); ?></span></a>
                            </li> 
                            
                        <?php endif; ?>
                                                             
                    <?php endif; ?>
                    <li>
                        <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                    </li>
                    <li>
                        <a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                    </li>
                    <li class="divider"></li>
                    <li class="sub-menu show-on-hover">
                        <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
                        <ul class="dropdown-menu open-left-side">
                            <li>
                                <a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo e(route('login.cerrar')); ?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
</nav><?php /**PATH D:\Escritorio\Importante\Clientes\clinica nueva\clinicaNueva\resources\views/plantilla/navbar.blade.php ENDPATH**/ ?>