@extends('tenants.default.layouts.app')

@section('title', tenantPageName('services', 'Servicios') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@push('styles')
<style>
.services-section {
    margin-top: 80px;
}
.services-title {
    font-family: {{ tenantSetting('heading_font', '') }};
}
.services-text {
    text-align: justify;
}
.services-list li {
    text-align: justify;
}
.card-title {
    font-weight: bold;
}
</style>
@endpush

@section('content')
    <section class="py-5 services-section">
        <div class="container">
            <h1 class="mb-4 services-title">
                {{ tenantPageName('services', 'Servicios') }}
            </h1>

            <div class="row g-4">
                {{-- Recuadro 1 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="{{ asset('images/services/' . tenantSetting('services_path_1', 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Asesoría jurídica integral">
                        <div class="card-body">
                            <h5 class="card-title">
                                {!! tenantText('title_service_1', 'Servicio 1') !!}
                            </h5>
                            <div class="card-text">
                                {!! tenantText(
                                    'body_service_1',
                                    '
                                        <p class="services-text">Quisque accumsan odio quis facilisis ullamcorper.</p>
                                        <p class="services-text">Praesent pharetra:</p>
                                        <ul class="services-list">
                                            <li>Ut elementum neque sem, vitae condimentum magna ullamcorper eget.</li>
                                            <li>Pellentesque eleifend mauris non risus consequat feugiat.</li>
                                            <li>Fusce rhoncus justo elementum eros hendrerit, ac tincidunt neque tempor.</li>
                                            <li>Donec eleifend, elit et rhoncus sodales, eros risus euismod justo, ac tristique massa est vitae nisl.</li>
                                            <li>Nunc ac dictum mauris, in blandit tortor.</li>
                                        </ul>
                                    ',
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 2 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="{{ asset('images/services/' . tenantSetting('services_path_2', 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Representación judicial">
                        <div class="card-body">
                            <h5 class="card-title">
                                {!! tenantText('title_service_2', 'Servicio 2') !!}
                            </h5>
                            <div class="card-text">
                                {!! tenantText(
                                    'body_service_2',
                                    '
                                        <p class="services-text">Sed tincidunt ligula odio, sit amet tempor leo elementum et:</p>
                                        <ul class="services-list">
                                            <li>Quisque bibendum hendrerit libero. </li>
                                            <li>Nulla vestibulum quam ante, vel tincidunt mi dapibus ac.</li>
                                            <li>Praesent pharetra, urna quis porta auctor, mi lacus pellentesque metus, at pharetra purus lorem sed quam.</li>
                                        </ul>
                                    ',
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recuadro 3 --}}
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm fade-in-section">
                        <img src="{{ asset('images/services/' . tenantSetting('services_path_3', 'Servicio_(Predeterminado).png')) }}"
                            class="card-img-top" alt="Capacitaciones y charlas">
                        <div class="card-body">
                            <h5 class="card-title">
                                {!! tenantText('title_service_3', 'Servicio 3') !!}
                            </h5>
                            <div class="card-text">
                                {!! tenantText(
                                    'body_service_3',
                                    '
                                        <p class="services-text">Praesent tempus accumsan urna. Sed vel tempor nulla, et sodales enim. Vivamus a dictum urna, ut cursus leo.</p>
                                        <p class="services-text">Aliquam erat volutpat:</p>
                                        <ul class="services-list">
                                            <li>Mauris pretium aliquam neque vitae efficitur.</li>
                                            <li>Sed massa neque, malesuada ut blandit in, maximus non lorem.</li>
                                            <li>Duis posuere placerat vestibulum.</li>
                                        </ul>
                                    ',
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
