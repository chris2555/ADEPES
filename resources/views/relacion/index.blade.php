@extends('layout.app')

@section('subtitle', 'Sucursales')

@section('content_body')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Sucursales</h1>
        <x-adminlte-button label="Agregar una Sucursal" theme="primary" data-toggle="modal" data-target="#insert" />
    </header>

    <section>
        <x-adminlte-datatable striped id="table" :heads="['ID Relación', 'ID Solicitud', 'Nombre', 'Cónyuge', 'Ingresos', 'Egresos','Acciones']" with-buttons>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud['id_relacion'] }}</td>
                <td>{{ $solicitud['id_solicitud'] }}</td>
                <td>{{ $solicitud['nombre_persona'] }}</td>
                <td>{{ $solicitud['nombre_conyuge'] }}</td>
                <td>{{ $solicitud['ingresos'] }}</td>
                <td>{{ $solicitud['egresos'] }}</td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="viewModal({{ json_encode($solicitud) }})">
                        <i class="fa fa-eye"></i>
                    </a>
                    
                    <a href="{{ route('solicitud.edit', $solicitud['id_relacion']) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('solicitud.destroy', $solicitud['id_relacion']) }}" method="POST" style="display:inline;">
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
            <label for="nombrePersona">Nombre del Solicitante</label>
            <p id="nombrePersona"></p>
        </div>
    
        <div class="form-group">
            <label for="nombreConyuge">Cónyuge</label>
            <p id="nombreConyuge"></p>
        </div>
    
        <div class="form-group">
            <label for="ingresos">Ingresos</label>
            <p id="ingresos"></p>
        </div>
    
        <div class="form-group">
            <label for="egresos">Egresos</label>
            <p id="egresos"></p>
        </div>
    
        <div class="form-group">
            <label for="nombreAval1">Aval 1</label>
            <p id="nombreAval1"></p>
        </div>
    
        <div class="form-group">
            <label for="nombreAval2">Aval 2</label>
            <p id="nombreAval2"></p>
        </div>
    
        <div class="form-group">
            <label for="nombreAval3">Aval 3</label>
            <p id="nombreAval3"></p>
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
    


    <x-adminlte-modal id="insert" size="lg" title="Insertar Nueva Solicitud">
        <form id="insertForm">
            @csrf
            <div class="row">
    
                <x-adminlte-input name="id_solicitud" type="hidden" value="2" />
    
                <x-adminlte-input name="id_persona" type="number" label="ID Persona"
                    placeholder="Ingresa el ID de la persona" fgroup-class="col-md-6" required />
    
                <x-adminlte-input name="id_conyuge" type="number" label="ID Cónyuge"
                    placeholder="Ingresa el ID del cónyuge" fgroup-class="col-md-6" />
    
                <x-adminlte-input name="id_ingresos" type="number" label="ID Ingresos"
                    placeholder="Ingresa el ID de los ingresos" fgroup-class="col-md-6" required />
    
                <x-adminlte-input name="id_egresos" type="number" label="ID Egresos"
                    placeholder="Ingresa el ID de los egresos" fgroup-class="col-md-6" required />
    
                <x-adminlte-input name="id_aval1" type="number" label="ID Aval 1"
                    placeholder="Ingresa el ID del primer aval" fgroup-class="col-md-6" required />
    
                <x-adminlte-input name="id_aval2" type="number" label="ID Aval 2"
                    placeholder="Ingresa el ID del segundo aval (opcional)" fgroup-class="col-md-6" />
    
                <x-adminlte-input name="id_aval3" type="number" label="ID Aval 3"
                    placeholder="Ingresa el ID del tercer aval (opcional)" fgroup-class="col-md-6" />
    
                <x-adminlte-input name="creado_por" type="number" label="Creado por"
                    placeholder="Ingresa el ID de quien lo crea" fgroup-class="col-md-6" required />
    
            </div>
            <x-adminlte-button class="btn-flat" type="submit" id="btnGuardar" label="Guardar Solicitud"
                theme="success" icon="fas fa-lg fa-save" />
        </form>
    </x-adminlte-modal>
    


    {{-- este es el modal para editar un registro, cambiar solo title y los campos a mostrar --}}
    <x-adminlte-modal onclick="" id="edit" size="lg" title="Modifica un vehiculo">
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
    document.getElementById('nombrePersona').textContent = solicitud.nombre_persona;
    document.getElementById('nombreConyuge').textContent = solicitud.nombre_conyuge;
    document.getElementById('ingresos').textContent = solicitud.ingresos;
    document.getElementById('egresos').textContent = solicitud.egresos;
    document.getElementById('nombreAval1').textContent = solicitud.nombre_aval1;
    document.getElementById('nombreAval2').textContent = solicitud.nombre_aval2;
    document.getElementById('nombreAval3').textContent = solicitud.nombre_aval3;
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
