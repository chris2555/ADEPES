<!DOCTYPE html>
<html lang="es">
<div class="header">
            <div class="info">

            <table style="width: 90%;">
    <tr>
        <!-- LOGO A LA IZQUIERDA -->
        <td style="width: 100px; text-align: left; vertical-align: top; border: none;">
            <img src="{{ public_path('img/adepeslogo.jpg') }}" width="100" alt="Logo ADEPES">
        </td>

        <!-- INFORMACIÓN A LA PAR, MÁS A LA IZQUIERDA -->
        <td style="text-align: center; vertical-align: top; border: none;">
            <h3 style="margin: 0;">Asociacion de Desarrollo Pespirense</h3>
            <h3 style="margin: 0;">"ADEPES"</h3>
            <p style="margin: 0;">Barrio El Centro Pespire, Choluteca, Honduras. C.A Tel.2776-1100, 2776-1313</p>
            <p style="margin: 0;">Cel. 9565-0338, 9920-2690,  E-mail: <a href="mailto:adepespespire@yahoo.com">adepespespire@yahoo.com</a></p>
        </td>
    </tr>
</table>

<p>
        
<table style="width: 100%; margin-bottom: 10px;">
    <tr>
        <td><h3 style="margin: 0;">RECIBO</h3></td>
        <td style="text-align: right; vertical-align: middle;">
            <span style="
                border: 1px solid black;
                padding: 8px 20px;
                display: inline-block;
                background-color:rgb(139, 228, 144);  /* gris claro como el fondo de la imagen */
                margin-left: 8px;
                font-weight: bold;
                font-size: 16px;
            ">
               POR LPS: L {{ number_format($recibo['abono_capital'], 2) }}
            </span>
        </td>
    </tr>
</table>
<hr>




@php
function numeroALetras($numero) {
    $x = explode('.', number_format($numero, 2, '.', ''));
    $entero = intval($x[0]);
    $decimal = intval($x[1]);

    $formatter = new class {
        public function toWords($n) {
            $unidad = ['','uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve'];
            $decena = ['','diez','veinte','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa'];
            $especiales = [10=>'diez',11=>'once',12=>'doce',13=>'trece',14=>'catorce',15=>'quince',20=>'veinte'];
            $centena = ['','cien','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos'];

            if ($n == 0) return 'cero';
            if ($n < 10) return $unidad[$n];
            if ($n < 16) return $especiales[$n];
            if ($n < 20) return 'dieci' . $unidad[$n - 10];
            if ($n < 30) return $n == 20 ? 'veinte' : 'veinti' . $unidad[$n - 20];
            if ($n < 100) return $decena[intval($n/10)] . ($n%10 == 0 ? '' : ' y ' . $unidad[$n%10]);
            if ($n < 1000) return $centena[intval($n/100)] . ($n%100 == 0 ? '' : ' ' . $this->toWords($n%100));
            if ($n < 2000) return 'mil ' . $this->toWords($n%1000);
            if ($n < 1000000) return $this->toWords(intval($n/1000)) . ' mil' . ($n%1000 != 0 ? ' ' . $this->toWords($n%1000) : '');
            if ($n < 2000000) return 'un millón ' . $this->toWords($n%1000000);
            return $this->toWords(intval($n/1000000)) . ' millones' . ($n%1000000 != 0 ? ' ' . $this->toWords($n%1000000) : '');
        }
    };

    $letras = ucfirst($formatter->toWords($entero));

    if ($decimal > 0) {
        $centavos = $formatter->toWords($decimal);
        return "$letras con $centavos centavos";
    } else {
        return "$letras lempiras exactos";
    }
}
@endphp


<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <tr>
        <td style="border: 1px solid #000; padding: 6px;"><strong>Recibí de:</strong>
            {{ $persona['nombres_apellidos'] ?? 'N/A' }}
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid #000; background-color: #e0e0e0; padding: 6px;">
            <strong>La Cantidad de:</strong>
            {{ numeroALetras($recibo['abono_capital']) }}
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid #000; padding: 6px;">
            <strong>Por Concepto de:</strong>
            Pago correspondiente al mes de {{ \Carbon\Carbon::parse($recibo['fecha'])->translatedFormat('F') }}
        </td>
    </tr>
</table>
<p>

   @php
    $fecha = \Carbon\Carbon::now();
@endphp

<div style="margin-bottom: 20px; white-space: nowrap; font-size: 14px;">
    Recibido por: 
    <span style="border-bottom: 1px solid #000; padding-right: 80px;">{{ $usuarioNombre }}</span> 
    Pespire, Choluteca: 
    <span style="border-bottom: 1px solid #000; padding: 0 20px;">{{ $fecha->format('d') }}</span> de 
    <span style="border-bottom: 1px solid #000; padding: 0 20px;">{{ $fecha->format('m') }}</span> del 
    <span style="border-bottom: 1px solid #000; padding: 0 20px;">{{ $fecha->format('Y') }}</span>
</div>




<div style="margin-bottom: 20px;">
    <p style="margin: 0;">
        Identidad #: 
        <span style="display: inline-block; border: 1px solid #000; padding: 3px 10px;">
            {{ $persona['n_identidad'] ?? 'N/A' }}
        </span>
    </p>
</div>
<p>


<div style="margin-top: 60px; text-align: center;">
    <div style="border-bottom: 1px solid #000; width: 250px; margin: 0 auto;"></div>
    <p style="margin: 5px 0 0 0;">Entregado por: </p>
</div>


<p style="margin: 0;">
    
</p>

      
     

       
</body>
</html>
