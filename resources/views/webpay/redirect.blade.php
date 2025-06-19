<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redireccionando a Webpay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .redirect-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .spinner {
            width: 3rem;
            height: 3rem;
            margin: 2rem auto;
        }
    </style>
</head>
<body>
    <div class="redirect-container">
        <img src="{{ asset('images/abogasense2.png') }}" alt="AbogaSense" style="height: 60px;" class="mb-4">
        <h3 class="mb-4" style="color: #4A1D0B;">Redireccionando a Webpay</h3>
        <div class="spinner-border text-primary spinner" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mb-4">Estás siendo redirigido a la pasarela de pago de Webpay. Por favor no cierres esta página.</p>
        <p class="text-muted small">Si la redirección no funciona automáticamente, haz clic en el botón de abajo.</p>
        
        <form id="webpayForm" action="{{ $url }}" method="POST">
            <input type="hidden" name="token_ws" value="{{ $token }}">
            <button type="submit" class="btn btn-primary">Continuar al pago</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('webpayForm').submit();
        });
    </script>
</body>
</html>