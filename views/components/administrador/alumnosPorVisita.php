<?php

if (!isset($_SESSION['validarIngresoAdmin'])) {
    echo '<script> 
                window.location = "inicioAdministrador"
            </script>';
    return;
} else {
    if ($_SESSION['validarIngresoAdmin'] != "ok") {
        echo '<script> 
                window.location = "inicioAdministrador"
           </script>';
        return;
    }
}

$datos = ControlladorAdministrador::ctrAlumnosPorVisita($_POST["folioVisita"])
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php include "views/components/administrador/navbarAdmin.php" ?>
</nav>

<section class="container-fluid mt-5">
    <div class="container">
        <a class="btn btn-primary" href="consultaVisitas" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
            </svg>
            Regresar
        </a>
        <div class="row">
            <div class="p-3 mb-1 mt-2 border rounded-3" style="background-color: #e8ebf0;">
                <h2 class="text-center">
                    Alumnos registrados en la visita: <?php echo "VE/" . $_POST["folioVisita"] ?>
                </h2>
            </div>
            <div class="p-1 text-end">
                <form action="views/components/administrador/pdfs/listaAlumnos.php" method="post" target="_blank">
                    <input type="hidden" name="folioVisita-pdf" value="<?php echo $_POST["folioVisita"]; ?>">
                    <button type="submit" class="btn btn-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="Lista de alumnos"><i class="bi bi-file-earmark-pdf-fill"></i> Descargar lista de alumnos</button>
                </form>
            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="container-fluid px-1 text-center">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="text-center align-middle table-dark">
                            <tr class="text-center align-middle table-responsive-sm">
                                <th class="text-center align-middle">#</th>
                                <th class="text-center align-middle">No. Control</th>
                                <th class="text-center align-middle">Nombre(s)</th>
                                <th class="text-center align-middle">Apellidos</th>
                                <th class="text-center align-middle">Género</th>
                                <!-- <th class="text-center align-middle">Carrera</th> -->    
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($datos as $visita => $value) : ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $value["no_control"]; ?></td>
                                    <td><?php echo $value["nombres"]; ?></td>
                                    <td><?php echo $value["apellidos"]; ?></td>
                                    <td><?php echo $value["sexo"]; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
function formatoFechas4($fecha)
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

?>