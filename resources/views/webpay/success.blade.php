<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .success-card {
            max-width: 600px;
            border-radius: 15px;
            border: 1px solid #28a745;
        }
        .success-icon {
            font-size: 5rem;
            color: #28a745;
        }
        .btn-primary {
            background-color: #4A1D0B;
            border-color: #4A1D0B;
        }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card success-card shadow">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-check-circle success-icon mb-4"></i>
                        <h2 class="mb-3" style="color: #4A1D0B;">¡Pago Completado Exitosamente!</h2>
                        
                        @if(isset($isPlanPurchase) && $isPlanPurchase)
                            <p class="lead">Gracias por adquirir el plan <strong>{{ $planName }}</strong> en AbogaSense.</p>
                            <p>Hemos enviado los detalles de tu compra al correo electrónico proporcionado.</p>
                        @else
                            <p class="lead">Tu transacción ha sido procesada correctamente.</p>
                            <p>Hemos enviado los detalles de tu compra al correo electrónico proporcionado.</p>
                        @endif

                        <div class="transaction-details mt-4 text-start bg-light p-4 rounded">
                            <h5 class="mb-3" style="color: #6B3A2C;">Detalles de la transacción:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Orden de compra:</strong> {{ $buyOrder }}</li>
                                <li class="mb-2"><strong>Monto:</strong> ${{ number_format($amount, 0, ',', '.') }}</li>
                                <li class="mb-2"><strong>Código de autorización:</strong> {{ $authorizationCode }}</li>
                                <li class="mb-2"><strong>Fecha:</strong> {{ $transactionDate }}</li>
                            </ul>
                        </div>

                        <div class="mt-5">
                            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home me-2"></i> Volver al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>