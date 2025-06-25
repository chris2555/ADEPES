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

            {{-- Nueva contraseña --}}
            <div class="form-group" style="position: relative;">
                <label for="update_password_password" class="font-medium">{{ __('Nueva Contraseña') }}</label>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="form-control mt-1 block w-full" 
                    autocomplete="new-password" 
                >
                <button type="button"
                        id="togglePassword"
                        style="position:absolute;right:10px;top:38px;background:none;border:none;cursor:pointer">
                    Mostrar
                </button>
                @error('updatePassword.password')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            {{-- Requisitos --}}
            <div id="password-requirements" style="margin-top: 10px;">
                <p id="length" style="color: red;">• Al menos 8 caracteres</p>
                <p id="uppercase" style="color: red;">• Al menos 1 letra mayúscula</p>
                <p id="number" style="color: red;">• Al menos 1 número</p>
                <p id="special" style="color: red;">• Al menos 1 carácter especial</p>
            </div>

            {{-- Confirmar contraseña --}}
            <div class="form-group" style="position: relative;">
                <label for="update_password_password_confirmation" class="font-medium">{{ __('Confirmar Contraseña') }}</label>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="form-control mt-1 block w-full" 
                    autocomplete="new-password" 
                >
                <button type="button"
                        id="toggleConfirmPassword"
                        style="position:absolute;right:10px;top:38px;background:none;border:none;cursor:pointer">
                    Mostrar
                </button>
                <div id="password-match" style="margin-top: 10px; color: red;">
                    Las contraseñas no coinciden.
                </div>
                @error('updatePassword.password_confirmation')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            {{-- Botón Guardar --}}
<div class="card-footer">
    <button
        type="submit"
        id="saveBtn"
        class="btn btn-primary disabled"  {{-- «disabled» para estilo gris --}}
        disabled                           {{-- deshabilitado de verdad --}}
    >
        {{ __('Guardar') }}
    </button>
</div>

        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form          = document.querySelector('form');
    const passwordInput = document.querySelector('#update_password_password');
    const confirmInput  = document.querySelector('#update_password_password_confirmation');
    const saveBtn       = document.getElementById('saveBtn');

    const lengthReq   = document.getElementById('length');
    const uppercaseReq= document.getElementById('uppercase');
    const numberReq   = document.getElementById('number');
    const specialReq  = document.getElementById('special');
    const passwordMatch = document.getElementById('password-match');

    /* ---------- funciones ---------- */
    function reglasCumplidas () {
        const val = passwordInput.value;
        const lengthValid    = val.length >= 8;
        const uppercaseValid = /[A-Z]/.test(val);
        const numberValid    = /[0-9]/.test(val);
        const specialValid   = /[!@#$%^&*(),.?":{}|<>]/.test(val);

        lengthReq.style.color    = lengthValid    ? 'green' : 'red';
        uppercaseReq.style.color = uppercaseValid ? 'green' : 'red';
        numberReq.style.color    = numberValid    ? 'green' : 'red';
        specialReq.style.color   = specialValid   ? 'green' : 'red';

        return lengthValid && uppercaseValid && numberValid && specialValid;
    }

    function coincide () {
        const ok = passwordInput.value === confirmInput.value && confirmInput.value !== '';
        passwordMatch.textContent = ok ? 'Las contraseñas coinciden.' : 'Las contraseñas no coinciden.';
        passwordMatch.style.color = ok ? 'green' : 'red';
        return ok;
    }

    function actualizarBoton () {
        const habilitar = reglasCumplidas() && coincide();
        saveBtn.disabled = !habilitar;

        // agrega o quita clase «disabled» para el estilo de Bootstrap
        if (habilitar) {
            saveBtn.classList.remove('disabled');
        } else {
            saveBtn.classList.add('disabled');
        }
    }

    /* eventos */
    passwordInput.addEventListener('input', actualizarBoton);
    confirmInput .addEventListener('input', actualizarBoton);

    /* impedir envío si alguien fuerza el botón */
    form.addEventListener('submit', (e) => {
        if (saveBtn.disabled) {
            e.preventDefault();
            alert('Debes cumplir todos los requisitos y que ambas contraseñas coincidan.');
        }
    });

    /* ---------- toggle mostrar/ocultar ---------- */
    const togglePassword        = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    togglePassword.addEventListener('click', () => {
        const mostrar = passwordInput.type === 'password';
        passwordInput.type = mostrar ? 'text' : 'password';
        togglePassword.textContent = mostrar ? 'Ocultar' : 'Mostrar';
    });

    toggleConfirmPassword.addEventListener('click', () => {
        const mostrar = confirmInput.type === 'password';
        confirmInput.type = mostrar ? 'text' : 'password';
        toggleConfirmPassword.textContent = mostrar ? 'Ocultar' : 'Mostrar';
    });

    /* estado inicial */
    actualizarBoton();
});
</script>




