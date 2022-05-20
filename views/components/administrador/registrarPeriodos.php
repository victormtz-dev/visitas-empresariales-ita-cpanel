<?php

if (!isset($_SESSION['validarIngresoAdmin'])) {
    echo '<script> 
                window.location = "inicioAdministrador"
            </script>';
    return;
} else {
    if ($_SESSION['validarIngresoAdmin'] != "ok") {
        echo '<script> 
                window.location = "inicioAdministrador"
           </script>';
        return;
    }
}
$datos = ControlladorAdministrador::ctrTablaPeriodos();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/administrador/navbarAdmin.php"
    ?>
</nav>

<section class="container mt-5">
    <a class="btn btn-primary" href="menuAdmin" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Volver al inicio
    </a>
    <div class="row text-center mt-4 mb-4">
        <h2>Registrar periodo</h2>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Alta de periodos
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="inputPeriodo" class="form-label">Periodo:</label>
                                <input type="text" class="form-control" name="periodoAlta" id="inputPeriodo" placeholder="Ej. ENE-JUN 2022" required>
                            </div>
                            <input type="submit" class="btn btn-success" name="registrarPeriodo" value="Registrar">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="container-fluid px-1 text-center">
                <div class="table-responsive">
                    <table class="table align-middle table-bordered border-dark">
                        <thead class="text-center align-middle">
                            <tr class="text-center align-middle table-responsive-sm">
                                <th class="text-center align-middle">Periodo</th>
                                <th class="text-center align-middle">Responsable del registro</th>
                                <th class="text-center align-middle">Fecha y hora de registro</th>
                                <th class="text-center align-middle">Estatus</th>
                                <th class="text-center align-middle">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $periodo => $value) : ?>
                                <tr>
                                    <td><?php echo $value["descripcion"]; ?></td>
                                    <td><?php echo $value["usuario"]; ?></td>
                                    <td><?php echo $value["fecha_registro"]; ?></td>
                                    <td><?php echo $value["estatus"]; ?></td>
                                    <td>
                                        <div class="btn-group d-grid gap-2 d-md-flex justify-content-md-between">
                                            <?php if ($value["estatus"] == 'ALTA') : ?>
                                                <button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a BAJA"
                                                onclick="cambiarEstatus(<?php echo 1 ?>, <?php echo $value['id_periodo']; ?>)"
                                                ><i class="bi bi-check-circle-fill"></i></button>

                                            <?php else : ?>
                                                <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar estatus a ALTA"
                                                onclick="cambiarEstatus(<?php echo 0 ?>, <?php echo $value['id_periodo']; ?>)"><i class="bi bi-x-circle-fill"></i></button>

                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$respuesta = ControlladorAdministrador::ctrRegistroPeriodos();
switch ($respuesta) {

    case "exito":
        echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                     
                                 </script>';

        echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'success',
                                     title: 'Se ha registrado satisfactoriamente.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   });

                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   
                                   </script>
                                 ";
        break;

    case "error":
        echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                 </script>';
        echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'error',
                                     title: 'Error al ingresar datos.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) 
                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   </script>
                                 ";
        break;

    case "1":
        echo '<script> 
                                     if(window.history.replaceState){
                                         window.history.replaceState(null, null, window.location.href);
                                     }
                                 </script>';
        echo "
                                 <script> 
                                 Swal.fire({
                                     position: 'center',
                                     icon: 'error',
                                     title: 'Favor de rellenar todos los campos.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) 
                                   setTimeout(function(){
                                    window.location.reload();
                                }, 2300);
                                   </script>
                                 ";
        break;
}

?>

<script type="text/javascript">
    function cambiarEstatus(estatus1, clave1) {
       
        var parametros = {
            "estatus": estatus1,
            "clave": clave1
        };
        $.ajax({
            data: parametros,
            type: 'POST',
            url: 'views/components/administrador/ajax/actualizarEstatusPeriodo.php',
            success: function(data) {
              
    
             window.location.reload();
 

            }
        });
    }
</script>



