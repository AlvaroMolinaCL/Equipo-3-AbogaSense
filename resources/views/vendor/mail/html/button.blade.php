@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="{{ $align }}">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="mail-btn-td">
                                    <a href="{{ $url }}" 
                                       class="mail-btn-link"
                                       target="_blank" 
                                       rel="noopener">
                                        {{ $slot }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@push('styles')
<style>
.mail-btn-td {
    border-radius: 4px;
    background-color: #4A1D0B;
}
.mail-btn-link {
    display: inline-block;
    padding: 12px 24px;
    font-family: Arial, sans-serif;
    font-size: 15px;
    font-weight: bold;
    color: #ffffff !important;
    text-decoration: none;
    border-radius: 4px;
    text-align: center;
}
</style>
@endpush