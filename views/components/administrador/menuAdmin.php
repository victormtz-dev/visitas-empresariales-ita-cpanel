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


<section>
    
</section>