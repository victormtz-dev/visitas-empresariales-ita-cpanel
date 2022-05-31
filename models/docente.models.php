<?php

require_once "conexion.php";

class ModeloDocente{



    static public function mdlInicioDocente($tabla, $usuario, $password){

        try {
            $stmt = DB::conectar()->prepare("SELECT id_docente, usuario, password FROM $tabla WHERE usuario = :usuario and password = :password and estatus = 'ALTA' and rol = 'DOCENTE'");
    
             $stmt->bindParam(":usuario", $usuario, PDO::PARAM_INT);
             $stmt->bindParam(":password", $password, PDO::PARAM_STR);
     
             $stmt->execute();
    
            return  $stmt-> fetch();
            $stmt->closeCursor();
            $stmt = null;

        }catch(Exception $e) {
            return "error"; 
        } 
    }


    static public function mdlRegistroVisitas($tabla, $datos){
        try{
            $stmt = DB::conectar()->prepare("INSERT INTO $tabla(periodo, carrera, asignatura, cantidad_alumnos, lugares_disponibles, tipo_visita, transporte, nombre_docente, correo_docente, telefono_docente, rfc_docente, id_docente) VALUES (:periodo, :carrera, :asignatura, :cantidad_alumnos,  :lugares_disponibles, :tipo_visita, :transporte,
            :nombre_docente, :correo_docente, :telefono_docente, :rfc_docente, :id_docente)");
            
            $stmt->bindParam(":periodo", $datos["periodo"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
            $stmt->bindParam(":asignatura", $datos["asignatura"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad_alumnos", $datos["cantidad_alumnos"], PDO::PARAM_INT);
            $stmt->bindParam(":lugares_disponibles", $datos["cantidad_alumnos"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo_visita", $datos["tipo_visita"], PDO::PARAM_STR);
            $stmt->bindParam(":transporte", $datos["transporte"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_docente", $datos["nombre_docente"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_docente", $datos["correo_docente"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono_docente", $datos["telefono_docente"], PDO::PARAM_INT);
            $stmt->bindParam(":rfc_docente", $datos["rfc_docente"], PDO::PARAM_STR);
            $stmt->bindParam(":id_docente", $datos["id_docente"], PDO::PARAM_INT);


            if($stmt->execute()){
                return "exito";
                $stmt->closeCursor();
                $stmt = null;
            }else{
                return "error";
                $stmt->closeCursor();
                $stmt = null;
            }

        }catch(Exception $e) {
            return "error"; 
        } 

    }


    static public function mdlRegistroDetallesVisitas($tabla, $datos){

        try{
            $stmt = DB::conectar()->prepare("INSERT INTO $tabla(nombre_empresa, nombre_empresa_fiscal, rfc_empresa, tipo_empresa, area_empresa, objetivo_visita, observaciones, estado_empresa, ciudad_empresa, direccion_empresa, nombre_contacto, cargo_contacto, correo_contacto, numero_contacto, fecha_inicio, fecha_fin, hora_inicio, hora_fin, turno_empresa, folio_visita) VALUES (:nombre_empresa, :nombre_empresa_fiscal, :rfc_empresa, :tipo_empresa, :area_empresa, :objetivo_visita, :observaciones, :estado_empresa, :ciudad_empresa, :direccion_empresa, :nombre_contacto, :cargo_contacto, :correo_contacto, :numero_contacto, :fecha_inicio, :fecha_fin, :hora_inicio, :hora_fin, :turno_empresa, :folio_visita)");
            
            $stmt->bindParam(":nombre_empresa", $datos["nombre_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_empresa_fiscal", $datos["nombre_empresa_fiscal"], PDO::PARAM_STR);
            $stmt->bindParam(":rfc_empresa", $datos["rfc_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_empresa", $datos["tipo_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":area_empresa", $datos["area_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":objetivo_visita", $datos["objetivo_visita"], PDO::PARAM_STR);
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_empresa", $datos["estado_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":ciudad_empresa", $datos["ciudad_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion_empresa", $datos["direccion_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_contacto", $datos["nombre_contacto"], PDO::PARAM_STR);
            $stmt->bindParam(":cargo_contacto", $datos["cargo_contacto"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_contacto", $datos["correo_contacto"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_contacto", $datos["numero_contacto"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_inicio", $datos["hora_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":hora_fin", $datos["hora_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":turno_empresa", $datos["turno_empresa"], PDO::PARAM_STR);
            $stmt->bindParam(":folio_visita", $datos["folio_visita"], PDO::PARAM_INT);


            if($stmt->execute()){
                return "exito";
                $stmt->closeCursor();
            $stmt = null;
            }else{
                return "error";
                $stmt->closeCursor();
            $stmt = null;
            }

        }catch(Exception $e) {
            return "error";
        } 

    }


    static public function mdlMaxVisita($tabla, $IDdocente){

        try {
            $stmt = DB::conectar()->prepare("SELECT MAX(folio_visita) as folioMax FROM $tabla WHERE id_docente = :id_docente");
            $stmt->bindParam(":id_docente", $IDdocente, PDO::PARAM_INT);
            $stmt->execute();
    
            return  $stmt-> fetch();

            $stmt->closeCursor();
            $stmt = null;

        }catch(Exception $e) {
            return "error"; 
        } 
    }

    
    static public function mdlListaVisitas($tabla, $id){
        try{
            $stmt = DB::conectar()->prepare("SELECT folio_visita, periodo FROM $tabla WHERE id_docente = :id_docente");
            $stmt->bindParam(":id_docente", $id, PDO::PARAM_INT);
            $stmt->execute();
    
            return  $stmt-> fetchAll();

        }catch(Exception $e) {
            return "error"; 
        } finally{
            $stmt->closeCursor();
            $stmt = null;
        }

    }


    static public function mdlTablaVisitas($folio){
        try{

            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.folio_visita, visitas_detalles.nombre_empresa, visitas_detalles.ciudad_empresa, visitas_detalles.fecha_inicio, visitas_detalles.fecha_fin, visitas.estatus_visita FROM visitas_detalles, visitas WHERE visitas.folio_visita = visitas_detalles.folio_visita and visitas_detalles.folio_visita = :folio_visita");
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

    static public function mdlDatosPDF1($folio)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT folio_visita, nombre_docente, carrera, cantidad_alumnos, lugares_disponibles FROM visitas WHERE folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlDatosPDF2($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.nombre_contacto, visitas_detalles.nombre_empresa, visitas_detalles.estado_empresa, visitas_detalles.ciudad_empresa, visitas_detalles.objetivo_visita, visitas_detalles.fecha_inicio, visitas_detalles.turno_empresa
            FROM visitas_detalles WHERE visitas_detalles.id_detalles = :detalles");
            $stmt->bindParam(":detalles", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }



}


?>