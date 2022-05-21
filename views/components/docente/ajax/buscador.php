<?php

require_once "../../../../models/conexion.php";
require_once "../../../../controllers/docente.controller.php";
require_once "../../../../models/docente.models.php";

$datos = ControlladorDocente::ctrTablaVisitas($_POST["buscar"])

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
                    <!-- <th class="text-center align-middle">Acciones </th> -->
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
                        <td><?php echo $value["estatus_visita"]; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <form action="views/components/docente/pdfs/cartaPresentacion.php" method="post" target="_blank">
        <input type="hidden" name="folioVisita-pdf" value="<?php echo $_POST["buscar"] ?>">
        <button type="submit" class="btn btn-success ms-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Formato de visitas"><i class="bi bi-file-pdf-fill me-2"></i>Obtener carta de presentacion</button>
    </form>
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