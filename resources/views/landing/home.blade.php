<x-landing-layout>
    <div class="position-relative d-flex align-items-center">
        <div class="content content-full">
            <div class="row g-6 w-100 py-7 overflow-hidden">
                <div class="col-md-4 order-md-last py-4 d-md-flex align-items-md-center justify-content-md-end">
                    <img class="img-fluid" src="/images/mobile.png" alt="Hero Promo">
                </div>
                <div class="col-md-8 py-4 d-flex align-items-center">
                    <div class="text-center text-md-start">
                        <h1 class="fw-bold fs-2 mb-3">
                            Next generation, multipurpose UI framework for web apps
                        </h1>
                        <p class="text-muted fw-medium mb-4">
                            Codebase is a super flexible solution built with <span class="fw-semibold">Bootstrap
                                5</span>, <span class="fw-semibold">ES6</span> and <span
                                class="fw-semibold">Sass</span>. Use it to save time and create all kinds of web
                            applications with friendly and fast user interface. <span class="fw-semibold">No
                                jQuery</span> in core. Now with a brand new <a class="fw-semibold"
                                href="javascript:void(0)" data-toggle="layout" data-action="dark_mode_toggle">dark
                                mode</a>.
                        </p>
                        <a class="btn btn-alt-primary py-3 px-4" href="be_pages_dashboard.html" target="_blank">
                            <i class="fa fa-arrow-right opacity-50 me-1"></i> Enter Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-body-light">
        <div class="content content-full" id="harga">
            <div class="pt-5 pb-5">
                <div class="pb-4 position-relative">
                    <h2 class="fw-bold text-center mb-2">
                        Harga
                    </h2>
                    <p class="text-center fs-base text-muted">Tidak Puas Dengan Layanan Kami ?<br/>Kami Beri Garansi Uang Kembali Berlaku dari 30 Hari Sejak Tanggal Pembelian</p>
                </div>
                <div class="row py-4 justify-content-center">
                    @foreach ($paket as $d)
                    <div class="col-md-6 col-xl-3">
                        <!-- Startup Plan -->
                        <a class="block block-link-pop block-rounded block-bordered text-center" href="javascript:void(0)">
                            <div class="block-header">
                                <h3 class="block-title fs-lg fw-bold">{{ $d->nama }}</h3>
                            </div>
                            <div class="block-content p-3 bg-body-light">
                                <div class="fs-2 fw-bold mb-1">
                                    Rp {{ number_format($d->harga,0,',','.') }}</div>
                                <div class="fs-5 text-muted">per bulan</div>
                            </div>
                            <div class="block-content text-start">
                                <ul class="fa-ul">
                                    @foreach(explode(',', $d->fitur) as $f)
                                    <li><i class="fa fa-check fa-li"></i>{{ $f }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="block-content block-content-full">
                                <span class="btn btn-gd-main">
                                    <i class="fa fa-arrow-up opacity-50 me-1"></i> Pesan Sekarang
                                </span>
                            </div>
                        </a>
                        <!-- END Startup Plan -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>