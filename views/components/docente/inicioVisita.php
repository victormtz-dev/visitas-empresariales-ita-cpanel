<?php

if (!isset($_SESSION['validarIngresoDocente'])) {
    echo '<script> 
                     window.location = "inicioDocente"
                 </script>';
    return;
} else {
    if ($_SESSION['validarIngresoDocente'] != "ok") {
        echo '<script> 
                     window.location = "inicioDocente"
                </script>';
        return;
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/docente/navbarDocente.php"
    ?>
</nav>


<section>
    <div class="row text-center mt-3">
        <div class="col-12">
            <h1>
                Registro de visitas.
            </h1>
        </div>
    </div>
    <div class="row text-center mt-3">
        <div class="col-12">
            <h2>
                Por favor, ingrese el número de visitas.
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="container p-4">
                <div class="col-md-6 mx-auto">
                    <form action="registrarVisita" method="POST">
                        <div class="form-group">
                            <div class="d-grid gap-3">
                                <input type="number" name="numVisitas" class="form-control" placeholder="Numero de visitas" required min="1" max="10">
                                <input type="submit" class="btn btn-success btn-block" value="Aceptar" name="sigVisitas">
                            </div>
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
</section>