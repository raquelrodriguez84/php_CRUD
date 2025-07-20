<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__. '/../modelos/usuario.php';
require_once __DIR__.'/validations/v_login.php';
class controllerLogin{
        public static function crearContrasena(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $idUser = $_POST['idUser']?? null;
                $contrasena = $_POST['contrasena']?? null;
                $email = $_POST['email']?? null;
    
                if (!$idUser || !$contrasena || !$email) {
                    error_log("Faltan datos para crear la contraseña: " . print_r($_POST, true));
                    
                    return;
                }
    
                $usuario = new usuario();
                $resultado = $usuario->registrarLogin($idUser, $email, $contrasena);
    
                if ($resultado) {
                    header('location: ../home.php');
                    exit;
                } else {
                    error_log("Error al guardar la contraseña para ID: $idUser");
                    
                }
            } else {
                require __DIR__. '/../views/registro.php';
                
            }
        }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            $usuario = new usuario();

            // Verificar si el usuario existe
            if (!$usuario->existeUsuario($email)) {
                $_SESSION['mensaje_error_registro'] = "Usuario no encontrado. Por favor, regístrese.";
                header('location: index.php?controller=registro');
                exit;
            }

            // Validación usando validarLogin()
            $resultado = validarLogin($email, $contrasena);

            if ($resultado['valido']) {
                $_SESSION['usuario'] = [
                    'idUser' => $resultado['usuario']['idUser'],
                    'email' => $resultado['usuario']['email'],
                ];
                $_SESSION['rol'] = $resultado['usuario']['rol'];
                $_SESSION['mensaje_exito_login'] = "Inicio de sesión exitoso."; // Añadido mensaje de éxito
                header('location: index.php?controller=index');
                exit;
               
            } else {
                $_SESSION['mensaje_error'] = $resultado['error']; // Mensaje de error
                header('location: index.php?controller=login');
                exit;
            }
        }
    }
}
?>