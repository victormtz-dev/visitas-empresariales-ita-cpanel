<?php

require_once "conexion.php";

class ModeloAdministrador
{



    static public function mdlInicioAdministrador($tabla, $usuario, $password)
    {

        try {
            $stmt = DB::conectar()->prepare("SELECT * FROM $tabla WHERE usuario = :usuario and password = :password and estatus = 'ALTA' and rol = 'ADMINISTRADOR'");

            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlSelectPeriodo($tabla)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT descripcion FROM $tabla WHERE estatus = 'ALTA'");
            $stmt->execute();
            return  $stmt->fetchAll();
        } catch (Exception $e) {
            return "error";
        } finally {
            $stmt->closeCursor();
            $stmt = null;
        }
    }

    static public function mdlTablaPeriodo()
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT periodo.id_periodo, periodo.descripcion, docente.usuario, periodo.fecha_registro, periodo.estatus FROM periodo, docente WHERE periodo.id_docente = docente.id_docente");
            $stmt->execute();
            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlRegistrarPeriodo($tabla, $idDocente, $descripcion)
    {
        try {
            $stmt = DB::conectar()->prepare("INSERT INTO $tabla(descripcion, id_docente) VALUES (:descripcion, :id_docente)");
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":id_docente", $idDocente, PDO::PARAM_INT);


            if ($stmt->execute()) {
                return "exito";
                $stmt->closeCursor();
                $stmt = null;
            } else {
                return "error";
                $stmt->closeCursor();
                $stmt = null;
            }
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlCambiarEstatusPeriodo($tabla, $estatus, $clave)
    {
        try {

            if($estatus == 1){
                $stmt = DB::conectar()->prepare("UPDATE $tabla SET estatus = 'BAJA' WHERE id_periodo = :id_periodo");
                $stmt->bindParam(":id_periodo", $clave, PDO::PARAM_INT);
            }else {
                $stmt = DB::conectar()->prepare("UPDATE $tabla SET estatus = 'ALTA' WHERE id_periodo = :id_periodo");
                $stmt->bindParam(":id_periodo", $clave, PDO::PARAM_INT);
            }

            if ($stmt->execute()) {
                return "exito";
                $stmt->closeCursor();
            $stmt = null;
            } else {
                return "error";
                $stmt->closeCursor();
            $stmt = null;
            }
        } catch (Exception $e) {
            return "error";
        } 
    }


    static public function mdlTablaUsuario()
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT id_docente, usuario, password, estatus, usuario_registro, fecha_registro FROM  docente WHERE rol = 'DOCENTE'");
            $stmt->execute();
            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlRegistrarUsuario($tabla, $usuarioAdmin, $usuarioDocente, $password)
    {
        try {
            $stmt = DB::conectar()->prepare("INSERT INTO $tabla(usuario, usuario_registro, password, rol) VALUES (:usuario, :usuario_registro, :password, 'DOCENTE')");

            $stmt->bindParam(":usuario", $usuarioDocente, PDO::PARAM_STR);
            $stmt->bindParam(":usuario_registro", $usuarioAdmin, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);


            if ($stmt->execute()) {
                return "exito";
                $stmt->closeCursor();
                $stmt = null;
            } else {
                return "error";
                $stmt->closeCursor();
                $stmt = null;
            }
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlCambiarEstatusUsuario($tabla, $estatus, $clave)
    {
        try {

            if($estatus == 1){
                $stmt = DB::conectar()->prepare("UPDATE $tabla SET estatus = 'BAJA' WHERE id_docente = :id_docente");
                $stmt->bindParam(":id_docente", $clave, PDO::PARAM_INT);
            }else {
                $stmt = DB::conectar()->prepare("UPDATE $tabla SET estatus = 'ALTA' WHERE id_docente = :id_docente");
                $stmt->bindParam(":id_docente", $clave, PDO::PARAM_INT);
            }

            if ($stmt->execute()) {
                return "exito";
                $stmt->closeCursor();
            $stmt = null;
            } else {
                return "error";
                $stmt->closeCursor();
            $stmt = null;
            }
        } catch (Exception $e) {
            return "error";
        } 
    }

    static public function mdlListasVisitas(){
        try{

            $stmt = DB::conectar()->prepare("SELECT folio_visita, periodo, carrera, asignatura, cantidad_alumnos, lugares_disponibles, tipo_visita, transporte, nombre_docente, correo_docente, telefono_docente, rfc_docente, estatus_visita, fecha_creacion FROM visitas ORDER BY folio_visita DESC");
            
            $stmt->execute();
            return $stmt-> fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        }catch(Exception $e) {
            return "error"; 
        } 

    }


}
