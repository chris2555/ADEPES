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
            <h3 style="margin: 0;">ADEPES</h3>
            <p style="margin: 0;">Programa de Desarrollo Sostenible con Enfoque a Derecho</p>
            <p style="margin: 0;">Fondo Rotatorio</p>
            <p style="margin: 0;">Pespire, Choluteca</p>
            <p style="margin: 0;">Tel:2226-2345</p>
            <strong>Solicitud creada por:</strong> {{ $datos['estado_ingresos']['creado_por_nombre'] ?? 'N/A' }}<br>
            <p style="margin: 0;"><strong>Fecha de emisión:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>

        </td>
        <td style="text-align: right; vertical-align: top; border: none;">
        <img src="{{ public_path('img/adepeslogo.jpg') }}" width="150" alt="Logo ADEPES">
        </td>
    </tr>
</table>

                

<div class="title"><span style="text-decoration: underline;">SOLICITUD FONDO ROTATORIO</span></div>

        
<h2>Solicitud</h2>
<hr>

<div style="font-size: 14px; line-height: 2.0;">
  <div style="display: inline-block; width: 32%; vertical-align: top;">
    <div><strong>Tipo de garantia:</strong> {{ $datos['solicitud']['tipo_garantia'] ?? 'N/A' }}</div>
    <div><strong>Monto:</strong> {{ $datos['solicitud']['monto'] ?? 'N/A' }}</div>
    </div>

<div style="display: inline-block; width: 32%; vertical-align: top; ">
    <div><strong>Tipo de Cuota:</strong> {{ $datos['solicitud']['tipo_cuota'] ?? 'N/A' }}</div>
    <div><strong>Plazo:</strong> {{ $datos['solicitud']['plazo'] ?? 'N/A' }}</div>
  </div>

  <div style="display: inline-block; width: 32%; vertical-align: top;">
    <div><strong>Tasa:</strong> {{ $datos['solicitud']['tasa'] ?? 'N/A' }}</div>
    <div><strong>Invierte en:</strong> {{ $datos['solicitud']['invierte_en'] ?? 'N/A' }}</div>
  </div>
</div>
<br>

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
    <td class="encabezado">Fecha de nacimiento:</td>
<td>{{ \Carbon\Carbon::parse($datos['persona']['fecha_nacimiento'])->format('d-m-Y') }}</td>

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
    <td class="encabezado">Identidad:</td> <td>{{ $datos['conyuge']['identidad_conyuge'] }}</td>
    </tr>
    <tr>
    <td class="encabezado">Fecha de nacimiento:</td>
    <td>{{ \Carbon\Carbon::parse($datos['conyuge']['fecha_nacimiento_conyuge'])->format('d-m-Y') }}</td>
    <td class="encabezado">Direccion:</td> <td>{{ $datos['conyuge']['direccion_conyuge'] }}</td>
   

    </tr>
    <tr>
    <td class="encabezado">Profesion:</td> <td> {{ $datos['conyuge']['profesion_oficio_conyuge'] }}</td>
    <td class="encabezado">Direccion de Trabajo:</td> <td> {{ $datos['conyuge']['direccion_trabajo_conyuge'] }}</td>
    </tr>
    <tr>
    <td class="encabezado">Cargo de trabajo:</td> <td>{{ $datos['conyuge']['cargo_conyuge'] }}</td> 
    <td class="encabezado">Tiempo de laborar:</td> <td>{{ $datos['conyuge']['tiempo_laborar_conyuge'] }}</td>

    </tr>
    <tr>
    <td class="encabezado">Ingresos por negocio:</td> <td> {{ $datos['conyuge']['ingresos_negocio_conyuge'] }}</td>
    <td class="encabezado">Gastos de alimentacion:</td> <td> {{ $datos['conyuge']['gastos_alimentacion_conyuge'] }}</td>
    </tr>
</tr>
    </table>


    <h2>Vivienda</h2> 
<hr>

<div style="font-size: 14px;">
  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <div><strong>Dirección:</strong> {{ $datos['vivienda']['direccion_completa'] ?? 'N/A' }}</div>
    <div><strong>Tiempo de vivir:</strong> {{ $datos['vivienda']['tiempo_vivir'] ?? 'N/A' }}</div>
    <div><strong>Tipo de casa:</strong> {{ $datos['vivienda']['tipo_casa'] ?? 'N/A' }}</div>
    <div><strong>Pago de vivienda:</strong> {{ $datos['vivienda']['pago_vivienda'] ?? 'N/A' }}</div>
  </div>

  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <div><strong>Tipo de pago:</strong> {{ $datos['vivienda']['tipo_pago_vivienda'] ?? 'N/A' }}</div>
    <div><strong>Valor del pago:</strong> {{ $datos['vivienda']['valor_pago'] ?? 'N/A' }}</div>
    <div><strong>Material de construcción:</strong> {{ $datos['vivienda']['material_construccion'] ?? 'N/A' }}</div>
    <div><strong>Dependiente:</strong> {{ $datos['vivienda']['dependiente'] ?? 'N/A' }}</div>
  </div>
</div>


<h2>Información Laboral</h2>
<hr>

<div style="font-size: 14px;">
  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <div><strong>Profesión:</strong> {{ $datos['informacionlaboral']['profesion_oficio'] ?? 'N/A' }}</div>
    <div><strong>Actividad:</strong> {{ $datos['informacionlaboral']['actividad'] ?? 'N/A' }}</div>
    <div><strong>Ingresos del negocio:</strong> {{ $datos['informacionlaboral']['ingresos_negocio'] ?? 'N/A' }}</div>
    <div><strong>Dirección de trabajo:</strong> {{ $datos['informacionlaboral']['direccion_trabajo'] ?? 'N/A' }}</div>
  </div>

  <div style="display: inline-block; width: 48%; vertical-align: top;">
    <div><strong>Nombre del patrono o del negocio:</strong> {{ $datos['informacionlaboral']['patrono_negocio'] ?? 'N/A' }}</div>
    <div><strong>Tiempo de laborar:</strong> {{ $datos['informacionlaboral']['tiempo_laborar'] ?? 'N/A' }}</div>
    <div><strong>Gastos de alimentación:</strong> {{ $datos['informacionlaboral']['gastos_alimentacion'] ?? 'N/A' }}</div>
  </div>
</div>



<div style="position: fixed; bottom: 20px; right: 20px; font-size: 12px;">
    Página 1 de 2
</div>

<h2>Estado de Ingresos y Egresos</h2>
<hr>

<table style="width: 100%; border-collapse: collapse; max-width: 800px; font-family: Arial, sans-serif;">
    <tr>
        <td style="background-color:rgb(133, 245, 122)"><strong>Sueldo Base:</strong></td>
        <td>L {{ $datos['estado_ingresos']['sueldo_base'] ?? '0.00' }}</td>
        <td style="background-color:rgb(133, 245, 122)"><strong>Cuota de préstamo:</strong></td>
        <td>L {{ $datos['estado_ingresos']['cuota_de_prestamo'] ?? '0.00' }}</td>
    </tr>
    <tr>
        <td style="background-color:rgb(133, 245, 122)"><strong>Renta Propiedades:</strong></td>
        <td>L {{ $datos['estado_ingresos']['renta_propiedades'] ?? '0.00' }}</td>
        <td style="background-color:rgb(133, 245, 122)"><strong>Cuota de vivienda:</strong></td>
        <td>L {{ $datos['estado_ingresos']['cuota_vivienda'] ?? '0.00' }}</td>
    </tr>
    <tr>
        <td style="background-color:rgb(133, 245, 122)"><strong>Remesas:</strong></td>
        <td>L {{ $datos['estado_ingresos']['remesas'] ?? '0.00' }}</td>
        <td style="background-color:rgb(133, 245, 122)"><strong>Alimentación:</strong></td>
        <td>L {{ $datos['estado_ingresos']['alimentacion'] ?? '0.00' }}</td>
    </tr>
    <tr>
        <td style="background-color:rgb(133, 245, 122)"><strong>Aporte Cónyuge:</strong></td>
        <td>L {{ $datos['estado_ingresos']['aporte_conyuge'] ?? '0.00' }}</td>
        <td style="background-color:rgb(133, 245, 122)"><strong>Otros egresos:</strong></td>
        <td>L {{ $datos['estado_ingresos']['otro_egresos'] ?? '0.00' }}</td>
    </tr>
    <tr>
        <td style="background-color:rgb(133, 245, 122)"><strong>Ingresos Sociedad:</strong></td>
        <td>L {{ $datos['estado_ingresos']['ingresos_sociedad'] ?? '0.00' }}</td>
        <td style="background-color:rgb(133, 245, 122)"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(113, 255, 77); padding: 8px; border-radius: 5px;">
            <strong>Total Ingresos:</strong> L {{ $datos['estado_ingresos']['total_ingresos'] ?? '0.00' }}
        </td>
        <td colspan="2" style="background-color:rgb(113, 255, 77); padding: 8px; border-radius: 5px;">
            <strong>Total Egresos:</strong> L {{ $datos['estado_ingresos']['total_egresos'] ?? '0.00' }}
        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color:rgba(135, 197, 255, 0.99); padding: 10px; border-radius: 5px; text-align: center; font-weight: bold;">
            Ingreso Neto: L {{ $datos['estado_ingresos']['ingreso_neto'] ?? '0.00' }}
        </td>
    </tr>
</table>

<h2>Relacion cuotas en cuanto a ingresos netos</h2>
<hr>

<table class="tabla-datos" width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-family: Arial, sans-serif;">
    <tr>
        <td class="encabezado" style="font-weight: bold;">Letra mensual:</td>
        <td>L. {{ number_format($datos['solicitud']['capital'], 2) }}</td>
    </tr>
    <tr>
        <td class="encabezado" style="font-weight: bold;">Interés corriente mensual:</td>
        <td>L. {{ number_format($datos['solicitud']['interes'], 2) }}</td>
    </tr>
    <tr>
        <td class="encabezado" style="font-weight: bold;">Total por pagar cuota:</td>
        <td>L. {{ number_format($datos['solicitud']['valor_cuota'], 2) }}</td>
    </tr>
    <tr>
        <td class="encabezado" style="font-weight: bold; background-color: yellow;">Liquidez del Cliente:</td>
        <td style="font-weight: bold; background-color: yellow;">
            L. {{ number_format($datos['estado_ingresos']['ingreso_neto'] - $datos['solicitud']['valor_cuota'], 2) }}
        </td>
    </tr>
</table>

@php
    $liquidez = $datos['estado_ingresos']['ingreso_neto'] - $datos['solicitud']['valor_cuota'];
@endphp

@if ($liquidez >= 0)
    <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-family: Arial, sans-serif; text-align: center;">
        <tr>
            <td colspan="1" style="background-color: yellow; font-weight: bold;">
                EVALUACIÓN SEGÚN INFORMACIÓN RECOPILADA
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">
                CLIENTE TIENE CAPACIDAD DE PAGO, PARA EL MONTO QUE ESTÁ SOLICITANDO
            </td>
        </tr>
    </table>
@else
    <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; font-family: Arial, sans-serif; text-align: center;">
        <tr>
            <td colspan="1" style="background-color: yellow; font-weight: bold;">
                EVALUACIÓN SEGÚN INFORMACIÓN RECOPILADA
            </td>
        </tr>
        <tr>
            <td style="font-weight: bold;">
                CLIENTE NO TIENE CAPACIDAD DE PAGO, PARA EL MONTO QUE ESTÁ SOLICITANDO
            </td>
        </tr>
    </table>
@endif

<h2>Referencias Familiares</h2>
<hr>
<table width="100%" cellspacing="0" cellpadding="8"  
    style="font-family: Arial, sans-serif; border-collapse: collapse; border: none; line-height: 1.5;">
    <tr>
        <td style="width: 50%; vertical-align: top; padding-right: 15px; border: none;">
            <strong>Referencia 1:</strong>
            <div><strong>Nombre del Familiar:</strong> {{ $datos['referencias_familiares']['nombre_familiar'] ?? 'N/A' }}</div>
            <div><strong>Parentesco:</strong> {{ $datos['referencias_familiares']['parentesco'] ?? 'N/A' }}</div>
            <div><strong>Dirección Familiar:</strong> {{ $datos['referencias_familiares']['direccion_familiar'] ?? 'N/A' }}</div>
        </td>
        <td style="width: 50%; vertical-align: top; padding-left: 15px; border: none;">
            <strong>Referencia 2:</strong>
            <div><strong>Nombre del Familiar:</strong> {{ $datos['referencias_familiares']['nombre_familiardos'] ?? 'N/A' }}</div>
            <div><strong>Parentesco:</strong> {{ $datos['referencias_familiares']['parentesco_dos'] ?? 'N/A' }}</div>
            <div><strong>Dirección Familiar:</strong> {{ $datos['referencias_familiares']['direccion_familiardos'] ?? 'N/A' }}</div>
        </td>
    </tr>
</table>

<h2>Avales</h2>
<hr>
<table width="100%" cellspacing="0" cellpadding="8"  
    style="font-family: Arial, sans-serif; border-collapse: collapse; border: none; line-height: 1.5;">
    <tr>
        <td style="width: 50%; vertical-align: top; padding-right: 15px; border: none;">
            <div><strong>Aval 1:</strong> {{ $datos['relacion']['nombre_aval1'] ?? 'N/A' }}</div>
        </td>
        <td style="width: 50%; vertical-align: top; padding-left: 15px; border: none;">
            <div><strong>Aval2:</strong> {{ $datos['relacion']['nombre_aval2'] ?? 'N/A' }}</div>
        </td>
    </tr>
</table>




<div style="margin-top: 50px; width: 80%; margin-left: auto; margin-right: auto;">
    <p><strong>Observaciones:</strong></p>
    <div style="border: 1px solid #000; height: 80px; padding: 5px;"></div>
</div>


<div style="margin-top: 50px; text-align: center;">
    <p>_______________________________________________________</p>
    <p><strong>Nombre o Firma del Solicitante</strong></p>
</div>



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