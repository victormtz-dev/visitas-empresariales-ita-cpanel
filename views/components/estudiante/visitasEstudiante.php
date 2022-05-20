<?php

if (!isset($_SESSION['validarIngresoEstudiante'])) {
    echo '<script> 
                window.location = "inicioEstudiante"
            </script>';
    return;
} else {
    if ($_SESSION['validarIngresoEstudiante'] != "ok") {
        echo '<script> 
                window.location = "inicioEstudiante"
           </script>';
        return;
    }
}
$datosVisita = ControlladorEstudiante::ctrListaVisitas();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/estudiante/navbarEstudiante.php"
    ?>
</nav>



<section class="container mt-5">

    <a class="btn btn-primary" href="menuEstudiante" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
        </svg>
        Volver al inicio
    </a>

    <div class="row text-center">
        <h1>
            CONSULTA DE VISITAS
        </h1>
    </div>

    <?php foreach ($datosVisita as $opcion) :   ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <div class="card border-ita-docente">
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <h4 class="mt-2"><?php echo $opcion['nombre_docente'] ?></h4>
                        <h5><?php echo $opcion['asignatura'] ?></h5>
                        <h6><?php echo $opcion['correo_docente'] ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="card border-ita">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-2"><span class="tag tag-folio"><?php echo "VE/" . $opcion['folio_visita']; ?></span></div>
                            <div class="col-xs-12 col-sm-12 col-md-4"><span class="tag tag-periodo"><?php echo $opcion['periodo'] ?></span></div>
                        </div>
                        <div class="row">
                            <h4 class="card-title mt-3">
                                <strong><?php echo $opcion['carrera'] ?></strong>
                            </h4>
                            <p class="card-text">Lugares a disponibles: <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg> <?php echo $opcion['lugares_disponibles'] ?> </p>
                            <p class="card-text">Empresas a visitar:</p>
                        </div>

                        <?php
                        $datosEmpresa = ControlladorEstudiante::ctrListasEmpresas($opcion['folio_visita']);
                        ?>

                        <?php
                        foreach ($datosEmpresa as $dato) :   ?>

                            <div class="row ul-ita">
                                <div class="col-3 fs-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                        <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                    </svg> <?php echo $dato["nombre_empresa"]; ?>
                                </div>
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                    </svg> <?php echo "" . formatoEstados($dato['estado_empresa']) ?>
                                </div>
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                    </svg> <?php echo formatoFechas($dato['fecha_inicio']) ?>

                                </div>
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                    </svg> <?php echo "" . $dato['hora_inicio'] . " hrs." ?>
                                </div>
                            </div>
                        <?php endforeach ?>


                        <div class="row mt-3">
                            <div class="d-grid gap-2 d-md-flex">
                                <!-- <a class="btn-a text-center" href="" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                        <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                        <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                    </svg> Formato de visitas</a> -->

                                
                                    <a class="btn-a text-center" href="" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo $opcion['periodo'] . "/" .  $opcion['folio_visita'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-check-fill" viewBox="0 0 16 16">
                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                                    </svg> Registrarse</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="folioID"></p>
            </div>
            <div class="modal-footer">
                <form action="" method="POST">
                    <input type="hidden" name="idVisita" id="idVisita" value="">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" name="registrarseAVisita" value="Registrarse en la visita">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$respuesta = ControlladorEstudiante::ctrRegistroVisitas();
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
    case "existe":
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
                                             title: 'Ya se ha registrado a este curso.',
                                             showConfirmButton: false,
                                             timer: 1500
                                           }) 
                                          
                                           </script>
                                         ";
        break;
}


?>

<script type="text/javascript">
    var exampleModal = document.getElementById('exampleModal')

    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever')
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = document.getElementById('idVisita')
        var modalBodyP = document.querySelector('.folioID')

        var id = `${recipient.split("/")[1]}`
        var periodo = `${recipient.split("/")[0]}`

        modalTitle.textContent = 'Visita empresarial del periodo ' + periodo;
        modalBodyP.textContent = '¿Seguro que se quiere registrar a la visita con folio VE/' + id + '?';
        modalBodyInput.value = id;
    })
</script>



<?php
function formatoFechas($fecha)
{

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "ENE";
            break;
        case '02':
            $mes2 = "FEB";
            break;
        case '03':
            $mes2 = "MAR";
            break;
        case '04':
            $mes2 = "ABR";
            break;
        case '05':
            $mes2 = "MAY";
            break;
        case '06':
            $mes2 = "JUN";
            break;
        case '07':
            $mes2 = "JUL";
            break;
        case '08':
            $mes2 = "AGO";
            break;
        case '09':
            $mes2 = "SEP";
            break;
        case '10':
            $mes2 = "OCT";
            break;
        case '11':
            $mes2 = "NOV";
            break;
        case '12':
            $mes2 = "DIC";
            break;
    }

    $fechaFormateada = $dia . "/" . $mes2 . "/" . $anio;


    return $fechaFormateada;
}


function formatoEstados($edo)
{

    $estado = "";

    switch ($edo) {
        case 'AGUASCALIENTES':
            $estado = "AGS.";
            break;
        case 'BAJA CALIFORNIA':
            $estado = "B.C.";
            break;
        case 'BAJA CALIFORNIA SUR':
            $estado = "B.C.S.";
            break;
        case 'CAMPECHE':
            $estado = "CAMP.";
            break;
        case 'COAHUILA DE ZARAGOZA':
            $estado = "COAH.";
            break;
        case 'COLIMA':
            $estado = "COL.";
            break;
        case 'CHIAPAS':
            $estado = "CHIS.";
            break;
        case 'CIUDAD DE MÉXICO':
            $estado = "C.D.MX.";
            break;
        case 'DURANGO':
            $estado = "DGO.";
            break;
        case 'GUANAJUATO':
            $estado = "GTO.";
            break;
        case 'GUERRERO':
            $estado = "GRO.";
            break;
        case 'HIDALGO':
            $estado = "HGO.";
            break;
        case 'JALISCO':
            $estado = "JAL.";
            break;
        case 'MÉXICO':
            $estado = "EDO. MEX.";
            break;
        case 'MICHOACÁN DE OCAMPO':
            $estado = "MICH.";
            break;
        case 'MORELOS':
            $estado = "MOR.";
            break;
        case 'NAYARIT':
            $estado = "NAY.";
            break;
        case 'NUEVO LEÓN':
            $estado = "N.L.";
            break;
        case 'OAXACA':
            $estado = "OAX.";
            break;
        case 'PUEBLA':
            $estado = "PUE.";
            break;
        case 'QUERÉTARO':
            $estado = "QRO.";
            break;
        case 'QUINTANA ROO':
            $estado = "Q. ROO.";
            break;
        case 'SAN LUIS POTOSÍ':
            $estado = "S.L.P.";
            break;
        case 'SINALOA':
            $estado = "SIN.";
            break;
        case 'SONORA':
            $estado = "SON.";
            break;
        case 'TABASCO':
            $estado = "TAB.";
            break;
        case 'TAMAULIPAS':
            $estado = "TAMPS.";
            break;
        case 'TLAXCALA':
            $estado = "TLAX.";
            break;
        case 'VERACRUZ DE IGNACIO DE LA LLAVE':
            $estado = "VER.";
            break;
        case 'YUCATÁN':
            $estado = "YUC.";
            break;
        case 'ZACATECAS':
            $estado = "ZAC.";
            break;
    }



    return $estado;
}
?>