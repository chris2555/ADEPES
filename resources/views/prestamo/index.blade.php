@extends('adminlte::page')

@section('title', 'Solicitudes - Creando nueva solicitud')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <!-- Logo en la esquina izquierda -->
        <img src="{{ asset('img/logo-adepes.png') }}" alt="Logo ADEPES" style="height: 60px;">
        
        <!-- Contenedor de los títulos centrados -->
        <div class="text-center flex-grow-1">
            <h1 class="titulo-negrita">Asociación de Desarrollo Pespirense</h1>
            <h1 class="titulo-negrita">"ADEPES"</h1>
        </div>

        <!-- Espacio vacío para mantener el título centrado -->
        <div style="width: 60px;"></div>
    </div>
@stop

@section('css')
    <style>
        .titulo-negrita {
            font-weight: bold; /* Negrita */
            font-family: 'Arial', sans-serif; /* Cambia el tipo de letra */
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-title {
            font-weight: bold;
            margin: 0;
        }       
    .custom-border-top {
    border-top: 2px solid #28a745; /* Línea verde en la parte superior */
    border-bottom: none;  /* Elimina el borde inferior */
    border-left: none;    /* Elimina el borde izquierdo */
    border-right: none;   /* Elimina el borde derecho */
    background-color: #f8f9fa; /* Color de fondo neutro */
    padding: 10px 15px;  /* Espaciado interno para mejor apariencia */
}
    .card {
        border: none; /* Eliminar borde de la tarjeta */
        box-shadow: none; /* Sin sombras */
    }
        .btn-collapse {
            border: none;
            background: none;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .btn-collapseC {
            border: none;
            background: none;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .btn-collapseF {
            border: none;
            background: none;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .btn-collapseR {
            border: none;
            background: none;
            font-size: 0.8rem;
            cursor: pointer;
        }
        .btn-collapseA{
            border: none;
            background: none;
            font-size: 0.8rem;
            cursor: pointer;
        }
        
.btn-collapse:focus {
        outline: none;
        box-shadow: none;
    }
    </style>
@stop

@section('content')
<div class="card border border-success">
    <!-- Nueva Sección: Información General -->
    <div class="card-header bg-green text-white">
        <h3 class="card-title">SOLICITUD DE PRESTAMO</h3>
    </div>
    <div class="card-body">
    <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                     <!-- Tipo de Garantía -->
                <label for="tipoGarantia" class="form-label">Tipo de Garantía:</label>
                <select class="form-control select2" style="width: 100%;" id="tipoGarantia" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="fiduciario">Fiduciario</option>
                    <option value="hipotecario">Hipotecario</option>
                    <option value="prendario">Prendario</option>
                </select>
                </div>
             </div>
            <!-- Cuota -->
            <div class="col-md-3">
                <div class="form-group">
                <label for="cuota" class="form-label">Cuota:</label>
                <select class="form-control select2" style="width: 100%;" id="cuota" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="nivelada">Nivelada</option>
                    <option value="variable">Variable</option>
                </select>
                </div>
                </div>
            <!-- Tasa -->
            <div class="col-md-3">
                <div class="form-group">
                <label for="tasa" class="form-label">Tasa:</label>
                <select class="form-control select2" id="tasa" required style="width: 100%;" >
                    <option selected disabled value="">Seleccione</option>
                    <option>12%</option>
                    <option>16%</option>
                    <option>20%</option>
                    <option>24%</option>
                    <option>30%</option>
                    <option>32%</option>
                    <option>36%</option>
                </select>
                </div>
                </div>
                   
                   <div class="col-md-3">
                <div class="form-group">
                <label for="tasaTipo" class="form-label">Tipo de Tasa</label>
                <input type="text" class="form-control" id="tasaTipo" placeholder="Anual" required>
                </div>
                <!-- /.form-group -->
                </div>
            <div class="col-md-4">
                <label for="asesor">Monto</label>
                <input type="number" class="form-control" id="monto" placeholder="Ej: 40,000.00" required >
            </div>
            <div class="col-md-4">
                <label for="asesor">Plazo</label>
                <input type="number" class="form-control" id="plazo" placeholder="Ej: 24 meses" required >
            </div>
            <div class="col-md-4">
            <label for="invierteEn" class="form-label">Invierte En:</label>
                <select class="form-control select2" id="tasa" style="width: 100%;" required >
                    <option selected disabled value="">Seleccione</option>
                    <option value="comercio">Comercio</option>
                    <option value="Industria">Industria</option>
                    <option value="servicios">Servicios</option>
                    <option value="mejoravivienda">Mejora de Vivienda</option>
                    <option value="agropecuario">Agropecuario</option>
                    <option value="energiarenovable">Energia Renovable</option>
                    <option value="consumo">Consumo</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card border">
<div class="card-header custom-border-top d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">DATOS PERSONALES</h2>
        <button class="btn btn-collapse ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#datosPersonales" aria-expanded="false" aria-controls="datosPersonales">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- Contenido colapsable -->
    <div class="collapse" id="datosPersonales">
        <div class="card-body">
            <form action="{{ route('solicitud.store') }}" method="POST">
                @csrf
                
                <!-- Campos del formulario -->
                <div class="row">
                    <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres y Apellidos:</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="identidad">Número de Identidad</label>
                        <input type="text" class="form-control" name="identidad" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fechaNacimiento" required>
                    </div>

                    <div class="col-md-4">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edad" required>     
                    </div>

                    <div class="col-md-4">
                    <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                    <input type="text" class="form-control" id="nacionalidad" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                    <label for="direccion" class="form-label">Dirección Completa:</label>
                <textarea class="form-control" id="direccion" rows="1" placeholder="Escribe la direccion aquí..." required></textarea>
                    </div>

                    <div class="col-md-4">
                    <label for="telefono" class="form-label">Teléfono:</label>
              <input type="tel" class="form-control" id="telefono" required>
                    </div>
                    
                    <div class="col-md-4">
                    <label for="celular" class="form-label">Celular:</label>
                    <input type="tel" class="form-control" id="celular" required> 
                    </div>
                
                <div class="col-md-4">
                <label for="estadoCivil" class="form-label">Estado Civil:</label>
                <select class="form-control select2" id="estadoCivil" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="casado">Casado</option>
                    <option value="soltero">Soltero</option>
                    <option value="unionlibre">Union libre</option>
                    <option value="nodefinido">No Definido</option>
                </select>            
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="dependientes" class="form-label">Dependientes:</label>
                    <input type="text" class="form-control" id="dependientes" required>
                    </div>

                    <div class="col-md-4">
                    <label for="casa" class="form-label">Casa:</label>
                <select class="form-control select2" id="casa" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="propia">Propia</option>
                    <option value="alquilada">Alquilada</option>
                    <option value="familiar">Familiar</option>
                </select>      
                    </div>

                    <div class="col-md-4">
                    <label for="tiempoVivir" class="form-label">Tiempo de Vivir:</label>
                <select class="form-control select2" id="tiempoVivir" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="1años">1 años</option>
                    <option value="2años">2 años</option>
                    <option value="3años">3 años</option>
                    <option value="4años">4 años</option>
                    <option value="masde5Años">Mas de 5 años</option>
                </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="paga" class="form-label">Paga:</label>
                <select class="form-control select2" id="paga" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                    </div>
                    <div class="col-md-4">
                    <label for="valorPago" class="form-label">Valor del Pago:</label>
                <input type="number" class="form-control" id="valorPago" required>  
                    </div>
                    <div class="col-md-4">
                    <label for="paga" class="form-label">Genero</label>
                <select class="form-control select2" id="paga" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="si">Maculino</option>
                    <option value="no">Femenino</option>
                </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="patrono" class="form-label">Profesion u oficio</label>
                <input type="text" class="form-control" id="patrono" required>
                    </div>
                    <div class="col-md-6">
                    <label for="cargo" class="form-label">Patrono o negocio</label>
                    <input type="text" class="form-control" id="cargo" required>    
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="cargo" class="form-label">Actividad que desempeña:</label>
                <input type="text" class="form-control" id="cargo" required>
                    </div>
                    <div class="col-md-6">
                    <label for="tiempoLaborar" class="form-label">Tiempo de Laborar:</label>
                <select class="form-control select2" id="tiempoLaborar" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="1años">1 años</option>
                    <option value="2años">2 años</option>
                    <option value="3años">3 años</option>
                    <option value="4años">4 años</option>
                    <option value="masde5Años">Mas de 5 años</option>
                </select> 
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="ingresos" class="form-label">Ingresos por negocio</label>
                <input type="text" class="form-control" id="ingreso" required>
                    </div>
                    <div class="col-md-4">
                    <label for="sueldo" class="form-label">Sueldo base</label>
                    <input type="text" class="form-control" id="sueldo" required>    
                    </div>
                    <div class="col-md-4">
                    <label for="gasto" class="form-label">Gasto Alimentacion</label>
                    <input type="text" class="form-control" id="gasto" required>    
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">Direccion de trabajo</label>
                <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>
                    <div class="col-md-6">
                    <label for="tiempoLaborar" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="tipoCredito" class="form-label">Tipo credito</label>
                <select class="form-control select2" id="tipoCredito" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="primeravez">Primera Vez</option>
                    <option value="novacion">Novacion</option>
                    <option value="reingreso">Reingreso</option>
                    <option value="refinanciamiento">Refinanciamiento</option>
                </select> 
                    </div>
                    <div class="col-md-6">
                    <label for="estadoCredito" class="form-label">Estado Credito</label>
                <select class="form-control select2" id="estadoCredito" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="irregular">Con pago irregular</option>
                    <option value="regular">Con pago regular</option>
                    <option value="normal">con pago normal</option>
                </select> 
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                    <label for="valorCuota" class="form-label">Valor de la cuota:</label>
                    <input type="text" class="form-control" id="valorCuota" required>
                    </div>
                    <div class="col-md-3">
                    <label for="esAval" class="form-label">¿Es Aval?</label>
                <select class="form-control select2" id="esAval" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="noEs">No es aval</option>
                    <option value="avala1">Avala 1 persona</option>
                    <option value="avala2">Avala 2 personas</option>
                    <option value="avalaMas">Avala mas de 2 personas</option>
                </select>      
                    </div>
                    <div class="col-md-3">
                    <label for="esAval" class="form-label"></label>
                <select class="form-control select2" id="esAval" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="noEs">Credito(s) al dia</option>
                    <option value="avalMora1">1 aval en mora</option>
                    <option value="avalaMora2">2 avales en mora</option>
                    <option value="avalMora">2 avales en mora</option>
                    <option value="avalMora">3 avales en mora</option>
                </select>      
                    </div>
                    <div class="col-md-3">
                    <label for="valorCuota" class="form-label">Valor de la cuota</label>
                    <input type="text" class="form-control" id="valorCuota" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SECCION DE CONTENEDOR INFORMACION DEL ESPOSO(A) O COMPAÑERO(A)-->
<div class="card border ">
<div class="card-header custom-border-top d-flex justify-content-between align-items-center">
        <h3 class="card-title">INFORMACION DEL ESPOSO(A) O COMPAÑERO(A)</h3>
        <button class="btn btn-collapseC ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#datosConyugue" aria-expanded="false" aria-controls="datosConyugue">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <!-- Contenido colapsable -->
    <div class="collapse" id="datosConyugue">
        <div class="card-body">
            <form action="{{ route('solicitud.store') }}" method="POST">
                @csrf
                
                <!-- Campos del formulario -->
                <div class="row">
                    <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres y Apellidos:</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="identidad">Número de Identidad</label>
                        <input type="text" class="form-control" name="identidad" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fechaNacimiento" required>
                    
                </div>
                    <div class="col-md-4">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edad" required>     
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                    <label for="direccion" class="form-label">Dirección Completa:</label>
                <textarea class="form-control" id="direccion" rows="1" placeholder="Escribe la direccion aquí..." required></textarea>
                    </div>
                    <div class="col-md-4">
                    <label for="telefono" class="form-label">Teléfono:</label>
              <input type="tel" class="form-control" id="telefono" required>
                    </div>
                    
                    <div class="col-md-4">
                    <label for="celular" class="form-label">Celular:</label>
                    <input type="tel" class="form-control" id="celular" required> 
                    </div>
                    </div>
                    
                    <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="patrono" class="form-label">Profesion u oficio</label>
                <input type="text" class="form-control" id="patrono" required>
                    </div>

                    <div class="col-md-6">
                    <label for="cargo" class="form-label">Patrono o negocio</label>
                    <input type="text" class="form-control" id="cargo" required>    
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="cargo" class="form-label">Actividad que desempeña:</label>
                <input type="text" class="form-control" id="cargo" required>
                    </div>

                    <div class="col-md-6">
                    <label for="tiempoLaborar" class="form-label">Tiempo de Laborar:</label>
                <select class="form-control select2" id="tiempoLaborar" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="1años">1 años</option>
                    <option value="2años">2 años</option>
                    <option value="3años">3 años</option>
                    <option value="4años">4 años</option>
                    <option value="masde5Años">Mas de 5 años</option>
                </select> 
                    </div>
                </div> 
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="ingresos" class="form-label">Ingresos por negocio</label>
                <input type="text" class="form-control" id="ingreso" required>
                    </div>

                    <div class="col-md-4">
                    <label for="sueldo" class="form-label">Sueldo base</label>
                    <input type="text" class="form-control" id="sueldo" required>    
                    </div>
                    <div class="col-md-4">
                    <label for="gasto" class="form-label">Gasto Alimentacion</label>
                    <input type="text" class="form-control" id="gasto" required>    
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">Direccion de trabajo</label>
                <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>

                    <div class="col-md-6">
                    <label for="tiempoLaborar" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

                <div class="card border">
                <div class="card-header custom-border-top d-flex justify-content-between align-items-center">
        <h3 class="card-title">ESTADO DE INGRESOS Y GASTOS</h3>
        <button class="btn btn-collapseF ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#datosFinancieros" aria-expanded="false" aria-controls="datosdatosFinancieros">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- Contenido colapsable -->
    <div class="collapse" id="datosFinancieros">
        <div class="card-body">
            <form action="{{ route('solicitud.store') }}" method="POST">
                @csrf
                
                <div class="d-flex justify-content-center">
                <div class="table-responsive" style="max-width: 800px;">
    <h4 class="text-center titulo-negrita">ESTADO DE INGRESOS Y GASTOS</h4>
    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th colspan="2" class="text-center">Ingresos Mensuales</th>
                <th colspan="2" class="text-center">Egresos Mensuales</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sueldo Base</td>
                <td><input type="number" class="form-control" id="sueldoBase" readonly></td>
                <td>Cuota de préstamo en ADEPES</td>
                <td><input type="number" class="form-control" id="cuotaADEPES" readonly></td>
            </tr>
            <tr>
                <td>Ingresos del negocio</td>
                <td><input type="number" class="form-control" id="ingresoNegocio"></td>
                <td>Cuota de Vivienda</td>
                <td><input type="number" class="form-control" id="cuotaVivienda" readonly></td>
            </tr>
            <tr>
                <td>Renta de propiedades</td>
                <td><input type="number" class="form-control" id="rentaPropiedades"></td>
                <td>Alimentación</td>
                <td><input type="number" class="form-control" id="alimentacion" readonly></td>
            </tr>
            <tr>
                <td>Remesas</td>
                <td><input type="number" class="form-control" id="remesas"></td>
                <td>Central de riesgo como Cliente</td>
                <td><input type="number" class="form-control" id="centralRiesgo"></td>
            </tr>
            <tr>
                <td>Aporte del cónyuge</td>
                <td><input type="number" class="form-control" id="aporteConyuge"></td>
                <td>Otros egresos</td>
                <td><input type="number" class="form-control" id="otrosEgresos"></td>
            </tr>
            <tr>
                <td>Ingresos por sociedad</td>
                <td><input type="number" class="form-control" id="ingresoSociedad"></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="bg-warning text-white">
                <td class="text-right"><strong>Total Ingresos</strong></td>
                <td><input type="number" class="form-control" id="totalIngresos" readonly></td>
                <td class="text-right"><strong>Total Egresos</strong></td>
                <td><input type="number" class="form-control" id="totalEgresos" readonly></td>
            </tr>
            <tr class="bg-success text-white">
                <td colspan="2" class="text-right"><strong>Total Ingresos Netos</strong></td>
                <td colspan="2"><input type="number" class="form-control" id="totalIngresosNetos" readonly></td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    <div class="table-responsive" style="max-width: 600px;">
        <h4 class="text-center titulo-negrita">RELACION CUOTAS EN CUANTO A INGRESOS NETOS</h4>
        <table class="table table-bordered">
            <thead class="bg-warning text-white">
                <tr>
                    <th colspan="2" class="text-center">Relación de Cuotas</th>
                    <th colspan="2" class="text-center">Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Letra mensual</td>
                    <td>L.</td>
                    <td><input type="number" class="form-control" id="letraMensual" readonly value="3038.92"></td>
                </tr>
                <tr>
                    <td>Interés corriente mensual</td>
                    <td>L.</td>
                    <td><input type="number" class="form-control" id="interesMensual" readonly value="620.00"></td>
                </tr>
                <tr class="bg-primary text-white">
                    <td><strong>Total por pagar cuota</strong></td>
                    <td>L.</td>
                    <td><input type="number" class="form-control" id="totalCuota" readonly value="3658.92"></td>
                </tr>
                <tr class="bg-success text-white">
                    <td colspan="2" class="text-center"><strong>Capital disponible para el crédito</strong></td>
                    <td><input type="number" class="form-control bg-success text-white text-center" id="capitalDisponible" readonly value="16092.00"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    <div class="table-responsive" style="max-width: 400px;">
        <table class="table table-bordered">
            <thead class="bg-warning text-black text-center">
                <tr>
                    <th>EVALUACIÓN SEGÚN INFORMACIÓN RECOPILADA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <textarea class="form-control" rows="4" placeholder="Escriba aquí..."></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
    function calcularTotales() {
        let totalIngresos = 0;
        let totalEgresos = 0;
        
        totalIngresos += Number(document.getElementById('sueldoBase').value) || 0;
        totalIngresos += Number(document.getElementById('ingresoNegocio').value) || 0;
        totalIngresos += Number(document.getElementById('rentaPropiedades').value) || 0;
        totalIngresos += Number(document.getElementById('remesas').value) || 0;
        totalIngresos += Number(document.getElementById('aporteConyuge').value) || 0;
        totalIngresos += Number(document.getElementById('ingresoSociedad').value) || 0;
        
        totalEgresos += Number(document.getElementById('cuotaADEPES').value) || 0;
        totalEgresos += Number(document.getElementById('cuotaVivienda').value) || 0;
        totalEgresos += Number(document.getElementById('alimentacion').value) || 0;
        totalEgresos += Number(document.getElementById('centralRiesgo').value) || 0;
        totalEgresos += Number(document.getElementById('otrosEgresos').value) || 0;
        
        document.getElementById('totalIngresos').value = totalIngresos.toFixed(2);
        document.getElementById('totalEgresos').value = totalEgresos.toFixed(2);
        document.getElementById('totalIngresosNetos').value = (totalIngresos - totalEgresos).toFixed(2);
    }
    
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', calcularTotales);
    });
</script>




@stop
 
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        
        // Cambiar el icono del botón cuando se colapsa o expande
        $('#datosPersonales').on('show.bs.collapse', function () {
            // Cambiar icono a mas cuando se expanda
            $('.btn-collapse i').removeClass('fas fa-plus').addClass('fas fa-minus');
        }).on('hide.bs.collapse', function () {
            // Cambiar icono a más cuando se colapse
            $('.btn-collapse i').removeClass('fas fa-minus').addClass('fas fa-plus');
        });
        </script>

         <script>
        $('#datosConyugue').on('show.bs.collapse', function () {
            // Cambiar icono a mas cuando se expanda
            $('.btn-collapseC i').removeClass('fas fa-plus').addClass('fas fa-minus');
        }).on('hide.bs.collapse', function () {
            // Cambiar icono a más cuando se colapse
            $('.btn-collapseC i').removeClass('fas fa-minus').addClass('fas fa-plus');
        });
        </script>

         <script>

        $('#datosFinancieros').on('show.bs.collapse', function () {
            // Cambiar icono a mas cuando se expanda
            $('.btn-collapseF i').removeClass('fas fa-plus').addClass('fas fa-minus');
        }).on('hide.bs.collapse', function () {
            // Cambiar icono a más cuando se colapse
            $('.btn-collapseF i').removeClass('fas fa-minus').addClass('fas fa-plus');
        });

    </script>
    
<!-- CONTENEDOR REFERENCIAS FAMILIARES QUE NO VIVAN EN SU CASA -->
<div class="card border">
<div class="card-header custom-border-top d-flex justify-content-between align-items-center">
        <h3 class="card-title">REFERENCIAS FAMILIARES QUE NO VIVAN EN SU CASA</h3>
        <button class="btn btn-collapseR ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#datosReferencia" aria-expanded="false" aria-controls="datosReferencia">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <!-- Contenido colapsable -->
    <div class="collapse" id="datosReferencia">
        <div class="card-body">
            <form action="{{ route('solicitud.store') }}" method="POST">
                @csrf
                
                <!-- Campos del formulario -->    
                <div class="row mt-3">
                    <div class="col-md-4">
                    <label for="ingresos" class="form-label">1. Nombre</label>
                <input type="text" class="form-control" id="ingreso" required>
                    </div>

                    <div class="col-md-4">
                    <label for="sueldo" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" id="sueldo" required>    
                    </div>

                    <div class="col-md-4">
                    <label for="gasto" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="gasto" required>    
                    </div>

                    <div class="col-md-12">
                    <label for="direccion_trabajo" class="form-label">Direccion de trabajo</label>
                <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>
                
                    <div class="col-md-4">
                    <label for="ingresos" class="form-label">2. Nombre</label>
                <input type="text" class="form-control" id="ingreso" required>
                    </div>

                    <div class="col-md-4">
                    <label for="sueldo" class="form-label">Parentesco</label>
                    <input type="text" class="form-control" id="sueldo" required>    
                    </div>
                    <div class="col-md-4">
                    <label for="gasto" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="gasto" required>    
                    </div>
                
                    <div class="col-md-12">
                    <label for="direccion_trabajo" class="form-label">Direccion de trabajo</label>
                <input type="text" class="form-control" id="direccion_trabajo" required>
                </div>
            </div>  
        </div>
    </div>
</div>
    
<script>
        $('#datosReferencia').on('show.bs.collapse', function () {
            // Cambiar icono a mas cuando se expanda
            $('.btn-collapseR i').removeClass('fas fa-plus').addClass('fas fa-minus');
        }).on('hide.bs.collapse', function () {
            // Cambiar icono a más cuando se colapse
            $('.btn-collapseR i').removeClass('fas fa-minus').addClass('fas fa-plus');
        });
        </script>
    
<!-- CONTENEDOR REFERENCIAS FAMILIARES QUE NO VIVAN EN SU CASA -->
<div class="card border">
<div class="card-header custom-border-top d-flex justify-content-between align-items-center">
        <h3 class="card-title">INFORMACION ADICIONAL</h3>
        <button class="btn btn-collapseA ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#datosAdicional" aria-expanded="false" aria-controls="datosAdicional">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <!-- Contenido colapsable -->
    <div class="collapse" id="datosAdicional">
        <div class="card-body">
            <form action="{{ route('solicitud.store') }}" method="POST">
                @csrf
                
                <!-- Campos del formulario -->    
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">Actividad Actual</label>
                <input type="text" class="form-control" id="direccion_trabajo" required>
                    </div>
                
                    <div class="col-md-6">
                    <label for="ingresos" class="form-label">Lo inventira en:</label>
                <input type="text" class="form-control" id="ingreso" required>
                    </div>

                    <div class="col-md-12">
                    <label for="sueldo" class="form-label">Personas que dependen de usted</label>
                    <input type="text" class="form-control" id="sueldo" required>    
                    </div>
                    
                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">OBSERVACIONES</label>
                <input type="text" class="form-control" id="" required>
                <label for="direccion_trabajo" class="form-label"></label>
                    </div>
                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">Fecha de emision</label>
                
                    </div>

                    <div class="col-md-6">
                    <label for="direccion_trabajo" class="form-label">Firma del solicitante</label>
                    <label for="direccion_trabajo" class="form-label">____________________________________________________________</label>
                    </div>
                <!-- Agrega más campos si es necesario -->
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Guardar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#datosAdicional').on('show.bs.collapse', function () {
            // Cambiar icono a mas cuando se expanda
            $('.btn-collapseA i').removeClass('fas fa-plus').addClass('fas fa-minus');
        }).on('hide.bs.collapse', function () {
            // Cambiar icono a más cuando se colapse
            $('.btn-collapseA i').removeClass('fas fa-minus').addClass('fas fa-plus');
        });
        </script>
    
@stop