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
$datos = ControlladorAdministrador::ctrTablaUsuarios();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/administrador/navbarAdmin.php"
    ?>
</nav>

<section class="container mt-5">
    <a class="btn btn-primary" href="menuAdmin" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Volver al inicio
    </a>
    <div class="row text-center mt-4 mb-4">
        <h2>Registrar usuario</h2>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Alta de usuarios para docentes
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputUsuario" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" name="usuarioAlta" id="inputUsuario" required>
                            </div>
                            <div class="col-12">
                                <label for="inputCorreo" class="form-label">Correo:</label>
                                <input type="email" class="form-control" name="CorreoAlta" id="inputCorreo" required>
                            </div>
                            <div class="col-12">
                                <label for="inputContraseña" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" name="contraseñaAlta" id="inputContraseña" required>
                            </div>
                            <div class="col-12">
                                <label for="inputVerificar" class="form-label">Verificar contraseña:</label>
                                <input type="password" class="form-control" name="verificarAlta" id="inputVerificar" required>
                            </div>
                            <input type="submit" class="btn btn-success" name="registrarUsuario" value="Registrar">

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="container-fluid px-1 text-center">
                <div class="table-responsive">
                    <table class="table align-middle table-bordered border-dark">
                        <thead class="text-center align-middle">
                            <tr class="text-center align-middle table-responsive-sm">
                                <th class="text-center align-middle">Usuario del docente</th>
                                <th class="text-center align-middle">Responsable del registro</th>
                                <th class="text-center align-middle">Fecha y hora de registro</th>
                                <th class="text-center align-middle">Estatus</th>
                                <th class="text-center align-middle">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $periodo => $value) : ?>
                                <tr>
                                    <td><?php echo $value["usuario"]; ?></td>
                                    <td><?php echo $value["usuario_registro"]; ?></td>
                                    <td><?php echo $value["fecha_registro"]; ?></td>
                                    <td><?php echo $value["estatus"]; ?></td>
                                    <td>
                                        <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">
                                            <?php if ($value["estatus"] == 'ALTA') : ?>
                                                <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a BAJA" onclick="cambiarEstatusDocente(<?php echo 1 ?>, <?php echo $value['id_docente']; ?>)"><i class="bi bi-check-circle-fill"></i></button>

                                            <?php else : ?>
                                                <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a ALTA" onclick="cambiarEstatusDocente(<?php echo 0 ?>, <?php echo $value['id_docente']; ?>)"><i class="bi bi-x-circle-fill"></i></button>

                                            <?php endif ?>

                                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCambiarPassword" data-bs-whatever="<?php echo $value['id_docente']; ?>" data-bs-placement="top" title="Cambiar estatus a ALTA"><i class="bi bi-pencil-square"></i></button>
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

<div class="modal fade" id="exampleModalCambiarPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="password" class="form-control" name="passwordNuevo" id="inputContraseña" required>
                        </div>
                        <div class="col-12">
                            <label for="inputVerificar" class="form-label">Verificar contraseña:</label>
                            <input type="password" class="form-control" name="verificarNuevo" id="inputVerificar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idUsuario" name="idUsuario">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" name="nuevoPassword" value="Guardar cambios">
                </form>
            </div>
        </div>
    </div>
</div>



<?php
$respuesta = ControlladorAdministrador::ctrRegistroUsuarios();
switch ($respuesta) {

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
                                     title: 'Se ha registrado satisfactoriamente.',
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


$respuestaEdit = ControlladorAdministrador::ctrRestaurarPassword();
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
                                     title: 'Se ha cambiado la contraseña.',
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


    let exampleModal = document.getElementById('exampleModalCambiarPassword')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')
        let modalBodyP = document.querySelector('.texto')

        let folioInput = document.getElementById('idUsuario')
        folioInput.value = recipient;

        modalTitle.textContent = 'Restaurar contraseña';

    })
</script>