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
    <?php include "views/components/administrador/navbarAdmin.php" ?>
</nav>

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
                                        <td><?php echo formatoFechas($value["fecha_inicio"]); ?></td>
                                        <td><?php echo $value["tipo_visita"]; ?></td>
                                        <td><?php echo $value["transporte"]; ?></td>
                                        <td><?php echo $value["estatus_visita"]; ?></td>
                                        <td>
                                            <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">

                                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModalAdminVisitas" data-bs-whatever="<?php echo $value['folio_visita']; ?>"><i class="bi bi-pencil-square"></i></button>

                                                <form action="views/components/administrador/pdfs/formatoVisitasEmp.php" method="post" target="_blank">
                                                    <input type="hidden" name="folioVisita-pdf" value="<?php echo $value["folio_visita"]; ?>">
                                                    <button type="submit" class="btn btn-outline-danger " data-bs-toggle="tooltip" data-bs-placement="top" title="Formato de visitas General"><i class="bi bi-file-earmark-pdf-fill"></i></button>
                                                </form>
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

<!-- Modal -->

<div class="modal fade" id="exampleModalAdminVisitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="texto"></p>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <label for="inputEstatus" class="form-label">Estatus</label>
                            <select id="inputEstatus" class="form-select" name="estatusEdit" required>
                                <option disabled hidden selected value="">Seleccione una opcion</option>
                                <option value="ACEPTADA">ACEPTADA</option>
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="EN CURSO">EN CURSO</option>
                                <option value="RECHAZADA">RECHAZADA</option>
                                <option value="FINALIZADA">FINALIZADA</option>
                            </select>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
            
                <input type="hidden" id="idVisita" name="folio">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" name="editarEstatusVisita" value="Guardar cambios">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
        $formularioVisitas = ControlladorAdministrador::ctrEstatusVisita();

        

        switch ($formularioVisitas) {

            case "exito":
                echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                 </script>';
                echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'success',
                                     title: 'El estatus de la visita se cambio satisfactoriamente.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   });

                                   setTimeout(function(){
                                    window.location.reload();
                                }, 1700);

                                   </script>
                                 ";
                break;

            case "error":
                echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                 </script>';
                echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'error',
                                     title: 'Ha ocurrido un error.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) </script>
                                 ";
                break;

            case "1":
                echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                 </script>';
                echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'error',
                                     title: 'Favor de rellenar todos los campos.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) </script>
                                 ";
                break;
        }


        ?>

<script type="text/javascript">


    let exampleModal = document.getElementById('exampleModalAdminVisitas')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')
        let modalBodyP = document.querySelector('.texto')

        let folioInput = document.getElementById('idVisita')
        folioInput.value = recipient;

        console.log(folioInput.value)
        console.log(recipient)
        modalTitle.textContent = 'Cambio de estatus de la visita';

    })
</script>

<?php
function formatoFechas($fecha)
{


    $mes = date("m", strtotime($fecha));

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




    return $mes2;
}
?>