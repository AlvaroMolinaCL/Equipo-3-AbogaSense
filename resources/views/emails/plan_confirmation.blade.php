<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Plan AbogaSense</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-height: 60px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
        }
        .details {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #4A1D0B;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4A1D0B;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/abogasense2.png') }}" alt="AbogaSense" class="logo">
        <h2 style="color: #4A1D0B;">Confirmación de Compra de Plan</h2>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $customerName }}</strong>,</p>
        <p>Gracias por adquirir el plan <strong>{{ $planName }}</strong> en AbogaSense. A continuación encontrarás los detalles de tu compra:</p>

        <div class="details">
            <h3 style="color: #6B3A2C; margin-top: 0;">Detalles de la compra</h3>
            <p><strong>Plan:</strong> {{ $planName }}</p>
            <p><strong>Monto:</strong> ${{ $planPrice }} CLP</p>
            <p><strong>Código de autorización:</strong> {{ $authorizationCode }}</p>
            <p><strong>Fecha de transacción:</strong> {{ $transactionDate }}</p>
        </div>

        <p>En los próximos días nos pondremos en contacto contigo para activar tu plan y configurar todos los servicios incluidos.</p>

        <p>Si tienes alguna pregunta sobre tu compra, no dudes en contactarnos respondiendo a este correo.</p>

        <a href="{{ url('/') }}" class="btn">Ir a AbogaSense</a>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} AbogaSense. Todos los derechos reservados.</p>
        <p>Este es un correo automático, por favor no lo respondas directamente.</p>
    </div>
</body>
</html>