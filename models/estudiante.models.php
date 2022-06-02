<?php

require_once "conexion.php";

class ModeloEstudiante
{

    static public function mdlRegistroEstudiante($tabla, $datos)
    {


        try {
            $stmt = DB::conectar()->prepare("INSERT INTO $tabla(no_control, nombres, apellidos, correo, carrera, sexo, nss, password) VALUES (:no_control, :nombres, :apellidos, :correo, :carrera, :sexo, :nss, :password)");

            $stmt->bindParam(":no_control", $datos["no_control"], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
            $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
            $stmt->bindParam(":nss", $datos["nss"], PDO::PARAM_INT);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

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

    static public function mdlInicioEstudiante($tabla, $correo)
    {

        try {
            $stmt = DB::conectar()->prepare("SELECT no_control, correo, password FROM $tabla WHERE correo = :correo and estatus = 'ALTA'");
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->execute();

            return  $stmt->fetch();
            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlListaVisitas()
    {
        try {

            $stmt = DB::conectar()->prepare("SELECT visitas.nombre_docente, visitas.asignatura, visitas.correo_docente, visitas.folio_visita, visitas.periodo, visitas.carrera, visitas.lugares_disponibles
            FROM visitas, periodo
            WHERE visitas.estatus_visita = 'ACEPTADA' and periodo.descripcion = visitas.periodo and periodo.estatus = 'ALTA' GROUP BY visitas.folio_visita DESC");
            $stmt->execute();

            return  $stmt->fetchAll();
            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlListasEmpresas($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.nombre_empresa, visitas_detalles.estado_empresa, visitas_detalles.ciudad_empresa, visitas_detalles.fecha_inicio, visitas_detalles.fecha_fin, visitas_detalles.hora_inicio FROM visitas, visitas_detalles where visitas.folio_visita = visitas_detalles.folio_visita and visitas.estatus_visita = 'ACEPTADA' and visitas_detalles.folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlRegistroVisitaEstudiante($tabla, $folio, $nocontrol, $datos)
    {


        try {

            $stmt = DB::conectar()->prepare("SELECT no_control FROM $tabla WHERE no_control = :no_control and folio_visita = :folio_visita");
            $stmt->bindParam(":no_control", $nocontrol, PDO::PARAM_INT);
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->fetch()) {
                return "existe";
            } else {
                $stmt = DB::conectar()->prepare("INSERT INTO $tabla(no_control, folio_visita, semestre_cursando, telefono_alumno, nombre_tutor, telefono_tutor) VALUES (:no_control, :folio_visita, :semestre_cursando, :telefono_alumno, :nombre_tutor, :telefono_tutor)");

                $stmt->bindParam(":no_control", $nocontrol, PDO::PARAM_INT);
                $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);
                $stmt->bindParam(":semestre_cursando", $datos['semestre_cursando'], PDO::PARAM_STR);
                $stmt->bindParam(":telefono_alumno", $datos['telefono_alumno'], PDO::PARAM_STR);
                $stmt->bindParam(":nombre_tutor", $datos['nombre_tutor'], PDO::PARAM_STR);
                $stmt->bindParam(":telefono_tutor", $datos['telefono_tutor'], PDO::PARAM_STR);


                if ($stmt->execute()) {
                    $stmt = DB::conectar()->prepare("UPDATE visitas SET lugares_disponibles = lugares_disponibles - 1 WHERE folio_visita = :folio_visita");
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
                } else {
                    return "error";
                    $stmt->closeCursor();
                    $stmt = null;
                }
            }
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlDatos($tabla, $id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT no_control, nombres, apellidos, correo, carrera, sexo, nss, estatus_editar FROM $tabla WHERE no_control = :no_control and estatus = 'ALTA'");
            $stmt->bindParam(":no_control", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlEditarEstudiante($tabla, $datos)
    {


        try {
            $stmt = DB::conectar()->prepare("UPDATE $tabla SET nombres=:nombres,apellidos=:apellidos,correo=:correo,carrera=:carrera,sexo=:sexo,nss=:nss,estatus_editar='EDITADO' WHERE no_control=:no_control
            ");

            $stmt->bindParam(":no_control", $datos["no_control"], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
            $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
            $stmt->bindParam(":nss", $datos["nss"], PDO::PARAM_INT);

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

    static public function mdlVisitasRegistradasEstudiante($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT alumnos_visitas.folio_visita, visitas.nombre_docente, visitas.periodo, visitas.asignatura FROM alumnos_visitas, visitas, periodo WHERE alumnos_visitas.folio_visita = visitas.folio_visita AND alumnos_visitas.no_control = :no_control AND visitas.estatus_visita IN ('ACEPTADA', 'EN CURSO') AND visitas.periodo = periodo.descripcion AND periodo.estatus = 'ALTA' GROUP BY alumnos_visitas.folio_visita DESC");
            $stmt->bindParam(":no_control", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlVisitasRegistradasEstudianteDocumentos($id, $folio)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT alumnos_visitas.folio_visita, alumnos_visitas.pdf_permiso_padre, alumnos_visitas.pdf_nss, alumnos_visitas.pdf_credencial FROM alumnos_visitas, visitas WHERE alumnos_visitas.folio_visita = visitas.folio_visita AND alumnos_visitas.no_control = :no_control AND 
            alumnos_visitas.folio_visita = :folio_visita AND visitas.estatus_visita in ('ACEPTADA', 'EN CURSO') AND alumnos_visitas.estatus = 'ALTA' ");
            $stmt->bindParam(":no_control", $id, PDO::PARAM_INT);
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return  $stmt->fetch();
            } else {
                return "error";
            }


            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }


    static public function mdlSubirDocumentos($tabla, $atributo, $datos)
    {
        try {
            $stmt = DB::conectar()->prepare("UPDATE $tabla SET $atributo = :urldocumento WHERE no_control = :no_control AND folio_visita = :folio_visita");
            $stmt->bindParam(":urldocumento", $datos["documento"], PDO::PARAM_STR);
            $stmt->bindParam(":no_control", $datos["no_control"], PDO::PARAM_INT);
            $stmt->bindParam(":folio_visita", $datos["folio_visita"], PDO::PARAM_INT);


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

    static public function mdlEliminarDocumentos($tabla, $atributo, $datos)
    {
        try {
            $stmt = DB::conectar()->prepare("UPDATE $tabla SET $atributo = :documento WHERE no_control = :no_control AND folio_visita = :folio_visita");
            $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
            $stmt->bindParam(":no_control", $datos["no_control"], PDO::PARAM_INT);
            $stmt->bindParam(":folio_visita", $datos["folio_visita"], PDO::PARAM_INT);


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

    static public function mdlDatosPDF1($noControl, $folio)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT visitas.nombre_docente, visitas.asignatura, visitas.carrera, estudiantes.nombres, estudiantes.apellidos, estudiantes.no_control FROM alumnos_visitas, visitas, estudiantes WHERE alumnos_visitas.no_control = estudiantes.no_control AND alumnos_visitas.folio_visita = visitas.folio_visita AND alumnos_visitas.no_control = :no_control AND alumnos_visitas.folio_visita = :folio_visita");
            $stmt->bindParam(":no_control", $noControl, PDO::PARAM_INT);
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlDatosPDF2($folio)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT folio_visita, nombre_docente, carrera, asignatura, lugares_disponibles, cantidad_alumnos FROM visitas WHERE folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $folio, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlListasEmpresasPDF($id)
    {
        try {
            $stmt = DB::conectar()->prepare("SELECT visitas_detalles.nombre_empresa, visitas_detalles.tipo_empresa, visitas_detalles.nombre_contacto, visitas_detalles.cargo_contacto, visitas_detalles.numero_contacto, visitas_detalles.objetivo_visita, visitas_detalles.area_empresa, visitas_detalles.observaciones, visitas_detalles.fecha_inicio, visitas_detalles.fecha_fin
            FROM visitas, visitas_detalles WHERE visitas.folio_visita = visitas_detalles.folio_visita and visitas.estatus_visita = 'ACEPTADA' and visitas_detalles.folio_visita = :folio_visita");
            $stmt->bindParam(":folio_visita", $id, PDO::PARAM_INT);

            $stmt->execute();

            return  $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        } catch (Exception $e) {
            return "error";
        }
    }
}
