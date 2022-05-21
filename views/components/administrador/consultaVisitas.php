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
$datos = ControlladorAdministrador::ctrListasVisitas();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    < <?php
        include "views/components/administrador/navbarAdmin.php"
        ?> </nav>

        <section class="container-fluid mt-5">
            <div class="container">

                <a class="btn btn-primary" href="menuAdmin" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                    Volver al inicio
                </a>
            </div>
            <div class="row">
                <h1 class="text-center">
                    Visitas a empresas registradas
                </h1>
            </div>
            <div class="row mt-5 pt-2">
                <div class="col-12">
                    <div id="datos_buscador">
                        <div class="container-fluid px-1 text-center">
                            <div class="table-responsive">
                                <table class="table align-middle table-bordered border-dark">
                                    <thead class="text-center align-middle">
                                        <tr class="text-center align-middle table-responsive-sm">
                                            <th class="text-center align-middle">Folio</th>
                                            <th class="text-center align-middle">Periodo</th>
                                            <th class="text-center align-middle">Docente encargado</th>
                                            <th class="text-center align-middle">Carrera</th>
                                            <th class="text-center align-middle">Fecha</th>
                                            <th class="text-center align-middle">Tipo de visita</th>
                                            <th class="text-center align-middle">Transporte</th>
                                            <th class="text-center align-middle">Estatus</th>
                                            <th class="text-center align-middle">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datos as $visita => $value) : ?>

                                            <tr>
                                                <th><?php echo "VE/" . $value["folio_visita"]; ?></th>
                                                <td><?php echo $value["periodo"]; ?></td>
                                                <td><?php echo $value["nombre_docente"]; ?></td>
                                                <td><?php echo $value["carrera"]; ?></td>
                                                <td><?php echo "JUNIO" ?></td>
                                                <td><?php echo $value["tipo_visita"]; ?></td>
                                                <td><?php echo $value["transporte"]; ?></td>
                                                <td><?php echo $value["estatus_visita"]; ?></td>
                                                <td>
                                                    <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">
                                                       
                                                            <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar estatus de la visita" onclick="cambiarEstatus(<?php echo 1 ?>, <?php echo $value['folio_visita']; ?>)"><i class="bi bi-pencil-square"></i></button>

                                                    
                                                            <!-- <button class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar estatus de la visita" onclick="cambiarEstatus(<?php echo 0 ?>, <?php echo $value['folio_visita']; ?>)"><i class="bi bi-pencil-square"></i></button> -->

                                                    
                                                        <button class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar formato de visitas"><i class="bi bi-file-earmark-pdf-fill"></i></button>

                                                    </div>
                                                </td>
                                            </tr>

                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <script type="text/javascript">
            function buscar_ahora() {
                let buscar = document.getElementById("visitaBuscar").value;
                var parametros = {
                    "buscar": buscar
                };
                $.ajax({
                    data: parametros,
                    type: 'POST',
                    url: 'views/components/administrador/ajax/buscarVisitas.php',
                    success: function(data) {
                        document.getElementById("datos_buscador").innerHTML = data;
                    }
                });
            }
        </script>