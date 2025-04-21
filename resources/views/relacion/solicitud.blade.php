<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud Fondo Rotatorio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            margin-bottom: 60px; /* espacio para el footer */
        }

        .container {
            width: 850px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ccc;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header .info {
            text-align: left;
            font-size: 13px;
        }

        .header img {
            width: 100px;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 8px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px 10px;
            border: 1px solid #000;
            text-align: left;
        }

        .label {
            font-weight: bold;
        }

        .no-info {
            font-style: italic;
            color: #666;
        }


    </style>
</head>
<body>
    
        <div class="header">
            <div class="info">

            <table width="100%" style="margin-bottom: 20px; border: none; border-collapse: collapse;">
    <tr>
    <td style="text-align: left; vertical-align: top; border: none;">
            <h2 style="margin: 0;">ADEPES</h2>
            <p style="margin: 0;">Programa de Desarrollo Sostenible con Enfoque a Derecho</p>
            <p style="margin: 0;">Fondo Rotatorio</p>
            <p style="margin: 0;">Pespire, Choluteca</p>
            <p style="margin: 0;">Tel:2226-2345</p>
            <strong>Solicitud creada por:</strong> {{ $datos['estado_ingresos']['creado_por_nombre'] ?? 'N/A' }}<br>
        </td>
        <td style="text-align: right; vertical-align: top; border: none;">
        <img src="{{ public_path('img/adepeslogo.jpg') }}" width="150" alt="Logo ADEPES">
        </td>
    </tr>
</table>

                

<div class="title"><span style="text-decoration: underline;">SOLICITUD FONDO ROTATORIO</span></div>

        


<h2>Datos Personales</h2>
<hr>
<style>
    .tabla-datos td {
        border: 1px solid #000;
        padding: 6px;
    }

    .tabla-datos .encabezado {
        background-color:rgb(133, 245, 122); /* Verde claro */
        font-weight: bold;
    }
</style>
       
<table class="tabla-datos" width="100%">
    <tr>
        <td class="encabezado">Nombre:</td> <td>{{ $datos['persona']['nombres_apellidos'] }}</td>
        <td class="encabezado">Identidad:</td> <td>{{ $datos['persona']['n_identidad'] }}</td>
    </tr>
    <tr>
        <td class="encabezado">Fecha de nacimiento:</td> <td>{{ $datos['persona']['fecha_nacimiento'] }}</td>
        <td class="encabezado">Edad:</td> <td>{{ $datos['persona']['edad'] }}</td>
    </tr>
    <tr>
        <td class="encabezado">Nacionalidad:</td> <td>{{ $datos['persona']['nacionalidad'] }}</td>
        <td class="encabezado">Estado Civil:</td> <td>{{ $datos['persona']['estado_civil'] }}</td>
    </tr>
    <tr>
        <td class="encabezado">Género:</td> <td>{{ $datos['persona']['genero'] }}</td>
        <td class="encabezado">Teléfono:</td> <td>{{ $datos['persona']['telefono_secundario'] }}</td>
        
    </tr>
    <tr>
    <td class="encabezado">Email Personal:</td> <td>{{ $datos['persona']['email_personal'] }}</td>
    <td class="encabezado">Email Laboral:</td> <td>{{ $datos['persona']['email_laboral'] }}</td>
        
    </tr>
</table>


<h2>Datos del cónyuge</h2>
<hr>

<table class="tabla-datos" width="100%">
    <tr>
    <td class="encabezado">Nombre:</td> <td>{{ $datos['conyuge']['nombres_conyuge'] }}</td>
    <td class="encabezado">Conyuge:</td> <td>{{ $datos['conyuge']['identidad_conyuge'] }}</td>
    </tr>
    <tr>
    <td class="encabezado">Direccion:</td> <td>{{ $datos['conyuge']['direccion_conyuge'] }}</td>
    <td class="encabezado">Fecha de nacimiento:</td> <td> {{ $datos['conyuge']['fecha_nacimiento_conyuge'] }}</td>
    </tr>
    <tr>
    <td class="encabezado">Direccion de Trabajo:</td> <td> {{ $datos['conyuge']['direccion_trabajo_conyuge'] }}</td>
    <td class="encabezado">Tiempo de laborar:</td> <td>{{ $datos['conyuge']['tiempo_laborar_conyuge'] }}</td>
    </tr>
    <tr>
    <td class="encabezado">Ingresos por negocio:</td> <td> {{ $datos['conyuge']['ingresos_negocio_conyuge'] }}</td>
    <td class="encabezado">Gastos de alimentacion:</td> <td> {{ $datos['conyuge']['gastos_alimentacion_conyuge'] }}</td>
    </tr>
    </table>


<h2>Vivienda</h2>
<hr>

<div style="font-size: 14px;">
  <div style="display: inline-block; width: 48%; vertical-align: top;">
<strong>Dirección:</strong>{{ $datos['vivienda']['direccion_completa'] ?? 'N/A' }}<br>
<strong>Tiempo de vivir:</strong> {{ $datos['vivienda']['tiempo_vivir'] ?? 'N/A' }}<br>
<strong>Tipo de casa:</strong>{{ $datos['vivienda']['tipo_casa'] ?? 'N/A' }}<br>
<strong>Pago de vivienda:</strong>{{ $datos['vivienda']['pago_vivienda'] ?? 'N/A' }}<br>
</div>

  <div style="display: inline-block; width: 48%; vertical-align: top;">
<strong>Tipo de pago:</strong>{{ $datos['vivienda']['tipo_pago_vivienda'] ?? 'N/A' }}<br>
<strong>Valor del pago:</strong> {{ $datos['vivienda']['valor_pago'] ?? 'N/A' }}<br>
<strong>Material de construccion:</strong> {{ $datos['vivienda']['material_construccion'] ?? 'N/A' }}<br>
<strong>Dependiente:</strong> {{ $datos['vivienda']['dependiente'] ?? 'N/A' }}<br>
</div>
</div>


    <h2>Información Laboral</h2>
<hr>

<div style="font-size: 14px;">
  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <strong>Profesión:</strong> {{ $datos['informacionlaboral']['profesion_oficio'] ?? 'N/A' }}<br>
    <strong>Actividad:</strong> {{ $datos['informacionlaboral']['actividad'] ?? 'N/A' }}<br>
    <strong>Ingresos del negocio:</strong> {{ $datos['informacionlaboral']['ingresos_negocio'] ?? 'N/A' }}<br>
    <strong>Dirección de trabajo:</strong> {{ $datos['informacionlaboral']['direccion_trabajo'] ?? 'N/A' }}<br>
  </div>

  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <strong>Nombre del patrono o del negocio:</strong> {{ $datos['informacionlaboral']['patrono_negocio'] ?? 'N/A' }}<br>
    <strong>Tiempo de laborar:</strong> {{ $datos['informacionlaboral']['tiempo_laborar'] ?? 'N/A' }}<br>
    <strong>Gastos de alimentación:</strong> {{ $datos['informacionlaboral']['gastos_alimentacion'] ?? 'N/A' }}<br>
  </div>
</div>




<div style="position: fixed; bottom: 20px; right: 20px; font-size: 12px;">
    Página 1 de 2
</div>

<h2>Estado de Ingresos</h2>
<hr>
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




<h2>Referencias Familiares</h2>
<hr>
<strong>Referencia 1:</strong><br>
<table class="tabla-datos" width="100%">
    <tr>
<td class="encabezado">Nombre del Familiar:</td> <td> {{ $datos['referencias_familiares']['nombre_familiar'] ?? 'N/A' }}</td>
<td class="encabezado">Parentesco:</td> <td> {{ $datos['referencias_familiares']['parentesco'] ?? 'N/A' }}</td>
<td class="encabezado">Direccion Familiar:</td> <td>{{ $datos['referencias_familiares']['direccion_familiar'] ?? 'N/A' }}</td>
</tr>
    </table>

<strong>Referencia 2:</strong><br>
<table class="tabla-datos" width="100%">
<td class="encabezado">Nombre del Familiar:</td> <td> {{ $datos['referencias_familiares']['nombre_familiardos'] ?? 'N/A' }}</td>
<td class="encabezado">Parentesco:</td> <td> {{ $datos['referencias_familiares']['parentesco_dos'] ?? 'N/A' }}</td>
<td class="encabezado">Direccion Familiar:</td> <td> {{ $datos['referencias_familiares']['direccion_familiardos'] ?? 'N/A' }}</td>
</tr>
    </table>
<div style="position: fixed; bottom: 20px; right: 20px; font-size: 12px;">
    Página 2 de 2
</div>


<div class="footer">
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 10;
                    $pageText = "Página " . $PAGE_NUM . " de " . $PAGE_COUNT;
                    $x = 520;
                    $y = 820;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
    </script>
</div>

</body>
</html>