<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recibo de Pago</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>RECIBO DE PAGO</h2>
    </div>
    <div class="content">
        <p><strong>Cliente:</strong> {{ $recibo['nombre'] }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($recibo['fecha'])->format('d/m/Y') }}</p>
        <p><strong>Monto:</strong> L. {{ number_format($recibo['monto'], 2) }}</p>
        <p><strong>Método de pago:</strong> {{ $recibo['metodo_pago'] }}</p>
        <p><strong>Número de recibo:</strong> {{ $recibo['recibo'] }}</p>
    </div>
</body>
</html>
