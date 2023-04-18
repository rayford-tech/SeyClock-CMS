<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        {{-- <meta name="description" content="Smarthr - Bootstrap Admin Template" /> --}}
        {{-- <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects" /> --}}
        {{-- <meta name="author" content="Dreamguys - Bootstrap Admin Template" /> --}}
        <meta name="robots" content="noindex, nofollow" />
        <title>{{env('APP_NAME')}}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>

    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />

        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="/assets/css/line-awesome.min.css" />
        @livewireStyles

        <!-- Main CSS -->
        <link rel="stylesheet" href="/assets/css/style.css" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/override.css">

        <style>
            .logo{
                width: 154px;
                object-fit: contain;
                height: 83px;
            }
        </style>
        @yield('links')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="/assets/js/html5shiv.min.js"></script>
            <script src="/assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Header -->
            <div class="header">
                <!-- Logo -->
                <div class="header-left">
                    <a href="index.html" class="logo">
                        <img src="/assets/img/logo.jpg" width="40" height="40" alt="" class="logo"/>
                        {{-- <h3>SeyClock</h3> --}}
                    </a>
                </div>
                <!-- /Logo -->

                <a id="toggle_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <!-- Header Title -->
                <div class="page-title-box">
                    <h3>{{env('APP_NAME')}}</h3>
                </div>
                <!-- /Header Title -->

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <!-- Header Menu -->
                <ul class="nav user-menu">
                    <!-- Search -->
                    <li class="nav-item">
                        <div class="top-nav-search">
                            <a href="javascript:void(0);" class="responsive-search">
                                <i class="fa fa-search"></i>
                            </a>
                            <form action="#">
                                <input class="form-control" type="text" placeholder="Search here" />
                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                    <!-- /Search -->

                    <!-- Flag -->
                    <li class="nav-item dropdown has-arrow flag-nav">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"> <img src="/assets/img/flags/us.png" alt="" height="20" /> <span>English</span> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0);" class="dropdown-item"> <img src="/assets/img/flags/us.png" alt="" height="16" /> English </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="/assets/img/user.jpg" alt="" /> <span class="status online"></span></span>
                            <span>Admin</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                            document.getElementById('lgform').submit();">Logout</a>
                        </div>
                        <form method="POST" id="lgform" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- /Header Menu -->

                <!-- Mobile Menu -->
                <div class="dropdown mobile-user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </div>
                <!-- /Mobile Menu -->
            </div>
            <!-- /Header -->

            <!-- Sidebar -->
            @include('backend.components.sidebar')
            <!-- /Sidebar -->

            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <div class="alert alert-{{$msg}} alert-dismissible fade show" role="alert">
                            {{ Session::get('alert-' . $msg) }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endif
                    @endforeach


                    <!-- Page Header -->
                    @yield('heading')
                    <!-- /Page Header -->

                    <!-- Content Starts -->
                    @yield('content')
                    <!-- /Content End -->
                </div>
                <!-- /Page Content -->
            </div>
            <!-- /Page Wrapper -->
        </div>
        <!-- /Main Wrapper -->

        <!-- jQuery -->
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
        {{-- <script src="/assets/js/jquery-3.2.1.min.js"></script> --}}

        <!-- Bootstrap Core JS -->
        <script src="/assets/js/popper.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>

        <!-- Slimscroll JS -->
        <script src="/assets/js/jquery.slimscroll.min.js"></script>

        <!-- Custom JS -->
        <script src="/assets/js/app.js"></script>
        @yield('scripts')
    </body>
</html>
