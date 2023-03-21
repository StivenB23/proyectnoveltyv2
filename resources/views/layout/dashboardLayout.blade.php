<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AsisQuick</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/LOGO_ASISQUICK.png') }}" />

    <!--Datatable CSS-->
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo fw-bold fs-2" href="{{ route('dashboard') }}"><img
                        src="{{ asset('assets/images/logoSena.png') }}" alt="logo sena"
                        style="width: 30px; height:30px"> AsisQuick</a>
                <a class="navbar-brand brand-logo-mini fw-bold" href="{{ route('dashboard') }}"> <i
                        class="mdi mdi-buffer me-2 text-primary"></i></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <div class=" bg-gradient-info text-white fw-bold text-center rounded-circle"></div>
                                <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon">
                                    {{ Auth::user()->name[0] }}{{ Auth::user()->lastname[0] }}
                                </button>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" title="Ir arriba"></a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-light">
                                    <i class="mdi mdi-logout me-2 text-primary"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-arrow-up-bold"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <button type="button" class="btn btn-gradient-primary btn-rounded btn-icon">
                                    {{ Auth::user()->name[0] }}{{ Auth::user()->lastname[0] }}
                                </button>
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ Auth::user()->name }}
                                    {{ Auth::user()->lastname }}</span>
                                <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#novelties" aria-expanded="false"
                            aria-controls="novelties">
                            <span class="menu-title">Novedades</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-alert-octagon menu-icon"></i>
                        </a>
                        <div class="collapse" id="novelties">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('myAmbient') }}">Mi
                                        ambiente</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('novelty') }}">Registrar
                                        Novedad</a></li>
                                @if (Auth::user()->role === 'administrador')
                                    <li class="nav-item"> <a class="nav-link"
                                            href="pages/ui-features/typography.html">Listar Novedades</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @if (Auth::user()->role === 'administrador')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false"
                                aria-controls="users">
                                <span class="menu-title">Usuarios</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('formUser') }}">Registrar Usuario</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="{{ route('users') }}">Listar
                                            Usuarios</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classrooms') }}">
                            <span class="menu-title">Ambientes</span>
                            <i class="mdi mdi-chair-school menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('setting') }}">
                            <span class="menu-title">Configuración</span>
                            <i class="mdi mdi-settings menu-icon"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        @yield('content')

                    </div>

                </div>

            </div>
        </div>
    </div>
    <footer>
      <p class="text-center "> <span class="text-primary fs-5" >&copy;</span> 2023 SENA todos los derechos reservados</p>
    </footer>
    @include('sweetalert::alert')
    <!-- End custom js for this page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/todo.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
    <!-- Custom js for this page -->
    <!--Datatable Js-->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"
        type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
</body>

</html>
