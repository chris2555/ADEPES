@extends('adminlte::page')

@section('title', 'Editar Referencia Familiar')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Editar Referencia Familiar</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Actualizar Información</h3>
                    </div>

                    <form id="editForm" action="{{ route('referencias.update', $referencia['id_referencia']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <!-- ID de Referencia (readonly) -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="id_referencia" id="id_referencia" label="ID de Referencia" value="{{ $referencia['id_referencia'] }}" readonly fgroup-class="mb-3" />
                                </div>

                                <!-- ID de Solicitud -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="id_solicitud" id="id_solicitud" label="ID de Solicitud" value="{{ $referencia['id_solicitud'] }}" required fgroup-class="mb-3" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Nombre del Familiar -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="nombre_familiar" id="nombre_familiar" label="Nombre del Familiar" value="{{ $referencia['nombre_familiar'] }}" required fgroup-class="mb-3" />
                                </div>

                                <!-- Parentesco -->
                                <div class="col-md-6">
                                    <x-adminlte-input name="parentesco" id="parentesco" label="Parentesco" value="{{ $referencia['parentesco'] }}" fgroup-class="mb-3" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Dirección -->
                                <div class="col-md-12">
                                    <x-adminlte-textarea name="direccion_familiar" id="direccion_familiar" label="Dirección" fgroup-class="mb-3" rows="3">{{ $referencia['direccion_familiar'] }}</x-adminlte-textarea>
                                </div>
                            </div>

                            <!-- Usuario Modificador -->
                            <input type="hidden" name="modificado_por" value="{{ auth()->user()->id }}">
                        </div>

                        <!-- Botones bien alineados -->
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="{{ route('referencias.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <x-adminlte-button class="btn-flat" type="submit" id="btnActualizar" label="Actualizar Referencia" theme="success" icon="fas fa-lg fa-save" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById("editForm").addEventListener("submit", function(event) {
    // Obtener valores
    let idSolicitud = document.getElementById("id_solicitud").value.trim();
    let nombreFamiliar = document.getElementById("nombre_familiar").value.trim();
    let parentesco = document.getElementById("parentesco").value.trim();
    let direccionFamiliar = document.getElementById("direccion_familiar").value.trim();

    // Expresiones regulares
    let soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Letras, acentos y espacios
    let letrasYNumeros = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s.,#-]+$/; // Letras, números y caracteres básicos

    // Validación ID Solicitud (debe ser mayor que 0)
    if (isNaN(idSolicitud) || idSolicitud < 1) {
        alert("Error: ID Solicitud debe ser un número mayor que 0.");
        event.preventDefault();
        return;
    }

    // Validación Nombre del Familiar (solo letras y espacios)
    if (!soloLetras.test(nombreFamiliar)) {
        alert("Error: Nombre del Familiar solo puede contener letras y espacios.");
        event.preventDefault();
        return;
    }

    // Validación Parentesco (solo letras y espacios, si se ingresa)
    if (parentesco !== "" && !soloLetras.test(parentesco)) {
        alert("Error: Parentesco solo puede contener letras y espacios.");
        event.preventDefault();
        return;
    }

    // Validación Dirección (letras, números y caracteres especiales permitidos)
    if (direccionFamiliar !== "" && !letrasYNumeros.test(direccionFamiliar)) {
        alert("Error: Dirección solo puede contener letras, números y algunos caracteres especiales.");
        event.preventDefault();
        return;
    }

    // Si pasa todas las validaciones, el formulario se enviará
});
</script>

@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita la recarga inmediata

    // Obtener valores de los campos
    let idSolicitud = document.getElementById("id_solicitud").value.trim();
    let nombreFamiliar = document.getElementById("nombre_familiar").value.trim();
    let parentesco = document.getElementById("parentesco").value.trim();
    let direccionFamiliar = document.getElementById("direccion_familiar").value.trim();

    // Expresiones regulares para validaciones
    let soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Solo letras, acentos y espacios
    let letrasYNumeros = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s.,#-]+$/; // Letras, números y caracteres básicos

    // Validación ID Solicitud (debe ser mayor que 0)
    if (isNaN(idSolicitud) || idSolicitud < 1) {
        return; // No enviar el formulario
    }

    // Validación Nombre del Familiar (solo letras y espacios)
    if (!soloLetras.test(nombreFamiliar)) {
        return;
    }

    // Validación Parentesco (opcional, pero debe contener solo letras y espacios si se ingresa)
    if (parentesco !== "" && !soloLetras.test(parentesco)) {
        return;
    }

    // Validación Dirección (opcional, pero debe contener letras, números y caracteres especiales permitidos)
    if (direccionFamiliar !== "" && !letrasYNumeros.test(direccionFamiliar)) {
        return;
    }

    // Si todas las validaciones pasan, enviar la solicitud
    let form = event.target;

    fetch(form.action, {
        method: form.method,
        body: new FormData(form),
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Accept": "application/json" // Asegura que Laravel responda en JSON
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirigir directamente a la vista de referencias sin SweetAlert
            window.location.href = "{{ route('referencias.index') }}";
        } else {
            alert("Error: No se pudo actualizar la referencia.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Error: Hubo un problema con la actualización.");
    });
});
</script>

@stop