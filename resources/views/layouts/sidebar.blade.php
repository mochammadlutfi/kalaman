<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="d-flex justify-content-lg-center pt-4">
            <!-- Logo -->
            <div>
                <img src="/images/logo.png" height="50px">
            </div>
            <!-- END Logo -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/beranda') ? ' active' : '' }}" href="{{ route('admin.beranda') }}">
                            <i class="nav-main-link-icon si si-grid"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/peserta') ? ' active' : '' }}" href="{{ route('admin.user.index') }}">
                            <i class="nav-main-link-icon si si-user"></i>
                            <span class="nav-main-link-name">Konsumen</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/order') ? ' active' : '' }}" href="{{ route('admin.order.index') }}">
                            <i class="nav-main-link-icon si si-energy"></i>
                            <span class="nav-main-link-name">Pemesanan</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/paket', 'admin/paket/*') ? ' active' : '' }}" href="{{ route('admin.paket.index') }}">
                            <i class="nav-main-link-icon fa fa-boxes-stacked"></i>
                            <span class="nav-main-link-name">Paket</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/project') ? ' active' : '' }}" href="{{ route('admin.project.index') }}">
                            <i class="nav-main-link-icon si si-briefcase"></i>
                            <span class="nav-main-link-name">Proyek</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/pembayaran') ? ' active' : '' }}" href="{{ route('admin.payment.index') }}">
                            <i class="nav-main-link-icon si si-wallet"></i>
                            <span class="nav-main-link-name">Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </div>
    <!-- Sidebar Content -->
</nav>