@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password"
                                           class="form-control form-control-dark @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password"
                                           placeholder="Contraseña"
                                           title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo"
                                           style="max-width: 450px;">
                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye" id="iconPwd"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password-confirm" type="password"
                                           class="form-control form-control-dark"
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="Confirmar Contraseña"
                                           style="max-width: 450px;">
                                    <button type="button" id="toggleConfirmPassword" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye" id="iconConfirmPwd"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submitBtn" class="btn btn-primary" disabled>
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Validación y visibilidad de contraseña --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form                 = document.getElementById('resetPasswordForm');
    const passwordInput        = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password-confirm');
    const submitBtn            = document.getElementById('submitBtn');
    const togglePassword       = document.getElementById('togglePassword');
    const toggleConfirmPassword= document.getElementById('toggleConfirmPassword');
    const iconPwd              = document.getElementById('iconPwd');
    const iconConfirmPwd       = document.getElementById('iconConfirmPwd');

    const strongPwd = pwd =>
        /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()[\]{};:'",.<>/?\\|`~\-_=+]).{8,}$/.test(pwd);

    const setInputStatus = (input, isValid) => {
        input.classList.toggle('is-invalid', !isValid);
        input.classList.toggle('is-valid', isValid);
    };

    const toggleSubmitBtn = () => {
        const validPwd = strongPwd(passwordInput.value);
        const match    = passwordInput.value === confirmPasswordInput.value;
        submitBtn.disabled = !(validPwd && match);
    };

    const toggleVisibility = (input, icon) => {
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    };

    togglePassword.addEventListener('click', () => {
        toggleVisibility(passwordInput, iconPwd);
    });

    toggleConfirmPassword.addEventListener('click', () => {
        toggleVisibility(confirmPasswordInput, iconConfirmPwd);
    });

    passwordInput.addEventListener('input', () => {
        setInputStatus(passwordInput, strongPwd(passwordInput.value));
        toggleSubmitBtn();
    });

    confirmPasswordInput.addEventListener('input', () => {
        setInputStatus(confirmPasswordInput, confirmPasswordInput.value === passwordInput.value);
        toggleSubmitBtn();
    });

    form.addEventListener('submit', e => {
        const validPwd = strongPwd(passwordInput.value);
        const match    = passwordInput.value === confirmPasswordInput.value;

        setInputStatus(passwordInput, validPwd);
        setInputStatus(confirmPasswordInput, match);

        if (!match || !validPwd) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: !match
                    ? 'Las contraseñas no coinciden.'
                    : 'La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.'
            });
        }
    });
});
</script>
@endpush
@endsection
