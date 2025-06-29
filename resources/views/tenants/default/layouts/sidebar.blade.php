<style>
    .navbar-nav .nav-link.active {
        background-color:
            {{ tenantSetting('button_color_sidebar', '#BF8A49') }}
            !important;
        border-radius: 0.375rem;
    }
</style>

<nav class="navbar navbar-light flex-column p-3 h-100"
    style="background-color: {{ tenantSetting('navbar_color_1', 'rgb(68, 30, 8)') }};">
    <a class="navbar-brand mx-auto d-none d-lg-block p-0" href="{{ route('dashboard') }}">
        <img src="{{ asset(tenantSetting('logo_path_1', 'images/logo/Logo_1_(Predeterminado).png')) }}" alt="Logo"
            style="max-width: 100%; height: 60px" class="img-fluid mx-auto d-block">
    </a>
    {{-- Botón Inicio --}}
    <div class="px-3 mb-3 mt-3">
        <a href="{{ route('tenants.default.index') }}" class="btn w-100" style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
              color: {{ tenantSetting('navbar_text_color_1', 'white') }};
              border-radius: 0.375rem;
              text-align: center;
              display: block;">
            <i class="bi bi-house-door-fill me-2"></i> Inicio
        </a>
    </div>

    <ul class="navbar-nav flex-column w-100" id="sidebarAccordion">
        {{-- Panel de Control --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <i class="bi bi-speedometer2 me-2"></i> Panel de Control
            </a>
        </li>

        {{-- Agenda (Desplegable) --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#agendaMenu"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};"
                aria-expanded="{{ Route::is('available-slots.*') || Route::is('appointments.*') ? 'true' : 'false' }}">
                <span><i class="bi bi-calendar me-2"></i> Agenda</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse ps-3 {{ Route::is('available-slots.*') || Route::is('appointments.*') ? 'show' : '' }}"
                id="agendaMenu" data-bs-parent="#sidebarAccordion">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('available-slots.index') ? 'active' : '' }}"
                            href="{{ route('available-slots.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Disponibilidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('appointments.index') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}"
                            style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Citas Agendadas</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Apariencia --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('appearance') ? 'active' : '' }}" href="{{ route('appearance') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <i class="bi bi-palette me-2"></i> Apariencia
            </a>
        </li>

        @if (tenant()->hasFeature('archivos'))
            {{-- Archivos --}}
            <li class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#filesMenu" style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};"
                    aria-expanded="false">
                    <span><i class="bi bi-file-text me-2"></i> Archivos</span>
                    <i class="bi bi-chevron-down small"></i>
                </a>
                <div class="collapse ps-3 {{ Route::is('files.*') ? 'show' : '' }}" id="filesMenu"
                    data-bs-parent="#sidebarAccordion">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('files.index') ? 'active' : '' }}"
                                href="{{ route('files.index') }}"
                                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Mis Archivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('files.shared.files') ? 'active' : '' }}"
                                href="{{ route('files.shared.files') }}"
                                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">Archivos
                                Compartidos</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        {{-- Casos --}}
        <li>
            <a class="nav-link {{ Route::is('cases.index') ? 'active' : '' }}"
               href="{{ route('cases.index', ['tenantId' => request()->route('tenantId')]) }}"
               style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
               <span><i class="bi bi-journal-text me-2"></i> Casos</span>
            </a>
        </li>

        {{-- Planes --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <span><i class="bi bi-card-checklist me-2"></i> Planes</span>
            </a>
        </li>

        {{-- Roles --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('roles.index') ? 'active' : '' }}" href="{{ route('roles.index') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">
                <span><i class="bi bi-person-check me-2"></i> Roles</span>
            </a>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}"
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};" aria-expanded="false">
                <span><i class="bi bi-people me-2"></i> Usuarios</span>
            </a>
        </li>
    </ul>

    {{-- Información de Usuario --}}
    <div class="mt-auto border-top pt-3"
        style="border-color: {{ tenantSetting('navbar_text_color_1', '#BF8A49') }} !important;">
        <div class="text-left">
            <strong
                style="color: {{ tenantSetting('navbar_text_color_1', 'white') }};">{{ Auth::user()->name }}</strong><br>
            <small
                style="color: {{ tenantSetting('navbar_text_color_1', '#BF8A49') }};">{{ Auth::user()->email }}</small>
        </div>
        <div class="dropup mt-2">
            <button class="btn btn-sm w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" style="background-color: {{ tenantSetting('button_color_sidebar', '#BF8A49') }};
               color: {{ tenantSetting('navbar_text_color_1', 'white') }};
               border: 1px solid {{ tenantSetting('navbar_text_color_1', 'white') }};">
                Cuenta
            </button>

            <ul class="dropdown-menu w-100">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>