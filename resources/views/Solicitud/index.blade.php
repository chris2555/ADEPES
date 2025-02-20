@extends('layout.app')

@section('subtitle', 'Sucursales')

@section('content_body')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Solicitudes</h1>
    </header>

    <section>
        <x-adminlte-datatable striped id="table" :heads="['ID Solicitud', 'Garantia', 'Cuota', 'Tasa', 'Plazo','Monto','Acciones']" with-buttons>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud['id_solicitud'] }}</td>
                <td>{{ $solicitud['tipo_garantia'] }}</td>
                <td>{{ $solicitud['tipo_cuota'] }}</td>
                <td>{{ $solicitud['tasa'] }}</td>
                <td>{{ $solicitud['plazo'] }}</td>
                <td>{{ $solicitud['monto'] }}</td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="viewModal({{ json_encode($solicitud) }})">
                        <i class="fa fa-eye"></i>
                    </a>
                    
                    <a href="{{ route('solicitud.edit', $solicitud['id_solicitud']) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('solicitud.destroy', $solicitud['id_solicitud']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta solicitud?');">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </x-adminlte-datatable>
        
        
    </section>

    <x-adminlte-modal id="view" size="lg" title="Información de Solicitud">
        <div class="form-group">
            <label for="tipoGarantia">Tipo Garantia</label>
            <p id="tipoGarantia"></p>
        </div>
    
        <div class="form-group">
            <label for="tipoCuota">Tipo Cuota</label>
            <p id="tipoCuota"></p>
        </div>
    
        <div class="form-group">
            <label for="tasa">Tasa</label>
            <p id="tasa"></p>
        </div>
    
        <div class="form-group">
            <label for="plazo">Plazo</label>
            <p id="plazo"></p>
        </div>
    
        <div class="form-group">
            <label for="monto">Monto</label>
            <p id="monto"></p>
        </div>
    
        <div class="form-group">
            <label for="invierteEn">Invierte En</label>
            <p id="invierteEn"></p>
        </div>
    
        <div class="form-group">
            <label for="tipoCredito">Tipo Credito</label>
            <p id="tipoCredito"></p>
        </div>

        <div class="form-group">
            <label for="estadoSolicitud">EstadoSolicitud</label>
            <p id="estadoSolicitud"></p>
        </div>

        <div class="form-group">
            <label for="valorCuota">Valor Cuota</label>
            <p id="valorCuota"></p>
        </div>

        <div class="form-group">
            <label for="esAval">Es Aval</label>
            <p id="esAval"></p>
        </div>
    
        <div class="form-group">
            <label for="creadoPor">Creado por</label>
            <p id="creadoPor"></p>
        </div>
    
        <div class="form-group">
            <label for="creadoEn">Creado en</label>
            <p id="creadoEn"></p>
        </div>
    
        <div class="form-group">
            <label for="modificadoPor">Modificado por</label>
            <p id="modificadoPor"></p>
        </div>
    
        <div class="form-group">
            <label for="modificadoEn">Modificado en</label>
            <p id="modificadoEn"></p>
        </div>
    </x-adminlte-modal>
    


    {{-- este es el modal para editar un registro, cambiar solo title y los campos a mostrar --}}
    <x-adminlte-modal onclick="" id="edit" size="lg" title="Modifica una solicitud">
        <form id="updateForm">

            <div class="row">

                <x-adminlte-input name="UPDATE_PI_COD_SUCURSAL" id="cod" readonly label="Codigo de la Sucursal"
                    placeholder="Ingresa el Codigo de la Sucursal" fgroup-class="col-md-6" />

                <x-adminlte-input name="UPDATE_PV_NOM_SUCURSAL" label="Nombre de la Sucursal"
                    placeholder="Ingresa el Nombre de la Sucursal" fgroup-class="col-md-6" />

                <x-adminlte-input name="UPDATE_PI_COD_GERENTE" type="number" label="Codigo de Gerente"
                    placeholder="Ingresa el Codigo del Gerente" fgroup-class="col-md-6" />

                <x-adminlte-input name="UPDATE_PI_COD_UBICACION" type="number" label="Codigo de Ubicacion"
                    placeholder="Ingresa el codigo de la ubicacion" fgroup-class="col-md-6" />
            </div>
            <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save" />
        </form>

        <span id="idField"></span>
    </x-adminlte-modal>


@stop

@section('js')
    <script>
      function viewModal(solicitud) {
    // Actualizar los valores en el modal
    document.getElementById('tipoGarantia').textContent = solicitud.tipo_garantia;
    document.getElementById('tipoCuota').textContent = solicitud.tipo_cuota;
    document.getElementById('tasa').textContent = solicitud.tasa;
    document.getElementById('plazo').textContent = solicitud.plazo;
    document.getElementById('monto').textContent = solicitud.monto;
    document.getElementById('invierteEn').textContent = solicitud.invierte_en;
    document.getElementById('tipoCredito').textContent = solicitud.tipo_credito;
    document.getElementById('estadoSolicitud').textContent = solicitud.estado_solicitud;
    document.getElementById('valorCuota').textContent = solicitud.valor_cuota;
    document.getElementById('esAval').textContent = solicitud.es_aval;
    document.getElementById('creadoPor').textContent = solicitud.creado_por;
    document.getElementById('creadoEn').textContent = solicitud.creado_en ? solicitud.creado_en : 'No disponible';
    document.getElementById('modificadoPor').textContent = solicitud.modificado_por ? solicitud.modificado_por : 'No disponible';
    document.getElementById('modificadoEn').textContent = solicitud.modificado_en ? solicitud.modificado_en : 'No disponible';

    // Abrir el modal
    $('#view').modal('show');
}


function showInsertModal() {
    // Limpiar los valores del formulario si es necesario
    document.getElementById("insertForm").reset();

    // Mostrar el modal
    $('#insert').modal('show');
}

document.getElementById("insertForm").addEventListener("submit", async function(event) {
        event.preventDefault(); // Evita que la página se recargue

        // Obtener los valores del formulario
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value ? value : null; // Si un campo está vacío, se envía como null
        });

        try {
            const response = await fetch("http://localhost:3000/api/relacionsolicitudpersona", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                alert("Solicitud creada con éxito. ID: " + result.id_relacion);
                document.getElementById("insertForm").reset(); // Limpiar formulario
                $("#insert").modal("hide"); // Cerrar modal (si usas jQuery)
            } else {
                alert("Error: " + result.error);
            }

        } catch (error) {
            alert("Error en la petición: " + error.message);
        }
    });



    </script>
@stop
