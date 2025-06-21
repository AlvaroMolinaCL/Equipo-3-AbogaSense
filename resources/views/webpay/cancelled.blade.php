<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Cancelado | AbogaSense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4A1D0B;
            --secondary-color: #6B3A2C;
            --warning-color: #ffc107;
            --light-brown: #F5E9E1;
            --dark-brown: #3A1A0A;
        }

        .text-primary-color {
            color: var(--primary-color) !important;
        }

        .text-secondary-color {
            color: var(--secondary-color) !important;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .warning-card {
            max-width: 650px;
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .warning-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: none;
        }

        .warning-icon {
            font-size: 5rem;
            color: var(--warning-color);
            animation: pulse 1.5s infinite;
        }

        .transaction-details {
            border-left: 4px solid var(--warning-color);
            background-color: #FFF9E6;
            transition: all 0.3s ease;
        }

        .transaction-details:hover {
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.1);
        }

        .transaction-item {
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-label {
            font-weight: 600;
            color: var(--secondary-color);
            flex: 1;
        }

        .transaction-value {
            flex: 2;
            text-align: right;
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
            border-color: var(--warning-color);
            color: var(--secondary-color);
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--warning-color);
            color: var(--dark-brown);
            transform: translateY(-2px);
        }

        .suggestions-list {
            list-style-type: none;
            padding-left: 20px;
        }

        .suggestions-list li {
            margin-bottom: 8px;
            position: relative;
        }

        .suggestions-list li:before {
            content: "•";
            color: var(--warning-color);
            font-weight: bold;
            position: absolute;
            left: -15px;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 576px) {
            .warning-icon {
                font-size: 4rem;
            }

            .card-body {
                padding: 20px;
            }

            .d-flex {
                flex-direction: column;
                gap: 10px !important;
            }

            .btn-primary,
            .btn-outline-secondary {
                width: 100%;
            }

            .transaction-item {
                flex-direction: column;
            }

            .transaction-value {
                text-align: left;
                margin-top: 4px;
            }
        }
    </style>
</head>

<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card warning-card animate__animated animate__fadeInUp mx-auto">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Proceso Cancelado</h2>
                    </div>
                    <div class="card-body text-center p-4 p-md-5">
                        <i class="fas fa-exclamation-triangle warning-icon mb-4"></i>
                        <h2 class="mb-3 text-primary-color">Pago Cancelado</h2>

                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Has cancelado el proceso de pago en Webpay.
                        </div>

                        <!-- Detalles de la transacción cancelada -->
                        <div class="transaction-details mt-4 text-start p-4 rounded">
                            <h5 class="mb-3 text-secondary-color"><i class="fas fa-info-circle me-2"></i>Información:</h5>
                            <div class="transaction-items">
                                <div class="transaction-item">
                                    <span class="transaction-label">Estado:</span>
                                    <span class="transaction-value"><span class="badge bg-warning text-dark">Cancelado
                                            por usuario</span></span>
                                </div>
                                @if(isset($buyOrder))
                                    <div class="transaction-item">
                                        <span class="transaction-label">Orden de compra:</span>
                                        <span class="transaction-value">{{ $buyOrder }}</span>
                                    </div>
                                @endif
                                @if(isset($amount))
                                    <div class="transaction-item">
                                        <span class="transaction-label">Monto:</span>
                                        <span class="transaction-value">${{ number_format($amount, 0, ',', '.') }}
                                            CLP</span>
                                    </div>
                                @endif
                                <div class="transaction-item">
                                    <span class="transaction-label">Fecha:</span>
                                    <span class="transaction-value">{{ date('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-5">
                            <a href="{{ route('index') }}" class="btn btn-primary py-2">
                                <i class="fas fa-home me-2"></i> Ir al inicio
                            </a>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center bg-light">
                        <p class="small text-muted mt-2">© {{ date('Y') }} AbogaSense. Todos los derechos reservados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>