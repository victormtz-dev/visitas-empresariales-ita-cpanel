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

$datos = ControlladorAdministrador::ctrAlumnos()
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
        <div class="row">
            <div class="p-3 mb-1 mt-2 border rounded-3" style="background-color: #e8ebf0;">
                <h2 class="text-center">
                    Alumnos registrados en la plataforma
                </h2>
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
                                <th class="text-center align-middle">No. Control</th>
                                <th class="text-center align-middle">Nombre(s)</th>
                                <th class="text-center align-middle">Apellidos</th>
                                <th class="text-center align-middle">Correo</th>
                                <th class="text-center align-middle">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($datos as $visita => $value) : ?>
                                <tr>
                                    <td><?php echo $value["no_control"]; ?></td>
                                    <td><?php echo $value["nombres"]; ?></td>
                                    <td><?php echo $value["apellidos"]; ?></td>
                                    <td><?php echo $value["correo"]; ?></td>
                                    <td>
                                        <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">
                                            <?php if ($value["estatus_editar"] == 'SIN EDITAR') : ?>
                                                <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Deshabilitar edicion de datos" onclick="cambiarEstatus(<?php echo 1 ?>, <?php echo $value['no_control']; ?>)"><i class="bi bi-check-circle-fill"></i></button>

                                            <?php else : ?>
                                                <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar edicion de datos" onclick="cambiarEstatus(<?php echo 0 ?>, <?php echo $value['no_control']; ?>)"><i class="bi bi-x-circle-fill"></i></button>

                                            <?php endif ?>
                                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCambiarPasswordAlumno" data-bs-whatever="<?php echo $value['no_control']; ?>" data-bs-placement="top" title="Restaurar contraseña"><i class="bi bi-key-fill"></i></button>
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


<div class="modal fade" id="exampleModalCambiarPasswordAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="texto"></p>
                <form action="" method="POST">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputContraseña" class="form-label">Contraseña nueva:</label>
                            <input type="password" class="form-control" name="passwordNuevoA" id="inputContraseña" required>
                        </div>
                        <div class="col-12">
                            <label for="inputVerificar" class="form-label">Verificar contraseña:</label>
                            <input type="password" class="form-control" name="verificarNuevoA" id="inputVerificar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="noControl" name="noControl">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" name="nuevoPasswordA" value="Guardar cambios">
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

$respuestaEdit = ControlladorAdministrador::ctrRestaurarPasswordAlumno();

switch ($respuestaEdit) {

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
                                     title: 'Se ha cambiado la contraseña. Se envio contraseña al correo del alumno.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   });

                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   
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
                                     title: 'Error al ingresar datos.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) 
                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   </script>
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
                                   }) 
                                   </script>
                                 ";
        break;

    case "2":
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
                                         title: 'Las contraseñas no coinciden.',
                                         showConfirmButton: false,
                                         timer: 1500
                                       }) 
                                       
                                       </script>
                                     ";
        break;
}

?>

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

<script type="text/javascript">
    function cambiarEstatusDocente(estatus, clave) {

        var parametros = {
            "estatus": estatus,
            "clave": clave
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'views/components/administrador/ajax/actualizarEstatusDocente.php',
            success: function(data) {


                window.location.reload();


            }
        });
    }


    let exampleModal = document.getElementById('exampleModalCambiarPasswordAlumno')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')
        let modalBodyP = document.querySelector('.texto')

        let folioInput = document.getElementById('noControl')
        folioInput.value = recipient;

        modalTitle.textContent = 'Restaurar contraseña';

    })
</script>