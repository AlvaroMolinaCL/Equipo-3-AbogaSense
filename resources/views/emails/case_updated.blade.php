<!DOCTYPE html>
<html>
<head>
    <title>Caso Actualizado</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { background-color: #8C2D18; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .case-details { margin-bottom: 20px; }
        .label { font-weight: bold; }
        .footer { margin-top: 20px; padding: 10px; text-align: center; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Actualización de Caso</h1>
    </div>

    <div class="content">
        <p>Hola {{ $case->user->name ?? 'Usuario' }},</p>
        <p>Tu caso ha sido actualizado. Aquí están los detalles:</p>

        <div class="case-details">
            <p><span class="label">Título:</span> {{ $case->title }}</p>
            <p><span class="label">Estado:</span> {{ ucfirst($case->status) }}</p>
            <p><span class="label">Descripción:</span></p>
            <p>{{ $case->description }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Si tienes preguntas o necesitas más información, no dudes en contactarnos.</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
    </div>
</body>
</html>
