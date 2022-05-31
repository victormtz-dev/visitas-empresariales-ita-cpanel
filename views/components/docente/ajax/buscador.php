<?php

require_once "../../../../models/conexion.php";
require_once "../../../../controllers/docente.controller.php";
require_once "../../../../models/docente.models.php";

$datos = ControlladorDocente::ctrTablaVisitas($_POST["buscar"]);
$estatus = '';
?>

<div class="container-fluid px-1 text-center">
    <div class="table-responsive">
        <table class="table align-middle table-bordered border-dark">
            <thead class="text-center align-middle">
                <tr class="text-center align-middle table-responsive-sm">
                    <th class="text-center align-middle">Folio</th>
                    <th class="text-center align-middle">Empresa</th>
                    <th class="text-center align-middle">Ciudad</th>
                    <th class="text-center align-middle">Fecha de inicio de visita</th>
                    <th class="text-center align-middle">Fecha de fin de visita</th>
                    <th class="text-center align-middle">Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $visita => $value) : ?>
                    <tr>
                        <th><?php echo "VE/" . $value["folio_visita"]; ?></th>
                        <td><?php echo $value["nombre_empresa"]; ?></td>
                        <td><?php echo $value["ciudad_empresa"]; ?></td>
                        <td><?php echo formatoFechas($value["fecha_inicio"]); ?></td>
                        <td><?php echo formatoFechas($value["fecha_fin"]); ?></td>
                        <td><?php echo $value["estatus_visita"];
                            $estatus = $value["estatus_visita"]; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <?php if ($estatus == 'ACEPTADA') : ?>

        <div class="alert alert-success  d-flex align-items-center text-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                Favor de pasar al departamento de gestión tecnologica y vinculación, por la carta de presentacion.
            </div>
        </div>

    <?php elseif ($estatus == 'FINALIZADA') : ?>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <div>
                La visita ha finalizado. Recuerde entregar los documentos en el Departamento de gestión tecnológica y vinculación.
            </div>
        </div>

    <?php endif ?>

</div>


<?php

function formatoFechas($fecha)
{

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "ENERO";
            break;
        case '02':
            $mes2 = "FEBRERO";
            break;
        case '03':
            $mes2 = "MARZO";
            break;
        case '04':
            $mes2 = "ABRIL";
            break;
        case '05':
            $mes2 = "MAYO";
            break;
        case '06':
            $mes2 = "JUNIO";
            break;
        case '07':
            $mes2 = "JULIO";
            break;
        case '08':
            $mes2 = "AGOSTO";
            break;
        case '09':
            $mes2 = "SEPTIEMBRE";
            break;
        case '10':
            $mes2 = "OCTUBRE";
            break;
        case '11':
            $mes2 = "NOVIEMBRE";
            break;
        case '12':
            $mes2 = "DICIEMBRE";
            break;
    }

    $fechaFormateada = $dia . "-" . $mes2 . "-" . $anio;


    return $fechaFormateada;
}

?>