<section class="bg-white p-4 rounded-3 shadow-sm">
    <h5 class="fw-medium mb-3 delete-user-title">
        <i class="bi bi-trash3 me-2"></i>{{ __('Eliminar Cuenta') }}
    </h5>

    <div class="p-3 mb-4 text-center delete-user-warning">
        <p class="mb-3 delete-user-warning-text">
            {{ __('Una vez eliminada su cuenta, todos sus datos se eliminarán permanentemente.') }}
        </p>
        <div class="text-center">
            <button class="btn fw-medium py-1 delete-user-btn" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ __('Eliminar Cuenta') }}
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold delete-user-modal-title" id="confirmUserDeletionLabel">
                        <i class="bi bi-exclamation-octagon me-2"></i>{{ __('Confirmar Eliminación') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="delete-user-modal-text">
                        {{ __('Esta acción no se puede deshacer. Todos sus datos serán eliminados permanentemente. Para confirmar, ingrese su contraseña.') }}
                    </p>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium delete-user-label">
                            <i class="bi bi-lock me-1"></i>{{ __('Contraseña') }}
                        </label>
                        <div class="input-group">
                            <span class="input-group-text delete-user-input-group-text">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 delete-user-input"
                                placeholder="Ingrese su contraseña" id="password"
                                name="password" required>
                            <button class="btn delete-user-eye-btn" type="button" onclick="togglePassword('password')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn fw-medium delete-user-cancel-btn" data-bs-dismiss="modal">
                        {{ __('Cancelar') }}
                    </button>
                    <button type="submit" class="btn fw-medium delete-user-confirm-btn">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Eliminar Definitivamente') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

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

@push('styles')
<style>
.delete-user-title {
    color: #8C2D18;
}
.delete-user-warning {
    background-color: #FDF5E5;
    border-radius: 8px;
}
.delete-user-warning-text {
    color: #8C2D18;
}
.delete-user-btn {
    background-color: #8C2D18;
    color: white;
    width: 210px;
}
.delete-user-modal-title {
    color: #8C2D18;
}
.delete-user-modal-text {
    color: #8C2D18;
}
.delete-user-label {
    color: #8C2D18;
}
.delete-user-input-group-text {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.delete-user-input {
    background-color: #FDF5E5;
}
.delete-user-eye-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.delete-user-cancel-btn {
    background-color: #F5E8D0;
    color: #8C2D18;
}
.delete-user-confirm-btn {
    background-color: #8C2D18;
    color: white;
}
</style>
@endpush
