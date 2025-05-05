<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Pagos - ADEPES</title>
    <style>
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
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px;
        }
        .cliente-table td {
            width: 50%;
            padding-left: 15px;
        }
    </style>
</head>
<body>

   

    <h1>Datos del Cliente</h1>

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

    <h1>Plan de Pagos</h1>

    <table>
        <thead>
            <tr>
                <th>Número de Pago</th>
                <th>Fecha de pago</th>
                <th>Saldo Inicial</th>
                <th>Cuota Mensual</th>
                <th>Interés Pagado</th>
                <th>Capital Pagado</th>
                <th>Saldo Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($amortizacion as $pago)
                <tr>
                    <td>{{ $pago['NumeroPago'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($pago['Fecha'])->format('d/m/Y') }}</td>
                    <td>L {{ number_format($pago['SaldoInicial'], 2) }}</td>
                    <td>L {{ number_format($pago['CuotaMensual'], 2) }}</td>
                    <td>L {{ number_format($pago['InteresPagado'], 2) }}</td>
                    <td>L {{ number_format($pago['CapitalPagado'], 2) }}</td>
                    <td>L {{ number_format($pago['SaldoFinal'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
