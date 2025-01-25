@extends('adminlte::page')

@section('title', 'Solicitud Prestamo')

@section('content_header')
    <h1>ASOCIACION DE DESARROLLO PESPIRENSE "ADEPES"</h1>
    <h1>"ADEPES"</h1>
    <img src="https://fundacioncovelo.hn/wp-content/uploads/2020/06/ADEPES.png" class="rounded float-start" alt="Logotipo de ADEPES">
    
    <head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="javascript" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<section class="content"> 
<div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Solicitud de Prestamo</h2>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
         
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

            </div>
            <!-- /.row -->
          

          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                     <!-- Monto -->
                <label for="monto" class="form-label">Monto:</label>
                <input type="number" class="form-control" id="monto" placeholder="Ej: 40,000.00" required >
                     <!-- /.form-group -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                     <!-- Plazo -->
                <label for="plazo" class="form-label">Plazo:</label>
                <input type="number" class="form-control" id="plazo" placeholder="Ej: 24 meses" required >
                     <!-- /.form-group -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                     <!-- Invierte En -->
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
                     <!-- /.form-group -->
                </div>
            </div>
          </div>
           <!-- /.row -->
          </div>
          <!-- /.card-body -->

          </div>
        <!-- /.card card-default -->

           <!-- /otra seccion 2-->
         <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Informacion Personal</h2>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label for="nombres" class="form-label">Nombres y Apellidos:</label>
                <input type="text" class="form-control" id="nombres" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="numeroidentidad" class="form-label">Numero de Identidad:</label>
                <input type="number" class="form-control" id="numeroidentidad" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fechaNacimiento" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="edad" class="form-label">Edad:</label>
                <input type="number" class="form-control" id="edad" required>     
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                <input type="text" class="form-control" id="nacionalidad" required>                    
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label for="direccion" class="form-label">Dirección Completa:</label>
                <textarea class="form-control" id="direccion" rows="3" placeholder="Escribe la direccion aquí..." required></textarea>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="telefono" class="form-label">Teléfono:</label>
              <input type="tel" class="form-control" id="telefono" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="celular" class="form-label">Celular:</label>
                <input type="tel" class="form-control" id="celular" required>   
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="estadoCivil" class="form-label">Estado Civil:</label>
                <select class="form-control select2" id="estadoCivil" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="casado">Casado</option>
                    <option value="soltero">Soltero</option>
                    <option value="unionlibre">Union libre</option>
                    <option value="nodefinido">No Definido</option>
                </select>                    
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="dependientes" class="form-label">Dependientes:</label>
              <input type="text" class="form-control" id="dependientes" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="casa" class="form-label">Casa:</label>
                <select class="form-control select2" id="casa" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="propia">Propia</option>
                    <option value="alquilada">Alquilada</option>
                    <option value="familiar">Familiar</option>
                </select>   
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
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
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="paga" class="form-label">Paga:</label>
                <select class="form-control select2" id="paga" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="valorPago" class="form-label">Valor del Pago:</label>
                <input type="number" class="form-control" id="valorPago" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="profesion" class="form-label">Profesión u Oficio:</label>
                <input type="text" class="form-control" id="profesion" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="patrono" class="form-label">Patrono o Negocio:</label>
                <input type="text" class="form-control" id="patrono" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="cargo" class="form-label">Cargo que desempeña:</label>
                <input type="text" class="form-control" id="cargo" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
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
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="sueldoMensual" class="form-label">Sueldo Mensual:</label>
                <input type="number" class="form-control" id="sueldoMensual" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="sueldoBase" class="form-label">Sueldo Base:</label>
                <input type="number" class="form-control" id="sueldoBase" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="gastos" class="form-label">Gastos Alimentación:</label>
                <input type="number" class="form-control" id="gastos" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-8">
              <div class="form-group">
              <label for="direccionTrabajo" class="form-label">Dirección del Trabajo:</label>
              <textarea class="form-control" id="direccionTrabajo" rows="2" placeholder="Escribe la direccion aquí..." required></textarea>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-4">
                <div class="form-group">
                <label for="telefonoTrabajo" class="form-label">Teléfono del Trabajo:</label>
                <input type="tel" class="form-control" id="telefonoTrabajo" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="tipoCliente" class="form-label">Tipo de Cliente:</label>
                <select class="form-control select2" id="tipoCliente" style="width: 100%;" required>
                    <option selected disabled value="seleccione">Seleccione</option>
                    <option value="primeraVez">Primera Vez</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="cuentan" class="form-label">cuenta #:</label>
                <input type="number" class="form-control" id="cuentan" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="estadoCredito" class="form-label">Estado del Credito:</label>
                <select class="form-control select2" id="estadoCredito" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="creditoAldia">Credito al Dia</option>
                    <option value="creditoMora">Credito en Mora</option>
                    <option value="noExiste">No Existe Registro</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="valorCuota" class="form-label">Valor de la Cuota:</label>
                <input type="number" class="form-control" id="valorCuota" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="esAval" class="form-label">¿Es Aval?</label>
                <select class="form-control select2" id="esAval" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="cuentanAval" class="form-label">cuenta #:</label>
                <input type="number" class="form-control" id="cuentanAval" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="nombreAval" class="form-label">Nombre del Aval:</label>
                <input type="text" class="form-control" id="nombreAval" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="estadoCreditoAval" class="form-label">Estado del Credito:</label>
                <select class="form-control select2" id="estadoCreditoAval" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="creditoAldia">Credito al Dia</option>
                    <option value="creditoMora">Credito en Mora</option>
                    <option value="noExiste">No Existe Registro</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
          </div>
          <!-- /.card card-default -->

          <!-- /otra seccion 3 -->
          <div class="card card-default">
          <div class="card-header">
            <h2 class="card-title">Información del Esposo(a) o Compañero(a)</h2>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label for="nombreC" class="form-label">Nombres y Apellidos:</label>
                <input type="text" class="form-control" id="nombresC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="numeroidentidadC" class="form-label">Numero de Identidad:</label>
                <input type="number" class="form-control" id="numeroidentidadC" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label for="fechaNacimientoC" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fechaNacimientoC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="edadC" class="form-label">Edad:</label>
                <input type="number" class="form-control" id="edadC" required>     
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label for="direccionC" class="form-label">Dirección Completa:</label>
                <textarea class="form-control" id="direccionC" rows="3" placeholder="Escribe la direccion aquí..." required></textarea>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="telefonoc" class="form-label">Teléfono:</label>
              <input type="tel" class="form-control" id="telefonoc" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="celularc" class="form-label">Celular:</label>
                <input type="tel" class="form-control" id="celularc" required>   
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="estadoCivilc" class="form-label">Estado Civil:</label>
                <select class="form-control select2" id="estadoCivilc" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="casado">Casado</option>
                    <option value="soltero">Soltero</option>
                    <option value="unionlibre">Union libre</option>
                    <option value="nodefinido">No Definido</option>
                </select>                    
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="profesionC" class="form-label">Profesión u Oficio:</label>
                <input type="text" class="form-control" id="profesionC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="patronoC" class="form-label">Patrono o Negocio:</label>
                <input type="text" class="form-control" id="patronoC" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="cargoC" class="form-label">Cargo que desempeña:</label>
                <input type="text" class="form-control" id="cargoC" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="tiempoLaborarC" class="form-label">Tiempo de Laborar:</label>
                <select class="form-control select2" id="tiempoLaborarC" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="1años">1 años</option>
                    <option value="2años">2 años</option>
                    <option value="3años">3 años</option>
                    <option value="4años">4 años</option>
                    <option value="masde5Años">Mas de 5 años</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="profesion" class="form-label">Profesión u Oficio:</label>
                <input type="text" class="form-control" id="profesion" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="patrono" class="form-label">Patrono o Negocio:</label>
                <input type="text" class="form-control" id="patrono" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="cargo" class="form-label">Cargo que desempeña:</label>
                <input type="text" class="form-control" id="cargo" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
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
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="sueldoMensualC" class="form-label">Sueldo Mensual:</label>
                <input type="number" class="form-control" id="sueldoMensualC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="sueldoBaseC" class="form-label">Sueldo Base:</label>
                <input type="number" class="form-control" id="sueldoBaseC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="gastosC" class="form-label">Gastos Alimentación:</label>
                <input type="number" class="form-control" id="gastosC" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-12">
              <div class="form-group">
              <label for="direccionTrabajoC" class="form-label">Dirección del Trabajo:</label>
              <textarea class="form-control" id="direccionTrabajoC" rows="2" placeholder="Escribe la direccion aquí..." required></textarea>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="tipoClienteC" class="form-label">Tipo de Cliente:</label>
                <select class="form-control select2" id="tipoClienteC" style="width: 100%; required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="primeraVez">Primera Vez</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="idc" class="form-label">IDC #:</label>
                <input type="number" class="form-control" id="idc" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="estadoCreditoC" class="form-label">Estado del Credito:</label>
                <select class="form-control select2" id="estadoCreditoC" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="creditoAldia">Credito al Dia</option>
                    <option value="creditoMora">Credito en Mora</option>
                    <option value="noExiste">No Existe Registro</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
              <label for="valorCuotaC" class="form-label">Valor de la Cuota:</label>
                <input type="number" class="form-control" id="valorCuotaC" required>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="esAvalC" class="form-label">¿Es Aval?</label>
                <select class="form-control select2" id="esAvalC" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label for="cuentanAvalC" class="form-label">cuenta #:</label>
                <input type="number" class="form-control" id="cuentanAvalC" required>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="nombreAvalC" class="form-label">Nombre del Aval:</label>
                <input type="text" class="form-control" id="nombreAvalC" required>
                </div>
                 <!-- /.form-group -->
              </div>


              <div class="col-md-6">
                <div class="form-group">
                <label for="estadoCreditoAvalC" class="form-label">Estado del Credito:</label>
                <select class="form-control select2" id="estadoCreditoAvalC" style="width: 100%;" required>
                    <option selected disabled value="">Seleccione</option>
                    <option value="creditoAldia">Credito al Dia</option>
                    <option value="creditoMora">Credito en Mora</option>
                    <option value="noExiste">No Existe Registro</option>
                </select>
                </div>
                 <!-- /.form-group -->
              </div>
            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
          </div>
          <!-- /.card card-default -->

        
            <div class="container mt-5"> 
                <h2 class="text-center">Estado de Ingresos y Gastos</h2> 
                <h4 class="mt-4">Ingresos Mensuales</h4> 
                <table class="table table-bordered"> 
                    <thead> 
                    <tr> 
                     <th>Descripción</th>
                     <th>Monto</th> 
                    </tr> 
                    </thead> 
                    <tbody> 
                    <tr> 
                    <td>Sueldos Netos</td> 
                    <td>L. 10,000.00</td> 
                    </tr> 
                    <tr> 
                    <td>Renta de propiedades</td> 
                    <td>L. 2,000.00</td> 
                    </tr> 
                    <tr> 
                    <td>Otros Ingresos</td> 
                    <td>L. 1,000.00</td> 
                    </tr> 
                    <tr> 
                    <td><strong>Total Ingresos</strong></td> 
                    <td><strong>L. 13,000.00</strong></td> 
                    </tr> 
                    </tbody> 
                    </table> 
                    <h4 class="mt-4">Gastos Mensuales</h4> 
                    <table class="table table-bordered">
                    <thead> 
                    <tr> 
                    <th>Descripción</th> 
                    <th>Monto</th> 
                    </tr> 
                    </thead> 
                    <tbody> 
                    <tr> 
                    <td>Obligaciones financieras</td> 
                    <td>L. 4,000.00</td> 
                    </tr> 
                    <tr> 
                    <td>Alimentación</td> 
                    <td>L. 2,000.00</td> 
                    </tr> 
                    <tr> 
                    <td>Otros Gastos</td> 
                    <td>L. 1,000.00</td> 
                    </tr> 
                    <tr> 
                    <td><strong>Total Gastos</strong></td> 
                    <td><strong>L. 7,000.00</strong></td> 
                    </tr> 
                    </tbody> 
                    </table> 
                    <div class="mt-4"> 
                    <h5>Evaluación según información recopilada</h5> 
                    <p>Relación cuotas en cuanto a ingresos netos: L. 496.31</p> 
                    <p>Liquidez del Cliente: L. 10,117.56</p> 
            </div> 
    
</div>
            

            <!-- Botón Enviar -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
            </div>
        </div>
    </div>

</div>
</section>



@stop

@section('content')


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

    <style>
    .logo {
        width: 150px;
        /* Ajusta este valor según el tamaño deseado */
        height: auto;
        /* Mantiene la proporción original de la imagen */
    }

    body {
        background-color: #fff;
        font-family: 'Karla', sans-serif;
    }

    h1>a {
        text-decoration: none;
        color: #fff !important;
    }

    @media (max-width: 991px) {
        .intro-section {
            padding-left: 50px;
            padding-rigth: 50px;
        }
    }

    @media (max-width: 767px) {
        .intro-section {
            padding: 28px;
        }
    }

    @media (max-width: 575px) {
        .intro-section {
            min-height: auto;
        }
    }

    .brand-wrapper .logo {
        height: 35px;
    }

    @media (max-width: 767px) {
        .brand-wrapper {
            margin-bottom: 35px;
        }
    }

    .intro-content-wrapper {
        width: 410px;
        max-width: 100%;
        margin-top: auto;
        margin-bottom: auto;
    }

    .intro-content-wrapper .intro-title {
        font-size: 40px;
        font-weight: bold;
        margin-bottom: 17px;
    }

    .intro-content-wrapper .intro-text {
        font-size: 19px;
        line-height: 1.37;
    }

    .intro-content-wrapper .btn-read-more {
        background-color: #fff;
        padding: 13px 30px;
        border-radius: 0;
        font-size: 16px;
        font-weight: bold;
        color: #000;
    }

    .intro-content-wrapper .btn-read-more:hover {
        background-color: transparent;
        border: 1px solid #fff;
        color: #fff;
    }

    @media (max-width: 767px) {
        .intro-section-footer {
            margin-top: 35px;
        }
    }

    .intro-section-footer .footer-nav a {
        font-size: 20px;
        font-weight: bold;
        color: inherit;
    }

    @media (max-width: 767px) {
        .intro-section-footer .footer-nav a {
            font-size: 14px;
        }
    }

    .intro-section-footer .footer-nav a+a {
        margin-left: 30px;
    }

    .form-section {
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
    }

    @media (max-width: 767px) {
        .form-section {
            padding: 35px;
        }
    }

    .login-wrapper {
        width: 300px;
        max-width: 100%;
    }

    @media (max-width: 575px) {
        .login-wrapper {
            width: 100%;
        }
    }

    .login-wrapper .form-control {
        border: 0;
        border-bottom: 1px solid #e7e7e7;
        border-radius: 0;
        font-size: 14px;
        font-weight: bold;
        padding: 15px 10px;
        margin-bottom: 7px;
    }

    .login-wrapper .form-control::-webkit-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::-moz-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control:-ms-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::-ms-input-placeholder {
        color: #b0adad;
    }

    .login-wrapper .form-control::placeholder {
        color: #b0adad;
    }

    .login-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .login-btn {
        padding: 13px 30px;
        background-color: #000;
        border-radius: 0;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }

    .login-btn:hover {
        border: 1px solid #000;
        background-color: transparent;
        color: #000;
    }

    .forgot-password-link {
        font-size: 14px;
        color: #080808;
        text-decoration: underline;
    }

    .social-login-title {
        font-size: 15px;
        color: #919aa3;
        display: -webkit-box;
        display: flex;
        margin-bottom: 23px;
    }

    .social-login-title::before,
    .social-login-title::after {
        content: "";
        background-image: -webkit-gradient(linear, left top, left bottom, from(#f4f4f4), to(#f4f4f4));
        background-image: linear-gradient(#f4f4f4, #f4f4f4);
        -webkit-box-flex: 1;
        flex-grow: 1;
        background-size: calc(100% - 20px) 1px;
        background-repeat: no-repeat;
    }

    .social-login-title::before {
        background-position: center left;
    }

    .social-login-title::after {
        background-position: center right;
    }

    .social-login-links {
        text-align: center;
        margin-bottom: 32px;
    }

    .social-login-link img {
        width: 40px;
        height: 40px;
        -o-object-fit: contain;
        object-fit: contain;
    }

    .social-login-link+.socia-login-link {
        margin-left: 16px;
    }

    .login-wrapper-footer-text {
        font-size: 14px;
        text-align: center;
    }
</style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    $(document).ready(function() {
            $('.select2').select2();
        });
@stop



