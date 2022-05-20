<?php
session_start();

include "views/includes/header.php"
?>

<header>
<div class="container">
  <div class="row justify-content-md-center text-center">
    <div class="col">
    <img src="public/img/logoita.png" alt="logoita" width=" " height="83">
    </div>
    <div class="col">
    <img src="public/img/pleca-gob2.png" alt="logoeducación" width=" " height="83">
    </div>
    <div class="col">
    <img src="public/img/tecnm.png" alt="tecnm" width=" " height="83">
    </div>
  </div>
</div>
</header>




<main>
    <?php
    if (isset($_GET["pagina"])) {
        if ( //login
            $_GET["pagina"] == "inicioEstudiante" ||
            $_GET["pagina"] == "registroEstudiante" ||
            $_GET["pagina"] == "inicioDocente" ||
            $_GET["pagina"] == "inicioAdministrador"
        ) {
            include "views/login/" . $_GET["pagina"] . ".php";
            
        } else if ( //menu de docentes
            $_GET["pagina"] == "menuDocente" ||
            $_GET["pagina"] == "listaVisitas" ||
            $_GET["pagina"] == "registrarVisita" ||
            $_GET["pagina"] == "inicioVisita" ||
            $_GET["pagina"] == "salirDocente"
        ) {
            include "views/components/docente/" . $_GET["pagina"] . ".php";

        } else if ( //menu de administrador
            $_GET["pagina"] == "menuAdmin" ||
            $_GET["pagina"] == "salirAdmin" ||
            $_GET["pagina"] == "registrarPeriodos" ||
            $_GET["pagina"] == "registrarDocente" ||
            $_GET["pagina"] == "consultaVisitas"
        ) {
            include "views/components/administrador/" . $_GET["pagina"] . ".php";

        }else if ( //menu de alumno
            $_GET["pagina"] == "menuEstudiante" ||
            $_GET["pagina"] == "salirEstudiante" ||
            $_GET["pagina"] == "visitasEstudiante" ||
            $_GET["pagina"] == "visitasRegistradasEstudiante" ||
            $_GET["pagina"] == "datosEstudiante" ||
            $_GET["pagina"] == "cargarDocumentos" ||
            $_GET["pagina"] == "cargarDocumentoPermiso" ||
            $_GET["pagina"] == "cargarDocumentoNSS" ||
            $_GET["pagina"] == "cargarDocumentoCredencial" 
        ) {
            include "views/components/estudiante/" . $_GET["pagina"] . ".php";

        } 
        else {

            include "views/includes/error404.php";
        }
    } else {
        include "views/login/inicioEstudiante.php";
    }
    ?>
</main>


<?php
include "views/includes/footer.php";
?>