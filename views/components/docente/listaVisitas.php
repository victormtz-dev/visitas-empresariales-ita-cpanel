<?php
require_once "models/conexion.php";

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


$datosVisita = ControlladorDocente::ctrListaVisitas();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/docente/navbarDocente.php"
    ?>
</nav>

<section class="container-fluid mt-5">
    <div class="container">

        <a class="btn btn-primary" href="menuDocente" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
            </svg>
            Volver al inicio
        </a>
    </div>
    <div class="row">
        <h1 class="text-center">
            Visitas Registradas
        </h1>
    </div>
    <div class="row mt-5 pt-2">
        <div class="col-3">
            <label for="inputPeriodo" class="form-label">Visitas empresariales:</label>
            <select onchange="buscar_ahora()" class="form-select" name="visitaBuscar" id="visitaBuscar" required autofocus>
                <option disabled hidden value="" selected>Seleccione el periodo</option>
                <?php foreach ($datosVisita as $opcion) :   ?>
                    <option value="<?php echo $opcion['folio_visita'] ?>"><?php echo "VE/" . $opcion['folio_visita'] . " -- " . $opcion['periodo']; ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="col-9">
            <div id="datos_buscador">
                <div class="container-fluid px-1 text-center">
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered border-dark">
                            <thead class="text-center align-middle">
                                <tr class="text-center align-middle table-responsive-sm">
                                    <th class="text-center align-middle">Folio</th>
                                    <th class="text-center align-middle">Empresa</th>
                                    <th class="text-center align-middle">Ciudad</th>
                                    <th class="text-center align-middle">Fecha de inicio de visita</th>
                                    <th class="text-center align-middle">Fecha de fin de visita</th>
                                    <th class="text-center align-middle">Estatus</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>


<script type="text/javascript">
    function buscar_ahora() {
        let buscar = document.getElementById("visitaBuscar").value;
        var parametros = {
            "buscar": buscar
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'views/components/docente/ajax/buscador.php',
            success: function(data) {
                document.getElementById("datos_buscador").innerHTML = data;
            }
        });
    }
</script>