<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Kalaman Project</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">

        @stack('styles')
        <!-- Scripts -->
        @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js', 'resources/js/app.js'])
        <style>
            .content-header{
                height: 5.25rem !important;
            }
        </style>
    </head>
    <body>
        <div id="page-container" class="main-content-boxed side-scroll">

            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="space-x-1">
                        <!-- Logo -->
                        <a class="fw-bold" href="{{ route('home') }}">
                            <img src="/images/logo.png" style="height: 80px;"/>
                        </a>
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->
                    <div class="d-flex">
                        
                        <ul class="nav-main nav-main-horizontal nav-main-hover me-2">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="#harga">
                                    <span class="nav-main-link-name">Harga</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">

                        @if (Auth::guard('web')->check())
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block fw-semibold">{{ Auth::guard('web')->user()->nama }}</span>
                                <i class="fa fa-angle-down opacity-50 ms-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                                aria-labelledby="page-header-user-dropdown">
                                <div class="px-2 py-3 bg-body-light rounded-top">
                                    <h5 class="h6 text-center mb-0">
                                        {{ Auth::guard('web')->user()->nama }}
                                    </h5>
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                        href="{{ route('profil.edit') }}">
                                        <span>Profil</span>
                                        <i class="fa fa-fw fa-user opacity-25"></i>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                        href="{{ route('user.training') }}">
                                        <span>Pelatihan Saya</span>
                                        <i class="fa fa-fw fa-user opacity-25"></i>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="{{ route('profil.password') }}">
                                        <span>Ubah Password</span>
                                        <i class="fa fa-fw fa-envelope-open opacity-25"></i>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            <span>Keluar</span>
                                            <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="space-x1">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Daftar</a>
                            </div>
                        @endif
                    </div>
                    <!-- END Middle Section -->
                </div>
                <!-- END Header Content -->
            </header>

            <!-- Page Content -->
            <main id="main-container">
                {{ $slot }}
            </main>
            <footer id="page-footer" class="bg-white">
                <div class="content py-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="/images/logo.png" style="width: 150px;" class="mb-3">
                            <address class="fs-sm">
                                Xircle by US Coworking Space, Jl. Terusan Buah Batu No.33, Batununggal, Kec. Bandung Kidul, Kota Bandung, Jawa Barat 40266
                            </address>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="h5 fw-bold mb-2">
                                Kontak Kami
                            </h4>
                            <ul class="fa-ul">
                                <li>
                                    <i class="fa fa-envelope fa-li"></i>
                                    <a href="mailto:sales@infotechglobal.id" target="_blank">
                                        sales@infotechglobal.id
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-phone fa-li"></i>
                                    <a href="tel:+6281288164118" target="_blank">
                                        +62812-8816-4118
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-phone fa-li"></i>
                                    <a href="tel:+6285113435440" target="_blank">
                                        +62851-1343-5440
                                    </a>
                                </li>
                                <li>
                                    <i class="fab fa-instagram fa-li"></i>
                                    <a href="https://www.instagram.com/infotechglobalindonesia" target="_blank">
                                        @infotechglobalindonesia
                                    </a>
                                </li>
                                <li>
                                    <i class="fab fa-linkedin fa-li"></i>
                                    <a href="https://www.linkedin.com/company/infotechglobalid/" target="_blank">
                                        @infotechglobalid
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="h5 fw-bold mb-2">
                                Layanan Kami
                            </h4>
                            <ul class="fa-ul fw-medium">
                                <li>
                                    <i class="fa fa-chevron-right fa-li"></i>
                                    <a href="{{ route('services.training') }}">
                                        IT Training
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-chevron-right fa-li"></i>
                                    <a href="{{ route('services.consultant') }}">
                                        IT Consultant
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        <script src="/js/jquery.min.js"></script>
        <script src="/js/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
        <script src="/js/plugins/flatpickr/l10n/id.js"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
        <script src="/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
        <script src="/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
        <script src="/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
        <script src="/js/plugins/datatables-buttons/buttons.print.min.js"></script>
        <script src="/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>