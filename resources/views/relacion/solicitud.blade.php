<!DOCTYPE html>
<html>
<head>
    <title>Solicitud</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info div {
            flex: 1;
            margin-right: 10px;
        }
        .info div:last-child {
            margin-right: 0;
        }
        .analysis {
            margin-bottom: 20px;
        }
        .footer {
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            
            <h2>ASOCIACIÓN DE DESARROLLO PESPIRENSE</h2>
            <h3>"ADEPES"</h3>
        </div>
        <div class="title">SOLICITUD FONDO ROTATORIO</div>
        <div class="info">
        <h2>Datos Personales</h2>

 <strong>Nombre:</strong> {{ $datos['persona']['nombres_apellidos'] }} <br>
<strong>Identidad:</strong> {{ $datos['persona']['n_identidad'] }}<br>
<strong>Fecha de nacimiento:</strong> {{ $datos['persona']['fecha_nacimiento'] }}<br>
<strong>Edad:</strong> {{ $datos['persona']['edad'] }}<br>
<strong>Nacionalidad:</strong> {{ $datos['persona']['nacionalidad'] }}<br>
<strong>Estado Civil:</strong> {{ $datos['persona']['estado_civil'] }}<br>
<strong>Genero:</strong> {{ $datos['persona']['genero'] }}<br>
<strong>Email Personal:</strong> {{ $datos['persona']['email_personal'] }}<br>
<strong>Email Laboral:</strong> {{ $datos['persona']['email_laboral'] }}<br>
<strong>Telefono:</strong> {{ $datos['persona']['telefono_secundario'] }}<br>

<hr>
<h4>Cónyuge</h4>
@if ($datos['conyuge'])
<strong>Nombre:</strong> {{ $datos['conyuge']['nombres_conyuge'] }}<br>
<strong>Conyuge:</strong> {{ $datos['conyuge']['identidad_conyuge'] }}<br>
<strong>Direccion:</strong> {{ $datos['conyuge']['direccion_conyuge'] }}<br>
<strong>Fecha de nacimiento:</strong> {{ $datos['conyuge']['fecha_nacimiento_conyuge'] }}<br>
<strong>Direccion de Trabajo:</strong> {{ $datos['conyuge']['direccion_trabajo_conyuge'] }}<br>
<strong>Tiempo de laborar:</strong> {{ $datos['conyuge']['tiempo_laborar_conyuge'] }}<br>
<strong>Ingresos por negocio:</strong> {{ $datos['conyuge']['ingresos_negocio_conyuge'] }}<br>
<strong>Gastos de alimentacion:</strong> {{ $datos['conyuge']['gastos_alimentacion_conyuge'] }}<br>

@else
<p>No hay información registrada.</p>
@endif


<hr>
<h4>Vivienda</h4>
@if ($datos['vivienda'])
<strong>Dirección:</strong> {{ $datos['vivienda']['direccion_completa'] ?? 'N/A' }}<br>
<strong>Dependiente:</strong> {{ $datos['vivienda']['dependiente'] ?? 'N/A' }}<br>
<strong>Tipo de casa:</strong> {{ $datos['vivienda']['tipo_casa'] ?? 'N/A' }}<br>
<strong>Tiempo de vivir:</strong> {{ $datos['vivienda']['tiempo_vivir'] ?? 'N/A' }}<br>
<strong>Pago de vivienda:</strong> {{ $datos['vivienda']['pago_vivienda'] ?? 'N/A' }}<br>
<strong>Tipo de pago:</strong> {{ $datos['vivienda']['tipo_pago_vivienda'] ?? 'N/A' }}<br>
<strong>Valor del pago:</strong> {{ $datos['vivienda']['valor_pago'] ?? 'N/A' }}<br>
<strong>Material de construccion:</strong> {{ $datos['vivienda']['material_construccion'] ?? 'N/A' }}<br>

@else
<p>No hay información registrada.</p>
@endif

<hr>
<h4>Información Laboral</h4>
@if ($datos['informacionlaboral'])
<strong>Profesión:</strong> {{ $datos['informacionlaboral']['profesion_oficio'] ?? 'N/A' }}<br>
<strong>Actividad:</strong> {{ $datos['informacionlaboral']['actividad'] ?? 'N/A' }}<br>

<strong>Ingresos del negocio:</strong> {{ $datos['informacionlaboral']['ingresos_negocio'] ?? 'N/A' }}<br>
<strong>Direccion de trabajo:</strong> {{ $datos['informacionlaboral']['direccion_trabajo'] ?? 'N/A' }}<br>

<strong>Nombre del patrono o del negocio:</strong> {{ $datos['informacionlaboral']['patrono_negocio'] ?? 'N/A' }}<br>
<strong>Tiempo de laborar:</strong> {{ $datos['informacionlaboral']['tiempo_laborar'] ?? 'N/A' }}<br>
<strong>Gastos de alimentacion:</strong> {{ $datos['informacionlaboral']['gastos_alimentacion'] ?? 'N/A' }}<br>
@else
<p>No hay información registrada.</p>
@endif

<hr>
<h4>Estado de Ingresos</h4>
<strong>Sueldo Base:</strong> L {{ $datos['estado_ingresos']['sueldo_base'] ?? '0.00' }}<br>
<strong>Ingresos por renta de propiedades:</strong> L {{ $datos['estado_ingresos']['renta_propiedades'] ?? '0.00' }}<br>
<strong>Ingresos por Remesas:</strong> L {{ $datos['estado_ingresos']['remesas'] ?? '0.00' }}<br>
<strong>Ingresos por Aporte del conyuge:</strong> L {{ $datos['estado_ingresos']['aporte_conyuge'] ?? '0.00' }}<br>
<strong>Ingresos por sociedad:</strong> L {{ $datos['estado_ingresos']['ingresos_sociedad'] ?? '0.00' }}<br>
<strong>Total Ingresos:</strong> L {{ $datos['estado_ingresos']['total_ingresos'] ?? '0.00' }}<br>
<strong>Cuota de prestamo:</strong> L {{ $datos['estado_ingresos']['cuota_de_prestamo'] ?? '0.00' }}<br>
<strong>Cuota de vivienda:</strong> L {{ $datos['estado_ingresos']['cuota_vivienda'] ?? '0.00' }}<br>
<strong>Gastos de alimentacion:</strong> L {{ $datos['estado_ingresos']['alimentacion'] ?? '0.00' }}<br>
<strong>Otros egresos:</strong> L {{ $datos['estado_ingresos']['otro_egresos'] ?? '0.00' }}<br>
<strong>Otros egresos:</strong> L {{ $datos['estado_ingresos']['total_egresos'] ?? '0.00' }}<br>
<strong>Ingreso Neto:</strong> L {{ $datos['estado_ingresos']['ingreso_neto'] ?? '0.00' }}<br>



<hr>
<h4>Referencias Familiares</h4>
<strong>Referencia 1:</strong><br>
<strong>Nombre del Familiar:</strong> {{ $datos['referencias_familiares']['nombre_familiar'] ?? 'N/A' }}<br>
<strong>Direccion Familiar:</strong> {{ $datos['referencias_familiares']['parentesco'] ?? 'N/A' }}<br>
<strong>Direccion Familiar:</strong> {{ $datos['referencias_familiares']['direccion_familiar'] ?? 'N/A' }}<br>

<strong>Referencia 2:</strong><br>
<strong>Nombre del Familiar:</strong> {{ $datos['referencias_familiares']['nombre_familiardos'] ?? 'N/A' }}<br>
<strong>Direccion Familiar:</strong> {{ $datos['referencias_familiares']['parentesco_dos'] ?? 'N/A' }}<br>
<strong>Direccion Familiar:</strong> {{ $datos['referencias_familiares']['direccion_familiardos'] ?? 'N/A' }}<br>

</body>
</html>