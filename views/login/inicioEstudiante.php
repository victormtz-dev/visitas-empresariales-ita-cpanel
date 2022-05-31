<?php
include "views/includes/navbar.php"
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-ita-loginA">
                <div class="card-header text-center" style="background-color: white;">
                <h5>Iniciar sesión: Alumno</h5>
                <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                </div>
                <div class="card-body ">
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="d-grid gap-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="correo" class="form-control" placeholder="Correo" required autofocus>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                </div>                          
                                <input type="submit" class="btn btn-alumno btn-block" value="Iniciar Sesion" name="ingresarEstudiante">
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$ingreso = new ControlladorEstudiante;
$ingreso->ctrFormInicioEstudiante();


?>