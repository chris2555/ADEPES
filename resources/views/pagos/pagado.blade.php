<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Realizados - ADEPES</title>
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
    </style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('vendor/adminlte/dist/img/adepes.png') }}" alt="ADEPES">
    </div>

    <h1>Resumen de Préstamo</h1>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>ID Cliente</th>
                <th>ID Préstamo</th>
                <th>Monto del Préstamo</th>
                <th>Total Pagado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pagado[0]['nombres_apellidos'] ?? 'N/A' }}</td>
                <td>{{ $pagado[0]['id_persona'] ?? 'N/A' }}</td>
                <td>{{ $pagado[0]['id_prestamo'] ?? 'N/A' }}</td>
                <td>L {{ number_format($pagado[0]['monto_prestamo'] ?? 0, 2) }}</td>
                <td>L {{ number_format($pagado[0]['total_pagado'] ?? 0, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <h1>Pagos Realizados</h1>

    <table>
        <thead>
            <tr>
                <th>ID Pago</th>
                <th>Fecha</th>
                <th>Método de Pago</th>
                <th>Recibo</th>
                <th>Monto Pagado</th>
                <th>Intereses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagado as $pago)
                <tr>
                    <td>{{ $pago['id_pago'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($pago['fecha'])) }}</td>
                    <td>{{ $pago['metodo_pago'] }}</td>
                    <td>{{ $pago['recibo'] }}</td>
                    <td>L {{ number_format($pago['monto'], 2) }}</td>
                    <td>L {{ number_format($pago['intereses'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
