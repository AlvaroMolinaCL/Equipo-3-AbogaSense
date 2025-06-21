@props(['url'])
<tr>
    <td class="header mail-header">
        <a href="{{ $url }}" class="mail-header-link">
            <div class="mail-header-title">
                <h1 class="mail-header-title-text">Restablecer Contraseña</h1>
            </div>
        </a>
    </td>
</tr>

@push('styles')
<style>
.mail-header {
    background-color: #8C2D18;
    padding: 20px 0;
    text-align: center;
}
.mail-header-link {
    display: inline-block;
    text-decoration: none;
}
.mail-header-title {
    color: white;
    font-family: Arial, sans-serif;
}
.mail-header-title-text {
    margin: 0;
    font-size: 22px;
    font-weight: bold;
    color: white;
}
</style>
@endpush