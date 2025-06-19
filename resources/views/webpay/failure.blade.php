<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Rechazado | AbogaSense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4A1D0B;
            --secondary-color: #6B3A2C;
            --error-color: #dc3545;
            --light-brown: #F5E9E1;
            --dark-brown: #3A1A0A;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .error-card {
            max-width: 650px;
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .error-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: none;
        }
        
        .error-icon {
            font-size: 5rem;
            color: var(--error-color);
            animation: shake 0.8s;
        }
        
        .transaction-details {
            border-left: 4px solid var(--error-color);
            background-color: #FEF2F2;
            transition: all 0.3s ease;
        }
        
        .transaction-details:hover {
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--dark-brown);
            border-color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 29, 11, 0.3);
        }
        
        .btn-outline-secondary {
            border-color: var(--error-color);
            color: var(--error-color);
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--error-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .error-solutions {
            background-color: var(--light-brown);
            border-radius: 10px;
            padding: 20px;
        }
        
        .error-solutions h5 {
            color: var(--secondary-color);
        }
        
        .error-solutions ul {
            padding-left: 20px;
        }
        
        .error-solutions li {
            margin-bottom: 8px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        @media (max-width: 576px) {
            .error-icon {
                font-size: 4rem;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .d-flex {
                flex-direction: column;
                gap: 10px !important;
            }
            
            .btn-primary, .btn-outline-secondary {
                width: 100%;
            }
        }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card error-card animate__animated animate__fadeInUp mx-auto">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Problema con el Pago</h2>
                    </div>
                    <div class="card-body text-center pt-4 p-md-3">
                        <i class="fas fa-times-circle error-icon mb-4"></i>
                        <h2 class="mb-3" style="color: var(--primary-color);">Pago Rechazado</h2>
                        
                        @if(isset($isPlanPurchase) && $isPlanPurchase)
                            <p class="lead mb-4">Lo sentimos, no pudimos procesar el pago de tu plan <strong>{{ $planName ?? '' }}</strong> en AbogaSense.</p>
                        @else
                            <p class="lead mb-4">Lo sentimos, no pudimos procesar tu transacción.</p>
                        @endif

                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            @if(isset($errorMessage))
                                <strong>Motivo:</strong> {{ $errorMessage }}
                            @elseif(isset($error))
                                <strong>Error:</strong> {{ $error }}
                            @else
                                El banco emisor ha rechazado la transacción.
                            @endif
                        </div>

                        <!-- Detalles del error -->
                        <div class="transaction-details mt-4 text-start p-4 rounded">
                            <h5 class="mb-3" style="color: var(--secondary-color);"><i class="fas fa-bug me-2"></i>Detalles del error:</h5>
                            <div class="row">
                                @if(isset($buyOrder))
                                    <div class="col-md-6 mb-2">
                                        <p class="mb-0"><strong>Orden de compra:</strong> {{ $buyOrder }}</p>
                                    </div>
                                @endif
                                @if(isset($responseCode))
                                    <div class="col-md-6 mb-2">
                                        <p class="mb-0"><strong>Código de error:</strong> <span class="badge bg-danger">{{ $responseCode }}</span></p>
                                    </div>
                                @endif
                                @if(isset($amount))
                                    <div class="col-md-6 mb-2">
                                        <p class="mb-0"><strong>Monto:</strong> ${{ number_format($amount, 0, ',', '.') }} CLP</p>
                                    </div>
                                @endif
                                @if(isset($transactionDate))
                                    <div class="col-md-6 mb-2">
                                        <p class="mb-0"><strong>Fecha:</strong> {{ date('d/m/Y H:i', strtotime($transactionDate)) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Posibles soluciones -->
                        <div class="error-solutions mt-4 text-start">
                            <h5 class="mb-3"><i class="fas fa-lightbulb me-2"></i>¿Qué puedes hacer?</h5>
                            <ul>
                                <li>Verifica los datos de tu tarjeta de crédito/débito</li>
                                <li>Asegúrate de tener fondos suficientes</li>
                                <li>Intenta con otro método de pago</li>
                                <li>Comunícate con tu banco para verificar el motivo del rechazo</li>
                            </ul>
                        </div>

                        <!-- Acciones -->
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3">
                            @if(isset($isPlanPurchase) && $isPlanPurchase)
                                <a href="{{ route('index') }}" class="btn btn-primary py-2">
                                    <i class="fas fa-undo me-2"></i> Reintentar compra
                                </a>
                            @else
                                <a href="{{ route('index')}}" class="btn btn-primary py-2">
                                    <i class="fas fa-credit-card me-2"></i> Intentar nuevamente
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="card-footer text-center bg-light">
                        <p class="small text-muted mt-2">© {{ date('Y') }} AbogaSense. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>