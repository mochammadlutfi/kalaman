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
                            Social Profil Management
                        </h1>
                        <p class="text-muted fw-medium mb-4">
                            Tingkatkan penjualan bisnis Anda menggunakan Jasa Pengelolaan Media Sosial. Ada tidak perlu repot, Team Kalaman Multimedia Karya akan melakukannya untuk Anda.</a>.
                        </p>
                        <a class="btn btn-gd-main py-3 px-4" href="#harga">
                            <i class="fa fa-arrow-right opacity-50 me-1"></i> Pesan Sekarang
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
                                <div class="fs-5 text-muted mb-2">per bulan</div>
                                <p class="text-sm mb-2">{{ $d->deskripsi }}</p>
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