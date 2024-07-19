<x-landing-layout>
    <div class="bg-image" style="background-image: url('{{ $data->foto }}');">
        <div class="{{ ($data->foto) ? "bg-black-75" : "bg-primary" }}">
            <div class="content content-top text-start">
                <div class="py-4">
                    <h1 class="fw-bold text-white mb-2">{{ $data->nama }}</h1>
                    <div class="d-flex">
                        <div class="me-4 text-white text-start">
                            <div class="font-size-md fw-medium">Tgl Pendaftaran</div>
                            <div class="font-size-md">
                                <i class="fa fa-calendar-alt me-1"></i>
                                @if($data->tgl_selesai)
                                {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y')}}
                                @endif
                            </div>
                        </div>
                        <div class="me-4 text-white text-start">
                            <div class="font-size-md fw-medium">Tgl Pelatihan</div>
                            <div class="font-size-md">
                                <i class="fa fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($data->tgl)->format('d M Y')}}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="content content-full">
            <div class="row">
                <div class="col-lg-8">
                    <div class="block block-bordered rounded">
                        <div class="block-content p-3">
                            {!! $data->deskripsi !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="block block-rounded">
                        <div class="block-content p-3">
                            <h3 class="h5 fw-medium mb-2">Tanggal</h3>
                            <p class="mb-2">{{ \Carbon\Carbon::parse($data->tgl)->translatedformat('d F Y H:i')}}
                                WIB</p>
                            <h3 class="h5 fw-medium mb-2">Kuota</h3>
                            <p class="mb-2">{{ $data->slot }}
                                Peserta</p>
                            <h3 class="h5 fw-medium mb-2">Lokasi</h3>
                            <p class="mb-2">{!! $data->lokasi !!}</p>
                            <h3 class="h5 fw-medium mb-2">Harga</h3>
                            <p class="mb-2">
                                @if($data->harga)
                                Rp {{ number_format($data->harga,0,',','.') }}
                                @else Gratis @endif
                            </p>
                            @if (Auth::guard('web')->check())
                                @if($register)
                                    @if($register->status == 'lunas')
                                        @if ($data->status == 'tutup')
                                        <a href="{{ route('user.training.certificate', $data->id) }}" class="btn btn-alt-primary w-100">
                                            Download Sertifikat
                                        </a>
                                        @else
                                        <div class="border border-3 border-danger p-3 rounded-3 text-center w-100">
                                            Kamu Sudah Terdaftar
                                        </div>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-alt-primary w-100" onclick="snapShow('{{ $register->snap }}')">
                                            Menunggu Pembayaran
                                        </button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-alt-primary  w-100" id="btn-register">
                                        Daftar Sekarang
                                    </button>
                                @endif
                            @else
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">
                                Daftar Sekarang
                            </a>
                            @endif

                            @if($data->document)
                            <a href="{{ $data->document }}" target="_blank" class="btn btn-primary w-100">
                                Download Sylabus
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
            <script>
                $('#clock').countdown('2020/10/10 12:34:56')
                    .on('update.countdown', function(event) {
                    var format = '%H:%M:%S';
                    if(event.offset.totalDays > 0) {
                        format = '%-d day%!d ' + format;
                    }
                    if(event.offset.weeks > 0) {
                        format = '%-w week%!w ' + format;
                    }
                    $(this).html(event.strftime(format));
                    })
                    .on('finish.countdown', function(event) {
                    $(this).html('This offer has expired!')
                        .parent().addClass('disabled');

                    });
            
                    $("#btn-register").on("click", function(e){
                        $.ajax({
                            url: '{{ route("user.training.register") }}',
                            type: "POST",
                            data: {
                                training_id : "{{ $data->id }}",
                                _token : $("meta[name='csrf-token']").attr("content"),
                            },
                            success: function (response){
                                if(response.snapToken != ""){
                                    snap.pay(response.snapToken, {
                                        onSuccess: function(result) {
                                            console.log(result)
                                            // location.reload();
                                            if(result.transaction_status == 'settlement'){
                                                updateStatus(result.order_id, 'lunas');
                                            }
                                        },
                                        // Optional
                                        onPending: function(result) {
                                            console.log(result);
                                            // location.reload();
                                            if(result.transaction_status == 'settlement'){
                                                updateStatus(result.order_id, 'pending');
                                            }
                                        },
                                        // Optional
                                        onError: function(result) {
                                            /* You may add your own js here, this is just example */
                                            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                            console.log(result)
                                            // location.reload();
                                        }
                                    });
                                }else{
                                    location.reload();
                                }
                            }
                        });
                    });


                    function updateStatus(id, status){
                        $.ajax({
                            url: '{{ route("user.training.update") }}',
                            type: "POST",
                            data: {
                                id : id,
                                status : status,
                                _token : $("meta[name='csrf-token']").attr("content"),
                            },
                            success: function (response){
                                location.reload();
                                console.log(response);
                            }
                        });
                    }

                    function snapShow(snap){
                        window.snap.pay(snap, {
                            // Optional
                            onSuccess: function(result) {
                                // console.log(result);
                                // location.reload();
                                updateStatus("{{ $data->id }}", "lunas");
                            },
                            // Optional
                            onPending: function(result) {
                                console.log(result);
                                // location.reload();/
                                updateStatus("{{ $data->id }}", "pending");
                            },
                            // Optional
                            onError: function(result) {
                                console.log(result);
                                // location.reload();
                            }
                        });
                    }
            </script>
        @endpush
    </x-landing-layout>