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

$datos = ControlladorEstudiante::ctrDatosEstudiante($_SESSION["no_control"]);
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

    <div class="row text-center">
        <h1>
            DATOS PERSONALES
        </h1>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card border-ita-alumno">
            <div class="card-body">
                <div class="row g-3">
                <input type="hidden" class="form-control" id="inputControl" value="<?php echo $datos["no_control"] ?>">
                    <div class="col-6">
                        <label for="inputNombre" class="form-label">Nombre (s):</label>
                        <input type="text" class="form-control" id="inputNombre" value="<?php echo $datos["nombres"] ?>" pattern="[a-zA-Z ]{2,254}" required>
                    </div>

                    <div class="col-6">
                        <label for="inputApellido" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="inputApellido" value="<?php echo $datos["apellidos"] ?>" pattern="[a-zA-Z ]{2,254}" required>
                    </div>

                    <div class="col-6">
                        <label for="inputCorreo" class="form-label">Correo institucional:</label>
                        <input type="text" class="form-control" id="inputCorreo" pattern="([Ll])\d{8}@acapulco\.tecnm\.mx" value="<?php echo $datos["correo"] ?>" required>
                    </div>

                    <div class="col-6">
                        <label for="inputCarrera" class="form-label">Carrera:</label>
                        <select id="inputCarrera" class="form-select" required>
                            <option disabled hidden selected value="<?php echo $datos["carrera"] ?>"><?php echo $datos["carrera"] ?></option>
                            <option value="ARQUITECTURA">ARQUITECTURA</option>
                            <option value="INGENIERÍA EN SISTEMAS COMPUTACIONALES">INGENIERÍA EN SISTEMAS COMPUTACIONALES</option>
                            <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
                            <option value="INGENIERÍA BIOQUÍMICA">INGENIERÍA BIOQUÍMICA</option>
                            <option value="INGENIERÍA EN GESTIÓN EMPRESARIAL">INGENIERÍA EN GESTIÓN EMPRESARIAL</option>
                            <option value="LICENCIATURA EN ADMINISTRACIÓN">LICENCIATURA EN ADMINISTRACIÓN</option>
                            <option value="CONTADOR PÚBLICO">CONTADOR PÚBLICO</option>
                            <option value="MAESTRIA EN SISTEMAS COMPUTACIONALES">MAESTRIA EN SISTEMAS COMPUTACIONALES</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="inputNSS" class="form-label">NSS:</label>
                        <input type="text" class="form-control" id="inputNSS"  value="<?php echo $datos["nss"] ?>" minlength="11" maxlength="11" required>
                    </div>

                    <div class="col-6">
                        <label for="inputSexo" class="form-label">Sexo:</label>
                        <select id="inputSexo" class="form-select" aria-label="Default select example" required>
                            <option disabled hidden value="<?php echo $datos["sexo"] ?>" selected><?php echo $datos["sexo"] ?></option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>
                    </div>

                    <?php if ($datos["estatus_editar"] == "SIN EDITAR") : ?>

                        <div class="d-flex">
                            <button class="btn btn-primary btn-block ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModalEstudiante" data-bs-whatever="<?php echo $datos['no_control'] . "/" .  $datos['nombres']. "/" .  $datos['apellidos']. "/" .  $datos['correo']. "/" .  $datos['carrera'] . "/" .  $datos['nss'] . "/" .  $datos['sexo']?>">
                                Guardar Cambios
                            </button>
                        </div>

                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->

<div class="modal fade" id="exampleModalEstudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="texto"></p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    <input type="text" id="inputControl-edit" name="controlEdit">
                    <input type="text" id="inputNombre-edit" name="nombresEdit" pattern="[a-zA-Z ]{2,254}">
                    <input type="text" id="inputApellido-edit" name="apellidosEdit" pattern="[a-zA-Z ]{2,254}">
                    <input type="text" id="inputCorreo-edit" name="correoEdit" pattern="([Ll])\d{8}@acapulco\.tecnm\.mx">
                    <input type="text" id="inputCarrera-edit" name="carreraEdit" >
                    <input type="text" id="inputNSS-edit" name="nssEdit" minlength="11" maxlength="11">
                    <input type="text" id="inputSexo-edit" name="sexoEdit">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" name="editarDatosEstudiante" value="Guardar cambios">
                </form>
            </div>
        </div>
    </div>
</div>


<?php

//$respuesta = ControlladorEstudiante::ctrDatosEditar();
// echo "<pre>"; print_r($respuesta); echo "</pre>";
$respuesta = ControlladorEstudiante::ctrDatosEditar();
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
                                     title: 'Los datos se han modificado satisfactoriamente.',
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
                                     title: 'Error al modificar datos.',
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
                                       setTimeout(function(){
                                        window.location.reload();
                                    }, 2300);
                                       </script>
                                     ";
                    break;
        }

    
?>


<script type="text/javascript">
    let exampleModal = document.getElementById('exampleModalEstudiante')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let recipient = button.getAttribute('data-bs-whatever')
        let modalTitle = exampleModal.querySelector('.modal-title')

        let noControlValue= document.getElementById('inputControl-edit')
        let nombresValue= document.getElementById('inputNombre-edit')
        let apellidosValue = document.getElementById('inputApellido-edit')
        let correoValue = document.getElementById('inputCorreo-edit')
        let carreraValue = document.getElementById('inputCarrera-edit')
        let nssValue = document.getElementById('inputNSS-edit')
        let sexoValue = document.getElementById('inputSexo-edit')

        let noControl= document.getElementById('inputControl').value;
        let nombres= document.getElementById('inputNombre').value;
        let apellidos = document.getElementById('inputApellido').value;
        let correo = document.getElementById('inputCorreo').value;
        let carrera = document.getElementById('inputCarrera').value;
        let nss = document.getElementById('inputNSS').value;
        let sexo = document.getElementById('inputSexo').value;
        let modalBodyP = document.querySelector('.texto')


        
        modalTitle.textContent = 'Cambiar datos del alumno con numero de control:  ' + noControl;
        modalBodyP.textContent = '¿Seguro que quiere modificar sus datos? Una vez modificados, ya no se podran modificar otra vez.' ;

        noControlValue.value = noControl;
        nombresValue.value = nombres;
        apellidosValue.value = apellidos;
        correoValue.value = correo;
        carreraValue.value = carrera;
        nssValue.value = nss;
        sexoValue.value = sexo;
    })
</script>