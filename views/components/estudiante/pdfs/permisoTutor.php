<?php
require_once "../../../../models/conexion.php";
require_once "../../../../controllers/estudiante.controller.php";
require_once "../../../../models/estudiante.models.php";

ob_start();


$noControl = $_POST["noControl-pdf"];
$folio = $_POST["folioVisita-pdf"];

$datos_principales = ControlladorEstudiante::ctrDatosPDF1($noControl, $folio);
$datosEmpresa = ControlladorEstudiante::ctrListasEmpresas($folio);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>Permiso del padre o tutor</title>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }


        .texto {
            font-size: 12px;
            padding-left: 5px;
        }

        .tb {
            border: 1px solid;
            border-collapse: collapse;
        }

        .tb-td {
            border: 1px solid;
            border-collapse: collapse;
        }

        .contenedor {

            margin: 0 60px 0 60px;
            display: block;
        }

        .encabezado {

            display: block;
            margin-left: 55%;
            height: 7em;
            font-size: 12px;
        }

        .cuerpo {

            font-size: 11px;
        }

        .tb2 {
            width: 100%;
            border-collapse: collapse;
        }

        .titulo {
            text-align: center;
        }

        .encargado {
            font-size: 10px;
        }

        .tb3 {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tb-footer {
            width: 100%;
            /* border-collapse: collapse;
            font-size: 10px; */
            font-size: 10px;
            text-align: center;
        }

        .derecha {
            text-align: right;
        }

        .tb4 {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            /* font-size: 8px; */
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
            /* margin-left: 50%; */
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
            <p>DEPARTAMENTO: GESTIÓN TEC. Y VINC.</p>
            <p>NO. DE OFICIO : <?php echo "GTYV-" . $folio . "/2022" ?></p>
            <p><strong>ASUNTO: Permiso de Salida de Viaje.</strong></p>
        </div>

        <div class="cuerpo">
            <p><strong>C. PADRE DE FAMILIA O TUTOR</strong></p>
            <p><strong>PRESENTE.</strong></p>
            <p>Por este conducto se le solicita su autorización para que su hijo(a) realice una visita de prácticas con las siguientes
                características:</p>

            <p><strong>DOCENTE RESPONSABLE DE LA VISITA:</strong> <?php echo $datos_principales['nombre_docente']; ?></p>
            <p><strong>ASIGNATURA:</strong> <?php echo $datos_principales['asignatura']; ?></p>
            <p><strong>CARRERA:</strong> <?php echo $datos_principales['carrera']; ?></p>

            <table class="tb4">
                <tr>
                    <td>
                        <p><strong>LUGARES A VISITAR</strong></p>
                    </td>
                    <td>
                        <p><strong>FECHA DE INICIO DE LA VISITA</strong></p>
                    </td>
                    <td>
                        <p><strong>FECHA DE TERMINACIÓN DE LA VISITA</strong></p>
                    </td>
                </tr>

                <?php foreach ($datosEmpresa as $dato) :   ?>
                    <tr>

                        <td><?php echo $dato["nombre_empresa"]; ?></td>
                        <td><?php echo formatoFechas($dato['fecha_inicio']) ?></td>
                        <td><?php echo formatoFechas($dato['fecha_fin']) ?></td>

                    </tr>
                <?php endforeach ?>
            </table>

            <p>El objetivo de la visita es complementar los conocimientos teóricos obtenidos en el aula, lo cual redundara en beneficio
                para su desarrollo profesional.</p>
            <p>Así mismo, le solicitamos atentamente haga las recomendaciones pertinentes a su hijo (a) en lo que refiere al cuidado de
                su persona. Favor de anexar copia de credencial de estudiante, copia del INE/IFE del padre o tutor que firma el permiso y
                copia del carnet de citas médicas, <b>sin estos documentos el estudiante no podrá viajar.</b>
            </p>
            <p>Quedo a sus órdenes para cualquier comentario al respecto y me despido deseándole éxito en sus actividades.</p> <br>

            <div>
                <table class="tb2">
                    <tr>
                        <td class="titulo">
                            <strong>ATENTAMENTE</strong>
                        </td>
                        <td class="titulo">
                            Autorización de la visita
                        </td>
                        <td class="titulo">
                            Alumno
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            _______________________________
                        </td>
                        <td>
                            <br>
                            _______________________________
                        </td>
                        <td>
                            <br>
                            _______________________________
                        </td>
                    </tr>
                    <tr>
                        <td class="encargado"><b>ING. RODOLFO MENA ROJAS<br>
                                JEFE DEL DEPARTAMENTO DE GESTIÓN TECNOLÓGICA
                                Y VINCULACIÓN.</b></td>
                        <td></td>
                        <td class="titulo"><?php echo $datos_principales['nombres'] . " " . $datos_principales['apellidos']; ?> <BR><?php echo $datos_principales['no_control']; ?></td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <div>
                <p><strong>ANOTAR SU NUMERO TELEFONICO: ___________________</strong></p>
                <p>c.c.p. Archivo</p>
            </div>
        </div>
    </div>

    <br>
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

    <div class="contenedor">
        <table class="tb3">
            <tr>
                <td>
                    <p><strong>ITA-VI-PO-001-07</strong></p>
                </td>
                <td class="derecha">
                    <p><strong>Rev. 0</strong></p>
                </td>
            </tr>
        </table>
    </div>
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
$dompdf->stream('permiso-tutor-ITA.pdf', ['Attachment' => false]);
?>