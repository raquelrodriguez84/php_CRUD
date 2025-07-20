<?php

require_once __DIR__.  '/constRegex.php';

function validaPerfil($datos) {
    $errores = [];

    // Validación de campos
    if (empty($datos['nombre'])) {
        $errores[] = 'El nombre no puede estar vacío.';
    } elseif (!preg_match(REGEX_NOMBRE, $datos['nombre'])) {
        $errores[] = 'El nombre no es válido.';
    }

    if (empty($datos['apellidos'])) {
        $errores[] = 'Los apellidos no pueden estar vacíos.';
    } elseif (!preg_match(REGEX_APELLIDOS, $datos['apellidos'])) {
        $errores[] = 'Los apellidos no son válidos.';
    }

    if (!empty($datos['telefono']) && !preg_match(REGEX_TELEFONO, $datos['telefono'])) {
        $errores[] = 'El teléfono debe contener 9 dígitos numéricos.';
    }

    if (!empty($datos['fechaNac'])) {
        $fechaNac = DateTime::createFromFormat('Y-m-d', $datos['fechaNac']);
        $fechaActual = new DateTime();

        if (!$fechaNac) {
            $errores[] = 'La fecha de nacimiento no es válida.';
        } elseif ($fechaNac > $fechaActual) {
            $errores[] = 'La fecha de nacimiento no puede ser una fecha futura.';
        }
    }

    if (empty($datos['direccion'])) {
        $errores[] = 'La dirección no puede estar vacía.';
    } elseif (!preg_match(REGEX_DIRECCION, $datos['direccion'])) {
        $errores[] = 'La dirección no es válida.';
    }

    if (empty($datos['sexo'])) {
        $errores[] = 'Debes seleccionar un sexo.';
    }

    // Agregar nombres de campo a los mensajes de error
    $errores_con_nombres = [];
    foreach ($errores as $error) {
        if (strpos($error, 'teléfono') !== false) {
            $errores_con_nombres['telefono'] = $error;
        } elseif (strpos($error, 'fecha de nacimiento') !== false) {
            $errores_con_nombres['fechaNac'] = $error;
        } else {
            $errores_con_nombres[] = $error;
        }
    }

    return $errores_con_nombres;
}

?>