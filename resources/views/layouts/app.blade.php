<!doctype html>
@routes
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'L&F') }} | @yield('title')</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="index, follow">

    <link rel="stylesheet" id="css-main" href="{{asset('assets/admin/css/codebase.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/packages/toast/jquery.toast.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css')}}">
    <style>
        .avatar {
            background-color: #BE0306   ;
            border-radius: 50%;
            height: 64px;
            text-align: center;
            width: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .initials {
            font-size: 24px;
            line-height: 1;
            color: #000000;
            font-weight: bold;
            text-transform: uppercase;
        }

    </style>
    @yield('css')
</head>
<body>
@php
    $name = Auth::user()->name;
    $initials = '';
    $words = explode(' ', $name);
    for ($i = 0; $i < min(2, count($words)); $i++) {
        $initials .= $words[$i][0];
    }
@endphp
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
    <nav id="sidebar">
        <div class="sidebar-content">
            <div class="content-header justify-content-lg-center">
                <div>
                </div>

                <div>
                    <button type="button" class="btn btn-sm btn-alt-danger d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>


            <div class="js-sidebar-scroll">
                <div class="content-side content-side-user px-0 py-0">
                    <div class="smini-visible-block animated fadeIn px-3">
                        <img id="avatarImage" class="img-avatar img-avatar32"
                             src="{{ asset('assets/images/lyflogo2.jpg') }}" alt="">
                        <input type="file" id="avatarInput" style="display: none;">
                        <button id="changeAvatarBtn" class="btn btn-sm btn-alt-secondary">Cambiar Avatar</button>
                    </div>
                    <div class="smini-hidden text-center mx-auto">
                        <a class="img-link" href="javascript:void(0)">
                            <div class="avatar">
                                <span class="initials">{{$initials}}</span>
                            </div>
                        </a>
                        <ul class="list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a class="link-fx text-dual fs-sm fw-semibold text-uppercase"
                                   href="be_pages_generic_profile.html">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="link-fx text-dual" data-toggle="layout" data-action="dark_mode_toggle"
                                   href="javascript:void(0)">
                                    <i class="fa fa-moon"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="link-fx text-dual" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link active" href="{{route('home')}}">
                                <i class="nav-main-link-icon fa fa-house-user"></i>
                                <span class="nav-main-link-name">Inicio</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('employees')}}">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Empleados</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('customers')}}">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Clientes</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link" href="{{route('suppliers')}}">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">Provedores</span>
                            </a>
                        </li>


                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                               aria-expanded="false" href="#">
                                <i class="nav-main-link-icon fa fa-grip-vertical"></i>
                                <span class="nav-main-link-name">Inventario</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{route('products')}}">
                                        <span class="nav-main-link-name">Productos</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


    </nav>
    <header id="page-header">
        <div class="content-header">
            <div class="space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>
            <div class="space-x-1">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user d-sm-none"></i>
                        <span
                                class="d-none d-sm-inline-block fw-semibold text-capitalize">{{ Auth::user()->name }}</span>
                        <i class="fa fa-angle-down opacity-50 ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                         aria-labelledby="page-header-user-dropdown">
                        <div class="px-2 py-3 bg-body-light rounded-top">
                            <h5 class="h6 text-center mb-0 text-capitalize">
                                {{ Auth::user()->name }}
                            </h5>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="#">
                                <span>Perfíll</span>
                                <i class="fa fa-fw fa-user opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span>Salir</span>
                                <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="page-header-loader" class="overlay-header bg-primary">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="far fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
    </header>
    <main id="main-container">
        <div class="content">
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{asset('assets/admin/js/codebase.app.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/packages/toast/jquery.toast.min.js')}}"></script>

@yield('js')

<script>
  $(document).ready(function () {
    $('#changeAvatarBtn').on('click', function () {
      $('#avatarInput').click();
    });

    $('#avatarInput').on('change', function (e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#avatarImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    });
  });
</script>
</body>
</html>
