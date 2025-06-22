<section class="bg-white p-4 rounded-3 shadow-sm mb-1">
    <h5 class="fw-medium mb-3" style="color: #8C2D18;">
        <i class="bi bi-shield-lock me-2"></i>{{ __('Actualizar Contraseña') }}
    </h5>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label fw-medium" style="color: #8C2D18;">
                <i class="bi bi-lock me-1"></i>{{ __('Contraseña Actual') }}
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                    <i class="bi bi-key"></i>
                </span>
                <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                    placeholder="Ingrese su contraseña actual" id="update_password_current_password"
                    name="current_password" autocomplete="current-password">
                <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                    onclick="togglePassword('update_password_current_password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label fw-medium" style="color: #8C2D18;">
                <i class="bi bi-lock me-1"></i>{{ __('Nueva Contraseña') }}
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                    <i class="bi bi-key"></i>
                </span>
                <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                    placeholder="Ingrese una contraseña segura" id="update_password_password" name="password"
                    autocomplete="new-password">
                <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                    onclick="togglePassword('update_password_password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label fw-medium" style="color: #8C2D18;">
                <i class="bi bi-lock me-1"></i>{{ __('Confirmar Nueva Contraseña') }}
            </label>
            <div class="input-group">
                <span class="input-group-text" style="background-color: #F5E8D0; color: #8C2D18;">
                    <i class="bi bi-key-fill"></i>
                </span>
                <input type="password" class="form-control border-start-0" style="background-color: #FDF5E5;"
                    placeholder="Confirme la contraseña ingresada anteriormente"
                    id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                <button class="btn" type="button" style="background-color: #F5E8D0; color: #8C2D18;"
                    onclick="togglePassword('update_password_password_confirmation')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top text-center">
            <button type="submit" class="btn fw-medium py-1"
                style="background-color: #8C2D18; color: white; width: 250px;">
                <i class="bi bi-save me-2"></i>{{ __('Actualizar Contraseña') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="mt-3 small" style="color: #BF8A49;" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 3000)">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Contraseña actualizada correctamente.') }}
                </div>
            @endif
        </div>
    </form>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</section>

@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordForm = document.querySelector('form[action="{{ route('password.update') }}"]');
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(passwordForm);
                formData.append('_method', 'PUT');
                fetch(passwordForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(async response => {
                    if (!response.ok) {
                        const data = await response.json();
                        if (data.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: Object.values(data.errors).map(arr => arr.join('<br>')).join('<br>'),
                                confirmButtonColor: '#8C2D18'
                            });
                        } else {
                            throw new Error();
                        }
                    } else {
                        const data = await response.json();
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: data.success,
                                confirmButtonColor: '#8C2D18'
                            }).then(() => {
                                passwordForm.reset();
                            });
                        }
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error inesperado.',
                        confirmButtonColor: '#8C2D18'
                    });
                });
            });
        }
    });
    </script>
@endpush