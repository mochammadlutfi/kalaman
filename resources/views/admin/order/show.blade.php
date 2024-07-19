<x-app-layout>
    <div class="bg-gd-dusk">
        <div class="content content-top text-center">
            <div class="py-4">
                <h1 class="fw-bold text-white mb-2">Detail Pemesanan</h1>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('admin.order.edit', $data->id) }}" class="btn rounded-pill btn-alt-primary me-2">
                        <i class="fa fa-edit me-1"></i>
                        Ubah
                    </a>
                    <button type="button" class="btn rounded-pill btn-alt-danger">
                        <i class="fa fa-close me-1"></i>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
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
                        <button class="nav-link active" id="btabs-animated-fade-home-tab" data-bs-toggle="tab"
                            data-bs-target="#btabs-animated-fade-home" role="tab" aria-controls="btabs-animated-fade-home"
                            aria-selected="true">
                            <i class="si fa-fw si-briefcase opacity-50 me-1"></i> Project
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="btabs-animated-fade-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#btabs-animated-fade-profile" role="tab"
                            aria-controls="btabs-animated-fade-profile" aria-selected="false" tabindex="-1">
                            <i class="si fa-fw si-wallet opacity-50 me-1"></i> Pembayaran
                        </button>
                    </li>
                </ul>
            </div>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade show active" id="btabs-animated-fade-home" role="tabpanel"
                    aria-labelledby="btabs-animated-fade-home-tab" tabindex="0">
                    <table class="table table-bordered w-100 table-vcenter" id="tableProject">
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
                <div class="tab-pane fade" id="btabs-animated-fade-profile" role="tabpanel"
                    aria-labelledby="btabs-animated-fade-profile-tab" tabindex="0">
                    <h4 class="fw-normal">Profile Content</h4>
                    <p>Content fades in..</p>
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
    <script>
        $(function () {
            var tableProject = $('#tableProject').DataTable({
                processing: true,
                serverSide: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                        "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    url : "{{ route('admin.payment.index') }}",
                    data : function(data){
                        data.booking_id = "{{ $data->id }}";
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

            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                        "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    url : "{{ route('admin.payment.index') }}",
                    data : function(data){
                        data.booking_id = "{{ $data->id }}";
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
        });

        $("#field-tgl").flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
            locale : "id",
            defaultDate : new Date(),
            minDate: "today"
        });

        function modalShow(id){
            $.ajax({
                url: "/admin/pembayaran/"+id,
                type: "GET",
                dataType: "html",
                success: function (response) {
                    var el = document.getElementById('modal-show');
                    $("#detailPembayaran").html(response);
                    var myModal = bootstrap.Modal.getOrCreateInstance(el);
                    myModal.show();
                },
                error: function (error) {
                }

            });
        }

        
        function updateStatus(id, status, booking_id){
            // console.log(status);
            $.ajax({
                url: "/admin/pembayaran/"+id +"/status",
                type: "POST",
                data : {
                    booking_id : booking_id,
                    status : status,
                    _token : $("meta[name='csrf-token']").attr("content"),
                },
                success: function (response) {
                    // console.log(response);
                    location.reload();
                    var el = document.getElementById('modal-show');
                    $('.datatable').DataTable().ajax.reload();
                    // $("#detailPembayaran").html(response);
                    var myModal = bootstrap.Modal.getOrCreateInstance(el);
                    myModal.hide();
                },
                error: function (error) {
                }
            });
        }

        $("#form-payment").on("submit",function (e) {
            e.preventDefault();
            var fomr = $('form#form-payment')[0];
            var formData = new FormData(fomr);
            let token   = $("meta[name='csrf-token']").attr("content");
            formData.append('_token', token);

            $.ajax({
                url: "{{ route('admin.payment.store') }}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.fail == false) {
                        $('.datatable').DataTable().ajax.reload();
                        var myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modal-normal'));
                        myModal.hide();
                    } else {
                        for (control in response.errors) {
                            $('#field-' + control).addClass('is-invalid');
                            $('#error-' + control).html(response.errors[control]);
                        }
                    }
                },
                error: function (error) {
                }

            });

        });
    </script>
    @endpush

</x-app-layout>
