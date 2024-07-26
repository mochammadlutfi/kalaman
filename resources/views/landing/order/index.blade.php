<x-landing-layout>
    <div class="bg-primary">
        <div class="content text-center">
            <div class="py-4">
                <h1 class="h2 fw-bold text-white mb-2">Program Pelatihan</h1>
                <h2 class="h5 fw-medium text-white-75">Kembangkan Keahlianmu Bersama Kami!</h2>
            </div>
        </div>
    </div>
    <div class="content content-full">
        <div class="row">
            @foreach ($data as $d)
                <div class="col-lg-6 mb-3">
                    <div class="block block-bordered block-rounded d-flex flex-column h-100 mb-0">
                        <div class="block-content flex-grow-1">
                            <div class="mb-2">
                                @if($d->status == 'buka')
                                    <span class="badge bg-primary">Buka</span>
                                {{-- @elseif($d->status == 'tutup') --}}
                                    {{-- <span class="badge bg-success">Berlangsung</span> --}}
                                @else
                                    <span class="badge bg-danger">Tutup</span>
                                @endif
                            </div>
                            <h5 class="fs-6 fw-medium mb-1">
                                <a class="text-dark" href="{{ route('training.show', $d->slug) }}">
                                    {{ $d->nama }}
                                </a>
                            </h5>
                        </div>
                        <div class="block-content py-3 bg-body-light flex-grow-0">
                            <div class="d-flex g-0 fs-sm text-center">
                                <div class="text-muted fw-semibold me-3">
                                    <i class="fa fa-users opacity-50 me-1"></i>
                                    {{ $d->slot }}
                                </div>
                                <div class="text-muted fw-semibold me-3">
                                    <i class="fa fa-fw fa-calendar-alt opacity-50 me-1"></i>
                                    @if(!empty($d->tgl_selesai) && Carbon\Carbon::parse($d->tgl_mulai)->isSameDay($d->tgl_selesai) == false)
                                        @if(Carbon\Carbon::parse($d->tgl_mulai)->isSameMonth($d->tgl_selesai))
                                            {{ Carbon\Carbon::parse($d->tgl_mulai)->translatedFormat('d') }} - {{ Carbon\Carbon::parse($d->tgl_selesai)->translatedFormat('d M Y') }}
                                        @else
                                            {{ Carbon\Carbon::parse($d->tgl_mulai)->translatedFormat('d M') }} - {{ Carbon\Carbon::parse($d->tgl_selesai)->translatedFormat('d M Y') }}
                                        @endif
                                    @else
                                        {{ Carbon\Carbon::parse($d->tgl_mulai)->translatedFormat('d M Y') }}
                                    @endif
                                </div>
                                <div class="text-muted fw-semibold">
                                    <i class="fa fa-map-pin opacity-50 me-1"></i>
                                    {{ $d->lokasi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-landing-layout>