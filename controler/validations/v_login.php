<?php

// validarLogin.php

require_once __DIR__ . '/../../modelos/usuario.php';
require_once __DIR__ . '/constRegex.php'; // Incluir el archivo de constantes

function validarLogin($email, $contrasena) {
    // Validar datos de entrada
    if (empty($email) || empty($contrasena)) {
        return ['valido' => false, 'error' => 'Por favor, introduce tu correo electrónico y contraseña.'];
    }

    // Validar formato de correo electrónico
    if (!preg_match(REGEX_EMAIL, $email)) {
        return ['valido' => false, 'error' => 'El formato del correo electrónico no es válido.'];
    }

    // Verificación de usuario
    $usuario = new usuario();
    $valido = $usuario->verificarLogin($email, $contrasena);

    if ($valido) {
        return ['valido' => true, 'usuario' => $valido];
    } else {
        return ['valido' => false, 'error' => 'Credenciales inválidas. Por favor, inténtalo de nuevo.'];
    }
}
?>