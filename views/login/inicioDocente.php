<?php
include "views/includes/navbar.php"
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card border-ita-loginD">
                <div class="card-header text-center" style="background-color: white;">
                <h5>Iniciar sesión</h5>
                <i class="bi bi-person-workspace" style="font-size: 4rem;"></i>
                </div>
                <div class="card-body ">
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="d-grid gap-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                    <input type="text" name="usuario" class="form-control" placeholder="Usuario"  required autofocus>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                </div>                          
                                <input type="submit" class="btn btn-docente btn-block" value="Iniciar Sesion" name="ingresarDocente">
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$ingreso = new ControlladorDocente();
$ingreso -> ctrFormInicioDocente();


?>