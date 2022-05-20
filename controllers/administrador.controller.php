<?php

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
            if(!empty($_POST["usuarioAlta"]) && !empty($_POST["contraseñaAlta"]) && !empty($_POST["verificarAlta"])){
                //Encriptar la contraseña????????
                
                $tabla = "docente";
                $usuarioAdmin =  $_SESSION['usuario'];
                $usuarioAlta = $_POST["usuarioAlta"];

                $password = $_POST["contraseñaAlta"];
                $verificar = $_POST["verificarAlta"];

                if($password == $verificar){
                    
                $respuesta = ModeloAdministrador::mdlRegistrarUsuario($tabla, $usuarioAdmin, $usuarioAlta, $password);
        
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



}

?>