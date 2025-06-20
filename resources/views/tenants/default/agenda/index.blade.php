@extends('tenants.default.layouts.app')

@section('title', tenantPageName('agenda', 'Agenda') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-light-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-light')

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

        .fc .fc-daygrid-event-harness {
            display: flex;
            justify-content: center;
            max-width: 100%;
            width: 100%;
            flex: 1 1 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .fc .fc-event-main {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .fc .fc-event-title {
            display: block;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fc .fc-col-header-cell-cushion {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: center;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 0.95rem;
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
        }

        .fc .fc-daygrid-day-number {
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
            font-weight: normal;
        }

        .fc .fc-toolbar-title {
            text-transform: capitalize;
            color: {{ tenantSetting('text_color_1', '#8C2D18') }};
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
            border-radius: 4px;
            text-decoration: none !important;
            pointer-events: auto;
        }

        .fc .fc-daygrid-more-link:hover,
        .fc .fc-daygrid-more-link:focus {
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }} !important;
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }} !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }

        .fc-daygrid-event-harness+.fc-daygrid-more-link {
            align-self: center;
        }

        .fc-event-title .icon-in-progress {
            display: inline-block;
            vertical-align: middle;
            font-size: 0.85rem;
            color: #ffc107;
            margin-left: 5px;
            line-height: 1;
        }

        .btn-outline-tenant {
            border: 1px solid {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            background-color: transparent;
            transition: all 0.2s ease-in-out;
        }

        .btn-outline-tenant:hover,
        .btn-outline-tenant:focus {
            background-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            color: {{ tenantSetting('navbar_text_color_2', '#FFFFFF') }};
            border-color: {{ tenantSetting('navbar_color_2', '#8C2D18') }};
            box-shadow: none;
            text-decoration: none;
        }
    </style>

    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h3 class="fw-bold mt-3 mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                <i class="bi bi-calendar-event me-2"></i>{{ __('Selecciona un Horario Disponible') }}
            </h3>
            <a href="{{ route('tenants.default.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
            <div id="calendar"></div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: {{ tenantSetting('background_color_1', '#FDF5E5') }};">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="dayModalLabel" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
                            Horarios del día
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modal-date-input" name="date">
                        <div id="slots-list-modal"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const modal = new bootstrap.Modal(document.getElementById('dayModal'));
            const modalDateInput = document.getElementById('modal-date-input');
            const modalDateTitle = document.getElementById('dayModalLabel');
            const slotsList = document.getElementById('slots-list-modal');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: new Date(),
                locale: 'es',
                buttonText: {
                    today: 'Hoy'
                },

                height: 600,
                eventOrder: "start,-duration,allDay,title",
                dayMaxEvents: 1,
                eventDisplay: 'block',

                moreLinkContent: function (args) {
                    return { html: `<span class="more-badge">+${args.num} más</span>` };
                },

                selectable: true,
                dayHeaders: true,
                dayHeaderFormat: { weekday: 'long' },
                titleFormat: { year: 'numeric', month: 'long' },

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                },

                events: '/api/client-slots',

                dayCellDidMount: function (info) {
                    const cellDate = new Date(info.date);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (cellDate < today) {
                        info.el.style.backgroundColor = '#eeeeee';
                        info.el.style.opacity = '0.5';
                        info.el.style.cursor = 'not-allowed';
                        info.el.classList.add('fc-disabled-day');
                    }
                },

                dateClick: function (info) {
                    const selectedDate = new Date(info.date);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    selectedDate.setHours(0, 0, 0, 0);
                    if (selectedDate < today) return;

                    const date = info.dateStr;
                    const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    const fechaFormateada = selectedDate.toLocaleDateString('es-CL', opcionesFecha);
                    modalDateTitle.textContent = `Horarios para el ${fechaFormateada.charAt(0).toUpperCase() + fechaFormateada.slice(1)}`;
                    modalDateInput.value = date;
                    slotsList.innerHTML = `<p class="text-muted">Cargando horarios...</p>`;
                    modal.show();


                    const formatTime = timeStr => timeStr.slice(0, 5);

                    fetch(`/api/client-slots?date=${date}`)
                        .then(res => res.json())
                        .then(data => {
                            slotsList.innerHTML = '';
                            if (data.length === 0) {
                                slotsList.innerHTML = '<p class="text-muted">No se registran horarios disponibles.</p>';
                            } else {
                                data.sort((a, b) => a.start_time.localeCompare(b.start_time));
                                data.forEach(slot => {
                                    const start = formatTime(slot.start_time);
                                    const end = formatTime(slot.end_time);
                                    slotsList.innerHTML += `
                                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                            <div class="d-flex align-items-center gap-2">
                                                <strong style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">${start} - ${end}</strong>
                                            </div>
                                            <a href="/agenda/confirmar?slot_id=${slot.id}"
                                                class="btn btn-sm btn-outline-tenant"
                                                title="Agendar este horario">
                                                Agendar
                                            </a>
                                        </div>
                                    `;

                                });
                            }
                        });
                }
            });

            calendar.render();
        });
    </script>

@endsection