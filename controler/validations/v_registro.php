<?php

require_once __DIR__ . '/constRegex.php';

function validarRegistro($datos, $esCreacion = true)
{
    $errores = [];

    // Validamos el nombre
    if (empty($datos['nombre']) || !preg_match(REGEX_NOMBRE, $datos['nombre'])) {
        $errores['nombre'] = "El nombre solo puede contener letras y tener entre 2 y 50 caracteres. Es obligatorio";
    }

    // Validamos los apellidos
    if (empty($datos['apellidos']) || !preg_match(REGEX_APELLIDOS, $datos['apellidos'])) {
        $errores['apellidos'] = "Los apellidos solo pueden contener letras y tener entre 2 y 50 caracteres. Es obligatorio";
    }

    // Validamos el email
    if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "El formato del correo electrónico no es válido.";
    }

    // Validamos el teléfono
    if (empty($datos['telefono']) || !preg_match(REGEX_TELEFONO, $datos['telefono'])) {
        $errores['telefono'] = "El teléfono debe contener exactamente 9 dígitos.";
    }

    // Validamos la fecha de nacimiento
    if (empty($datos['fechaNac'])) {
        $errores['fechaNac'] = "La fecha de nacimiento es obligatoria.";
    } elseif (!preg_match(REGEX_FECHA, $datos['fechaNac'])) {
        $errores['fechaNac'] = "La fecha de nacimiento debe tener el formato AAAA-MM-DD.";
    } else {
        $fechaNacObj = DateTime::createFromFormat('Y-m-d', $datos['fechaNac']);
        if (!$fechaNacObj || $fechaNacObj->format('Y-m-d') !== $datos['fechaNac']) {
            $errores['fechaNac'] = "La fecha de nacimiento no es válida.";
        } elseif ($fechaNacObj > new DateTime()) {
            $errores['fechaNac'] = "La fecha de nacimiento no puede ser futura.";
        }
    }

    // Validamos la dirección
    if (empty($datos['direccion']) || !preg_match(REGEX_DIRECCION, $datos['direccion'])) {
        $errores['direccion'] = "La dirección debe tener entre 5 y 255 caracteres, permitiendo letras, números, puntos, comas o guiones.";
    }
    if ($esCreacion || !empty($datos['contrasena'])) {
        if (empty($datos['contrasena']) || !preg_match(REGEX_CONTRASENA, $datos['contrasena'])) {
            $errores['contrasena'] = "La contraseña no cumple con los requisitos mínimos (al menos 8 caracteres).";
        }
    }
    // Validamos la contraseña
   
    // Validamos la confirmación de contraseña
    if (isset($datos['confirm_password']) && $datos['contrasena'] !== $datos['confirm_password']) {
        $errores['confirm_password'] = 'Las contraseñas no coinciden.';
    }

    return $errores;
}
?>
