<?php
include "views/includes/navbar.php"
?>

<section class="container mt-3">

    <div class="row align-items-stretch">
        <div class="col-md-8 mx-auto">
            <h2 class="fw-bold text-center mb-2">Registrarse</h2>
            <form class="row" action="" method="POST">

                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="text" name="nombres" class="form-control form-control-a" id="floatingInput" placeholder="Nombres(S)" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 ]{2,254}" required> 
                    <label for="floatingInput">Nombre(s)</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="text" name="apellidos" class="form-control form-control-a" id="floatingApellido" placeholder="Apellidos" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 ]{2,254}" required>
                    <label for="floatingApellido">Apellidos</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="email" name="correo" class="form-control form-control-a" id="floatingCorreo" placeholder="Correo Electronico Institucional" pattern="([Ll])\d{8}@acapulco\.tecnm\.mx" required>
                    <label for="floatingCorreo">Correo Institucional</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="number" name="noControl" class="form-control form-control-a" id="floatingNoControl" placeholder="Numero de Control" minlength="8" maxlength="8" required>
                    <label for="floatingNoControl">Numero de control</label>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 form-floating mb-3">
                    <select class="form-select form-control form-control-a" aria-label="Default select example" id="floatingCarrera" name="carrera" required>
                        <option disabled hidden selected value="">Seleccione una opcion</option>
                        <option value="ARQUITECTURA">ARQUITECTURA</option>
                        <option value="INGENIERÍA EN SISTEMAS COMPUTACIONALES">INGENIERÍA EN SISTEMAS COMPUTACIONALES</option>
                        <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
                        <option value="INGENIERÍA BIOQUÍMICA">INGENIERÍA BIOQUÍMICA</option>
                        <option value="INGENIERÍA EN GESTIÓN EMPRESARIAL">INGENIERÍA EN GESTIÓN EMPRESARIAL</option>
                        <option value="LICENCIATURA EN ADMINISTRACIÓN">LICENCIATURA EN ADMINISTRACIÓN</option>
                        <option value="CONTADOR PÚBLICO">CONTADOR PÚBLICO</option>
                        <option value="MAESTRIA EN SISTEMAS COMPUTACIONALES">MAESTRIA EN SISTEMAS COMPUTACIONALES</option>
                    </select>
                    <label for="floatingSelect">Programa Académico/Carrera</label>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="number" name="nss" class="form-control form-control-a" id="floatingNSS" placeholder="Numero del seguro social" minlength="11" maxlength="11" required>
                    <label for="floatingNSS">Numero de seguro social</label>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <select id="floatinGenero" class="form-select form-control form-control-a" aria-label="Default select example" name="sexo" required>
                        <option disabled hidden value="" selected>Seleccione una opcion</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                    <label for="floatingSelect">Género</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="password" name="password" class="form-control form-control-a" id="floatingContraseña" placeholder="Contraseña" required>
                    <label for="floatingContraseña">Contraseña</label>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 form-floating mb-3">
                    <input type="password" name="passwordVerificar" class="form-control form-control-a" id="floatingContraseñaV" placeholder="Verifica tu Contraseña" required>
                    <label for="floatingContraseñaV">Verificar contraseña</label>
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-success btn-block" name="registrarAlumno" value="Registrarse">
                </div>
            </form>
        </div>
    </div>
</section>


<?php


$formularioInicio = ControlladorEstudiante::ctrFormRegistroEstudiante();


switch ($formularioInicio) {

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
                                            title: 'El alumno se registro satisfactoriamente.',
                                            showConfirmButton: false,
                                            timer: 1500
                                          }) </script>
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
                                            title: 'El usuario no existe.',
                                            showConfirmButton: false,
                                            timer: 1500
                                          }) </script>
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
                                            icon: 'warning',
                                            title: 'Favor de rellenar los campos con el tipo de datos que se especifica.',
                                            showConfirmButton: false,
                                            timer: 1500
                                          }) </script>
                                        ";
        break;

    case "3":
        echo '<script> 
                                            if(window.history.replaceState){
                                                window.history.replaceState(null, null, window.location.href);
                                            }
                                        </script>';
        echo "
                                        <script> 
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'warning',
                                            title: 'La longitud de los datos no esta permitida. Favor de verificar.',
                                            showConfirmButton: false,
                                            timer: 1500
                                          }) </script>
                                        ";
        break;

    case "4":
        echo '<script> 
                                            if(window.history.replaceState){
                                                window.history.replaceState(null, null, window.location.href);
                                            }
                                        </script>';
        echo "
                                        <script> 
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'info',
                                            title: 'Favor de rellenar todos los campos.',
                                            showConfirmButton: false,
                                            timer: 1500
                                          }) </script>
                                        ";

        break;
}


?>