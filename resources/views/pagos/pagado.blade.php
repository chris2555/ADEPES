<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Realizados - ADEPES</title>
    <style>
        .numero-pago {
    text-align: center;
}

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
    border: 1px solid #ddd;
    text-align: left;
    line-height: 1.5;
}

    th {
    background-color:rgb(152, 236, 152); /* verde claro */
    color: dark;               /* opcional: azul para que coincida con el resto del estilo */
    font-weight: bold;
    padding: 6px;
}



    .resumen-prestamo td {
        padding: 2px !important;
        font-size: 12px;
        line-height: 1.1;
    }

    .resumen-prestamo td:nth-child(1) {
        background-color: yellow;
        font-weight: bold;
    }

    .resumen-prestamo td:nth-child(2) {
        background-color: yellow;
    }

    .resumen-prestamo .cuota {
        background-color: #ccffcc;
        color: blue;
    }

    .resumen-prestamo .nota {
        padding: 6px !important;
        font-size: 11px;
        line-height: 1.2;
        vertical-align: top;
    }

    .cliente-table td {
        width: 50%;
        padding-left: 15px;
    }
</style>
</head>
<body>
    

</table>

        @php
            $tipo = $pagado[0]['tipo_cuota'] ?? 'Nivelada'; // Asegúrate de tener el tipo en la data
            $tasaInteresAnual = ($pagado[0]['tasa'] ?? 0) / 100;
            $plazoMeses = $pagado[0]['plazo'] ?? 0;
            $montoPrestamo = $pagado[0]['monto_prestamo'] ?? 0;
            $valorCuotaCalculada = 0;

            if ($tasaInteresAnual > 0 && $plazoMeses > 0 && $montoPrestamo > 0) {
                if ($tipo === "Nivelada") {
                    $r = $tasaInteresAnual / 12;
                    $valorCuotaCalculada = ($montoPrestamo * $r * pow(1 + $r, $plazoMeses)) / (pow(1 + $r, $plazoMeses) - 1);
                } else {
                    $interesMensual = ($montoPrestamo * $tasaInteresAnual) / 12;
                    $capitalMensual = $montoPrestamo / $plazoMeses;
                    $valorCuotaCalculada = $interesMensual + $capitalMensual;
                }
            }
        @endphp

    

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
    <img src="{{ public_path('img/adepeslogo.jpg') }}" width="80" alt="Logo ADEPES">
    <h1 style="flex-grow: 1; text-align: center; margin: 0;">Detalles del Prestamo</h1>
</div>

<table class="cliente-table">
    <tr>s
        <th>Cliente</th>
        <td>{{ $pagado[0]['nombres_apellidos'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>ID Cliente</th>
        <td>{{ $pagado[0]['id_persona'] ?? 'N/A' }}</td>
</table>


<table class="resumen-prestamo" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    </tr>
        
    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Valor del préstamo</td>
        <td style="background-color: yellow; border: 1px solid #ddd;">L {{ number_format($pagado[0]['monto_prestamo'] ?? 0, 2) }}</td>
        <td rowspan="6" style="border: 1px solid #ddd; vertical-align: top; padding: 10px;">
            <strong>NOTA:</strong><br>
            Pagos realizados después de la<br>
            Fecha de vencimiento de la cuota<br>
            están sujetos a cobros de interés<br>
            moratorio, evite recargos.
        </td>
    </tr>
    <tr>
    
    <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Total Pagado</td>
    <td style="background-color: yellow; border: 1px solid #ddd;">{{ number_format($pagado[0]['total_pagado'] ?? 0, 2) }}</td>
    </tr>
    <tr>
    
    <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Cantidad de cuotas</td>
    <td style="background-color: yellow; border: 1px solid #ddd;">{{ $pagado[0]['plazo'] ?? 'N/A' }}</td>
</tr>
<tr>
    <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Tasa de interés anual</td>
    <td style="background-color: yellow; border: 1px solid #ddd;">{{ number_format($pagado[0]['tasa'] ?? 0, 2) }}%</td>
</tr>
<tr>
    <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Fecha Desembolso</td>
    <td style="background-color: yellow; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($pagado[0]['creado_en'])->format('d/m/Y') }}</td>
</tr>
<tr>
    <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Valor de la cuota mensual</td>
    <td style="background-color: #ccffcc; border: 1px solid #ddd; color: blue;">
        L {{ number_format($valorCuotaCalculada, 2) }}
    </td>
</tr>



</table>

<h1>Detalle de Pagos Realizados</h1>

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">Fecha</th>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">No. de Pago</th>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">Método de Pago</th>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">Recibo</th>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">Monto Pagado</th>
            <th style="border: 1px solid #ddd; background-color:rgb(152, 236, 152);">Intereses</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPagado = 0;
            $totalIntereses = 0;
        @endphp
        @foreach ($pagado as $pago)
            @php
                $totalPagado += $pago['monto'] ?? 0;
                $totalIntereses += $pago['intereses'] ?? 0;
            @endphp
        
            <tr>
                <td style="border: 1px solid #ddd;">{{ date('d/m/Y', strtotime($pago['fecha'])) }}</td>
                <td style="border: 1px solid #ddd;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid #ddd;">{{ $pago['metodo_pago'] ?? 'N/A' }}</td>
                <td style="border: 1px solid #ddd;">{{ $pago['recibo'] ?? 'N/A' }}</td>
                <td style="border: 1px solid #ddd;">L {{ number_format($pago['monto'] ?? 0, 2) }}</td>
                <td style="border: 1px solid #ddd;">L {{ number_format($pago['intereses'] ?? 0, 2) }}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold; background-color:rgb(152, 236, 152); color: blue;">
            <td colspan="4" style="text-align: right;">Totales:</td>
            <td>L {{ number_format($totalPagado, 2) }}</td>
            <td>L {{ number_format($totalIntereses, 2) }}</td>
        </tr>
    </tbody>
</table>

<div style="position: fixed; bottom: 20px; right: 20px; font-size: 12px;">
    Página 1 de 1
</div>


</body>
</html>