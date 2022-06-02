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

            $stmt = DB::conectar()->prepare("SELECT DISTINCT visitas.folio_visita, visitas.periodo, visitas.carrera, visitas_detalles.fecha_inicio, visitas.asignatura, visitas.cantidad_alumnos, visitas.lugares_disponibles, visitas.tipo_visita, visitas.transporte, visitas.nombre_docente, visitas.correo_docente, visitas.telefono_docente, visitas.rfc_docente, visitas.estatus_visita, visitas.fecha_creacion
            FROM visitas, visitas_detalles
            WHERE visitas.folio_visita = visitas_detalles.folio_visita
            ORDER BY folio_visita DESC");
            
            $stmt->execute();
            return $stmt-> fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        }catch(Exception $e) {
            return "error"; 
        } 

    }

    static public function mdlDatosDocente($folio)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT * FROM visitas WHERE folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlDatosEmpresas($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.nombre_empresa, visitas_detalles.nombre_empresa_fiscal, visitas_detalles.tipo_empresa, visitas_detalles.nombre_contacto, visitas_detalles.cargo_contacto, visitas_detalles.numero_contacto, visitas_detalles.objetivo_visita, visitas_detalles.area_empresa, visitas_detalles.observaciones, visitas_detalles.fecha_inicio, visitas_detalles.fecha_fin, visitas_detalles.hora_fin, visitas_detalles.hora_inicio
            FROM visitas, visitas_detalles WHERE visitas.folio_visita = visitas_detalles.folio_visita and visitas_detalles.folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlEstatusVisita($tabla, $folio, $estatus)
    {
        try {
            $stmt = DB::conectar()->prepare("UPDATE $tabla SET estatus_visita = :estatus WHERE folio_visita = :folio_visita");

            $stmt->bindParam(":estatus", $estatus, PDO::PARAM_STR);
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

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
            return $e;
        }
    }

    static public function mdlRestaurarPass($tabla, $usuario, $password)
    {
        try {
            $stmt = DB::conectar()->prepare("UPDATE $tabla SET password = :password WHERE id_docente = :id_docente");

            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":id_docente", $usuario, PDO::PARAM_INT);

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
            return $e;
        }
    }


    static public function mdlTablaEmpresas($folio){
        try{

            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.id_detalles, visitas_detalles.folio_visita, visitas_detalles.nombre_empresa, visitas_detalles.nombre_contacto,visitas_detalles.fecha_inicio, visitas_detalles.fecha_fin FROM visitas_detalles, visitas WHERE visitas.folio_visita = visitas_detalles.folio_visita and visitas_detalles.folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt-> fetchAll();

        }catch(Exception $e) {
            return "error"; 
        } finally{
            $stmt->closeCursor();
            $stmt = null;
        }

    }

    
    static public function mdlTotalAlumnos($id, $sexo)
    {
        try {
            if($sexo == 'MASCULINO' || $sexo == 'FEMENINO'){

            $stmt = DB::conectar()->prepare("SELECT COUNT(estudiantes.sexo) as numero
            FROM estudiantes, alumnos_visitas
            WHERE estudiantes.no_control = alumnos_visitas.no_control and alumnos_visitas.folio_visita = :folio and estudiantes.sexo = :sexo");
            $stmt->bindParam(":folio", $id, PDO::PARAM_INT);
            $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;

            }else{

                $stmt = DB::conectar()->prepare("SELECT COUNT(estudiantes.sexo) as numero
                FROM estudiantes, alumnos_visitas
                WHERE estudiantes.no_control = alumnos_visitas.no_control and alumnos_visitas.folio_visita = :folio");
                $stmt->bindParam(":folio", $id, PDO::PARAM_INT);
    
                $stmt->execute();
    
                return  $stmt->fetch();
    
                $stmt->closeCursor();
                $stmt = null;

            }
        
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlListaAlumnos($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT estudiantes.no_control, estudiantes.nombres, estudiantes.apellidos, estudiantes.carrera, estudiantes.nss
            FROM estudiantes, alumnos_visitas
            WHERE estudiantes.no_control = alumnos_visitas.no_control and alumnos_visitas.folio_visita = :folio ORDER BY estudiantes.no_control ASC");
            $stmt->bindParam(":folio", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlAlumnosPorVisita($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT estudiantes.no_control, estudiantes.nombres, estudiantes.apellidos, estudiantes.carrera,estudiantes.sexo
            FROM estudiantes, alumnos_visitas
            WHERE estudiantes.no_control = alumnos_visitas.no_control and alumnos_visitas.folio_visita = :folio ORDER BY estudiantes.no_control ASC");
            $stmt->bindParam(":folio", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlAlumnos($tabla)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT no_control, nombres, apellidos, correo, estatus, estatus_editar
            FROM $tabla
            ORDER BY no_control ASC");

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }


}
