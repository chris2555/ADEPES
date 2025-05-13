<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Pagos - ADEPES</title>
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

   
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
    <img src="{{ public_path('img/adepeslogo.jpg') }}" width="80" alt="Logo ADEPES">
    <h1 style="flex-grow: 1; text-align: center; margin: 0;">Plan de Pagos Cuota</h1>
</div>



    <table class="cliente-table">
        <tr>
            <th>Cliente</th>
            <td>{{ $amortizacion[0]['NombrePersona'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>ID Cliente</th>
            <td>{{ $amortizacion[0]['IdPersona'] ?? 'N/A' }}</td>
        </tr>
    </table>


    </table>

    <table class="resumen-prestamo" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">


    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Valor del préstamo</td>
        <td style="background-color: yellow; border: 1px solid #ddd;">L {{ number_format($solicitud['monto'], 2) }}</td>
        <td rowspan="5" style="border: 1px solid #ddd; vertical-align: top; padding: 10px;">
            <strong>NOTA:</strong><br>
            Pagos realizados después de la<br>
            Fecha de vencimiento de la cuota<br>
            están sujetos a cobros de interés<br>
            moratorio, evite recargos.
        </td>
    </tr>
    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Cantidad de cuotas</td>
        <td style="background-color: yellow; border: 1px solid #ddd;">{{ $solicitud['plazo'] }}</td>
    </tr>
    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Tasa de interés anual</td>
        <td style="background-color: yellow; border: 1px solid #ddd;">{{ number_format($solicitud['tasa'], 2) }}%</td>
    </tr>
    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Fecha Desembolso</td>
        <td style="background-color: yellow; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($solicitud['creado_en'])->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td style="background-color: yellow; font-weight: bold; border: 1px solid #ddd;">Valor de la cuota mensual</td>
        <td style="background-color: #ccffcc; border: 1px solid #ddd; color: blue;">
            L {{ number_format($solicitud['valor_cuota'], 2) }}
        </td>
    </tr>
</table>

    <h1>Plan de Pagos</h1>
    

    <table>
        <thead>
            <tr>
            <th>Fecha de pago</th>
                <th>Número de Pago</th>
                <th>Saldo Inicial</th>
                <th>Cuota Mensual</th>
                <th>Interés Pagado</th>
                <th>Capital Pagado</th>
                <th>Saldo Final</th>
            </tr>
        </thead>
        <tbody>
           
            @php
    $totalCuotas = 0;
    $totalIntereses = 0;
@endphp

@foreach ($amortizacion as $pago)
    @php
        $totalCuotas += $pago['CuotaMensual'];
        $totalIntereses += $pago['InteresPagado'];
    @endphp
                <tr>
                <td class="numero-pago">{{ \Carbon\Carbon::parse($pago['Fecha'])->format('d/m/Y') }}</td>
                <td class="numero-pago">{{ $pago['NumeroPago'] }}</td>
                <td>L {{ number_format($pago['SaldoInicial'], 2) }}</td>
                    <td>L {{ number_format($pago['CuotaMensual'], 2) }}</td>
                    <td>L {{ number_format($pago['InteresPagado'], 2) }}</td>
                    <td>L {{ number_format($pago['CapitalPagado'], 2) }}</td>
                    <td>L {{ number_format($pago['SaldoFinal'], 2) }}</td>
                </tr>
            @endforeach

<tr style="font-weight: bold; background-color:rgb(152, 236, 152); color: blue;">
    <td colspan="3" style="text-align: right;">Totales:</td>
    <td>L {{ number_format($totalCuotas, 2) }}</td>
    <td>L {{ number_format($totalIntereses, 2) }}</td>
    <td colspan="2"></td>
</tr>

        </tbody>
    </table>
    </div>
    <div style="position: fixed; bottom: 20px; right: 20px; font-size: 12px;">
    Página 1 de 1
</div>
</body>
</html>
