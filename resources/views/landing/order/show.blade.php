<x-landing-layout>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header bg-gd-dusk">
                <h3 class="block-title text-white fw-semibold">Detail Pesanan</h3>
                <div class="block-options">

                </div>
            </div>
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-show-field label="Konsumen" value="{{ $data->user->nama }}"/>
                        <x-show-field label="Tanggal pesan" value="{{ \Carbon\Carbon::parse($data->tgl)->translatedFormat('d F Y') }}"/>
                        <x-show-field label="Harga per bulan" value="Rp {{ number_format($data->paket->harga,0,',','.') }}"/>
                    </div>
                    <div class="col-md-6">
                        <x-show-field label="Paket" value="{{ $data->paket->nama }}"/>
                        <x-show-field label="Durasi" value="{{ $data->durasi }} Bulan"/>
                        <x-show-field label="Total" value="Rp {{ number_format($data->total,0,',','.') }}"/>

                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded overflow-hidden">
            <div class="p-4 border-bottom border-2">
                <ul class="nav nav-tabs nav-fill nav-pills" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="btabs-project-tab" data-bs-toggle="tab"
                            data-bs-target="#btabs-project" role="tab" aria-controls="btabs-project"
                            aria-selected="true">
                            <i class="si fa-fw si-briefcase opacity-50 me-1"></i> Project
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="btabs-payment-tab" data-bs-toggle="tab"
                            data-bs-target="#btabs-payment" role="tab"
                            aria-controls="btabs-payment" aria-selected="false" tabindex="-1">
                            <i class="si fa-fw si-wallet opacity-50 me-1"></i> Pembayaran
                        </button>
                    </li>
                </ul>
            </div>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade show active" id="btabs-project" role="tabpanel"
                    aria-labelledby="btabs-project-tab" tabindex="0">
                    <table class="table table-bordered w-100" id="tableProject">
                        <thead>
                            <tr>
                                <th width="60px">No</th>
                                <th width="200px">Nama</th>
                                <th width="200px">No Pesanan</th>
                                <th width="200px">Total Tugas</th>
                                <th width="60px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="btabs-payment" role="tabpanel"
                    aria-labelledby="btabs-payment-tab" tabindex="0">
                    <table class="table table-bordered w-100 table-vcenter" id="tablePayment">
                        <thead>
                            <tr>
                                <th width="60px">No</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th width="60px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
            class="modal"
            id="modal-normal"
            tabindex="-1"
            aria-labelledby="modal-normal"
            style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-payment"  onsubmit="return false;" enctype="multipart/form-data">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Pembayaran</h3>
                                <div class="block-options">
                                    <button
                                        type="button"
                                        class="btn-block-option"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm">
                                <input type="hidden" name="booking_id" value="{{ $data->id }}"/>
                                <div class="mb-4">
                                    <label for="field-tgl">Tanggal</label>
                                    <input type="text" class="form-control" id="field-tgl" name="tgl" placeholder="Masukan Tanggal">
                                    <div class="invalid-feedback" id="error-tgl">Invalid feedback</div>
                                </div>
                                <div class="mb-4">
                                    <label for="field-jumlah">Jumlah</label>
                                    <input type="number" value="{{ $data->total_bayar - $data->bayar_sum_jumlah }}" class="form-control" id="field-jumlah" name="jumlah" placeholder="Masukan Jumlah">
                                    <div class="invalid-feedback" id="error-jumlah">Invalid feedback</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="field-bukti">Bukti Bayar</label>
                                    <input class="form-control" type="file" name="bukti" id="field-bukti">
                                    <div class="invalid-feedback" id="error-bukti">Invalid feedback</div>
                                </div>
                                <div
                                    class="block-content block-content-full block-content-sm text-end border-top">
                                    <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
                                        batal
                                    </button>
                                    <button type="submit" class="btn btn-alt-primary" id="btn-simpan">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="modal"
            id="modal-show"
            tabindex="-1"
            aria-labelledby="modal-show"
            style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="form-payment"  onsubmit="return false;" enctype="multipart/form-data">
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Detail Pembayaran</h3>
                                <div class="block-options">
                                    <button
                                        type="button"
                                        class="btn-block-option"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content fs-sm" id="detailPembayaran">
                            </div>
                        </div>
                    </form>
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
        $(function () {
            var tablePayment = $('#tablePayment').DataTable({
                processing: true,
                serverSide: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                        "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    url : "{{ route('user.order.payment.data', $data->id) }}",
                    data : function(data){

                    },
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'tgl',
                        name: 'tgl'
                    }, {
                        data: 'jumlah',
                        name: 'jumlah'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });

            var tablePayment = $('#tableProject').DataTable({
                    processing: true,
                    serverSide: true,
                    dom : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: {
                        url : "{{ route('user.project', $data->id) }}",
                        data : function(data){

                        },
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'nama', name: 'nama'},
                        {data: 'order.nomor', name: 'order.nomor'},
                        {data: 'task_count', name: 'task_count'},
                        {
                            data: 'action', 
                            name: 'action', 
                            orderable: true, 
                            searchable: true
                        },
                    ]
                });
        });
        </script>
    @endpush
</x-landing-layout>