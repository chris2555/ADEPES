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
    <div style="margin-top: 10px;">
  <span class="field-label">Nombre:</span> {{ $nombreCompleto }}
</div>

<div style="margin-top: 10px;">
  <span class="field-label">Identidad #:</span>
  @if (!is_null($primerPago))
      {{ $primerPago['id_persona'] }}
  @else
      No disponible
  @endif
</div>

<table>
  <tr>
    <td class="encabezado" style="font-weight: bold;">Abono:</td>
    <td>
        @if (!is_null($primerPago))
            L. {{ number_format($primerPago['monto'], 2) }}
        @else
            No disponible
        @endif
    </td>
  </tr>
</table>

</body>
</html>
