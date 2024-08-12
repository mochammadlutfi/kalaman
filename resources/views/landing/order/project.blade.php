<x-landing-layout>
    
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header bg-gd-dusk">
                <h3 class="block-title text-white fw-semibold">Detail Project</h3>
                <div class="block-options">
                    <a href="{{ route('user.project.calendar', ['id' => $data->order_id, 'project' => $data->id]) }}" class="btn rounded-pill btn-alt-warning me-2">
                        <i class="si si-calendar me-1"></i>
                        Kalender
                    </a>
                </div>
            </div>
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-md-6">
                        <x-show-field label="Nama Project" value="{{ $data->nama }}"/>
                    </div>
                    <div class="col-md-6">
                        <x-show-field label="No Pemesanan" value="{{ $data->order->nomor }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="bg-gd-dusk block-header">
                <h3 class="block-title fs-4 fw-semibold mb-0 text-white">
                    Tugas
                </h3>
            </div>
            <div class="block-content p-4">
                <table class="table table-bordered w-100 table-vcenter" id="tableTask">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama</th>
                            <th>Tgl Tempo</th>
                            <th>Tgl Upload</th>
                            <th>Status</th>
                            <th>Status Upload</th>
                            <th width="60px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($task as $d)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>
                                    @if($d->status == 'Draft')
                                        <span class="badge bg-danger">Draft</span>
                                    @elseif($d->status == 'Pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($d->status == 'Selesai')
                                        <span class="badge bg-primary">Selesai</span>
                                    @elseif($d->status == 'Setuju')
                                        <span class="badge bg-success">Setuju</span>
                                    @elseif($d->status == 'Ditolak')
                                        <span class="badge bg-secondary">Ditolak</span>
                                    @endif
                                </td>
                                <td>

                                    @if($d->status_upload == 0)
                                        <span class="badge bg-danger">Belum Upload</span>
                                    @else
                                        <span class="badge bg-success">Sudah Upload</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-gd-main" onclick="detail({{json_encode($d)}})">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-show" aria-labelledby="modal-show" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header bg-gd-dusk">
                        <h3 class="block-title text-white">Detail Tugas</h3>
                        <div class="block-options">
                            <button type="button" class="text-white btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content p-4">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="row mb-3 fs-sm">
                                    <label class="col-sm-5 fw-medium">Nama Tugas</label>
                                    <div class="col-sm-7">: wq</div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">Link Brief</label>
                                    <div class="col-sm-7">: 
                                        <a href="wq" target="_blank" class="badge bg-primary px-3 text-white">Lihat Brief</a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">Status</label>
                                    <div class="col-sm-7">: <span class="badge bg-primary">Pending</span></div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">Tanggal Tempo</label>
                                    <div class="col-sm-7">
                                        : 12 Agustus 2024
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">Tanggal Upload</label>
                                    <div class="col-sm-7">
                                        : 12 Agustus 2024 19:51 WIB
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">Status Upload</label>
                                    <div class="col-sm-7">: <span class="badge bg-danger">Belum Upload</span></div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-5 fw-medium">File Task</label>
                                    <div class="col-sm-7">: 
                                        <a href="/uploads/task/1723467085.jpg" target="_blank" class="badge bg-primary px-3 text-white">
                                            Lihat File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(function () {
            var table = $('#tableTask').DataTable({
                processing: true,
                serverSide: false,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                        "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            });
        });

        function detail(data){
            var el = document.getElementById('modal-show');
            var myModal = bootstrap.Modal.getOrCreateInstance(el);
            myModal.show();
        }
    </script>
@endpush
</x-landing-layout>