<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../modelos/usuario.php';
require_once __DIR__ . '/validations/v_cambioPass.php';
require_once __DIR__ . '/validations/v_perfil.php';

class controllerPerfil
{

    public static function perfil()
    {

        if (!isset($_SESSION['usuario']['idUser'])) {
            header('location: index.php?controller=login');
            exit;
        }

        $idUsuario = $_SESSION['usuario']['idUser'];
        $usuarioPerfil = new usuario();
        $datosUser = $usuarioPerfil->datosUser($idUsuario);

        if ($datosUser) {
            require __DIR__ . '/../views/perfil.php';
        } else {
            echo "No se encontraron los datos del usuario.";
        }
    }
    public static function updateDatos()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = [
                'nombre' => trim(htmlspecialchars($_POST['nombre'])),
                'apellidos' => trim(htmlspecialchars($_POST['apellidos'])),
                'telefono' => trim(filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT)),
                'fechaNac' => trim(htmlspecialchars($_POST['fechaNac'])),
                'direccion' => trim(htmlspecialchars($_POST['direccion'])),
                'sexo' => trim(htmlspecialchars($_POST['sexo']))
            ];

            // Validar los datos
            $errores = validaPerfil($datos);

            if (empty($errores)) {
                // Actualizar los datos en la base de datos
                $resultado = Usuario::actualizarDatosUsuario($_SESSION['usuario']['idUser'], $datos['nombre'], $datos['apellidos'], $datos['telefono'], $datos['fechaNac'], $datos['direccion'], $datos['sexo']);

                if ($resultado) {
                    // Actualizar la sesión
                    $_SESSION['usuario']['nombre'] = $datos['nombre'];
                    $_SESSION['usuario']['apellidos'] = $datos['apellidos'];
                    $_SESSION['usuario']['telefono'] = $datos['telefono'];
                    $_SESSION['usuario']['fechaNac'] = $datos['fechaNac'];
                    $_SESSION['usuario']['direccion'] = $datos['direccion'];
                    $_SESSION['usuario']['sexo'] = $datos['sexo'];

                    // Éxito: Redirigir al perfil
                    header('Location: index.php?controller=perfil');
                    exit;
                } else {
                    // Error: Mostrar mensaje de error (o redirigir con mensaje de error)
                    $_SESSION['errores_perfil'] = ["Error al actualizar los datos."];
                    header('Location: index.php?controller=perfil');
                    exit;
                }
            } else {
                // Si hay errores de validación, almacenarlos en la sesión y redirigir
                $errores_por_campo = [];
                foreach ($errores as $error) {
                    if (strpos($error, 'nombre') !== false) {
                        $errores_por_campo['nombre'] = $error;
                    } elseif (strpos($error, 'apellidos') !== false) {
                        $errores_por_campo['apellidos'] = $error;
                    } elseif (strpos($error, 'correo electrónico') !== false) {
                        $errores_por_campo['email'] = $error;
                    } elseif (strpos($error, 'teléfono') !== false) {
                        $errores_por_campo['telefono'] = $error;
                    } elseif (strpos($error, 'fecha de nacimiento') !== false) {
                        $errores_por_campo['fechaNac'] = $error;
                    } elseif (strpos($error, 'dirección') !== false) {
                        $errores_por_campo['direccion'] = $error;
                    } elseif (strpos($error, 'sexo') !== false) {
                        $errores_por_campo['sexo'] = $error;
                    }
                }

                $_SESSION['errores_perfil'] = $errores_por_campo;
                header('Location: index.php?controller=perfil');
                exit;
            }
        } else {
            // Si se intenta acceder a esta acción sin enviar el formulario, redirigir al perfil
            header('Location: index.php?controller=perfil');
            exit;
        }
    }
    public static function updatePass()
    {

        if (!isset($_SESSION['usuario']['idUser'])) {
            header('location: index.php?controller=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevaContrasena = trim(htmlspecialchars($_POST['nuevaContrasena']));
            $confirmarContrasena = trim(htmlspecialchars($_POST['confirmarContrasena']));

            $errores = validarCambioPass($nuevaContrasena, $confirmarContrasena);

            if (empty($errores)) {
                $usuario = new usuario();
                try {
                    $resultado = $usuario->actualizarContrasena($_SESSION['usuario']['idUser'], $nuevaContrasena);
                    if ($resultado) {
                        $_SESSION['mensaje_exito'] = "¡Contraseña actualizada correctamente!";
                        header("Location: index.php?controller=perfil");
                    } else {
                        $_SESSION['errores_contrasena'] = ["Error al actualizar la contraseña. Por favor, inténtalo de nuevo."];
                        header("Location: index.php?controller=perfil");
                    }
                } catch (Exception $e) {
                    $_SESSION['errores_contrasena'] = ["Error al actualizar la contraseña: " . $e->getMessage()];
                    header("Location: index.php?controller=perfil");
                }
            } else {
                $_SESSION['errores_contrasena'] = $errores; // Almacenar errores de validación
                header("Location: index.php?controller=perfil");
            }
        } else {
            $_SESSION['errores_contrasena'] = ["Solicitud no válida."];
            header("Location: index.php?controller=perfil");
        }
    }
}

?>