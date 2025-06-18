<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Cancelado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .warning-card {
            max-width: 600px;
            border-radius: 15px;
            border: 1px solid #ffc107;
        }
        .warning-icon {
            font-size: 5rem;
            color: #ffc107;
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
                <div class="card warning-card shadow">
                    <div class="card-body text-center p-5">
                        <i class="fas fa-exclamation-triangle warning-icon mb-4"></i>
                        <h2 class="mb-3" style="color: #4A1D0B;">Pago Cancelado</h2>
                        
                        <p class="lead">Has cancelado el proceso de pago en Webpay.</p>

                        <div class="mt-4">
                            <p>Si fue un error, puedes volver a intentar completar tu compra.</p>
                        </div>

                        <div class="mt-5 d-flex justify-content-center gap-3">
                            <a href="{{ url('/planes') }}" class="btn btn-primary">
                                <i class="fas fa-undo me-2"></i> Volver a planes
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i> Ir al inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>