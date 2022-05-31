<?php
require_once "../../../../models/conexion.php";
require_once "../../../../controllers/docente.controller.php";
require_once "../../../../models/docente.models.php";

ob_start();

$folio = $_POST["folioVisita-pdf"];
$detalles = $_POST["detalles"];

$datos_principales = ControlladorDocente::ctrDatosCartaPresentacion1($folio);
$datosEmpresas = ControlladorDocente::ctrDatosCartaPresentacion2($detalles);


$hoy = getdate();

$dia = $hoy["mday"];
$mes = formatoFechaHoy($hoy["mon"]);
$anio = $hoy["year"];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>Carta de presentación</title>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .contenedor {

            margin: 0 45px 0 45px;
            display: block;
        }

        .encabezado {

            display: block;
            margin-left: 59%;
            height: 7em;
            font-size: 12px;
        }

        .cuerpo {

            font-size: 14px;
        }


        .tb-footer {
            width: 100%;
            font-size: 10px;
            text-align: center;
        }

        .img-sep {
            width: 290px;
        }

        .img-logo {
            width: 120px;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
        }

        .move-derecha {
            display: block;
            margin-left: 57px;
        }

        .tec {
            display: block;
            margin-left: 50%;
            height: 3em;
            font-size: 11px;
            text-align: right;
        }

        .frase {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 10px;
        }

        .img-footer {
            width: 30px;
        }
        
        .parrafos{
            text-align: justify;
            font-size: 13px;
        }
    </style>
</head>


    <body>


        <div class="contenedor">
            <table class="header">
                <tr>
                    <td><img class="img-sep" src="img/sep.jpeg" alt=""></td>
                    <td><img class="img-logo move-derecha" src="img/tecnm.png" alt=""></td>
                </tr>
            </table>

            <div class="tec">
                <p><span style="font-size: 13px;">Instituto Tecnológico de Acapulco </span><br>Departamento de Gestión Tecnológica y Vinculación</p>
            </div>

            <table class="frase">
                <tr>
                    <td>"2020, Año de Leona Vicario, Benemérita Madre de la Patria"</td>
                </tr>
            </table>

            <br>

            <div class="encabezado">
                <p>Acapulco, Gro. <?php echo $dia . " de " . $mes . " de " . $anio ?></p>
                <p>OFICIO No. <?php echo "GTV-0" . $datos_principales['folio_visita'] . "/" . $anio; ?></p>
                <p><strong>ASUNTO: SOLICITUD DE VISITA.</strong></p>
            </div>

            <div class="cuerpo">
                <p style="margin-bottom: -10px;"><strong><?php echo $datosEmpresas['nombre_contacto']; ?></strong></p>
                <p style="margin-bottom: -10px;"><strong><?php echo $datosEmpresas['nombre_empresa']; ?></strong></p>
                <p><strong><?php echo $datosEmpresas['estado_empresa'] . "," . $datosEmpresas['ciudad_empresa']; ?></strong></p>
                <p><strong>P R E S E N T E.</strong></p>
                <div class="parrafos">
                <p>Que el presente sirva para saludarle y con la finalidad de reforzar
                    los conocimientos adquiridos en el aula, solicitarle sea autorizada una visita a las
                    instalaciones de la empresa que usted atinadamente dirige, a un grupo de <?php echo $datos_principales['cantidad_alumnos'] - $datos_principales['lugares_disponibles']; ?> estudiantes de
                    la carrera de <b><?php echo $datos_principales['carrera']; ?></b> de este Instituto,
                    quienes acudirán bajo la responsabilidad de C. <b><?php echo $datos_principales['nombre_docente']; ?></b></p>
                <p>
                    El área a observar y objetivo de la visita es:
                    <b><u><?php echo $datosEmpresas['objetivo_visita']; ?></u></b>
                </p>
                <p>

                    De ser aceptada la visita, desearía que se programara para el día: <b><?php echo formatoFechas($datosEmpresas['fecha_inicio']); ?></b> en el turno
                    <?php echo $datosEmpresas['turno_empresa']; ?>. Para cualquier aclaración puede comunicarse con ING. RODOLFO MENA ROJAS, a la extensión 120 de este instituto.
                </p>
                <p>
                    Deseo hacerle saber que nuestra Institución se ha comprometido con los esquemas integrales de SGC-SGA (normas ISO 9001:2015 y 14001:2015), en donde, entre otros, la protección al medio ambiente es un punto medular; por lo tanto, solicito nos comunique requisitos de seguridad,presentación u otros aspectos, que deberán cubrir los participantes en la visita.
                </p>
                <p>
                Agradezco la atención que tenga a bien brindar a la presente y me despido
                </p>
                </div>

                <p style="text-align: left; margin-bottom: -7px;" ><b>A T E N T A M E N T E</b></p>
                <p style="text-align: left; font-size:8px;"><i>"Educación Tecnológica con Compromiso Social®"</i></p>
                <br>
                <p style="text-align: left; margin-bottom: -14px; font-size:13px;"><b>RODOLFO MENA ROJAS.</b></p>
                <p style="text-align: left; font-size:13px;" ><b>JEFE DEL DEPARTAMENTO DE GESTIÓN TECNOLOGICA Y VINCULACIÓN.</b></p>
            </div>
            

            <p style="text-align: left; font-size:8px; margin-bottom: -8px;">c.c.p. Depto. de Gestión Tecnológica y Vinculación.</p>
            <p style="text-align: left; font-size:8px;">c.c.p. Estudiante</p>
        </div>


        <table class="tb-footer">
            <tr>
                <td>
                    <img class="img-footer" src="img/logo1-f.png" alt="">
                </td>
                <td>
                    <img class="img-footer" src="img/logo2-f.png" alt="">
                </td>
                <td>
                    <img class="img-footer" src="img/logo3-f.png" alt="">
                </td>
                <td>
                    <p>Av. Instituto Tecnológico s/n Crucero del Cayaco C.P. 39905 <br>
                        E-mail de contacto: vin_acapulco.tecnm@tecnm.mx <br>
                        Teléfonos: (744) 4429010 al 19 ext. 120 y 142 <br>
                        <b><u>www.it-acapulco.edu.mx</u></b>
                    </p>
                </td>
                <td>
                    <img class="img-footer" src="img/logo4-f.jpg" alt="">
                </td>
                <td>
                    <img class="img-footer" src="img/logo5-f.png" alt="">
                </td>
                <td>
                    <img class="img-footer" src="img/logo6-f.png" alt="">
                </td>
            </tr>
        </table>
    </body>

</html>


<?php
function formatoFechas($fecha)
{

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "ENE";
            break;
        case '02':
            $mes2 = "FEB";
            break;
        case '03':
            $mes2 = "MAR";
            break;
        case '04':
            $mes2 = "ABR";
            break;
        case '05':
            $mes2 = "MAY";
            break;
        case '06':
            $mes2 = "JUN";
            break;
        case '07':
            $mes2 = "JUL";
            break;
        case '08':
            $mes2 = "AGO";
            break;
        case '09':
            $mes2 = "SEP";
            break;
        case '10':
            $mes2 = "OCT";
            break;
        case '11':
            $mes2 = "NOV";
            break;
        case '12':
            $mes2 = "DIC";
            break;
    }

    $fechaFormateada = $dia . "/" . $mes2 . "/" . $anio;


    return $fechaFormateada;
}

function formatoFechaHoy($mes)
{

    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "enero";
            break;
        case '02':
            $mes2 = "febrero";
            break;
        case '03':
            $mes2 = "marzo";
            break;
        case '04':
            $mes2 = "abril";
            break;
        case '05':
            $mes2 = "mayo";
            break;
        case '06':
            $mes2 = "junio";
            break;
        case '07':
            $mes2 = "julio";
            break;
        case '08':
            $mes2 = "agosto";
            break;
        case '09':
            $mes2 = "septiembre";
            break;
        case '10':
            $mes2 = "octubre";
            break;
        case '11':
            $mes2 = "noviembre";
            break;
        case '12':
            $mes2 = "diciembre";
            break;
    }


    return $mes2;
}

require_once "../../../libs/libreria/dompdf/autoload.inc.php";

use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');
$dompdf->setPaper("letter");

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('carta-presentacion-ITA.pdf', ['Attachment' => false]);
?>