@extends('adminlte::page')

@section('title', 'Gestión de Informacion Laboral')

@section('content_header')
<h1><b>Listado Informacion Laboral</b></h1>
    <hr>
@stop

@section('content')

<head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                <h3 class="card-title">Gestión de Informacion Laboral</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert">
                    <i class="fas fa-plus"></i> Nueva Informacion Laboral
                </button>
                </div>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table id="InformacionLaboralTable" class="table table-bordered table-hover table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center" data-order="asc">ID Informacion Laboral</th>
                                <th style="text-align: center">Id Persona</th>
                                <th style="text-align: center">Nombre cliente</th>
                                <th style="text-align: center">Profesion u oficio</th>
                                <th style="text-align: center">actividad</th>
                                <th style="text-align: center">Patrono/Negocio</th>
                                <th style="text-align: center">Tiempo de laborar </th>
                                <th style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(collect($InformacionLaboral)->sortBy(fn($p) => (int) $p['id_informacion_laboral']) as $informacionlaboral)
                                <tr>
                                    <td style="text-align: center" data-order="asc">{{ $informacionlaboral['id_informacion_laboral'] }}</td>
                                    <td>{{ $informacionlaboral['id_persona'] }}</td>
                                    <td>{{ $informacionlaboral['nombres_persona'] }}</td>
                                    <td>{{ $informacionlaboral['profesion_oficio'] }}</td>
                                    <td>{{ $informacionlaboral['actividad'] }}</td>
                                    <td>{{ $informacionlaboral['patrono_negocio'] }}</td>
                                    <td>{{ $informacionlaboral['tiempo_laborar'] }}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                            onclick="viewModal({{ json_encode($informacionlaboral) }})">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('informacionlaboral.show', $informacionlaboral['id_informacion_laboral'])}}" class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('informacionlaboral.destroy', $informacionlaboral['id_informacion_laboral']) }}" 
                                        method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </tbody>
            </table>

            <script>
                // Pasa los IDs de personas ya registradas en información laboral
                const personasConLaboral = @json(collect($InformacionLaboral)->pluck('id_persona')->unique()->values()->toArray());
            </script>

                    
                    <script>
function sortTable(columnIndex) {
    let table = document.getElementById("InformacionLaboralTable");
    let rows = Array.from(table.rows).slice(1); // Omitimos el encabezado
    let sortedRows = rows.sort((a, b) => {
        return a.cells[columnIndex].innerText - b.cells[columnIndex].innerText;
    });

    </script>
            </div>
        </div>
    </div>
</div>



    <div class="modal fade" id="view" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Información Laboral</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="viewModalBody">
                        {{-- El contenido del modal se carga aquí con JavaScript --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>

<!-- Modal para Insertar Nueva Información Laboral -->
<div class="modal fade" id="insert" tabindex="-1" aria-labelledby="insertinformacionlaboralLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="insertinformacionlaboralLabel">Agregar Nueva Información Laboral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="insertinformacionlaboralForm" action="{{ route('informacionlaboral.store') }}" method="POST" onsubmit="return validarFormulario(event)">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                        <x-adminlte-select name="id_persona" label="Seleccionar Persona" fgroup-class="mb-3" required>
                                <option value="">Seleccione una persona</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id_persona }}">
                                        {{ $persona->nombres_apellidos }} - {{ $persona->n_identidad }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>

                            <x-adminlte-input name="profesion_oficio" label="Profesión u Oficio" fgroup-class="mb-3" 
                            placeholder="Ingrese su profesión u oficio" required />

                            <x-adminlte-input name="actividad" label="Cargo que desempeña" fgroup-class="mb-3" 
                            placeholder="Ingrese el cargo que desempeña" required />

                            <x-adminlte-input name="ingresos_negocio" label="Ingresos del Negocio" fgroup-class="mb-3" 
                            placeholder="Ingrese ingresos" type="number" step="0.01" required />

                           
                            </div>
                            <div class="col-md-6">
                             <x-adminlte-input name="direccion_trabajo" label="Dirección de Trabajo" fgroup-class="mb-3" 
                            placeholder="Ingrese dirección del trabajo"  required/>

                            <x-adminlte-input name="patrono_negocio" label="Nombre del Patrono o Negocio" fgroup-class="mb-3" 
                            placeholder="Ingrese Patrono o Negocio" required />

                            <x-adminlte-input name="tiempo_laborar" label="Tiempo de Laborar" fgroup-class="mb-3" 
                            placeholder="Ej. 2 años" required />

                            <x-adminlte-input name="gastos_alimentacion" label="Gastos de Alimentación" fgroup-class="mb-3" 
                            placeholder="Ingrese gastos" type="number" step="0.01" />

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function validarTextoSinNumeros(input) {
        input.addEventListener("input", function () {
            this.value = this.value.replace(/\d/g, ""); // Elimina cualquier número ingresado
        });
    }

    // Aplica la validación a los campos específicos
    validarTextoSinNumeros(document.querySelector("input[name='profesion_oficio']"));
    validarTextoSinNumeros(document.querySelector("input[name='actividad']"));
    validarTextoSinNumeros(document.querySelector("input[name='patrono_negocio']"));
});
</script>

@stop



@section('js')
<script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

     $(function () {
    $('#InformacionLaboralTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 5,
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "language": {
            "search": "Buscador:",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoFiltered": "(Filtrado de _MAX_ total de entradas)",
            "lengthMenu": "Mostrar _MENU_ Configuraciones",
            "url": "//cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        dom: '<"row d-flex justify-content-between align-items-center"<"col-md-3"l><"col-md-6 text-center"B><"col-md-3 d-flex justify-content-end"f>>' +
             'rt' +
             '<"row d-flex align-items-center mt-2"<"col-md-6 text-start"i><"col-md-6 d-flex justify-content-end"p>>',
        buttons: [
            { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-success' },
            { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-success' },
            { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-success' },
            {
                text: '<i class="fas fa-file-pdf"></i> PDF',
                extend: 'pdfHtml5',
                className: 'btn btn-success',
                 title: 'Reporte de Información Laboral',
                orientation: 'landscape',     // Puedes cambiar a 'portrait'
                pageSize: 'A3',               // Cambia a 'A4', 'A5', 'LETTER', etc., según necesites
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 10; // Cambia el tamaño de la fuente
                    doc.pageMargins = [40, 60, 40, 60]; // Izquierda, arriba, derecha, abajo
                }
            },
            { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
        ]
    });
});


        function viewModal(informacionlaboral) {
    var modalBody = document.getElementById('viewModalBody');
    modalBody.innerHTML = `
        <div class="col-md-6">
            <p><strong>ID Información Laboral:</strong> ${informacionlaboral.id_informacion_laboral}</p>
            <p><strong>Nombre Cliente:</strong> ${informacionlaboral.nombres_persona}</p>
            <p><strong>Profesión u Oficio:</strong> ${informacionlaboral.profesion_oficio}</p>
            <p><strong>Actividad:</strong> ${informacionlaboral.actividad}</p>
            <p><strong>Ingresos del Negocio:</strong> ${informacionlaboral.ingresos_negocio}</p>
            <p><strong>Dirección de Trabajo:</strong> ${informacionlaboral.direccion_trabajo}</p>
            <p><strong>Patrono o Negocio:</strong> ${informacionlaboral.patrono_negocio}</p>
        </div>
        <div class="col-md-6">
            
            <p><strong>Tiempo de Laborar:</strong> ${informacionlaboral.tiempo_laborar}</p>
            <p><strong>Gastos de Alimentación:</strong> ${informacionlaboral.gastos_alimentacion}</p>
        <p><strong>Creado por:</strong> ${informacionlaboral.creado_nombre}</p>
        <p><strong>Creado en:</strong> ${informacionlaboral.creado_en ? new Date(informacionlaboral.creado_en).toLocaleString() : 'No disponible'}</p>
        <p><strong>Modificado por:</strong> ${informacionlaboral.modificado_nombre}</p>
        <p><strong>Modificado en:</strong> ${informacionlaboral.modificado_en ? new Date(informacionlaboral.modificado_en).toLocaleString() : 'No disponible'}</p>
        </div>
    `;

    var viewModalElement = new bootstrap.Modal(document.getElementById('view'));
    viewModalElement.show();
}


        
        document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todos los botones de eliminación
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Evita la eliminación inmediata
            let form = this.closest("form"); // Encuentra el formulario más cercano
            
            Swal.fire({
                title: "¿Está seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario solo si el usuario confirma
                }
            });
        });
    });
});
    </script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    // Agrega validación al seleccionar persona
    const selectPersona = document.querySelector("#insertinformacionlaboralForm select[name='id_persona']");
    const btnGuardar = document.querySelector("#insertinformacionlaboralForm button[type='submit']");

    if(selectPersona && btnGuardar){
        selectPersona.addEventListener("change", function() {
            if(personasConLaboral.includes(Number(this.value))){
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: 'Esta persona ya tiene información laboral registrada.',
                    confirmButtonColor: '#d33',
                });
                btnGuardar.disabled = true;
            }else{
                btnGuardar.disabled = false;
            }
        });
    }
});
</script>

    @endif
    
@stop


