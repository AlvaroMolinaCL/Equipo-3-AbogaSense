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
        <h3 class="fw-bold mt-3 mb-4" style="color: {{ tenantSetting('text_color_1', '#8C2D18') }};">
            <i class="bi bi-calendar-check me-2"></i>{{ __('Citas Agendadas') }}
        </h3>
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
                displayEventTime: false, // <-- esta línea evita que se muestre la hora por defecto
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
        });
    </script>
@endsection