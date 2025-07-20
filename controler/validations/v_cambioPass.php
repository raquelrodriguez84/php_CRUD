<?php
require_once __DIR__ . '/constRegex.php'; // Incluye el archivo de constantes

define('ERROR_CONTRASENA_VACIA', 'Los campos de contraseña no pueden estar vacíos.');
define('ERROR_CONTRASENAS_NO_COINCIDEN', 'Las contraseñas no coinciden.');

function validarCambioPass($nuevaContrasena, $confirmarContrasena)
{
    $errores = [];

    // Validar campos vacíos
    if (empty($nuevaContrasena) || empty($confirmarContrasena)) {
        $errores[] = ERROR_CONTRASENA_VACIA;
    }

    // Validar requisitos de contraseña usando la constante REGEX_CONTRASENA
    if (!preg_match(REGEX_CONTRASENA, $nuevaContrasena)) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }

    // Validar coincidencia de contraseñas
    if ($nuevaContrasena !== $confirmarContrasena) {
        $errores[] = ERROR_CONTRASENAS_NO_COINCIDEN;
    }

    return $errores;
}
?>
