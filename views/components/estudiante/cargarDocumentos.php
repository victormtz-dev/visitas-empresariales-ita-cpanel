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

$datos = ControlladorEstudiante::ctrVisitasRegistradasDocumentos($_SESSION["no_control"], $_POST["folioDocumentos"]);


?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/estudiante/navbarEstudiante.php"
    ?>
</nav>

<section class="container mt-5">
    <a class="btn btn-primary" href="visitasRegistradasEstudiante" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Volver a lista de visitas
    </a>
    <div class="row text-center mt-4">
        <h2>Subir documentos de la visita</h2>
    </div>

    <?php
    $respuesta = ControlladorEstudiante::ctrRegistrarDocumentos();
    echo $respuesta;
    ?>
</section>

<div class="container">
    <div class="row text-center mt-4 table-responsive">
        <table class="table">
            <thead class="table-secondary">
                <tr>
                    <th>Documentos</th>
                    <th class="text-center">Estatus</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="align-middle">Permiso del padre o tutor</td>

                    <?php if ($datos['pdf_permiso_padre'] == 'NO DOCUMENTO') : ?>

                        <td class="text-center"><i class="bi bi-x-square-fill" style="font-size: 2rem;"></i></td>

                        <td>
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" 
                            data-bs-placement="top" title="Subir archivo" 
                            data-bs-toggle="modal" data-bs-target="#exampleModalDocumentos" data-bs-whatever="<?php echo 'Permiso del padre o tutor' . "/" .  $datos['pdf_permiso_padre'] . "/" . $_SESSION["no_control"] . "/" . $_POST["folioDocumentos"] ?>"><i class="bi bi-file-earmark-pdf-fill" style="font-size: 2rem; padding:0px;"></i>
                            </button>
                        </td>

                        <td></td>
                        <td></td>

                    <?php else : ?>

                        <td class="text-center"><i class="bi bi-check-square-fill" style="font-size: 2rem;"></i></td>
                        <td></td>
                        <td class="text-center">
                            <input type="hidden" name="" id="tipoDocumentoEliminar" value="Permiso del padre o tutor">
                            <input type="hidden" name="" id="documentoEliminar" value="<?php echo $datos['pdf_permiso_padre'] ?>">
                            <input type="hidden" name="" id="folioDocumentoEliminar" value="<?php echo $_POST["folioDocumentos"] ?>">
                            <input type="hidden" name="" id="controlDocumentoEliminar" value="<?php echo $_SESSION["no_control"] ?>">
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar archivo" onclick="eliminar_archivo()">
                                <i class="bi bi-file-earmark-x-fill" style="font-size: 2rem;"></i>
                            </button>
                        </td>

                        <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo" href="<?php echo $datos['pdf_permiso_padre'] ?>" download="<?php echo "ITA_PERMISO_TUTOR_PADRE_".$_SESSION["no_control"] ?>"><i class="bi bi-file-earmark-arrow-down-fill" style="font-size: 2rem;"></i></a></td>

                    <?php endif ?>
                </tr>

                <tr>
                    <td class="align-middle">Carnet del Seguridad Social</td>

                    <?php if ($datos['pdf_nss'] == 'NO DOCUMENTO') : ?>

                        <td class="text-center"><i class="bi bi-x-square-fill" style="font-size: 2rem;"></i></td>
                        <td>
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" data-bs-toggle="modal" data-bs-target="#exampleModalDocumentos" data-bs-whatever="<?php echo 'NSS' . "/" .  $datos['pdf_nss'] . "/" . $_SESSION["no_control"] . "/" . $_POST["folioDocumentos"] ?>"><i class="bi bi-file-earmark-pdf-fill" style="font-size: 2rem; padding:0px;"></i>
                            </button>
                        </td>
                        <td></td>
                        <td></td>

                    <?php else : ?>

                        <td class="text-center"><i class="bi bi-check-square-fill" style="font-size: 2rem;"></i></td>
                        <td></td>

                               <td class="text-center">
                            <input type="hidden" name="" id="tipoDocumentoEliminar" value="NSS">
                            <input type="hidden" name="" id="documentoEliminar" value="<?php echo $datos['pdf_nss'] ?>">
                            <input type="hidden" name="" id="folioDocumentoEliminar" value="<?php echo $_POST["folioDocumentos"] ?>">
                            <input type="hidden" name="" id="controlDocumentoEliminar" value="<?php echo $_SESSION["no_control"] ?>">
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar archivo" onclick="eliminar_archivo()">
                                <i class="bi bi-file-earmark-x-fill" style="font-size: 2rem;"></i>
                            </button>
                        </td>

                        <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo"href="<?php echo $datos['pdf_permiso_padre'] ?>" download="<?php echo "ITA_NSS_".$_SESSION["no_control"] ?>"><i class="bi bi-file-earmark-arrow-down-fill" style="font-size: 2rem;"></i></a></td>

                    <?php endif ?>
                </tr>

                <tr>
                    <td class="align-middle">Credencial vigente</td>

                    <?php if ($datos['pdf_credencial'] == 'NO DOCUMENTO') : ?>

                        <td class="text-center"><i class="bi bi-x-square-fill" style="font-size: 2rem;"></i></td>
                        <td>
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" data-bs-toggle="modal" data-bs-target="#exampleModalDocumentos" data-bs-whatever="<?php echo 'Credencial' . "/" .  $datos['pdf_credencial'] . "/" . $_SESSION["no_control"] . "/" . $_POST["folioDocumentos"] ?>"><i class="bi bi-file-earmark-pdf-fill" style="font-size: 2rem; padding:0px;"></i>
                            </button>
                        </td>
                        <td></td>
                        <td></td>

                    <?php else : ?>

                        <td class="text-center"><i class="bi bi-check-square-fill" style="font-size: 2rem;"></i></td>
                        <td></td>

                        <td class="text-center">
                            <input type="hidden" name="" id="tipoDocumentoEliminar" value="Credencial">
                            <input type="hidden" name="" id="documentoEliminar" value="<?php echo $datos['pdf_credencial'] ?>">
                            <input type="hidden" name="" id="folioDocumentoEliminar" value="<?php echo $_POST["folioDocumentos"] ?>">
                            <input type="hidden" name="" id="controlDocumentoEliminar" value="<?php echo $_SESSION["no_control"] ?>">
                            <button class="btn btn-outline-primary" style="border:none; padding:0px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar archivo" onclick="eliminar_archivo()">
                                <i class="bi bi-file-earmark-x-fill" style="font-size: 2rem;"></i>
                            </button>
                        </td>



                        <td class="text-center"><a data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar archivo" href="<?php echo $datos['pdf_permiso_padre'] ?>" download="<?php echo "ITA_CREDENCIAL_".$_SESSION["no_control"] ?>"><i class="bi bi-file-earmark-arrow-down-fill" style="font-size: 2rem;"></i></a></td>

                    <?php endif ?>
                </tr>

            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalDocumentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-5 py-5">
                    <form class="row g-3" action="" method="POST" enctype="multipart/form-data" accept=".pdf">
                        <div class="col-md-12">
                            <label id="labelText" for="formFile" class="form-label text-center"></label>
                            <input class="form-control" type="file" id="formFile" name="pdfFile">
                        </div>
                        <input type="hidden" name="folio-doc" id="folio-doc" value="">
                        <input type="hidden" name="nocontrol-doc" id="nocontrol-doc" value="">
                        <input type="hidden" name="tipo-doc" id="tipo-doc" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar y regresar</button>
                            <input type="submit" class="btn btn-success" name="registrarDocumentos" value="Subir documento">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    let exampleModal = document.getElementById('exampleModalDocumentos')
    exampleModal.addEventListener('show.bs.modal', function(event) {

        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')
        let modalBodyInput = exampleModal.querySelector('.modal-body input')

        let titulo = `${recipient.split("/")[0]}`
        let pdf = `${recipient.split("/")[1]}`
        let noControl = `${recipient.split("/")[2]}`
        let folio = `${recipient.split("/")[3]}`

        let tipodoc = document.getElementById('tipo-doc');
        let foliodoc = document.getElementById('folio-doc');
        let nocontroldoc = document.getElementById('nocontrol-doc');
        let nombreTitulo = document.getElementById('labelText');


        modalTitle.textContent = 'Subir documento: ' + titulo
        nombreTitulo.textContent = 'Seleccione el formato del ' + titulo


        tipodoc.value = titulo;
        foliodoc.value = folio;
        nocontroldoc.value = noControl;

    })

    function eliminar_archivo() {
        let url = document.getElementById("documentoEliminar").value;
        let folio = document.getElementById("folioDocumentoEliminar").value;
        let tipo = document.getElementById("tipoDocumentoEliminar").value;
        let control = document.getElementById("controlDocumentoEliminar").value;
        let parametros = {
            "url": url,
            "folio": folio,
            "tipo": tipo,
            "control": control,
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'views/components/estudiante/ajax/eliminarDocumentos.php',
            success: function(data) {
                //console.log(data)

                if (data == 'ok') {
                    window.location = "visitasRegistradasEstudiante"
                }
                //document.getElementById("datos_buscador").innerHTML = data;
            }
        });
    }
</script>