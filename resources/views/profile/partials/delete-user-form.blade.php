<section class="card">
    <header class="card-header">
        <h2 class="h5 mb-2 text-danger">
            {{ __('Eliminar cuenta') }}
        </h2>

        <p class="text-muted small">
            {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}
        </p>
    </header>

    <div class="card-body">
        <button
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#confirmUserDeletionModal"
        >
            {{ __('Eliminar cuenta') }}
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                            {{ __('¿Está seguro de que desea eliminar su cuenta?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Por favor, ingrese su contraseña para confirmar que desea eliminar su cuenta de forma permanente.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                {{ __('Contraseña') }}
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="{{ __('Contraseña') }}"
                            />
                            @error('password', 'userDeletion')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancelar') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar cuenta') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
