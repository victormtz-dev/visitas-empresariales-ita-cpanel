<?php


require_once "../../../../models/conexion.php";
require_once "../../../../controllers/estudiante.controller.php";
require_once "../../../../models/estudiante.models.php";

//$datos = ControlladorDocente::ctrTablaVisitas($_POST["buscar"])
$url = $_POST["url"];
$folio = $_POST["folio"];
$tipo = $_POST["tipo"];
$control = $_POST["control"];

$datos = ControlladorEstudiante::ctrEliminarDocumentos($url, $folio, $tipo, $control);

 if($datos == 'ok'){
     echo "ok";
 }

//echo $datos;

?>