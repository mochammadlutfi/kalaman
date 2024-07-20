<x-app-layout>

    @push('styles')
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">
    @endpush

    <div class="bg-gd-dusk">
        <div class="content content-top text-center">
            <div class="pb-5 pt-2">
                <h1 class="fw-bold text-white mb-2">Kalender Project</h1>
                <h3 class="fs-4 text-white">{{ $data->nama }}</h3>
                <div class="d-flex justify-content-center">
                    {{-- <a href="{{ route('admin.project.edit', $data->id) }}" class="btn rounded-pill btn-alt-primary me-2">
                        <i class="fa fa-edit me-1"></i>
                        Ubah
                    </a>
                    <a href="{{ route('admin.project.edit', $data->id) }}" class="btn rounded-pill btn-alt-warning me-2">
                        <i class="si si-calendar me-1"></i>
                        Kalender
                    </a>
                    <button type="button" class="btn rounded-pill btn-alt-danger">
                        <i class="si si-trash me-1"></i>
                        Hapus
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block">
            <div class="block-content" id="calendar">
            </div>
        </div>
    </div>


    @push('scripts')
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/js/plugins/flatpickr/l10n/id.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales/id.global.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                initialView: 'dayGridMonth',
                events: {
                    url: "{{ route('admin.task.json') }}",
                    method: 'GET',
                    extraParams: {
                        project_id : "{{ $data->id }}",
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    },
                }
            });
            calendar.render();
      });
    </script>
    @endpush
</x-app-layout>

