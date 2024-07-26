<x-landing-layout>
    <div class="content content-full">
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header bg-gd-dusk">
                        <h3 class="block-title text-white fw-semibold">Pesanan Saya</h3>
                        <div class="block-options">

                        </div>
                    </div>
                    <div class="block-content p-3">
                        <table class="table table-bordered datatable w-100 table-vcenter">
                            <thead>
                                <tr>
                                    <th width="300px">Nomor</th>
                                    <th width="200px">Paket</th>
                                    <th width="200px">Tanggal</th>
                                    <th width="200px">Durasi</th>
                                    <th width="200px">Status</th>
                                    <th width="60px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $(function () {
                $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    dom : "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    ajax: "{{ route('user.order') }}",
                    columns: [
                        {data: 'nomor', name: 'nomor'},
                        {data: 'paket.nama', name: 'paket.nama'},
                        {data: 'tgl', name: 'tgl'},
                        {data: 'durasi', name: 'durasi'},
                        {data: 'status', name: 'status'},
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