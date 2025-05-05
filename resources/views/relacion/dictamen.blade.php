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
        .info-linea {
        display: flex;
        justify-content: center;
        gap: 50px;
        margin-bottom: 20px;
    }
    .info-linea div {
        white-space: nowrap;
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
        .box-verde h2,
.box-verde h3 {
    margin: 0;
    padding: 2px;
    font-size: 18px; /* Puedes reducir más si lo deseas */
    line-height: 1.2;
}

.box-verde {
    border: 1px solid #90ee90;
    background-color:rgb(148, 236, 148);
    padding: 3px; /* antes 5px */
    border-radius: 1px;
    text-align: center;
    margin-bottom: 5px;
}

.single-line-info {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 40px;
        margin-bottom: 20px;
        flex-wrap: nowrap;
    }

    .single-line-info div {
        white-space: nowrap;
    }

    </style>
</head>
<body>
<div class="header">
            <div class="info">

            
   
            
            <div class="box-verde">
    <h2>ASOCIACIÓN DE DESARROLLO PESPIRENSE</h2>
    <h3>"ADEPES"</h3>
</div>

            
        </div>
        <table width="100%" style="margin-bottom: 20px; border: none; border-collapse: collapse;">


        <tr>
    <td style="text-align: left; vertical-align: top; border: none;">
    </td>
        <td style="text-align: center; vertical-align: top; border: none;">
        <img src="{{ public_path('img/adepeslogo.jpg') }}" width="150" alt="Logo ADEPES">
        </td>
    </tr>
</table>
<div class="title"><h4><u>DICTAMEN DEL ASESOR</u></h4></div>
<p>

<p>
    <strong>Monto:</strong> {{ $dictamen['monto'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong>Plazo:</strong> {{ $dictamen['plazo'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <strong>Destino:</strong> {{ $dictamen['invierte_en'] }}
</p>



        <div class="analysis">
        <div class="box-verde">
    <h3>DATOS PARA ANALISIS</h3>
</div>
            <p>
                SOLICITANTE: <strong>{{ $dictamen['nombre_solicitante'] }}</strong> obtiene sus ingresos por: <strong>{{ $informacionlaboral['profesion_oficio'] ?? 'N/A' }}</strong> actualmente se decida como: <strong>{{ $informacionlaboral['actividad'] ?? 'N/A' }}</strong> 
                de <strong>{{ $informacionlaboral['patrono_negocio'] ?? 'N/A' }}</strong>,  el tipo de credito es <strong>{{ $dictamen['tipo_credito'] }}</strong> segun transunion (no tiene credito)
                el monto solicitado es de: <strong>{{ $dictamen['monto'] }}</strong> la finalidad del credito es para compre de:(--------). 
                La inversión se realizara en el sector de <strong>{{ $dictamen['invierte_en'] }}</strong>, ya que el solicitante trabaja como
                <strong>{{ $dictamen['actividad'] }}</strong> en <strong>{{ $dictamen['direccion_trabajo_solicitante'] }}</strong>.
                es su segundo credito en el fondo rotatorio (---------------)
            </p>
            <p>
                POR LO TANTO YO ________________________________ SUGIERO LA APROBACION DEL MONTO ANTES
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