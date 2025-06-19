<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de tu Compra - AbogaSense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6B3A2C;
            --secondary-color: #4A1D0B;
            --accent-color: #D89B6A;
            --light-bg: #FFF9F5;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .checkout-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(107, 58, 44, 0.1);
            transition: transform 0.3s ease;
        }

        .checkout-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1.5rem;
        }

        .plan-name {
            color: var(--secondary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .plan-name:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--accent-color);
        }

        .price-tag {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 15px 0;
        }

        .feature-item {
            padding: 12px 0;
            border-bottom: 1px solid rgba(107, 58, 44, 0.1);
            display: flex;
            align-items: center;
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-icon {
            color: var(--accent-color);
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .btn-pay {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border: none;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(107, 58, 44, 0.3);
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(216, 155, 106, 0.25);
        }

        .section-title {
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .secure-badge {
            background-color: rgba(107, 58, 44, 0.1);
            color: var(--secondary-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-top: 20px;
        }

        .secure-icon {
            color: #28a745;
            margin-right: 8px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/abogasense2.png') }}" alt="AbogaSense" style="height: 60px;"
                        class="mb-3">
                    <h2 class="fw-bold" style="color: var(--primary-color);">Finaliza tu compra</h2>
                    <p class="text-muted">Estás a un paso de acceder a todos los beneficios de tu plan</p>
                </div>

                <div class="checkout-card card mb-4">
                    <div class="card-header text-center text-white">
                        <h3 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Resumen de tu Compra</h3>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Resumen del plan -->
                        <div class="mb-5">
                            <h4 class="plan-name fw-bold">{{ $plan['name'] }}</h4>
                            <p class="price-tag">CLP ${{ number_format($plan['price'], 0, ',', '.') }}</p>

                            <h6 class="fw-bold mb-3" style="color: var(--primary-color);">Beneficios incluidos:</h6>
                            <ul class="list-unstyled">
                                @foreach ($plan['features'] as $feature)
                                    <li class="feature-item">
                                        <i class="fas fa-check-circle feature-icon"></i>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Formulario de datos -->
                        <h5 class="section-title fw-bold" style="color: var(--primary-color);">Tus datos</h5>

                        <form method="POST" action="{{ route('plan.checkout.pay') }}" id="paymentForm">
                            @csrf
                            <input type="hidden" name="plan_name" value="{{ $plan['name'] }}">
                            <input type="hidden" name="plan_price" value="{{ $plan['price'] }}">

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Nombre completo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i
                                            class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" placeholder="Ej: María González"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i
                                            class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Ej: tuemail@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="form-label fw-bold">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i
                                            class="fas fa-phone text-muted"></i></span>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}" placeholder="+56912345678"
                                        required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="subdomain" class="form-label fw-bold">Subdominio</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i
                                            class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" class="form-control @error('subdomain') is-invalid @enderror"
                                        id="subdomain" name="subdomain" value="{{ old('subdomain') }}"
                                        placeholder="Ej: miempresa" required>
                                    @error('subdomain')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small id="subdomain-feedback" class="form-text"></small>

                            </div>

                            <div class="alert alert-light border mb-4" style="border-color: rgba(107, 58, 44, 0.2);">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope-open-text me-3"
                                        style="color: var(--accent-color); font-size: 1.5rem;"></i>
                                    <div>
                                        <p class="mb-0 fw-semibold" style="color: var(--secondary-color);">
                                            Recibirás toda la información en tu correo electrónico
                                        </p>
                                        <small class="text-muted">
                                            Una vez completado el pago, te enviaremos los detalles de acceso y
                                            documentación relevante a la dirección de correo proporcionada.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-pay text-white py-2" id="pay-button">
                                    <span id="pay-text">Pagar ahora</span>
                                    <span id="pay-spinner" class="spinner-border spinner-border-sm ms-2 d-none"
                                        role="status"></span>
                                </button>
                            </div>

                            <div class="text-center mt-2">
                                <span class="secure-badge">
                                    <i class="fas fa-lock secure-icon"></i>
                                    Pago seguro y encriptado
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center text-muted mt-4">
                    <p class="small">¿Necesitas ayuda? <a href="#" style="color: var(--primary-color);">Contáctanos</a>
                    </p>
                    <p class="small">Al completar tu compra aceptas nuestros <a href="#"
                            style="color: var(--primary-color);">Términos y Condiciones</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentForm = document.getElementById('paymentForm');

            if (paymentForm) {
                paymentForm.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const payButton = document.getElementById('pay-button');
                    const payText = document.getElementById('pay-text');
                    const paySpinner = document.getElementById('pay-spinner');

                    // Actualizar UI
                    payText.innerText = 'Procesando pago...';
                    paySpinner.classList.remove('d-none');
                    payButton.disabled = true;

                    try {
                        // Enviar datos del formulario
                        const formData = new FormData(paymentForm);
                        const response = await fetch(paymentForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (data.url && data.token) {
                            // Crear formulario dinámico para redirección a Webpay
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = data.url;

                            const tokenInput = document.createElement('input');
                            tokenInput.type = 'hidden';
                            tokenInput.name = 'token_ws';
                            tokenInput.value = data.token;

                            form.appendChild(tokenInput);
                            document.body.appendChild(form);
                            form.submit();
                        } else {
                            throw new Error('Respuesta inesperada del servidor');
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        payText.innerText = 'Pagar ahora';
                        paySpinner.classList.add('d-none');
                        payButton.disabled = false;

                        // Mostrar mensaje de error
                        alert('Ocurrió un error al procesar el pago. Por favor intente nuevamente.');
                    }
                });
            }
        });
    </script>
    <script>
        document.getElementById('subdomain').addEventListener('input', function () {
            const subdomain = this.value.trim();
            const feedback = document.getElementById('subdomain-feedback');
            const payButton = document.getElementById('pay-button');

            if (subdomain.length < 3) {
                feedback.textContent = 'El subdominio debe tener al menos 3 caracteres.';
                feedback.className = 'form-text text-warning';
                payButton.disabled = true;
                return;
            }

            fetch(`{{ route('subdomain.check') }}?subdomain=${encodeURIComponent(subdomain)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        feedback.textContent = 'El subdominio ya está ocupado.';
                        feedback.className = 'form-text text-danger';
                        payButton.disabled = true;
                    } else {
                        feedback.textContent = 'El subdominio está disponible.';
                        feedback.className = 'form-text text-success';
                        payButton.disabled = false;
                    }
                })
                .catch(() => {
                    feedback.textContent = 'Error al verificar el subdominio.';
                    feedback.className = 'form-text text-danger';
                    payButton.disabled = true;
                });
        });
    </script>


</body>

</html>