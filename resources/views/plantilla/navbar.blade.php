<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="{{route('index')}}">
                    <img class="brand-img"  src="{{asset('img/logo15.png')}}" alt="brand"/> 
                    <img class="brand-img1" src="{{asset('img/logo11.png')}}"/>
                </a>
            </div>
        </div>	
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        {{-- <form id="search_form" role="search" class="top-nav-search collapse pull-left">
            <div class="input-group">
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                </span>
            </div>
        </form> --}}
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
           {{--  <li>
                <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
            </li> --}}
            <li class="dropdown app-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
                <ul class="dropdown-menu app-dropdown" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
                    <li>
                        <div class="app-nicescroll-bar">
                            <ul class="app-icon-wrap pa-10">
                                @foreach (Auth::user()->rol->menu() as $pantalla_menu)  
                                    @if ($pantalla_menu->url_pantalla <>'#')
                                        <li>
                                            <a href="{{$pantalla_menu->url_pantalla}}" class="connection-item">
                                            <i class="{{$pantalla_menu->icono_pantalla}} {{$pantalla_menu->color_pantalla}}"></i>
                                            <span class="block">{{$pantalla_menu->nombre_pantalla}}</span>
                                            </a>
                                        </li>
                                    @endif 
                                @endforeach
                               
                            </ul>
                        </div>	
                    </li>
                   
                </ul>
            </li>
            
            <li class="dropdown alert-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i>
                    <span class="top-nav-icon-badge">
                        25
                    </span>
                        {{-- @if ($cantidad_notificaciones>0)
                            <span class="top-nav-icon-badge">
                                {{$cantidad_notificaciones}}
                            </span>
                        @endif --}}
                </a>
                <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">Notificaciones</span>
                            <a class="txt-danger pull-right clear-notifications inline-block" href="{{route('notificacion.borrarTodas')}}"> Borrar Todas </a>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0"/>
                        </div>
                    </li>
                    <li>
                        <div class="streamline message-nicescroll-bar">
                           {{--  @if ($cantidad_notificaciones==0)
                            <div class="sl-item">
                                <a href="javascript:void(0)">                                    
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                            Sin Notificaciones
                                        </span>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>
                            @else
                                
                                @foreach ($notificaciones as $notificacion)
                                    @if ($notificacion->type =='App\Notifications\notificacionsOrdenes')

                                        <?php
                                            $data = json_decode($notificacion->data, true);
                                                    
                                            $id_orden =  $data["orden_id"]; 
                                        ?>
                                        <div class="sl-item">
                                            <a href="{{route('notificacion.orden', ['id'=> $id_orden] )}}">
                                                <div class="icon bg-green">
                                                    <i class="zmdi zmdi-flag"></i>
                                                </div>
                                                <div class="sl-content">
                                                    <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                                    Nueva Orden de Laboratorio
                                                    </span>
                                                    <span class="inline-block font-11  pull-right notifications-time">{{Carbon\Carbon::parse($notificacion->created_at)->diffForHumans()}}</span>
                                                    <div class="clearfix"></div>
                                                    <p class="truncate">
                                                        <?php
                                                            $data = json_decode($notificacion->data, true);
                                                                    
                                                            echo $data["mensaje"]; 
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>	
                                        </div>
                                        <hr class="light-grey-hr ma-0"/>
                                        
                                    @endif 
                                    @if ($notificacion->type =='App\Notifications\ordenTerminada')
                                        
                                        <?php
                                            $data = json_decode($notificacion->data, true);
                                                    
                                            $id_orden =  $data["orden_id"]; 
                                        ?>
                                        <div class="sl-item">
                                            <a href="{{route('notificacion.ordenTerminada', ['id'=> $id_orden] )}}">
                                                <div class="icon bg-blue">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="sl-content">
                                                    <span class="inline-block capitalize-font  pull-left truncate head-notifications">Orden Terminada</span>
                                                    <span class="inline-block font-11  pull-right notifications-time">{{Carbon\Carbon::parse($notificacion->created_at)->diffForHumans()}}</span>
                                                    <div class="clearfix"></div>
                                                    <p class="truncate">
                                                        <?php
                                                            $data = json_decode($notificacion->data, true);
                                                                    
                                                            echo $data["mensaje"]; 
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>	
                                        </div>
                                        <hr class="light-grey-hr ma-0"/>
                                       
                                    @endif 
                                    @if ($notificacion->type =='App\Notifications\nuevoUsuario')
                                        <?php
                                            $data = json_decode($notificacion->data, true);
                                                    
                                            $identificacion =  $data["identificacion_paciente"]; 
                                        ?>
                                        <div class="sl-item">
                                            <a href="{{route('paciente.verPassword', ['id'=> $identificacion ] )}}">
                                                <div class="icon bg-yellow">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="sl-content">
                                                    <span class="inline-block capitalize-font  pull-left truncate head-notifications">Nuevo Usuario</span>
                                                    <span class="inline-block font-11  pull-right notifications-time">{{Carbon\Carbon::parse($notificacion->created_at)->diffForHumans()}}</span>
                                                    <div class="clearfix"></div>
                                                    <p class="truncate">
                                                        <?php
                                                            $data = json_decode($notificacion->data, true);
                                                                    
                                                            echo $data["mensaje"]; 
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>	
                                        </div>
                                        <hr class="light-grey-hr ma-0"/>                                        
                                        
                                    @endif 
                                    
                                @endforeach
                            @endif   --}}                          
                            
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
                    
                        {{Auth::user()->nombre_usuario}}
                    
                </a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    @if (Auth::user())
                        <li>
                            <a href="{{route('usuario.update.password', ['id' => Auth::user()->id])}}"><i class="zmdi zmdi-lock"></i><span>Cambiar Contraseña</span></a>
                        </li>
                        @if (Auth::user()->sucursal)
                            <li>
                                <a  data-toggle="modal" data-target="#actualizarSucursalModal"><i class="zmdi zmdi-home"></i><span>{{Auth::user()->sucursal->nombre_sucursal}}</span></a>
                            </li> 
                            
                        @endif
                                                             
                    @endif
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
                        <a href="{{route('login.cerrar')}}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
</nav>