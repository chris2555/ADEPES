<section class="card card-primary col-md-12">
    <div class="card-header">
        <h3 class="card-title text-lg font-medium">
            {{ __('Información del Perfil') }}
        </h3>
        <br>
        <hr>
        <p class="mt-1 text-sm">
            {{ __('Actualiza la información de tu perfil y dirección de correo electrónico.') }}
        </p>
    </div>

    <div class="card-body">
        <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name" class="font-medium">{{ __('Nombre') }}</label>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="form-control mt-1 block w-full" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autofocus 
                    autocomplete="name" 
                >
                @error('name')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="font-medium">{{ __('Correo Electrónico') }}</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="form-control mt-1 block w-full" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username" 
                >
                @error('email')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800">
                            {{ __('Tu dirección de correo electrónico no está verificada.') }}

                            <button 
                                form="send-verification" 
                                class="btn btn-link p-0 align-baseline text-primary"
                            >
                                {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-success">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                @if (session('status') === 'profile-updated')
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

