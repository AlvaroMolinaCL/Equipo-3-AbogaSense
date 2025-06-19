<!DOCTYPE html>
<html>

<head>
    <title>Confirmación de Plan AbogaSense</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            background-color: #8C2D18;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .order-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
        }

        .footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }

        .details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
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
        <h1>¡Gracias por adquirir tu plan AbogaSense!</h1>
    </div>

    <div class="content">
        <p>Hola <strong>{{ $customerName }}</strong>,</p>
        <p>Gracias por adquirir el plan <strong>{{ $planName }}</strong> en AbogaSense. A continuación encontrarás los
            detalles de tu compra:</p>

        <div class="details">
            <h2>Detalles de la compra</h2>
            <table>
                <tr>
                    <td><strong>Plan:</strong></td>
                    <td>{{ $planName }}</td>
                </tr>
                <tr>
                    <td><strong>Monto:</strong></td>
                    <td>${{ $planPrice }} CLP</td>
                </tr>
                <tr>
                    <td><strong>Código de autorización:</strong></td>
                    <td>{{ $authorizationCode }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de transacción:</strong></td>
                    <td>{{ $transactionDate }}</td>
                </tr>
                <tr>
                    <td><strong>Correo de acceso:</strong></td>
                    <td>{{ $loginEmail }}</td>
                </tr>
                <tr>
                    <td><strong>Contraseña:</strong></td>
                    <td>{{ $loginPassword }}</td>
                </tr>
                <tr>
                    <td><strong>URL de acceso:</strong></td>
                    <td><a href="https://{{ $tenantUrl }}">{{ $tenantUrl }}</a></td>
                </tr>
            </table>
        </div>

        <p>En los próximos días nos pondremos en contacto contigo para activar tu plan y configurar todos los servicios
            incluidos.</p>

        <p>Si tienes alguna pregunta sobre tu compra, no dudes en contactarnos respondiendo a este correo.</p>

        <a href="{{ url('/') }}" class="btn">Ir a AbogaSense</a>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} AbogaSense. Todos los derechos reservados.</p>
    </div>
</body>

</html>