<section class="card card-primary col-md-12">
    <div class="card-header">
        <h3 class="card-title text-lg font-medium">
            {{ __('Actualizar Contraseña') }}
        </h3>
        <br>
        <hr>
        <p class="mt-1 text-sm">
            {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="update_password_current_password" class="font-medium">{{ __('Contraseña Actual') }}</label>
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="form-control mt-1 block w-full" 
                    autocomplete="current-password" 
                >
                @error('updatePassword.current_password')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password" class="font-medium">{{ __('Nueva Contraseña') }}</label>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="form-control mt-1 block w-full" 
                    autocomplete="new-password" 
                >
                @error('updatePassword.password')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password_confirmation" class="font-medium">{{ __('Confirmar Contraseña') }}</label>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="form-control mt-1 block w-full" 
                    autocomplete="new-password" 
                >
                @error('updatePassword.password_confirmation')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success mt-2"
                    >
                        {{ __('Guardado.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>
