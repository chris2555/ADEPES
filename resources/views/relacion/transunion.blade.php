<!DOCTYPE html>
<html>
<head>
    <title>Autorización TransUnion</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        .container {
            width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
        }
        .info {
            margin-top: 20px;
        }
        .signature {
            margin-top: 50px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid black;
            padding-top: 5px;
            width: 300px;
            margin: 0 auto;
        }
        .signature-name {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>ASOCIACION DE DESARROLLO PESPIRENSE</h2>
            <h2>"ADEPES"</h2>
        </div>
        <div class="info">
            <p>Pespire, Choluteca</p>
            <p>{{ date('m/d/Y') }}</p>
            <p>Yo <strong>{{ $transunionData['nombres_apellidos'] }}</strong>, mayor de edad con # Ident. <strong>{{ $transunionData['n_identidad'] }}</strong>, estado civil <strong>{{ $transunionData['estado_civil'] }}</strong>, con domicilio en <strong>{{ $transunionData['direccion_completa'] }}</strong>, por este medio estoy autorizando a la Asociacion de Desarrollo Pespirense "ADEPES" a que haga las Consultas necesarias en la Central de Riesgo "TRANS UNION" sobre mi situacion Crediticia y la de mis avales en el Sistema Financiero Nacional.</p>
        </div>
        <div class="signature">
            <div class="signature-line"></div>
            <p class="signature-name">{{ $transunionData['nombres_apellidos'] }}</p>
            <p>{{ $transunionData['n_identidad'] }}</p>
        </div>
        <div class="signature">
            <div class="signature-line"></div>
            <p class="signature-name">JOSE ISAIAS LOPEZ OSEGUERA</p>
            <p>0611-1987-00517</p>
        </div>
    </div>
</body>
</html>