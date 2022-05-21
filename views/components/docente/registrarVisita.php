<?php

if (!isset($_SESSION['validarIngresoDocente'])) {
    echo '<script> 
                     window.location = "inicioDocente"
                 </script>';
    return;
} else {
    if ($_SESSION['validarIngresoDocente'] != "ok") {
        echo '<script> 
                     window.location = "inicioDocente"
                </script>';
        return;
    }
}
$formSelect = ControlladorAdministrador::ctrSelectPeriodo();
?>

<nav class="navbar navbar-expand-lg navbar-dark nav-color-tecnm">
    <?php
    include "views/components/docente/navbarDocente.php"
    ?>
</nav>

<div class="container px-5 mt-3">
    <h1>
        Registrar una visita
    </h1>
    <hr>
    <br>
    <h5>
        Asegúrese de tener todos los datos de este formulario y de anotarlos correctamente.<br>
        Si va a realizar visitas a diferentes empresas en un mismo viaje, registre los datos de cada empresa por separado.
    </h5>

    <div class="col-12 mt-4">

        <a class="btn btn-primary" href="inicioVisita" role="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
            </svg>
            Regresar
        </a>
    </div>
    <hr>
</div>

<div class="container p-5">

    <!-- =========================INICIO DE DATOS DE LA VISITA. BLOQUE 1========================= -->
    <h2>Datos de la visita</h2>
    <form class="row g-3" action="" method="POST">
        <div class="col-md-6">
            <label for="inputPeriodo" class="form-label">Periodo:</label>
            <select id="inputPeriodo" class="form-select" name="periodo" required autofocus>
                <option disabled hidden value="" selected>Seleccione un periodo</option>
                <?php foreach ($formSelect as $opcion) :   ?>
                    <option value="<?php echo $opcion['descripcion']; ?>"><?php echo $opcion['descripcion']; ?></option>
                <?php endforeach ?>

            </select>
        </div>
        <div class="col-md-6">
            <label for="inputCarrera" class="form-label">Carrera:</label>
            <select id="inputCarrera" class="form-select" name="carrera" required>
                <option disabled hidden selected value="">Seleccione una opcion</option>
                <option value="ARQUITECTURA">ARQUITECTURA</option>
                <option value="INGENIERÍA EN SISTEMAS COMPUTACIONALES">INGENIERÍA EN SISTEMAS COMPUTACIONALES</option>
                <option value="INGENIERÍA ELECTROMECÁNICA">INGENIERÍA ELECTROMECÁNICA</option>
                <option value="INGENIERÍA BIOQUÍMICA">INGENIERÍA BIOQUÍMICA</option>
                <option value="INGENIERÍA EN GESTIÓN EMPRESARIAL">INGENIERÍA EN GESTIÓN EMPRESARIAL</option>
                <option value="LICENCIATURA EN ADMINISTRACIÓN">LICENCIATURA EN ADMINISTRACIÓN</option>
                <option value="CONTADOR PÚBLICO">CONTADOR PÚBLICO</option>
                <option value="MAESTRIA EN SISTEMAS COMPUTACIONALES">MAESTRIA EN SISTEMAS COMPUTACIONALES</option>
            </select>
        </div>
        <div class="col-6">
            <label for="inputMateria" class="form-label">Asignatura que pretende reforzar:</label>
            <input type="text" class="form-control" id="inputMateria" placeholder="Ej. Ingenieria de Software" name="materia" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
        </div>
        <div class="col-6">
            <label for="inputCantidadAlumnos" class="form-label">Cantidad de alumnos contemplados para la visita:</label>
            <input type="number" class="form-control" id="inputCantidadAlumnos" placeholder="Maximo 40 alumnos" name="cantidadAlumnos" min="1" max="40" required>
        </div>
        <div class="col-md-6">
            <label for="inputTipoVisita" class="form-label">Tipo de visita:</label>
            <select id="inputTipoVisita" class="form-select" name="tipoVisita" required>
                <option disabled hidden selected value="">Seleccione una opcion</option>
                <option value="LOCAL">LOCAL</option>
                <option value="FORANEA">FORANEA</option>
            </select>
        </div>
        <div class="col-6">
            <label for="inputTransporte" class="form-label">Transporte:</label>
                <select id="inputTransporte" class="form-select" name="transporte" required>
                    <option disabled hidden selected value="">Seleccione una opcion</option>
                    <option value="AUTOBUS">AUTOBUS (40 plazas)</option>
                    <option value="CAMIONETA">CAMIONETA (18 plazas)</option>
                </select>
        </div>
        <!-- =========================FIN DE DATOS DE LA VISITA. BLOQUE 1========================= -->



        <!-- =========================INICIO DE DATOS DEL DOCENTE. BLOQUE 2========================= -->
        <h2>Datos del docente</h2>
        <input type="hidden" name="idDocente" value="<?php echo $_SESSION['idDocente']; ?>">
        <div class="col-12">
            <label for="inputNombreDocente" class="form-label">Nombre del docente que estará encargado de la visita: (Anote su grado académico abreviado, si son más de dos docentes, solo anote un docente.)</label>
            <input type="text" class="form-control" id="inputNombreDocente" placeholder="Ej. ING. RODOLFO MENA ROJAS" name="nombreDocente" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
        </div>
        <div class="col-4">
            <label for="inputCorreoDocente" class="form-label">Correo electronico:</label>
            <input type="email" class="form-control" id="inputCorreoDocente" placeholder="Ej. rodolfo.mr@acapulco.tecnm.mx" name="correoDocente" required>
        </div>
        <div class="col-4">
            <label for="inputTelefonoDocente" class="form-label">Telefono:</label>
            <input type="number" class="form-control" id="inputTelefonoDocente" placeholder="Ej. 7441900214" name="telefonoDocente" minlength="10" maxlength="10" required>
        </div>
        <div class="col-4">
            <label for="inputRfcDocente" class="form-label">RFC:</label>
            <input type="text" class="form-control" id="inputRfcDocente" placeholder="Ej. MAAV980120APO" name="rfcDocente" required>
        </div>
        <!-- =========================FIN DE DATOS DEL DOCENTE. BLOQUE 2========================= -->



        <!-- =========================INICIO DE DATOS DE LAS EMPRESAS. BLOQUE 3========================= -->
        <?php


        if (isset($_POST["numVisitas"]) && !empty($_POST["numVisitas"])) {

            $numForms = $_POST["numVisitas"];
        } else {
            $numForms = 0;
        }

        for ($i = 1; $i <= $numForms; $i++) { ?>

            <h2>Datos de la empresa No. <?php echo $i ?></h2>
            
            <div class="col-2">
                <label class="form-label" for="inputFechaInicio">Fecha de inicio:</label>
                <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaInicio" name="fechaInicio<?php echo $i ?>" type="date" value="" min="2022-01-01" required />
            </div>
            <div class="col-2">
                <label class="form-label" for="inputFechaFin">Fecha de fin:</label>
                <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputFechaFin" name="fechaFin<?php echo $i ?>" type="date" value="" min="2022-01-01" required />
            </div>
            <div class="col-2">
                <label class="form-label" for="inputHoraInicio">Hora de inicio:</label>
                <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraInicio" name="horaInicio<?php echo $i ?>" type="time" value="" required />
            </div>
            <div class="col-2">
                <label class="form-label" for="inputHoraFin">Hora de fin:</label>
                <input class="form-control" data-val="true" data-val="Este campo es requerido" id="inputHoraFin" name="horaFin<?php echo $i ?>" type="time" value="" required />
            </div>
            <div class="col-4">
                <label for="inputTurno" class="form-label">Turno de la visita:</label>
                <select id="inputTurno" class="form-select" name="turnoEmpresa<?php echo $i ?>" required>
                    <option disabled hidden selected value="">Seleccione una opcion</option>
                    <option value="MATUTINO">MATUTINO</option>
                    <option value="VESPERTINO">VESPERTINO</option>
                </select>
            </div>

            <div class="col-4">
                <label for="inputNombreEmpresa" class="form-label">Nombre fiscal de la empresa:</label>
                <input type="text" class="form-control" id="inputNombreEmpresa" placeholder="Ej. Nissan Mexicana S.A. de C.V." name="nombreFiscalEmpresa<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            
            <div class="col-4">
                <label for="inputNombreEmpresa" class="form-label">Nombre comercial de la empresa:</label>
                <input type="text" class="form-control" id="inputNombreEmpresa" placeholder="Ej. Nissan Mexicana S.A. de C.V." name="nombreEmpresa<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            <div class="col-4">
                <label for="inputRfcEmpresa" class="form-label">RFC de la empresa:</label>
                <input type="text" class="form-control" id="inputRfcEmpresa" placeholder="" name="rfcEmpresa<?php echo $i ?>" required>
            </div>
            <div class="col-6">
                <label for="inputTipoEmpresa" class="form-label">Tipo de empresa:</label>
                <select id="inputTipoEmpresa" class="form-select" name="tipoEmpresa<?php echo $i ?>" required>
                    <option disabled hidden selected value="">Seleccione una opcion</option>
                    <option value="PUBLICA">PUBLICA</option>
                    <option value="PRIVADA">PRIVADA</option>
                </select>
            </div>
            <div class="col-6">
                <label for="inputAreaEmpresa" class="form-label">Área a visitar de la empresa:</label>
                <input type="text" class="form-control" id="inputAreaEmpresa" placeholder="Ej. Recursos Humanos" name="areaEmpresa<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            <div class="col-12">
                <label for="inputObjetivo" class="form-label">Objetivo de la visita a empresa:</label>
                <input type="text" class="form-control" id="inputObjetivo" placeholder="Ej. Conocer el proceso de capacitación por parte del departamento de recursos humanos." name="objetivoVisita<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,700}" required>
            </div>
            <div class="col-12">
                <label for="inputObservaciones" class="form-label">Observaciones de la visita:</label>
                <input type="text" class="form-control" id="inputObservaciones" placeholder="Ej. De ser posible, ver las consideraciones que se toman en cuenta en el proceso de capacitación de personal." name="observaciones<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,700}" required>
            </div>
            <div class="col-6">
                <label for="inputEstadoEmpresa" class="form-label">Estado:</label>
                <select id="inputEstadoEmpresa" class="form-select" name="estadoEmpresa<?php echo $i ?>" required>
                    <option disabled hidden selected value="">Seleccione una opcion</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>
                    <option value="Colima">Colima</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Ciudad de México">Ciudad de México</option>
                    <option value="Durango">Durango</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="México">México</option>
                    <option value="Michoacán de Ocampo">Michoacán de Ocampo</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz de Ignacio de la Llave">Veracruz de Ignacio de la Llave</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select>
            </div>
            <div class="col-6">
                <label for="inputCiudadEmpresa" class="form-label">Ciudad:</label>
                <input type="text" class="form-control" id="inputCiudadEmpresa" placeholder="Ej. Los mochis" name="ciudadEmpresa<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            <div class="col-12">
                <label for="inputDireccionEmpresa" class="form-label">Direccion:</label>
                <input type="text" class="form-control" id="inputDireccionEmpresa" placeholder="Ej. Avenida Instituto Tecnológico S/N, Crucero del Cayaco C.P. 39905" name="direccionEmpresa<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,-./0-9 ]{2,400}" required>
            </div>
            <div class="col-6">
                <label for="inputNombreContacto" class="form-label">Nombre de la persona a contactar de la empresa:</label>
                <input type="text" class="form-control" id="inputNombreContacto" placeholder="" name="nombreContacto<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            <div class="col-6">
                <label for="inputCargoContacto" class="form-label">Cargo de la persona a contactar de la empresa:</label>
                <input type="text" class="form-control" id="inputCargoContacto" placeholder="Ej. Jefe de Recursos Humanos" name="cargoContacto<?php echo $i ?>" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1,. ]{2,254}" required>
            </div>
            <div class="col-6">
                <label for="inputCorreoContacto" class="form-label">Correo electronico de la persona a contactar de la empresa:</label>
                <input type="email" class="form-control" id="inputCorreoContacto" placeholder="" name="correoContacto<?php echo $i ?>" required>
            </div>
            <div class="col-6">
                <label for="inputNumeroContacto" class="form-label">Número teléfonico de la persona a contactar:</label>
                <input type="number" class="form-control" id="inputNumeroContacto" placeholder="Ej. 7443277067" minlength="10" maxlength="10" name="numeroContacto<?php echo $i ?>" required>
            </div>

            <input type="hidden" name="interacciones" value="<?php echo $numForms ?>">


        <?php } ?>

        <!-- =========================FIN DE DATOS DE LAS EMPRESAS. BLOQUE 3========================= -->


        <?php
        $formularioVisitas = ControlladorDocente::ctrFormVisitas();

        switch ($formularioVisitas) {

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
                                     title: 'La visita se registro satisfactoriamente.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) </script>
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
                                     title: 'Ha ocurrido un error.',
                                     showConfirmButton: false,
                                     timer: 1500
                                   }) </script>
                                 ";
                break;

            case "4":
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
                                   }) </script>
                                 ";
                break;
        }


        ?>
        <?php if ($numForms == 0) : ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <a class="btn btn-danger" href="inicioVisita" role="button">Salir</a>
            </div>

        <?php else : ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <a class="btn btn-danger" href="inicioVisita" role="button">Cancelar y regresar</a>
                <input type="submit" class="btn btn-success btn-block" name="registrarVisitas" value="Registrar visita">
            </div>
        <?php endif ?>

    </form>
</div>