<?php

if (!isset($_SESSION['validarIngresoEstudiante'])) {
    echo '<script> 
                window.location = "inicioEstudiante"
            </script>';
    return;
} else {
    if ($_SESSION['validarIngresoEstudiante'] != "ok") {
        echo '<script> 
                window.location = "inicioEstudiante"
           </script>';
        return;
    }
}

$datos = ControlladorEstudiante::ctrVisitasRegistradas($_SESSION["no_control"]);
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/estudiante/navbarEstudiante.php"
    ?>
</nav>

<section class="container mt-5">
    <a class="btn btn-primary" href="menuEstudiante" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Volver al inicio
    </a>
    <div class="row text-center mt-4">
        <h2>Visitas Empresariales registradas</h2>
    </div>

    <div class="row text-center mt-4 table-responsive">
        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Folio</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Descarga de archivos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $visita => $value) : ?>

                    <tr>
                        <th><?php echo "VE/" . $value["folio_visita"]; ?></th>
                        <td><?php echo $value["periodo"]; ?></td>
                        <td><?php echo $value["nombre_docente"]; ?></td>
                        <td><?php echo $value["asignatura"]; ?></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                <form action="views/components/estudiante/pdfs/formatoVisita.php" method="post" target="_blank">
                                    <input type="hidden" name="folioVisita-pdf" value="<?php echo $value["folio_visita"]; ?>">
                                    <button type="submit" class="btn btn-outline-success ms-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Formato de visitas"><i class="bi bi-download me-2"></i>Descargar formato de visitas</button>
                                </form>

                                <form action="views/components/estudiante/pdfs/permisoTutor.php" method="post" target="_blank">
                                    <input type="hidden" name="noControl-pdf" value="<?php echo $_SESSION["no_control"] ?>">
                                    <input type="hidden" name="folioVisita-pdf" value="<?php echo $value["folio_visita"]; ?>">
                                    <button type="submit" class="btn btn-outline-warning ms-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Permiso del tutor"><i class="bi bi-download me-2"></i>Descargar permiso del tutor</button>
                                </form>
                               
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModalSubirArchivos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subir documentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <table class="table">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Documentos</th>
                                <th class="text-center" scope="col">Estatus</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Permiso del padre o tutor</td>
                                <td class="text-center"><i class="bi bi-check-square-fill"></i></td>
                                <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Cargar archivo" href=""><i class="bi bi-file-earmark-pdf-fill"></i></a></td>
                                <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar archivo" href=""><i class="bi bi-file-earmark-x-fill"></i></a></td>
                                <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo" href=""><i class="bi bi-file-earmark-arrow-down-fill"></i></a></td>
                            </tr>

                            <tr>
                                <td>Carnet del Seguridad Social </td>
                                <td class="text-center"><i class="bi bi-check-square-fill"></i></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-pdf-fill"></i></a></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-x-fill"></i></a></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-arrow-down-fill"></i></a></td>
                            </tr>

                            <tr>
                                <td>Credencial vigente</td>
                                <td class="text-center"><i class="bi bi-check-square-fill"></i></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-pdf-fill"></i></a></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-x-fill"></i></a></td>
                                <td class="text-center"><a href=""><i class="bi bi-file-earmark-arrow-down-fill"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>