<?php
//en caso de que no haya iniciado sesion que lo regrese al login de docente
if(!isset( $_SESSION['validarIngresoDocente'])){
         echo '<script> 
                     window.location = "inicioDocente"
                 </script>';
         return;
}else {
    if($_SESSION['validarIngresoDocente'] != "ok"){
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
    
</section>