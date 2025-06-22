@extends('layouts.guest')

@section('title', config('app.name', 'AbogaSense'))

@section('content')
    {{-- SECCIÓN 1: Presentación Principal --}}
    <section class="scroll-section" id="section1" style="background-color: #fdf5e5; border-bottom: 10px solid #6B3A2C;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <div class="row align-items-center flex-grow-1">
                <div class="col-lg-6">
                    {{-- Logo para Pantallas Intermedias y Pequeñas --}}
                    <div class="text-center mb-4 d-block d-lg-none">
                        <img src="{{ asset('images/abogasense2.png') }}" alt="Logo Abogasense" class="logo-mobile">
                    </div>
                    <h1 class="display-4 fw-bold mb-4" style="color: #4A1D0B;">Potencia tu Despacho Legal con una Página Web
                        Profesional</h1>
                    <p class="lead mb-4" style="color: #6B3A2C;">Solución todo-en-uno para gestión de clientes,
                        agendamiento, pagos y más</p>

                    <div class="d-flex gap-3 mb-4">
                        <a href="login" class="btn btn-lg text-white" style="background-color: #4A1D0B;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                        </a>
                        <a href="#section2" class="btn btn-lg btn-outline-dark">
                            <i class="bi bi-star-fill me-1"></i> Funciones
                        </a>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Agendamiento 24/7</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Pasarela de Pagos</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                            <span>Chatbot Inteligente</span>
                        </div>
                    </div>
                </div>
                {{-- Logo para Pantallas Grandes --}}
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/abogasense1.png') }}" alt="Dashboard para abogados"
                        class="img-fluid rounded-3">
                </div>
            </div>
            {{-- Sellos de Confianza --}}
            <div class="row justify-content-center mt-auto mb-4">
                <div class="col-auto text-center px-4">
                    <i class="bi bi-shield-lock fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Seguridad SSL</p>
                </div>
                <div class="col-auto text-center px-4">
                    <i class="bi bi-phone fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Personalizable</p>
                </div>
                <div class="col-auto text-center px-4">
                    <i class="bi bi-credit-card fs-1" style="color: #6B3A2C;"></i>
                    <p class="mb-0 small">Pagos Online</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECCIÓN 2: Características --}}
    <section class="scroll-section" id="section2" style="background-color: #fff;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <div class="section-header">
                <h2 class="section-title">Todo lo que tu Despacho Legal Necesita</h2>
                <p class="section-subtitle">Una solución completa diseñada específicamente para abogados</p>
            </div>
            <div class="carousel-container">
                <div class="carousel-track" id="carouselTrack">
                    {{-- Tarjeta 1: Agendamiento Inteligente --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-calendar-check"></i>
                                Agendamiento Inteligente
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Reservas online 24/7</li>
                                <li><i class="bi bi-check-circle-fill"></i> Integración en calendario</li>
                                <li><i class="bi bi-check-circle-fill"></i> Control de disponibilidad</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Tarjeta 2: Gestión de Clientes --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-people-fill"></i>
                                Gestión de Clientes
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Base de datos organizada</li>
                                <li><i class="bi bi-check-circle-fill"></i> Historial de casos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Documentos compartidos</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Tarjeta 3: Pagos en Línea --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-credit-card"></i>
                                Pagos en Línea
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Pasarela de pagos segura</li>
                                <li><i class="bi bi-check-circle-fill"></i> Confirmación de pagos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Seguimiento de pagos</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Tarjeta 4: Chatbot Legal --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-robot"></i>
                                Chatbot Legal
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Respuestas automáticas</li>
                                <li><i class="bi bi-check-circle-fill"></i> Derivación a abogado</li>
                                <li><i class="bi bi-check-circle-fill"></i> Disponible 24/7</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Tarjeta 5: Diseño Personalizado --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-brush"></i>
                                Diseño Personalizado
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Logo y colores corporativos</li>
                                <li><i class="bi bi-check-circle-fill"></i> Adaptado a tu especialidad</li>
                                <li><i class="bi bi-check-circle-fill"></i> Optimizado para móviles</li>
                            </ul>
                        </div>
                    </div>
                    {{-- Tarjeta 6: Reportes y Análisis --}}
                    <div class="feature-card">
                        <div class="feature-card-header">
                            <h4 class="feature-card-title">
                                <i class="bi bi-bar-chart"></i>
                                Reportes y Análisis
                            </h4>
                        </div>
                        <div class="feature-card-body">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i> Reporte de nuevos usuarios</li>
                                <li><i class="bi bi-check-circle-fill"></i> Eficiencia de tiempo</li>
                                <li><i class="bi bi-check-circle-fill"></i> Gestión de documentos</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button class="carousel-nav prev" id="prevBtn">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-nav next" id="nextBtn">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            <div class="carousel-indicators" id="indicators"></div>
        </div>
    </section>

    {{-- SECCIÓN 3: Testimonios --}}
    <section class="scroll-section" id="section3" style="background-color: #fdf5e5;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Abogados que Confían en Nosotros</h2>
                <p class="lead" style="color: #6B3A2C;">Lo que dicen nuestros clientes</p>
            </div>
            {{-- Sección para Pantallas Grandes --}}
            <div class="row g-4 justify-content-center d-none d-lg-flex">
                {{-- Testimonio 1 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3 align-items-center">
                            <img src="{{ asset('images/reseñas/reseña_1.jpg') }}"
                                class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Martínez">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dra. Martínez</h5>
                                <p class="text-muted small mb-0">Derecho Familiar</p>
                            </div>
                        </div>
                        <p class="mb-0">"Desde que implementé esta plataforma, mis clientes pueden agendar citas a
                            cualquier
                            hora y mis ingresos aumentaron un 30%."</p>
                    </div>
                </div>
                {{-- Testimonio 2 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('images/reseñas/reseña_2.jpg') }}"
                                class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dr. López">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dr. López</h5>
                                <p class="text-muted small mb-0">Derecho Corporativo</p>
                            </div>
                        </div>
                        <p class="mb-0">"El chatbot responde preguntas básicas de clientes potenciales, lo que me ahorra
                            horas de llamadas innecesarias cada semana."</p>
                    </div>
                </div>
                {{-- Testimonio 3 --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                        <div class="d-flex mb-3 align-items-center">
                            <img src="{{ asset('images/reseñas/reseña_3.jpeg') }}"
                                class="rounded-circle me-3 flex-shrink-0"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Rodríguez">
                            <div>
                                <h5 class="mb-1" style="color: #4A1D0B;">Dra. Rodríguez</h5>
                                <p class="text-muted small mb-0">Derecho Penal</p>
                            </div>
                        </div>
                        <p class="mb-0">"La pasarela de pagos ha simplificado enormemente el cobro de honorarios. Mis
                            clientes aprecian la facilidad de pago en línea."</p>
                    </div>
                </div>
            </div>
            {{-- Sección para Pantallas Intermedias y Pequeñas --}}
            <div class="d-block d-lg-none">
                <div class="carousel-mobile-container position-relative py-4">
                    <div id="testimoniosCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            {{-- Testimonio 1 --}}
                            <div class="carousel-item active">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 mx-auto testimonios-card-mobile">
                                    <div class="d-flex mb-3 align-items-center">
                                        <img src="{{ asset('images/reseñas/reseña_1.jpg') }}"
                                            class="rounded-circle me-3 flex-shrink-0"
                                            style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Martínez">
                                        <div>
                                            <h5 class="mb-1" style="color: #4A1D0B;">Dra. Martínez</h5>
                                            <p class="text-muted small mb-0">Derecho Familiar</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">"Desde que implementé esta plataforma, mis clientes pueden agendar
                                        citas a cualquier
                                        hora y mis ingresos aumentaron un 30%."</p>
                                </div>
                            </div>
                            {{-- Testimonio 2 --}}
                            <div class="carousel-item">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 mx-auto testimonios-card-mobile">
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('images/reseñas/reseña_2.jpg') }}"
                                            class="rounded-circle me-3 flex-shrink-0"
                                            style="width: 60px; height: 60px; object-fit: cover;" alt="Dr. López">
                                        <div>
                                            <h5 class="mb-1" style="color: #4A1D0B;">Dr. López</h5>
                                            <p class="text-muted small mb-0">Derecho Corporativo</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">"El chatbot responde preguntas básicas de clientes potenciales, lo
                                        que me ahorra
                                        horas de llamadas innecesarias cada semana."</p>
                                </div>
                            </div>
                            {{-- Testimonio 3 --}}
                            <div class="carousel-item">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-4 mx-auto testimonios-card-mobile">
                                    <div class="d-flex mb-3 align-items-center">
                                        <img src="{{ asset('images/reseñas/reseña_3.jpeg') }}"
                                            class="rounded-circle me-3 flex-shrink-0"
                                            style="width: 60px; height: 60px; object-fit: cover;" alt="Dra. Rodríguez">
                                        <div>
                                            <h5 class="mb-1" style="color: #4A1D0B;">Dra. Rodríguez</h5>
                                            <p class="text-muted small mb-0">Derecho Penal</p>
                                        </div>
                                    </div>
                                    <p class="mb-0">"La pasarela de pagos ha simplificado enormemente el cobro de
                                        honorarios. Mis
                                        clientes aprecian la facilidad de pago en línea."</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Testimonio 1"></button>
                            <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="1"
                                aria-label="Testimonio 2"></button>
                            <button type="button" data-bs-target="#testimoniosCarousel" data-bs-slide-to="2"
                                aria-label="Testimonio 3"></button>
                        </div>
                        <button class="carousel-nav prev" type="button" data-bs-target="#testimoniosCarousel"
                            data-bs-slide="prev">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="carousel-nav next" type="button" data-bs-target="#testimoniosCarousel"
                            data-bs-slide="next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECCIÓN 4: Planes y Precios --}}
    <section class="scroll-section" id="section4" style="background-color: #fff;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <div class="text-center mb-5">
                <h2 class="fw-bold" style="color: #4A1D0B;">Planes a Medida para tu Despacho</h2>
                <p class="lead" style="color: #6B3A2C;">Elige el paquete que mejor se adapte a tus necesidades</p>
            </div>
            {{-- Sección para Pantallas Grandes --}}
            <div class="row g-4 justify-content-center d-none d-lg-flex">
                {{-- Tarjeta 1: Plan Básico --}}
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                            <h4 class="mb-0" style="color: #4A1D0B;">Básico</h4>
                        </div>
                        <div class="card-body text-start p-4">
                            <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $79.990/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Página web personalizada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Agendamiento de citas</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de clientes</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Pasarela de pagos</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Gestión de archivos</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot inteligente</li>
                            </ul>
                            <a href="{{ route('plan.checkout.form', ['plan' => 'basico']) }}"
                                class="btn btn-outline-dark w-100"> Contratar Ahora
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Tarjeta 2: Plan Profesional --}}
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden"
                        style="border: 3px solid #6B3A2C;">
                        <div class="card-header py-4 text-center text-white" style="background-color: #6B3A2C;">
                            <h4 class="mb-0">Profesional</h4>
                            <span class="badge bg-white text-dark mt-2">Más Popular</span>
                        </div>
                        <div class="card-body text-start p-4">
                            <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $169.990/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Página web personalizada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Agendamiento de citas</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de clientes</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Pasarela de pagos integrada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de archivos</li>
                                <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot inteligente</li>
                            </ul>
                            <a href="{{ route('plan.checkout.form', ['plan' => 'profesional']) }}"
                                class="btn text-white w-100" style="background-color: #4A1D0B;">
                                Contratar Ahora
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Tarjeta 3: Plan Premium --}}
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                            <h4 class="mb-0" style="color: #4A1D0B;">Premium</h4>
                        </div>
                        <div class="card-body text-start p-4">
                            <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $239.990/mes</h3>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Página web personalizada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Agendamiento de citas</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de clientes</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Pasarela de pagos integrada</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Gestión de archivos</li>
                                <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #6B3A2C;"></i>
                                    Chatbot inteligente</li>
                            </ul>
                            <a href="{{ route('plan.checkout.form', ['plan' => 'premium']) }}"
                                class="btn btn-outline-dark w-100"> Contratar Ahora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Sección para Pantallas Intermedias y Pequeñas --}}
            <div class="d-block d-lg-none">
                <div class="carousel-mobile-container position-relative py-4">
                    <div id="preciosCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div
                                    class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden mx-auto precios-card-mobile">
                                    <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                                        <h4 class="mb-0" style="color: #4A1D0B;">Básico</h4>
                                    </div>
                                    <div class="card-body text-start p-4">
                                        <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $79.990/mes</h3>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Página web personalizada</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Agendamiento de citas</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Gestión de clientes</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Pasarela de pagos</li>
                                            <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Gestión de
                                                archivos</li>
                                            <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot
                                                inteligente</li>
                                        </ul>
                                        <a href="{{ route('plan.checkout.form', ['plan' => 'basico']) }}"
                                            class="btn btn-outline-dark w-100"> Contratar Ahora
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden mx-auto precios-card-mobile"
                                    style="border: 3px solid #6B3A2C;">
                                    <div class="card-header py-4 text-center text-white"
                                        style="background-color: #6B3A2C;">
                                        <h4 class="mb-0">Profesional</h4>
                                        <span class="badge bg-white text-dark mt-2">Más Popular</span>
                                    </div>
                                    <div class="card-body text-start p-4">
                                        <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $169.990/mes</h3>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Página web personalizada</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Agendamiento de citas</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Gestión de clientes</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Pasarela de pagos integrada</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Gestión de archivos</li>
                                            <li class="mb-3"><i class="bi bi-x-circle me-2 text-muted"></i> Chatbot
                                                inteligente</li>
                                        </ul>
                                        <a href="{{ route('plan.checkout.form', ['plan' => 'profesional']) }}"
                                            class="btn text-white w-100" style="background-color: #4A1D0B;">
                                            Contratar Ahora
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div
                                    class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden mx-auto precios-card-mobile">
                                    <div class="card-header py-4 text-center" style="background-color: #fdf5e5;">
                                        <h4 class="mb-0" style="color: #4A1D0B;">Premium</h4>
                                    </div>
                                    <div class="card-body text-start p-4">
                                        <h3 class="fw-bold mb-3 text-center" style="color: #6B3A2C;">CLP $239.990/mes</h3>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Página web personalizada</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Agendamiento de citas</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Gestión de clientes</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Pasarela de pagos integrada</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Gestión de archivos</li>
                                            <li class="mb-3"><i class="bi bi-check-circle-fill me-2"
                                                    style="color: #6B3A2C;"></i> Chatbot inteligente</li>
                                        </ul>
                                        <a href="{{ route('plan.checkout.form', ['plan' => 'premium']) }}"
                                            class="btn btn-outline-dark w-100"> Contratar Ahora
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#preciosCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Básico"></button>
                            <button type="button" data-bs-target="#preciosCarousel" data-bs-slide-to="1"
                                aria-label="Profesional"></button>
                            <button type="button" data-bs-target="#preciosCarousel" data-bs-slide-to="2"
                                aria-label="Premium"></button>
                        </div>
                        <button class="carousel-nav prev" type="button" data-bs-target="#preciosCarousel"
                            data-bs-slide="prev">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="carousel-nav next" type="button" data-bs-target="#preciosCarousel"
                            data-bs-slide="next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECCIÓN 5: Preguntas Frecuentes --}}
    <section class="scroll-section" id="section5" style="background-color: #4A1D0B;">
        <div class="container h-100 d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        {{-- FAQ 1 --}}
                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Cuánto tiempo toma implementar la solución?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Normalmente implementamos tu página web profesional en 4-7 días laborales después de
                                    recibir toda la información necesaria (logo, contenido, fotos, etc.).
                                </div>
                            </div>
                        </div>
                        {{-- FAQ 2 --}}
                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Puedo migrar mis clientes actuales al sistema?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, ofrecemos servicio de migración de datos sin costo adicional. Solo necesitas
                                    proporcionarnos tus datos en formato Excel o CSV y nosotros nos encargamos del resto,
                                    manteniendo toda la información segura y organizada.
                                </div>
                            </div>
                        </div>
                        {{-- FAQ 3 --}}
                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Qué métodos de pago están disponibles?
                                </button>
                            </h3>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Contamos con la integración de Webpay, por lo que tus
                                    clientes podrán pagar con tarjeta de crédito/débito y transferencias bancarias.
                                </div>
                            </div>
                        </div>
                        {{-- FAQ 4 --}}
                        <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Ofrecen capacitación para usar el sistema?
                                </button>
                            </h3>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, incluimos una sesión de capacitación virtual de 1 hora con cada implementación,
                                    además de videotutoriales paso a paso y documentación detallada. También ofrecemos
                                    soporte prioritario por correo para resolver cualquier duda rápidamente.
                                </div>
                            </div>
                        </div>
                        {{-- FAQ 5 --}}
                        <div class="accordion-item border-0 rounded-4 overflow-hidden shadow-sm">
                            <h3 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"
                                    style="background-color: #fdf5e5; color: #4A1D0B;">
                                    ¿Es compatible con dispositivos móviles?
                                </button>
                            </h3>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutamente. Tu página web y panel de control están completamente optimizados para
                                    smartphones y tablets. Tus clientes podrán agendar citas, hacer pagos y comunicarse
                                    desde cualquier dispositivo sin problemas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1"></div>
            <div class="text-center mt-5">
                <h3 class="text-white mt-2">Transforma tu Práctica Legal Hoy Mismo</h3>
                <p class="lead text-white">Más de 200 abogados ya confían en nuestra plataforma para gestionar sus
                    despachos</p>
            </div>
            <div class="flex-grow-1"></div>
        </div>
    </section>

    {{-- Botón para Siguiente Sección --}}
    <button id="scrollNextBtn" class="scroll-next-btn" aria-label="Siguiente sección">
        <i class="bi bi-chevron-down"></i>
    </button>
@endsection

@section('styles')
    <style>
        html,
        body {
            height: 100%;
            scroll-behavior: smooth;
            scroll-snap-type: y mandatory;
        }

        .scroll-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            scroll-snap-align: start;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0;
        }

        .container.h-100 {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-top: 0;
            padding-bottom: 0;
        }

        @media (max-width: 992px) {
            .carousel-mobile-container {
                padding-top: 32px;
                padding-bottom: 48px;
                position: relative;
            }

            .testimonios-card-mobile,
            .precios-card-mobile {
                width: 100%;
                max-width: calc(100vw - 120px);
                min-width: 0;
                margin-left: auto;
                margin-right: auto;
                box-sizing: border-box;
            }

            #testimoniosCarousel .carousel-nav,
            #preciosCarousel .carousel-nav {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 44px;
                height: 44px;
                background: #6B3A2C;
                color: #fff;
                border: none;
                border-radius: 50%;
                box-shadow: 0 4px 8px rgba(107, 58, 44, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
                transition: all 0.3s ease;
            }

            #testimoniosCarousel .carousel-nav.prev,
            #preciosCarousel .carousel-nav.prev {
                left: 8px;
                right: auto;
            }

            #testimoniosCarousel .carousel-nav.next,
            #preciosCarousel .carousel-nav.next {
                right: 8px;
                left: auto;
            }

            #testimoniosCarousel .carousel-nav i,
            #preciosCarousel .carousel-nav i {
                font-size: 1.4rem;
                color: #fff;
            }

            #testimoniosCarousel .carousel-nav:hover,
            #preciosCarousel .carousel-nav:hover {
                background: #4A1D0B;
            }

            #testimoniosCarousel .carousel-indicators,
            #preciosCarousel .carousel-indicators {
                position: static;
                margin-top: 24px;
                margin-bottom: 0;
                justify-content: center;
                gap: 8px;
            }

            #testimoniosCarousel .carousel-indicators [data-bs-target],
            #preciosCarousel .carousel-indicators [data-bs-target] {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: rgba(107, 58, 44, 0.2);
                border: none;
                margin: 0 4px;
                transition: background 0.3s;
            }

            #testimoniosCarousel .carousel-indicators .active,
            #preciosCarousel .carousel-indicators .active {
                background: #6B3A2C;
            }
        }

        @media (max-width: 768px) {
            .display-4 {
                font-size: 2.5rem;
            }

            .d-flex.gap-3 {
                justify-content: center;
            }
        }

        @media (min-width: 768px) and (max-width: 1199.98px) {

            .testimonios-card-mobile,
            .precios-card-mobile {
                max-width: 420px;
                width: 100%;
                margin-left: auto;
                margin-right: auto;
                box-sizing: border-box;
            }
        }

        .scroll-next-btn {
            position: fixed;
            right: 32px;
            bottom: 24px;
            left: auto;
            transform: none;
            z-index: 1000;
            background: #6B3A2C;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: background 0.2s;
        }

        .scroll-next-btn:hover {
            background: #4A1D0B;
        }

        .scroll-section:last-of-type~.scroll-next-btn,
        .scroll-section:last-child.active~.scroll-next-btn {
            display: none;
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(106, 58, 44, 0.1) !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: #6B3A2C !important;
            color: white !important;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(106, 58, 44, 0.2);
        }

        .nav-pills .nav-link.active {
            background-color: #6B3A2C;
        }

        .nav-pills .nav-link {
            color: #4A1D0B;
        }

        .logo-mobile {
            max-width: 160px;
            width: 60vw;
            height: auto;
            margin-bottom: 1rem;
        }

        @media (max-width: 576px) {
            .logo-mobile {
                max-width: 120px;
                width: 80vw;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = Array.from(document.querySelectorAll('.scroll-section'));
            const btn = document.getElementById('scrollNextBtn');
            let current = 0;
            let isScrolling = false;

            function goToSection(idx) {
                if (idx < 0 || idx >= sections.length) return;
                isScrolling = true;
                sections[idx].scrollIntoView({
                    behavior: 'smooth'
                });
                setTimeout(() => {
                    isScrolling = false;
                }, 800);
                current = idx;
                updateBtn();
            }

            btn.addEventListener('click', () => {
                if (current < sections.length - 1) goToSection(current + 1);
            });

            window.addEventListener('wheel', function(e) {
                if (isScrolling) return;
                if (e.deltaY > 0 && current < sections.length - 1) {
                    goToSection(current + 1);
                } else if (e.deltaY < 0 && current > 0) {
                    goToSection(current - 1);
                }
            }, {
                passive: false
            });

            window.addEventListener('scroll', function() {
                let found = false;
                sections.forEach((sec, idx) => {
                    const rect = sec.getBoundingClientRect();
                    if (!found && rect.top <= window.innerHeight / 2 && rect.bottom > window
                        .innerHeight / 2) {
                        current = idx;
                        found = true;
                    }
                });
                updateBtn();
            });

            function updateBtn() {
                if (current >= sections.length - 1) {
                    btn.style.display = 'none';
                } else {
                    btn.style.display = 'flex';
                }
            }
            updateBtn();
        });
    </script>
@endsection
