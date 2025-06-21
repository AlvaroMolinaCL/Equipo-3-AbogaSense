<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td class="content-cell mail-footer-cell" align="center">
                    <p class="mail-footer-text">© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
                </td>
            </tr>
        </table>
    </td>
</tr>

@push('styles')
<style>
.mail-footer-cell {
    padding: 35px 0;
    color: #999999;
    font-size: 12px;
    font-family: Arial, sans-serif;
    border-top: 1px solid #e5e5e5;
}
.mail-footer-text {
    margin: 0 0 5px 0;
}
</style>
@endpush