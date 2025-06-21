@extends('tenants.default.layouts.app')

@section('title', tenantPageName('tips', 'Tips') . ' - ' . tenantSetting('name', 'Tenant'))

@section('navbar')
@section('navbar-class', 'navbar-dark-mode')
    @include('tenants.default.layouts.navigation')
@endsection

@section('body-class', 'theme-dark')

@push('styles')
<style>
.tips-section {
    margin-top: 80px;
}
.tips-title {
    font-family: {{ tenantSetting('heading_font', '') }};
}
.tips-text {
    text-align: justify;
}
</style>
@endpush

@section('content')
    <section class="py-5 tips-section">
        <div class="container">
            <h1 class="mb-4 tips-title">
                {{ tenantPageName('tips', 'Tips') }}</h1>
            <p class="mb-5 tips-text">
                {!! tenantText(
                    'body_tips',
                    '
                        <p class="tips-text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel dapibus nunc.
                    ',
                ) !!}
            </p>
        </div>
    </section>
@endsection
