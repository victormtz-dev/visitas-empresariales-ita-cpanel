<?php
require_once "controllers/plantilla.controller.php";

require_once "controllers/docente.controller.php";
require_once "controllers/estudiante.controller.php";
require_once "controllers/administrador.controller.php";

require_once "models/docente.models.php";
require_once "models/estudiante.models.php";
require_once "models/administrador.models.php";

$template = new ControlladorPlantilla();
$template -> getCtrPlantilla();

?>