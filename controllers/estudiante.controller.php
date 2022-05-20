<?php

class ControlladorEstudiante
{
    static public function ctrFormRegistroEstudiante()
    {

        if (isset($_POST['registrarAlumno'])) {
            if (
                !empty($_POST["noControl"]) && !empty($_POST["nombres"]) && !empty($_POST["apellidos"])
                && !empty($_POST["correo"]) && !empty($_POST["nss"]) && !empty($_POST["password"])
                && !empty($_POST["passwordVerificar"])  && !empty($_POST["carrera"])  && !empty($_POST["sexo"])
            ) {

                $tabla = "estudiantes";


                $noControl = $_POST["noControl"];
                $nombres = mb_strtoupper($_POST["nombres"], 'utf-8');
                $apellidos = mb_strtoupper($_POST["apellidos"], 'utf-8');
                $correo = strtolower($_POST["correo"]);
                $nss = $_POST["nss"];
                $password = $_POST["password"];
                $passwordVerificar = $_POST["passwordVerificar"];
                $carrera = mb_strtoupper($_POST["carrera"], 'utf-8');
                $sexo = mb_strtoupper($_POST["sexo"], 'utf-8');



                if ($password != $passwordVerificar) {
                    return "1"; //el password no es el mismo 
                } else if (!is_numeric($nss) || !is_numeric($noControl)) {
                    return "2"; //no es valor numerico
                } else if (strlen($nss) != 11 || strlen($noControl) != 8) {
                    return "3"; //no es la longitud correcta
                } else {

                    $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

                    $datos = array(
                        "no_control" => $noControl,
                        "nombres" => $nombres,
                        "apellidos" => $apellidos,
                        "correo" => $correo,
                        "nss" => $nss,
                        "password" => $hash,
                        "carrera" => $carrera,
                        "sexo" => $sexo
                    );

                    $respuesta = ModeloEstudiante::mdlRegistroEstudiante($tabla, $datos);

                    return $respuesta;
                }
            } else {
                return "4";
            }
        }
    }

    public function ctrFormInicioEstudiante()
    {
        if (isset($_POST['ingresarEstudiante'])) {

            $tabla = "estudiantes";
            $correo = $_POST["correo"];
            $password = $_POST["password"];

            $respuesta = ModeloEstudiante::mdlInicioEstudiante($tabla, $correo, $password);

            if (is_array($respuesta)) {
                if ($respuesta["correo"] == $correo && password_verify($password, $respuesta["password"])) {

                    $_SESSION["no_control"] = $respuesta["no_control"];
                    $_SESSION["validarIngresoEstudiante"] = "ok";

                    echo '<script> 
                     if(window.history.replaceState){
                         window.history.replaceState(null, null, window.location.href);
                     }

                     window.location = "menuEstudiante"

                 </script>';
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

    static public function ctrListaVisitas()
    {
        $respuesta = ModeloEstudiante::mdlListaVisitas();
        return $respuesta;
    }

    static public function ctrListasEmpresas($id)
    {
        $respuesta = ModeloEstudiante::mdlListasEmpresas($id);
        return $respuesta;
    }

    static public function ctrRegistroVisitas()
    {
        if (isset($_POST['registrarseAVisita'])) {

            if (!empty($_POST["idVisita"])) {

                $folioVisita = $_POST["idVisita"];
                $noControl = $_SESSION["no_control"];
                $tabla = "alumnos_visitas";

                $respuesta = ModeloEstudiante::mdlRegistroVisitaEstudiante($tabla, $folioVisita, $noControl);

                return $respuesta;
            } else {
                return "1";
            }
        }
    }

    static public function ctrDatosEstudiante($nocontrol)
    {
        $tabla = "estudiantes";
        $respuesta = ModeloEstudiante::mdlDatos($tabla, $nocontrol);
        return $respuesta;
    }

    static public function ctrDatosEditar()
    {


        if (isset($_POST['editarDatosEstudiante'])) {

            if (
                !empty($_POST["controlEdit"]) && !empty($_POST["nombresEdit"]) && !empty($_POST["apellidosEdit"]) && !empty($_POST["correoEdit"]) && !empty($_POST["nssEdit"]) && !empty($_POST["carreraEdit"])  && !empty($_POST["sexoEdit"])
            ) {
                $tabla = "estudiantes";


                $noControl = $_POST["controlEdit"];
                $nombres = mb_strtoupper($_POST["nombresEdit"], 'utf-8');
                $apellidos = mb_strtoupper($_POST["apellidosEdit"], 'utf-8');
                $correo = strtolower($_POST["correoEdit"]);
                $nss = $_POST["nssEdit"];
                $carrera = mb_strtoupper($_POST["carreraEdit"], 'utf-8');
                $sexo = mb_strtoupper($_POST["sexoEdit"], 'utf-8');

                $datos = array(
                    "no_control" => $noControl,
                    "nombres" => $nombres,
                    "apellidos" => $apellidos,
                    "correo" => $correo,
                    "nss" => $nss,
                    "carrera" => $carrera,
                    "sexo" => $sexo
                );


                $respuesta = ModeloEstudiante::mdlEditarEstudiante($tabla, $datos);

                return $respuesta;
            } else {
                return "1";
            }
        }
        //$respuesta = ModeloEstudiante::mdlDatos($tabla);
        // return $respuesta;
    }

    static public function ctrVisitasRegistradas($nocontrol)
    {
        // $tabla = "alumnos_visitas";
        $respuesta = ModeloEstudiante::mdlVisitasRegistradasEstudiante($nocontrol);
        return $respuesta;
    }

    static public function ctrVisitasRegistradasDocumentos($nocontrol, $folio)
    {
        $respuesta = ModeloEstudiante::mdlVisitasRegistradasEstudianteDocumentos($nocontrol, $folio);
        return $respuesta;
    }

    static public function ctrRegistrarDocumentos()
    {
        if (isset($_POST['registrarDocumentos'])) {
            $return = '<script> 
             if(window.history.replaceState){
                 window.history.replaceState(null, null, window.location.href);
             }

             window.location = "visitasRegistradasEstudiante"

             </script>';
            $tabla = 'alumnos_visitas';
            $noControl =  $_SESSION["no_control"];
            $folio = $_POST['folio-doc'];
            $tipo = $_POST['tipo-doc'];
            
            $hoy = getdate();

            $dia = $hoy["mday"];
            $mes = $hoy["mon"];
            $anio = $hoy["year"];
            $hora = $hoy["hours"];
            $min = $hoy["minutes"];
            $seg = $hoy["seconds"];
            
            $result = $dia.$mes.$anio.$hora.$min.$seg;

            $ruta = $folio . "/" . $noControl;

          
             
             $directorio = "/storage/ssd5/262/18952262/public_html/public/pdf/" . $folio . "/";
             $directorio2 = "/storage/ssd5/262/18952262/public_html/public/pdf/" . $folio . "/" . $noControl . "/";

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
            
            if (!is_dir($directorio2)) {
                mkdir($directorio2, 0777, true);
            }
            
         
            $nombrePdf = $_FILES['pdfFile']['name'];
            $archivo2= $directorio2. basename($nombrePdf);
            $archivo = $directorio2 . $result . ".pdf";
            $tipoDocumento = strtolower(pathinfo($archivo2, PATHINFO_EXTENSION));

            if ($tipo == 'Permiso del padre o tutor') {
                $atributo = 'pdf_permiso_padre';


                if ($tipoDocumento == 'pdf') {

                    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $archivo)) {

                        $datos = array(
                            "no_control" => $noControl,
                            "folio_visita" => $folio,
                            "documento" => $archivo,
                        );

                        ModeloEstudiante::mdlSubirDocumentos($tabla, $atributo, $datos);

                        return $return;
                    } else {
                        return "3";
                    }
                }
            } else if ($tipo == 'NSS') {
                $atributo = 'pdf_nss';
                if ($tipoDocumento == 'pdf') {

                    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $archivo)) {

                        $datos = array(
                            "no_control" => $noControl,
                            "folio_visita" => $folio,
                            "documento" => $archivo,
                        );

                        ModeloEstudiante::mdlSubirDocumentos($tabla, $atributo, $datos);

                        return $return;
                    } else {
                        return "3";
                    }
                }
            } else {
                $atributo = 'pdf_credencial';
                if ($tipoDocumento == 'pdf') {

                    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $archivo)) {

                        $datos = array(
                            "no_control" => $noControl,
                            "folio_visita" => $folio,
                            "documento" => $archivo,
                        );

                        ModeloEstudiante::mdlSubirDocumentos($tabla, $atributo, $datos);

                        return $return;
                    } else {
                        return "3";
                    }
                }
            }
        }
    }

    static public function ctrEliminarDocumentos($documento, $folio_visita, $tipo, $control)
    {

        $tabla = 'alumnos_visitas';
        $noControl = $control;
        $folio = $folio_visita;
        $update = "NO DOCUMENTO";
        $atributo = "";

        if ($tipo == 'Permiso del padre o tutor') {
            $atributo = 'pdf_permiso_padre';
        } else if ($tipo == 'NSS') {
            $atributo = 'pdf_nss';
        } else {
            $atributo = 'pdf_credencial';
        }

        $file_name = $documento;
        $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
        $file_delete =  $file_name;
        
       // return $file_delete;
        if (file_exists($file_delete)) {
            if (unlink($file_delete)) {

                $datos = array(
                    "no_control" => $noControl,
                    "folio_visita" => $folio,
                    "documento" => $update,
                );

                $respuesta = ModeloEstudiante::mdlEliminarDocumentos($tabla, $atributo, $datos);

                if ($respuesta == "exito") {
                    return "ok";
                }
            }
        } 
    }

    static public function ctrDatosPDF1($noControl, $folio){
        $respuesta = ModeloEstudiante::mdlDatosPDF1($noControl , $folio);
        return $respuesta;
    }

    static public function ctrDatosFormatoVisitaPDF($folio){
        $respuesta = ModeloEstudiante::mdlDatosPDF2($folio);
        return $respuesta;
    }

    static public function ctrDatosEmpresasFormatoVisitaPDF($id)
    {
        $respuesta = ModeloEstudiante::mdlListasEmpresasPDF($id);
        return $respuesta;
    }
}
