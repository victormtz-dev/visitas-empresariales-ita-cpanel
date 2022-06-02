<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/visitas/views/libs/libreria/PHPmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/visitas/views/libs/libreria/PHPmailer/src/SMTP.php';
require 'C:/xampp/htdocs/visitas/views/libs/libreria/PHPmailer/src/Exception.php';

/*
require '/home4/conveni2/public_html/visitass/views/libs/libreria/PHPmailer/src/PHPMailer.php';
require '/home4/conveni2/public_html/visitass/views/libs/libreria/PHPmailer/src/SMTP.php';
require '/home4/conveni2/public_html/visitass/views/libs/libreria/PHPmailer/src/Exception.php';
*/

Class ControlladorAdministrador {

    public function ctrFormInicioAdministrador() { 
        if(isset($_POST['ingresarAdmin'])){

            $tabla = "docente";
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $respuesta = ModeloAdministrador::mdlInicioAdministrador($tabla, $usuario, $password);


          if(is_array($respuesta)){
            if($respuesta["usuario"] == $usuario && $respuesta["password"] == $password){
               
                $_SESSION['validarIngresoAdmin'] = "ok";
                $_SESSION['idAdmin'] = $respuesta["id_docente"];
                $_SESSION['usuario'] = $respuesta["usuario"];

                echo '<script> 
                     if(window.history.replaceState){
                         window.history.replaceState(null, null, window.location.href);
                     }

                     window.location = "menuAdmin"

                 </script>';

       
            }
          }else {
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

    static public function ctrSelectPeriodo(){
        $tabla = "periodo";
        $respuesta = ModeloAdministrador::mdlSelectPeriodo($tabla);

        if(is_array($respuesta)){

            return $respuesta;

        }

    }

    static public function ctrTablaPeriodos(){
        $respuesta = ModeloAdministrador::mdlTablaPeriodo();

        if(is_array($respuesta)){
            return $respuesta;
        }

    }

    static public function ctrRegistroPeriodos(){
        if (isset($_POST['registrarPeriodo'])) {
            if(!empty($_POST["periodoAlta"])){
                $tabla = "periodo";
                $idDocente =  $_SESSION['idAdmin'];
            
                $descripcion = $_POST["periodoAlta"];

                $respuesta = ModeloAdministrador::mdlRegistrarPeriodo($tabla, $idDocente, $descripcion);
        
                return $respuesta;

            }else {
                return "1";
            }

        }

    }

    static public function ctrCambiarEstatusPeriodo($estatus, $clave)
    {
        $tabla = "periodo";
        $respuesta = ModeloAdministrador::mdlCambiarEstatusPeriodo($tabla, $estatus, $clave);
        return $respuesta;
    }

    static public function ctrTablaUsuarios(){
        $respuesta = ModeloAdministrador::mdlTablaUsuario();

        if(is_array($respuesta)){
            return $respuesta;
        }

    }

    static public function ctrRegistroUsuarios(){
        if (isset($_POST['registrarUsuario'])) {
            if(!empty($_POST["usuarioAlta"]) && !empty($_POST["contraseñaAlta"]) && !empty($_POST["verificarAlta"])
            && !empty($_POST["CorreoAlta"])){
                
                
                $tabla = "docente";
                $usuarioAdmin =  $_SESSION['usuario'];
                $usuarioAlta = $_POST["usuarioAlta"];
                $correo = $_POST["CorreoAlta"];
                $password = $_POST["contraseñaAlta"];
                $verificar = $_POST["verificarAlta"];
               

                if($password == $verificar){
                    
                    $respuesta = ModeloAdministrador::mdlRegistrarUsuario($tabla, $usuarioAdmin, $usuarioAlta, $password, $correo);
                    $cuerpo = '
                    Buen dia.<br> Sus credenciales para acceder a <a href="http://mx64.prueba.site/~conveni2/visitass/inicioDocente" target="_blank">Visitas Empresariales</a> son las siguientes: <br><br> USUARIO: <strong>'.$usuarioAlta.'</strong> <br> CONTRASEÑA: <strong>'.$password.'</strong><br><br> Saludos.';
                    
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
                        $mail->addAddress($correo);
                    
                        $mail->isHTML(true);
                        $mail->Subject = 'Credenciales para registro de visitas empresariales';
                        $mail->Body = $cuerpo;
                        $mail->CharSet = 'UTF-8';
                        $mail->send();
                    } catch (Exception $e) {
                    echo $e;
                    }
                


                return $respuesta;
                }else {
                    return "2";
                }

                

            }else {
                return "1";
            }

        }

    }


    static public function ctrCambiarEstatusUsuario($estatus, $clave)
    {
        $tabla = "docente";
        $respuesta = ModeloAdministrador::mdlCambiarEstatusUsuario($tabla, $estatus, $clave);
        return $respuesta;
    }

    static public function ctrListasVisitas()
    {
        $respuesta = ModeloAdministrador::mdlListasVisitas();
        return $respuesta;
    }

    static public function ctrVisitasDocente($folio){
        $respuesta = ModeloAdministrador::mdlDatosDocente($folio);
        return $respuesta;
    }

    static public function ctrVisitasEmpresas($id)
    {
        $respuesta = ModeloAdministrador::mdlDatosEmpresas($id);
        return $respuesta;
    }

    
    static public function ctrEstatusVisita()
    {
        if (isset($_POST['editarEstatusVisita'])) {
            if(!empty($_POST["folio"]) && !empty($_POST["estatusEdit"])){

                
                $tabla = "visitas";

                $folio = $_POST["folio"];
                $estatus = $_POST["estatusEdit"];

                    
                $respuesta = ModeloAdministrador::mdlEstatusVisita($tabla, $folio, $estatus);
        
                return $respuesta;
            //return $folio;
                

            }else {
                return "1";
            }

        }
    }

    static public function ctrRestaurarPassword()
    {
        if (isset($_POST['nuevoPassword'])) {
            if(!empty($_POST["idUsuario"]) && !empty($_POST["passwordNuevo"]) && !empty($_POST["verificarNuevo"])){

                
                $tabla = "docente";
                $usuario =  $_POST["idUsuario"];

                $password = $_POST["passwordNuevo"];
                $verificar = $_POST["verificarNuevo"];

                if($password == $verificar){
                    
                $respuesta = ModeloAdministrador::mdlRestaurarPass($tabla, $usuario, $password);
                $respuesta2 = ModeloAdministrador::mdlUsuarioCorreo($tabla, $usuario);
                $correo = $respuesta2['correo'];
                $usser =  $respuesta2['usuario'];
                
                $cuerpo = '
                Buen dia.<br> Se le notifica que su contraseña ha cambiado. Sus credenciales son las siguientes: <br><br> USUARIO: <strong>'.$usser.'</strong> <br> NUEVA CONTRASEÑA: <strong>'.$password.'</strong><br><br> Para verificar, entra al siguiente link --> <a href="http://mx64.prueba.site/~conveni2/visitass/inicioDocente" target="_blank">Visitas Empresariales</a>';
                
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
                    $mail->addAddress($correo);
                
                    $mail->isHTML(true);
                    $mail->Subject = 'Restauracion de contraseña';
                    $mail->Body = $cuerpo;
                    $mail->CharSet = 'UTF-8';
                    $mail->send();
                } catch (Exception $e) {
                echo $e;
                }
                return $respuesta;
                }else {
                    return "2";
                }

                

            }else {
                return "1";
            }

        }
    }


    static public function ctrDatosEmpresas($folio)
    {
        $respuesta = ModeloAdministrador::mdlTablaEmpresas($folio);
        return $respuesta;
    }

    static public function ctrCountAlumnos($id, $sexo)
    {
        $genero = '';

        if($sexo == 'MASCULINO'){
            $genero = 'MASCULINO';
            $respuesta = ModeloAdministrador::mdlTotalAlumnos($id, $genero);
            return $respuesta;

        }else if($sexo == 'FEMENINO'){
            $genero = 'FEMENINO';
            $respuesta = ModeloAdministrador::mdlTotalAlumnos($id, $genero);
            return $respuesta;
        }else{
            $genero = 'NINGUNO';
            $respuesta = ModeloAdministrador::mdlTotalAlumnos($id, $genero);
            return $respuesta;

        }
    }

    static public function ctrListaAlumnos($id)
    {
        $respuesta = ModeloAdministrador::mdlListaAlumnos($id);
        return $respuesta;

    }

    static public function ctrAlumnosPorVisita($folio)
    {
        $respuesta = ModeloAdministrador::mdlAlumnosPorVisita($folio);
        return $respuesta;
    }

    static public function ctrAlumnos()
    {   
        $tabla = 'estudiantes';
        $respuesta = ModeloAdministrador::mdlAlumnos($tabla);
        return $respuesta;
    }

    static public function ctrRestaurarPasswordAlumno()
    {
        if (isset($_POST['nuevoPasswordA'])) {
            if(!empty($_POST["noControl"]) && !empty($_POST["passwordNuevoA"]) && !empty($_POST["verificarNuevoA"])){

                
                $tabla = "estudiantes";
                $usuario =  $_POST["noControl"];

                $password = $_POST["passwordNuevoA"];
                $verificar = $_POST["verificarNuevoA"];

                if($password == $verificar){
                $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
                $respuesta = ModeloAdministrador::mdlRestaurarPassAlumno($tabla, $usuario, $hash);
                $respuesta2 = ModeloAdministrador::mdlAlumnoCorreo($tabla, $usuario);
                $correo = $respuesta2['correo'];

                
                $cuerpo = '
                Buen dia Alumno.<br> Se le notifica que su contraseña ha cambiado. Sus credenciales son las siguientes: <br><br> CORREO: <strong>'.$correo.'</strong> <br> NUEVA CONTRASEÑA: <strong>'.$password.'</strong><br> NUMERO DE CONTROL: <strong>'.$usuario.'</strong><br><br> Para verificar, entra al siguiente link --> <a href="http://mx64.prueba.site/~conveni2/visitass/inicioEstudiante" target="_blank">Visitas Empresariales</a>';
                
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
                    $mail->addAddress($correo);
                
                    $mail->isHTML(true);
                    $mail->Subject = 'Restauracion de contraseña';
                    $mail->Body = $cuerpo;
                    $mail->CharSet = 'UTF-8';
                    $mail->send();
                } catch (Exception $e) {
                echo $e;
                }
                return $respuesta;
                }else {
                    return "2";
                }

                

            }else {
                return "1";
            }

        }
    }

}

?>
