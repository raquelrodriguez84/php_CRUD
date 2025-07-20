<?php
require __DIR__ .'/constRegex.php';
function validarCitas($datos){
    $errores = [];

    // Validamos la fecha
    if(empty($datos['fecha_cita'])){
        $errores['fecha_cita'] = "La fecha es obligatoria.";
    }elseif(!preg_match(REGEX_FECHA, $datos['fecha_cita'])){
        $errores['fecha_cita'] = "Formato de fecha incorrecto.";
    }elseif((strtotime($datos['fecha_cita']))< strtotime(date('Y-m-d'))){
        $errores['fecha_cita'] = "La fecha no puede ser pasada.";
    }

    // Validamos el motivo
    if (empty(trim($datos['motivo_cita']))) {
        $errores['motivo_cita'] = "El motivo de la cita es obligatorio.";
        
    } elseif (!empty(trim($datos['motivo_cita'])) && strlen($datos['motivo_cita']) > 255) {
        $errores['motivo_cita'] = "El motivo de la cita no puede tener más de 255 caracteres.";
    }

    return $errores;
}

?>