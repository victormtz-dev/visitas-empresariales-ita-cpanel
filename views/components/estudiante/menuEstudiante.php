<?php
if(!isset( $_SESSION['validarIngresoEstudiante'])){
         echo '<script> 
                     window.location = "inicioEstudiante"
                 </script>';
         return;
}else {
    if($_SESSION['validarIngresoEstudiante'] != "ok"){
        echo '<script> 
                     window.location = "inicioEstudiante"
                </script>';
         return;
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
        include "views/components/estudiante/navbarEstudiante.php"
    ?>
</nav>


<section class="container p-4">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="">
                <div class="card-body text-center">
                    <h1>Registro de visitas a empresas</h1>
                </div>
            </div>
        </div>
    </div>
</section>