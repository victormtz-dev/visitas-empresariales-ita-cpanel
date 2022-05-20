<?php

require_once "../../../../models/conexion.php";
require_once "../../../../controllers/administrador.controller.php";
require_once "../../../../models/administrador.models.php";

$respuesta = ControlladorAdministrador::ctrCambiarEstatusPeriodo($_POST["estatus"], $_POST["clave"]);


  if($respuesta == 'exito'){
     echo 'ok';
  }




?>


