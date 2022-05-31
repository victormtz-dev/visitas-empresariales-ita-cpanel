<?php
require_once "../../../../models/conexion.php";
require_once "../../../../controllers/administrador.controller.php";
require_once "../../../../models/administrador.models.php";

ob_start();



$folio = $_POST["folioVisita-pdf"];

$datos_principales = ControlladorAdministrador::ctrVisitasDocente($folio);
$datosEmpresas = ControlladorAdministrador::ctrVisitasEmpresas($folio);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>Formato para visita</title>


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
            margin-left: 75%;
            height: 7em;
            font-size: 12px;
        }

        .cuerpo {

            font-size: 13px;
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
    </style>
</head>
<?php $i = 1; ?>
<?php foreach ($datosEmpresas as $visita => $value) : ?>

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


                <p><strong>Folio: </strong> <?php echo "VE/" . $datos_principales['folio_visita']; ?></p>
                <p><strong>Periodo: </strong><?php echo $datos_principales['periodo']; ?></p>
                <p><strong>Cantidad de alumnos: </strong> <?php echo $datos_principales['cantidad_alumnos']; ?></p>

            </div>


            <div class="cuerpo">

                <table style="width: 100%">
                    <tr>
                        <td>
                            <p>
                                <strong>Docente:</strong> <?php echo $datos_principales['nombre_docente']; ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <strong>Correo: </strong><?php echo $datos_principales['correo_docente']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>RFC del docente: </strong> <?php echo $datos_principales['rfc_docente']; ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <strong>Telefono del docente: </strong><?php echo $datos_principales['telefono_docente']; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <strong>Carrera: </strong><?php echo $datos_principales['carrera']; ?>
                            </p>
                        </td>
                        <td>
                            <p>
                                <strong> Asignatura: </strong> <?php echo $datos_principales['asignatura']; ?>
                            </p>
                        </td>
                    </tr>
                </table>
               

                <h1 style="text-align: center;">Empresa No. <?php echo $i ?></h1>

                <p><strong>Nombre fiscal: </strong><?php echo $value['nombre_empresa_fiscal']; ?><strong style="margin-left: 50px;">Nombre Comercial: </strong><?php echo $value['nombre_empresa']; ?></p>
                <p><strong>Tipo de empresa: </strong><?php echo $value['tipo_empresa']; ?></p>
                <p><strong>Persona a contactar: </strong><?php echo $value['nombre_contacto']; ?></p>
                <p><strong>Puesto: </strong><?php echo $value['cargo_contacto']; ?> <strong style="margin-left: 50px;">Telefono: </strong> <?php echo $value['numero_contacto']; ?></p>
                <p><strong>Objetivo: </strong> <?php echo $value['objetivo_visita']; ?></p>
                <p><strong>Departamento: </strong> <?php echo $value['area_empresa']; ?></p>
                <p><strong>Observaciones: </strong> <?php echo $value['observaciones']; ?></p>
                <p><strong>Fecha de inicio de la visita: </strong> <?php echo formatoFechas($value['fecha_inicio']); ?><strong style="margin-left: 50px;">Fecha de fin de la visita: </strong> <?php echo formatoFechas($value['fecha_fin']); ?> </p>
                <p><strong>Hora de inicio de la visita: </strong> <?php echo $value['hora_inicio']; ?><strong style="margin-left: 50px;">Hora de fin de la visita: </strong><?php echo $value['hora_fin']; ?> </p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>


            <p style="text-align: left; font-size:8px;">c.c.p. Archivo</p>
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
    <?php $i++; ?>
<?php endforeach ?>

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
$dompdf->stream('permiso-tutor-ITA.pdf', ['Attachment' => false]);
?>