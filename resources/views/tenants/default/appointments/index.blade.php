@extends('tenants.default.layouts.panel')

@section('title', 'Citas Agendadas - ' . tenantSetting('name', 'Tenant'))

@section('sidebar')
    @include('tenants.default.layouts.sidebar')
@endsection

@section('content')
    <style>
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid #ccc !important;
            border-radius: 12px;
            overflow: hidden;
        }
        .fc-theme-standard td,
        .fc-theme-standard th {
            border: 1px solid #dee2e6;
        }
        .fc .fc-daygrid-day-frame {
            padding: 6px;
            display: block;
        }
        .fc .fc-daygrid-event {
            font-size: 0.875rem;
            padding: 2px 4px;
            border: none;
            border-radius: 4px;
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .fc .fc-col-header-cell-cushion,
        .fc .fc-toolbar-title,
        .fc .fc-daygrid-day-number {
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
        }

        .fc .fc-col-header-cell-cushion {
            text-transform: capitalize;
        }
        
        .fc .fc-toolbar-title {
            text-transform: capitalize;
            font-weight: bold;
        }
        .fc .fc-daygrid-more-link {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 2px;
            padding: 2px 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            background-color: #198754; /* verde */
            color: #ffffff; /* blanco */
            border-radius: 4px;
            text-decoration: none !important;
            pointer-events: auto;
        }

    </style>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-calendar-check me-2"></i>{{ __('Citas Agendadas') }}
            </h3>
            <a href="{{ route('available-slots.index') }}" class="btn btn-sm"
                style="background-color: {{ tenantSetting('background_color_1', '#F5E8D0') }};
                    color: {{ tenantSetting('text_color_1', '#8C2D18') }};
                    border: 2px solid {{ tenantSetting('color_tables', '#8C2D18') }};">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
        <div id="calendar"></div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                buttonText: { today: 'Hoy' },
                height: 600,
                eventOrder: "start,-duration,allDay,title",
                dayMaxEvents: 1,
                eventDisplay: 'block',
                displayEventTime: false,
                moreLinkContent: args => ({ html: `<span class="more-badge">+${args.num} más</span>` }),
                dayHeaderFormat: { weekday: 'long' },
                titleFormat: { year: 'numeric', month: 'long' },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                dayCellDidMount: function (info) {
                    const cellDate = new Date(info.date);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (cellDate < today) {
                        info.el.style.backgroundColor = '#eeeeee';
                        info.el.style.opacity = '0.675';
                        info.el.classList.add('fc-disabled-day');
                    }
                },

                events: '/api/appointments',
            });
            calendar.render();
            const appointmentsModal = new bootstrap.Modal(document.getElementById('appointmentsModal'));
            const appointmentsList = document.getElementById('appointments-list-modal');
            const modalDateTitle = document.getElementById('appointmentsModalLabel');

            calendar.on('dateClick', function (info) {
                const selectedDate = info.dateStr;
                const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = new Date(selectedDate).toLocaleDateString('es-CL', opcionesFecha);
                modalDateTitle.textContent = `Citas para el ${fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1)}`;

                appointmentsList.innerHTML = '<p class="text-muted">Cargando citas...</p>';
                appointmentsModal.show();

                fetch(`/api/appointments?date=${selectedDate}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length === 0) {
                            appointmentsList.innerHTML = '<p class="text-muted">No se registran citas para este día.</p>';
                        } else {
                            data.sort((a, b) => a.start_time.localeCompare(b.start_time));
                            appointmentsList.innerHTML = '';
                            data.forEach((appointment, index) => {
                                const start = appointment.start_time.slice(0, 5);
                                const end = appointment.end_time.slice(0, 5);
                                const isLast = index === data.length - 1;
                                appointmentsList.innerHTML += `
                                    <div class="d-flex justify-content-between align-items-center py-2 ${!isLast ? 'border-bottom' : ''}">
                                        <div>
                                            <strong>${appointment.start_time} - ${appointment.end_time}</strong>
                                            <span class="ms-2">${appointment.client_name}</span>
                                        </div>
                                        <a href="/appointments/${appointment.id}" class="btn btn-sm btn-outline-primary">Ver detalles</a>
                                    </div>
                                `;
                            });
                        }
                    });
            });

        });
    </script>
    {{-- Modal para mostrar citas agendadas --}}
    <div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="appointmentsModalLabel">Citas del día</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal-date-input">
                    <div id="appointments-list-modal"></div>
                </div>
            </div>
        </div>
    </div>
@endsection