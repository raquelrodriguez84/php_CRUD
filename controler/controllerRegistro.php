<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../modelos/usuario.php';
require_once  __DIR__ . '/validations/v_registro.php';

class controllerRegistro
{
    public static function registro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos del formulario
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $apellidos = trim(htmlspecialchars($_POST['apellidos']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
            $fechaNac = filter_var(htmlspecialchars($_POST['fechaNac']));
            $direccion = trim(htmlspecialchars($_POST['direccion']));
            $sexo = $_POST['sexo'];
            $contrasena = $_POST['contrasena']; // Añadimos este dato desde el formulario
            $confirm_password = $_POST['confirm_password'];

            // Validar los datos utilizando la función de validación
            $errores = validarRegistro([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $telefono,
                'fechaNac' => $fechaNac,
                'direccion' => $direccion,
                'sexo' => $sexo,
                'contrasena' => $contrasena,
                'confirm_password' => $confirm_password,
            ]);

            if (!empty($errores)) {
                // Mostrar errores si los hay
                require __DIR__ . '/../views/registro.php';
                return;
            }

            // Validar datos obligatorios
            if (empty($nombre) || empty($apellidos) || empty($email) || empty($contrasena)) {
                require __DIR__ . '/../views/registro.php';
                return;
            }

            $errores = [];
            if (!empty($errores)) {
                foreach ($errores as $error) {
                }
                require __DIR__ .  '/../views/registro.php';
                return;
            }

            // Crear una instancia del modelo usuario
            $usuario = new usuario();

            // Verificar si el correo electrónico ya existe
            if ($usuario->existeUsuario($email)) {
                $_SESSION['mensaje_error_registro'] = "Este correo electrónico ya está registrado.";
                require __DIR__ . '/../views/registro.php';
                return;
            }

            // Paso 1: Registrar al usuario en `users_data`
            $idUser = $usuario->registrarUser($nombre, $apellidos, $email, $telefono, $fechaNac, $direccion, $sexo);

            if ($idUser) {
                // Paso 2: Registrar los datos de login en `users_login`
                $registroCompleto = $usuario->registrarLogin($idUser, $email, $contrasena);

                if ($registroCompleto) {
                    $_SESSION['mensaje_exito_registro'] = "Registro completado con éxito. Por favor, inicie sesión.";
                    require __DIR__ . '/../views/login.php'; // Redirigimos al login
                    return;
                } else {
                    $_SESSION['mensaje_error_registro'] = "Hubo un error al registrar los datos de login.";
                    require __DIR__ . '/../views/registro.php';
                    return;
                }
            } else {
                $_SESSION['mensaje_error_registro'] = "Hubo un error al registrar el usuario.";
                require __DIR__ . '/../views/registro.php';
                return;
            }
        }

        // Si no es un POST, mostramos el formulario de registro
        require __DIR__ . '/../views/registro.php';
    }


            // Crear una instancia del modelo usuario
            /*$usuario = new usuario();

            // Paso 1: Registrar al usuario en `users_data`
            $idUser = $usuario->registrarUser($nombre, $apellidos, $email, $telefono, $fechaNac, $direccion, $sexo);


            if ($idUser) {
                // Paso 2: Registrar los datos de login en `users_login`
                $registroCompleto = $usuario->registrarLogin($idUser, $email, $contrasena);

                if ($registroCompleto) {
                    echo "<p style='color:green;'>Registro completado con éxito. Por favor, inicie sesión.</p>";
                    require __DIR__ . '/../views/login.php'; // Redirigimos al login
                    return;
                } else {
                    echo "<p style='color:red;'>Hubo un error al registrar los datos de login.</p>";
                }
            } else {
                echo "<p style='color:red;'>Hubo un error al registrar el usuario.</p>";
            }
        }

        // Si no es un POST, mostramos el formulario de registro
        require __DIR__ . '/../views/registro.php';
    }*/
}
