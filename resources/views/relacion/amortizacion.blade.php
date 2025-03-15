<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Pagos</title>
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
    </style>
</head>
<body>
    <div>
        <strong>Cliente:</strong> {{ $amortizacion[0]['NombrePersona'] ?? 'N/A' }}
        <br>
        <strong>ID Cliente:</strong> {{ $amortizacion[0]['IdPersona'] ?? 'N/A' }}
    </div>

    <h1>Plan de Pagos</h1>

    <table>
        <thead>
            <tr>
                <th>Número de Pago</th>
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
                    <td>{{ $pago['SaldoInicial'] }}</td>
                    <td>{{ $pago['CuotaMensual'] }}</td>
                    <td>{{ $pago['InteresPagado'] }}</td>
                    <td>{{ $pago['CapitalPagado'] }}</td>
                    <td>{{ $pago['SaldoFinal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>