<?php

if(!isset( $_SESSION['validarIngresoAdmin'])){
         echo '<script> 
                     window.location = "inicioAdministrador"
                 </script>';
         return;
}else {
    if($_SESSION['validarIngresoAdmin'] != "ok"){
        echo '<script> 
                     window.location = "inicioAdministrador"
                </script>';
         return;
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
        include "views/components/administrador/navbarAdmin.php"
    ?>
</nav>


<section class="container p-4">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="">
                <div class="card-body text-center">
                    <h1>Bienvenido</h1>
                </div>
            </div>
        </div>
    </div>
</section>