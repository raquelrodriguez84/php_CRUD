<?php
require __DIR__.'/../validations/constRegex.php';
function validarNoticia($datos, $imagen) {
    $errores = [];

    // Validación del título
    
    if (empty(trim($datos['titulo'])) || preg_match('/^\s*$/', $datos['titulo'])) {
        $errores['titulo'] = "El título es obligatorio.";
    } elseif (!preg_match(REGEX_TITULO, $datos['titulo'])) {
        $errores['titulo'] = "El título debe tener entre 5 y 100 caracteres.";
    }

    // Validación del contenido
    if (empty($datos['texto'])) {
        $errores['texto'] = "El contenido es obligatorio.";
    } elseif (strlen($datos['texto']) < 10 || strlen($datos['texto']) > 5000) {
        $errores['texto'] = "El contenido debe tener entre 10 y 1000 caracteres.";
    }

    // Validación de la imagen
    if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
        $tipo_archivo = mime_content_type($imagen['tmp_name']);
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    
        if (!in_array($tipo_archivo, $tipos_permitidos)) {
            $errores['imagen'] = "Tipo de archivo no permitido. Solo se permiten JPEG, PNG y GIF.";
        } elseif ($imagen['size'] > 5 * 1024 * 1024) {
            $errores['imagen'] = "La imagen no puede superar los 5MB.";
        }
    } elseif ($imagen && $imagen['error'] === UPLOAD_ERR_NO_FILE) {
        $errores['imagen'] = "La imagen es obligatoria.";
    } elseif ($imagen && $imagen['error'] !== UPLOAD_ERR_OK) {
        $errores['imagen'] = "Error al subir la imagen.";
    }
    // Validación de la fecha
    if(empty($datos['fecha_noticia'])) {
        $errores['fecha_noticia'] = "La fecha es obligatoria.";
    } elseif (!preg_match(REGEX_FECHA, $datos['fecha_noticia'])) {
        $errores['fecha_noticia'] = "Formato de fecha no válido (AAAA-MM-DD).";
    } else {
        $fecha_actual = date('Y-m-d');
        if ($datos['fecha_noticia'] < $fecha_actual) { // Agregado para fecha pasada
            $errores['fecha_noticia'] = "La fecha no puede ser anterior a la actual.";
        } elseif ($datos['fecha_noticia'] > $fecha_actual) { //Condición para fecha futura
            $errores['fecha_noticia'] = "La fecha no puede ser futura.";
        }
    }

    error_log(print_r($errores, true)); 
    return $errores;
}

?>