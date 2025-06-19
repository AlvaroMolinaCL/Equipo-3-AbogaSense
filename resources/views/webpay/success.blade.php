<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso | AbogaSense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4A1D0B;
            --secondary-color: #6B3A2C;
            --success-color: #28a745;
            --light-brown: #F5E9E1;
            --dark-brown: #3A1A0A;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .success-card {
            max-width: 650px;
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .success-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: none;
        }

        .success-icon {
            font-size: 5rem;
            color: var(--success-color);
            animation: bounceIn 1s;
        }

        .transaction-details {
            border-left: 4px solid var(--primary-color);
            background-color: var(--light-brown);
            transition: all 0.3s ease;
        }

        .transaction-details:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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

        .benefits-list {
            list-style-type: none;
            padding-left: 0;
        }

        .benefits-list li {
            padding: 8px 0;
            position: relative;
            padding-left: 30px;
        }

        .benefits-list li:before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: var(--success-color);
            position: absolute;
            left: 0;
        }

        @media (max-width: 576px) {
            .success-icon {
                font-size: 4rem;
            }

            .card-body {
                padding: 20px;
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
                <div class="card success-card animate__animated animate__fadeInUp mx-auto">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-check-circle me-2"></i>Confirmación de Pago</h2>
                    </div>
                    <div class="card-body text-center pt-4 p-md-3">
                        <i class="fas fa-check-circle success-icon mb-4"></i>
                        <h2 class="mb-3" style="color: var(--primary-color);">¡Pago Completado Exitosamente!</h2>

                        @if(isset($isPlanPurchase) && $isPlanPurchase)
                            <p class="lead mb-4">Gracias por adquirir el plan <strong
                                    class="text-success">{{ $planName }}</strong> en AbogaSense.</p>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-envelope me-2"></i> Hemos enviado los detalles de tu compra a tu correo
                                electrónico.
                            </div>

                            <!-- Beneficios del plan -->
                            <div class="benefits-container mt-4 text-start bg-white p-4 rounded border">
                                <h5 class="mb-3" style="color: var(--secondary-color);"><i
                                        class="fas fa-star me-2"></i>Beneficios de tu plan:</h5>
                                <ul class="benefits-list">
                                    <li>Acceso completo a todas las funciones premium</li>
                                    <li>Soporte prioritario 24/7</li>
                                    <li>Actualizaciones automáticas</li>
                                    <li>Almacenamiento ampliado</li>
                                </ul>
                            </div>
                        @else
                            <p class="lead mb-4">Tu transacción ha sido procesada correctamente.</p>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-envelope me-2"></i> Hemos enviado el comprobante a tu correo electrónico.
                            </div>
                        @endif

                        <!-- Detalles de la transacción - Versión vertical -->
                        <div class="transaction-details mt-4 text-start p-4 rounded">
                            <h5 class="mb-3" style="color: var(--secondary-color);"><i
                                    class="fas fa-receipt me-2"></i>Detalles de la transacción:</h5>
                            <div class="transaction-items">
                                <div class="transaction-item">
                                    <span class="transaction-label">Orden de compra:</span>
                                    <span class="transaction-value">{{ $buyOrder }}</span>
                                </div>
                                <div class="transaction-item">
                                    <span class="transaction-label">Monto:</span>
                                    <span class="transaction-value">${{ number_format($amount, 0, ',', '.') }}
                                        CLP</span>
                                </div>
                                <div class="transaction-item">
                                    <span class="transaction-label">Fecha:</span>
                                    <span
                                        class="transaction-value">{{ date('d/m/Y H:i', strtotime($transactionDate)) }}</span>
                                </div>
                                <div class="transaction-item">
                                    <span class="transaction-label">Estado:</span>
                                    <span class="transaction-value"><span
                                            class="badge bg-success">Aprobado</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-3">
                            <a href="{{ route('index') }}" class="btn btn-primary py-2">
                                <i class="fas fa-home me-2"></i> Volver al inicio
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