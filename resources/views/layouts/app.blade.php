<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Academics - Dashboard</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="icon" type="image/ico" href="{{ asset('landing/images/icono.ico') }}" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fonts.googleapis.com.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
        <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace-rtl.min.css') }}" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="{{ asset('dashboard/assets/css/ace-ie.min.css') }}" />
    <![endif]-->

    <!-- inline styles related to this page -->
    <link rel="stylesheet" href="{{ asset('toast/jquery.toast.min.css') }}" />
    <!-- ace settings handler -->
    <script src="{{ asset('dashboard/assets/js/ace-extra.min.js') }}"></script>

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{ asset('dashboard/assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/respond.min.js') }}"></script>
    <![endif]-->
    @yield('styles')
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="{{ route('home') }}" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    DASHBOARD
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="green dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">5</span>
                    </a>
                </li>

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{ asset('dashboard/assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
                        <span class="user-info">
                            <small>Bienvenido,</small>
                            {{ Auth::user()->name }}
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                Perfil
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>{{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <ul class="nav nav-list">
            <li class="">
                <a href="{{ url('/') }}">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Academic </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="{{ url('/') }}">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Perfil </span>
                </a>

                <b class="arrow"></b>
            </li>

            @can('users.index')
            <li class="@yield('openUsers')">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
								Módulo Usuarios
							</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">

                    @can('users.index')
                    <li class="@yield('indexUsers')">
                        <a href="{{ route('users.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visualizar
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endcan

                    @can('users.create')
                    <li class="@yield('createUsers')">
                        <a href="{{ route('users.create') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Crear
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endcan

                </ul>
            </li>
            @endcan

            @can('roles.index')
            <li class="@yield('openRoles')">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Módulo Roles </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    @can('roles.index')
                    <li class="@yield('indexRoles')">
                        <a href="{{ route('roles.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visualizar
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endcan
                    @can('roles.create')
                    <li class="@yield('createRoles')">
                        <a href="{{ route('roles.create') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Crear
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            <li class="@yield('openPermission')">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Módulo permisos </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="@yield('indexPermission')">
                        <a href="{{ route('permission.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visualizar
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @can('courses.index')
            <li class="@yield('openCourses')">

                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Módulo cursos </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    @can('courses.index')
                    <li class="@yield('indexCourses')">
                        <a href="{{ route('courses.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visualizar
                        </a>

                        <b class="arrow"></b>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('teachers.index')
            <li class="@yield('openTeachers')">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Módulo docentes </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="@yield('indexTeachers')">
                        <a href="{{ route('teachers.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Visualizar
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            @endcan
        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            @yield('breadcrumbs')

            <div class="page-content">
                <!-- PAGE CONTENT BEGINS -->
                @if (session('info'))
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="alert alert-success">
                                    {{ session('info') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @yield('content')
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">Ace Master</span>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved by Edesce
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </span>
                <span class="action-buttons">
                    <a href="#">
                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->
<script src="{{ asset('dashboard/assets/js/jquery-2.1.4.min.js') }}"></script>
<!--[if !IE]> -->

<!-- <![endif]-->

<!--[if IE]>
<script src="{{ asset('dashboard/assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('dashboard/assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>
<script src="{{ asset('dashboard/assets/js/bootstrap.min.js') }}"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="{{ asset('dashboard/assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/ace.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script src="{{ asset('toast/jquery.toast.min.js') }}"></script>
@yield('scripts')
</body>
</html>

