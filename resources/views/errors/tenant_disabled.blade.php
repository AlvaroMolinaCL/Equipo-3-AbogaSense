{{-- resources/views/errors/tenant_disabled.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acceso Denegado - Tenant Deshabilitado</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Roboto&display=swap" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
        }
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f0e6, #8c2d18);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeInBackground 1.5s ease forwards;
        }
        @keyframes fadeInBackground {
            from { background-position: 0% 50%; }
            to { background-position: 100% 50%; }
        }
        .container {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 12px 35px rgba(140, 45, 24, 0.3);
            max-width: 420px;
            text-align: center;
            animation: slideUp 0.8s ease forwards;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 2.5rem;
            color: #8c2d18;
            margin-bottom: 15px;
        }
        p {
            font-size: 1.15rem;
            margin-bottom: 25px;
            color: #555;
        }
        .btn-home {
            background-color: #8c2d18;
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .btn-home:hover {
            background-color: #bf8a49;
            color: white;
        }
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
                max-width: 90vw;
            }
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container" role="alert" aria-live="assertive" aria-atomic="true">
        <h1>Acceso Denegado</h1>
        <p>Este sitio está temporalmente deshabilitado. Por favor, intenta nuevamente más tarde o contacta al administrador.</p>
        <a href="{{ route('index') }}" class="btn-home" aria-label="Volver a la página principal">Volver al Inicio</a>
    </div>
</body>
</html>
