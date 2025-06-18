<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Rechazado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .error-card {
            max-width: 600px;
            border-radius: 15px;
            border: 1px solid #dc3545;
        }

        .error-icon {
            font-size: 5rem;
            color: #dc3545;
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
                <div class="card error-card shadow">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-times-circle error-icon mb-4"></i>
                        <h2 class="mb-3" style="color: #4A1D0B;">Pago Rechazado</h2>

                        @if(isset($isPlanPurchase) && $isPlanPurchase)
                            <p class="lead">Lo sentimos, no pudimos procesar el pago de tu plan en AbogaSense.</p>
                        @else
                            <p class="lead">Lo sentimos, no pudimos procesar tu pago.</p>
                        @endif

                        <div class="transaction-details mt-4 text-start bg-light p-4 rounded">
                            <h5 class="mb-3" style="color: #6B3A2C;">Detalles del error:</h5>
                            <ul class="list-unstyled">
                                @if(isset($buyOrder))
                                    <li class="mb-2"><strong>Orden de compra:</strong> {{ $buyOrder }}</li>
                                @endif
                                @if(isset($responseCode))
                                    <li class="mb-2"><strong>Código de error:</strong> {{ $responseCode }}</li>
                                @endif
                                @if(isset($errorMessage))
                                    <li class="mb-2"><strong>Motivo:</strong> {{ $errorMessage }}</li>
                                @endif
                                @if(isset($error))
                                    <li class="mb-2"><strong>Error:</strong> {{ $error }}</li>
                                @endif
                            </ul>
                        </div>

                        <div class="mt-4">
                            <p>Por favor, intenta nuevamente o contacta con nuestro soporte si el problema persiste.</p>
                        </div>

                        <div class="mt-5 d-flex justify-content-center gap-3">
                            <a href="{{ url('/planes') }}" class="btn btn-primary">
                                <i class="fas fa-undo me-2"></i> Reintentar
                            </a>
                            <a href="{{ url('/contacto') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-headset me-2"></i> Contactar soporte
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>