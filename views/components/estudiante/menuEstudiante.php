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


<section>
    
</section>