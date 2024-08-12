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
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(function () {
            var table = $('#tableTask').DataTable({
                processing: true,
                serverSide: true,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'r" +
                        "ow'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    url : "{{ route('user.project.task', ['id' => $data->order_id, 'project' => $data->id]) }}",
                    data : function(data){
                        data.project_id = "{{ $data->id }}";
                    },
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    }, {
                        data: 'tgl_tempo',
                        name: 'tgl_tempo'
                    }, {
                        data: 'tgl_upload',
                        name: 'tgl_upload'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'status_upload',
                        name: 'status_upload'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });
        });
    </script>
@endpush
</x-landing-layout>