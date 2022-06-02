<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class ControlladorDocente
{

    public function ctrFormInicioDocente()
    {
        if (isset($_POST['ingresarDocente'])) {

            $tabla = "docente";
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $respuesta = ModeloDocente::mdlInicioDocente($tabla, $usuario, $password);


            if (is_array($respuesta)) {
                if ($respuesta["usuario"] == $usuario && $respuesta["password"] == $password) {

                    $_SESSION['idDocente'] = $respuesta["id_docente"];
                    $_SESSION['validarIngresoDocente'] = "ok";

                    echo '<script> 
                     if(window.history.replaceState){
                         window.history.replaceState(null, null, window.location.href);
                     }

                     window.location = "menuDocente"

                 </script>';
                }
            } else {
                echo '<script> 
                 if(window.history.replaceState){
                     window.history.replaceState(null, null, window.location.href);
                 }
             </script>';
             echo "<script> 
             Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'El usuario no existe.',
                showConfirmButton: false,
                timer: 1500
              }) 
              </script>";

            }
        }
    }

    static public function ctrFormVisitas()
    {

        if (isset($_POST['registrarVisitas'])) {

            $ciclo = $_POST["interacciones"];

            if (
                !empty($_POST["periodo"]) && !empty($_POST["carrera"]) && !empty($_POST["materia"])
                && !empty($_POST["cantidadAlumnos"]) && !empty($_POST["tipoVisita"]) && !empty($_POST["transporte"]) && !empty($_POST["idDocente"])
                && !empty($_POST["nombreDocente"])  && !empty($_POST["correoDocente"])  && !empty($_POST["telefonoDocente"] && !empty($_POST["rfcDocente"]))
            ) {

                $tabla = "visitas";

                $periodo = mb_strtoupper($_POST["periodo"], 'utf-8');
                $carrera = mb_strtoupper($_POST["carrera"], 'utf-8');
                $asignatura = mb_strtoupper($_POST["materia"], 'utf-8');
                $cantidadAlumnos = $_POST["cantidadAlumnos"];
                $tipoVisita = mb_strtoupper($_POST["tipoVisita"], 'utf-8');
                $transporte = mb_strtoupper($_POST["transporte"], 'utf-8');
                $nombreDocente = mb_strtoupper($_POST["nombreDocente"], 'utf-8');
                $correoDocente = strtolower($_POST["correoDocente"]);
                $telefonoDocente = $_POST["telefonoDocente"];
                $rfcDocente = mb_strtoupper($_POST["rfcDocente"], 'utf-8');
                $idDocente = $_POST["idDocente"];

                $datos = array(
                    "periodo" => $periodo,
                    "carrera" => $carrera,
                    "asignatura" => $asignatura,
                    "cantidad_alumnos" => $cantidadAlumnos,
                    "tipo_visita" => $tipoVisita,
                    "transporte" => $transporte,
                    "nombre_docente" => $nombreDocente,
                    "correo_docente" => $correoDocente,
                    "telefono_docente" => $telefonoDocente,
                    "rfc_docente" => $rfcDocente,
                    "id_docente" => $idDocente,
                );

                $respuesta = ModeloDocente::mdlRegistroVisitas($tabla, $datos);

                if ($ciclo > 0) {

                    for ($i = 1; $i <= $ciclo; $i++) {

                        $nombreEmpresa = mb_strtoupper($_POST["nombreEmpresa" . $i . ""], 'utf-8');
                        $nombreEmpresaFiscal = mb_strtoupper($_POST["nombreFiscalEmpresa" . $i . ""], 'utf-8');
                        $rfcEmpresa = mb_strtoupper($_POST["rfcEmpresa" . $i . ""], 'utf-8');
                        $tipoEmpresa = mb_strtoupper($_POST["tipoEmpresa" . $i . ""], 'utf-8');
                        $areaEmpresa = mb_strtoupper($_POST["areaEmpresa" . $i . ""], 'utf-8');
                        $objetivoVisita = mb_strtoupper($_POST["objetivoVisita" . $i . ""], 'utf-8');
                        $observaciones = mb_strtoupper($_POST["observaciones" . $i . ""], 'utf-8');
                        $estadoEmpresa = mb_strtoupper($_POST["estadoEmpresa" . $i . ""], 'utf-8');
                        $ciudadEmpresa = mb_strtoupper($_POST["ciudadEmpresa" . $i . ""], 'utf-8');
                        $direccionEmpresa = mb_strtoupper($_POST["direccionEmpresa" . $i . ""], 'utf-8');
                        $nombreContacto = mb_strtoupper($_POST["nombreContacto" . $i . ""], 'utf-8');
                        $cargoContacto = mb_strtoupper($_POST["cargoContacto" . $i . ""], 'utf-8');
                        $correoContacto = strtolower($_POST["correoContacto" . $i . ""]);
                        $numeroContacto = $_POST["numeroContacto" . $i . ""];
                        $fechaInicio = $_POST["fechaInicio" . $i . ""];
                        $fechaFin = $_POST["fechaFin" . $i . ""];
                        $horaInicio = $_POST["horaInicio" . $i . ""];
                        $horaFin = $_POST["horaFin" . $i . ""];
                        $turnoEmpresa = mb_strtoupper($_POST["turnoEmpresa" . $i . ""], 'utf-8');

                        if ($respuesta == "exito") {

                            $docente = $_POST["idDocente"];
                            $maxVisita = ModeloDocente::mdlMaxVisita($tabla, $docente);

                            if (is_array($maxVisita)) {

                                $tabla2 = "visitas_detalles";
                                $folioMax = $maxVisita["folioMax"];

                                $datos2 =  array(
                                    "nombre_empresa" => $nombreEmpresa,
                                    "nombre_empresa_fiscal" => $nombreEmpresaFiscal,
                                    "rfc_empresa" => $rfcEmpresa,
                                    "tipo_empresa" => $tipoEmpresa,
                                    "area_empresa" => $areaEmpresa,
                                    "objetivo_visita" => $objetivoVisita,
                                    "observaciones" => $observaciones,
                                    "estado_empresa" => $estadoEmpresa,
                                    "ciudad_empresa" => $ciudadEmpresa,
                                    "direccion_empresa" => $direccionEmpresa,
                                    "nombre_contacto" => $nombreContacto,
                                    "cargo_contacto" => $cargoContacto,
                                    "correo_contacto" => $correoContacto,
                                    "numero_contacto" => $numeroContacto,
                                    "fecha_inicio" => $fechaInicio,
                                    "fecha_fin" => $fechaFin,
                                    "hora_inicio" => $horaInicio,
                                    "hora_fin" => $horaFin,
                                    "turno_empresa" => $turnoEmpresa,
                                    "folio_visita" => $folioMax,
                                );

                                // $hoy = getdate();

                                // $dia = $hoy["mday"];
                                // $mes = formatoFechaHoy($hoy["mon"]);
                                // $anio = $hoy["year"];

                                // $hora = $hoy["hours"];
                                // $minutos =  $hoy["minutes"];

                                // $fechaRegistro = $dia . " de " . $mes . " de " . $anio;
                                // $horaRegistro = $hora.":".$minutos."hrs.";

                                $Object = new DateTime();  
                                $fechaRegistro = $Object->format("d-m-Y"); 
                                $horaRegistro = $Object->format("h:i:s a");  
                                $fechaFormat = formatoFechas3($fechaRegistro);
                                
                                $cuerpo = '
                                Buen dia.<br> Se le notifica que ha registrado una visita el '.$fechaFormat.' a las '.$horaRegistro.'<br><br> Saludos.';
                                
                              
                            
                            
                            $mail = new PHPMailer(true);
                            
                            try {
                                
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'deptogestionyvinculacion@gmail.com';
                                $mail->Password = 'gestion*99';
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;
                            
                                $mail->setFrom('deptogestionyvinculacion@gmail.com', 'DEPARTAMENTO DE GESTIÓN TECNOLOGIA Y VINCULACIÓN');
                                $mail->addAddress($correoDocente);
                                // $mail->addCC();  ->> si se quiere enviar una copia
                            
                                $mail->isHTML(true);
                                $mail->Subject = 'Registro de visita';
                                $mail->Body = $cuerpo;
                                $mail->CharSet = 'UTF-8';
                                $mail->send();
                            } catch (Exception $e) {
                                echo $e;
                            }


                                $respuesta2 = ModeloDocente::mdlRegistroDetallesVisitas($tabla2, $datos2);
                            }
                        }
                    }

                    return $respuesta2;
                }
            } else {
                return "4"; 
            }
        }
    }

    static public function ctrListaVisitas()
    {
        $tabla = "visitas";
        $idDocente = $_SESSION['idDocente'];
        $respuesta = ModeloDocente::mdlListaVisitas($tabla, $idDocente);

        return $respuesta;
    }

    static public function ctrTablaVisitas($folio)
    {
        $respuesta = ModeloDocente::mdlTablaVisitas($folio);
        return $respuesta;
    }

    static public function ctrDatosCartaPresentacion1($folio){
        $respuesta = ModeloDocente::mdlDatosPDF1($folio);
        return $respuesta;
    }

    static public function ctrDatosCartaPresentacion2($id)
    {
        $respuesta = ModeloDocente::mdlDatosPDF2($id);
        return $respuesta;
    }


}

function formatoFechas3($fecha)
{

    $dia = date("d", strtotime($fecha));
    $mes = date("m", strtotime($fecha));
    $anio = date("Y", strtotime($fecha));
    $mes2 = "";

    switch ($mes) {
        case '01':
            $mes2 = "ENERO";
            break;
        case '02':
            $mes2 = "FEBRERO";
            break;
        case '03':
            $mes2 = "MARZO";
            break;
        case '04':
            $mes2 = "ABRIL";
            break;
        case '05':
            $mes2 = "MAYO";
            break;
        case '06':
            $mes2 = "JUNIO";
            break;
        case '07':
            $mes2 = "JULIO";
            break;
        case '08':
            $mes2 = "AGOSTO";
            break;
        case '09':
            $mes2 = "SEPTIEMBRE";
            break;
        case '10':
            $mes2 = "OCTUBRE";
            break;
        case '11':
            $mes2 = "NOVIEMBRE";
            break;
        case '12':
            $mes2 = "DICIEMBRE";
            break;
    }

    $fechaFormateada = $dia . "-" . $mes2 . "-" . $anio;


    return $fechaFormateada;
}


?>