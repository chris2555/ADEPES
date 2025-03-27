<!DOCTYPE html>
<html>
<head>
    <title>Dictamen de Solicitud</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info div {
            flex: 1;
            margin-right: 10px;
        }
        .info div:last-child {
            margin-right: 0;
        }
        .analysis {
            margin-bottom: 20px;
        }
        .footer {
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="URL_DE_TU_IMAGEN_LOGO" alt="Logo ADEPES">
            <h2>ASOCIACIÓN DE DESARROLLO PESPIRENSE</h2>
            <h3>"ADEPES"</h3>
        </div>
        <div class="title">DICTAMEN DEL ASESOR</div>
        <div class="info">
            <div>
                <strong>Monto:</strong> {{ $dictamen['monto'] }}
            </div>
            <div>
                <strong>Plazo:</strong> {{ $dictamen['plazo'] }}
            </div>
        </div>
        <div class="info">
            <div>
                <strong>Nombres y Apellidos:</strong> {{ $dictamen['nombre_solicitante'] }}
            </div>
        </div>
        <div class="analysis">
            <strong>ANALISIS</strong>
            <p>
                CONSIDERANDO la informacion proporcionada, el analisis segun la informacion crediticia de
                la Prestataria <strong>{{ $dictamen['nombre_solicitante'] }}</strong> y la informacion de la garantia <strong>{{ $dictamen['tipo_garantia'] }}</strong>
                que presenta ante esta institucion este cliente tiene capacidad de pago para un monto de LPS.
                <strong>{{ $dictamen['monto'] }}</strong> y una forma de pago en cuotas NIVELADA. La inversión se realizara para
                fortalecer su negocio ya en marcha que consiste en la venta de ropa, calzado y otros
                accesorios, ubicado en la calle del comercio del Municipio de Pespire, en cuanto al aval el
                señor <strong>{{ $dictamen['nombre_aval1'] }}</strong> es miembro de la Comunidad de Palo Grande actualmente trabaja
                como jornalero en la propiedad del señor Carlos Galdames.
            </p>
            <p>
                La inversión se realizara en el sector de <strong>{{ $dictamen['invierte_en'] }}</strong>, ya que el solicitante trabaja como
                <strong>{{ $dictamen['actividad'] }}</strong> en <strong>{{ $dictamen['direccion_trabajo_solicitante'] }}</strong>.
            </p>
            <p>
                Los avales son: <strong>{{ $dictamen['nombre_aval1'] }}</strong>, quien trabaja en <strong>{{ $dictamen['direccion_trabajo_aval1'] }}</strong>;
                <strong>{{ $dictamen['nombre_aval2'] }}</strong>, quien trabaja en <strong>{{ $dictamen['direccion_trabajo_aval2'] }}</strong>;
                y <strong>{{ $dictamen['nombre_aval3'] }}</strong>, quien trabaja en <strong>{{ $dictamen['direccion_trabajo_aval3'] }}</strong>.
            </p>
            <p>
                POR LO TANTO YO JOSÉ LUIS MEJÍA SUGIERO LA APROBACION DEL MONTO ANTES
                EXBLUESTO
            </p>
        </div>
        <div class="footer">
            <strong>ASESOR DE CREDITO</strong>
            <p>____________________________</p>
        </div>
    </div>
</body>
</html>