<?php
require_once "../../../../models/conexion.php";
require_once "../../../../controllers/docente.controller.php";
require_once "../../../../models/docente.models.php";
require_once "../../../../controllers/administrador.controller.php";
require_once "../../../../models/administrador.models.php";

ob_start();

$folio = $_POST["folioVisita-pdf"];

$datos_principales = ControlladorDocente::ctrDatosCartaPresentacion1($folio);
$count_masculino = ControlladorAdministrador::ctrCountAlumnos($folio, 'MASCULINO');
$count_femenino = ControlladorAdministrador::ctrCountAlumnos($folio, 'FEMENINO');
$count_total = ControlladorAdministrador::ctrCountAlumnos($folio, 'TOTAL');
$alumnos = ControlladorAdministrador::ctrListaAlumnos($folio);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <title>Lista de alumnos</title>
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

        .parrafos {
            text-align: justify;
            font-size: 13px;
        }

        .titulo {
            text-align: center;
        }

        .tb2 {
            font-size: 12px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .pd {
            padding-left: 5px;
        }

        .footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
    </style>

</head>
<body>
    <div class="contenedor">
        <div class="header-fijo">
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
            <div style="text-align: center; font-size: 16px">
                <p><strong>LISTA DE ALUMNOS.</strong></p>
            </div>
        </div>
        <div class="cuerpo">
            <p> <strong>Docente encargado de la visita: </strong> <?php echo $datos_principales["nombre_docente"] ?></p>
            <p> <strong>Total de mujeres registradas en la visita: </strong> <?php echo $count_masculino["numero"] . " mujeres" ?></p>
            <p> <strong>Total de hombres registrados en la visita: </strong> <?php echo $count_femenino["numero"] . " hombres" ?></p>
            <p> <strong>Total de alumnos registrados en la visita: </strong> <?php echo $count_total["numero"] . " alumnos" ?></p>
            <br>
            <table class="tb2" border="2">
                <tr>
                    <td class="titulo">
                        <strong>No.</strong>
                    </td>
                    <td class="titulo">
                        <strong>Número de control</strong>
                    </td>
                    <td class="titulo">
                        <strong>Nombre (s)</strong>
                    </td>
                    <td class="titulo">
                        <strong>Apellidos</strong>
                    </td>
                    <td class="titulo">
                        <strong>Carrera</strong>
                    </td>
                    <td class="titulo">
                        <strong>NSS</strong>
                    </td>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($alumnos as $alumno => $value) : ?>
                    <tr>
                        <td class="titulo">
                            <strong> <?php echo $i ?> </strong>
                        </td>
                        <td class="pd">
                            <p>
                                <?php echo $value["no_control"] ?> </p>
                        </td>
                        <td class="pd">
                            <p>
                                <?php echo $value["nombres"] ?> </p>
                        </td>
                        <td class="pd">
                            <p>
                                <?php echo $value["apellidos"] ?> </p>
                        </td>
                        <td class="pd">
                            <p>
                                <?php echo $value["carrera"] ?> </p>
                        </td>
                        <td class="pd">
                            <p>
                                <?php echo $value["nss"] ?> </p>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach ?>
            </table>
        </div>
    </div>
    <table class="tb-footer footer">
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