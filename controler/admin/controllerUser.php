<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__.'/../../modelos/usuario.php';
require_once __DIR__.'/../../modelos/adminUser.php';
require_once __DIR__.'/../validations/v_registro.php';

class controllerAdminUser {
    
    // Listar todos los usuarios
    public static function listarUsuarios() {
        $usuarios = adminUser::obtenerTodos(); // Llama al modelo
        require __DIR__.'/../../views/adminUser/usuarios_admin.php'; // Carga la vista
    }
    
    //  Crear un nuevo usuario (admin puede definir el rol)
    public static function crearUsuario() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim(htmlspecialchars($_POST['nombre']));
            $apellidos = trim(htmlspecialchars_decode($_POST['apellidos']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $telefono = trim(htmlspecialchars($_POST['telefono']));
            $fechaNac = trim(htmlspecialchars($_POST['fechaNac']));
            $direccion = trim(htmlspecialchars($_POST['direccion']));
            $sexo = $_POST['sexo'];
            $rol = $_POST['rol']; // Admin define el rol: USER o ADMIN
            $contrasena = trim($_POST['contrasena']);

            $errores = validarRegistro([
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'telefono' => $telefono,
                'fechaNac' => $fechaNac,
                'direccion' => $direccion,
                'sexo' => $sexo,
                'rol' => $rol,
                'contrasena' => $contrasena,
            ], true);
            if (!empty($errores)) {
                // Mostrar errores si los hay
                require __DIR__.'/../../views/adminUser/form_Crear.php';
                return;
            }
            // Validar datos obligatorios
            if (empty($nombre) || empty($apellidos) || empty($email) || empty($contrasena)) {
                require __DIR__.'/../../views/adminUser/form_Crear.php';
                return;
            }
            $errores = [];
            if(!empty($errores)){
                foreach ($errores as $error){
                    
                }
                require __DIR__.  '/../../views/registro.php';
                return;
            }
            $usuario = new usuario();

            // Verificar si el correo electrónico ya existe
            if ($usuario->existeUsuario($email)) {
                $_SESSION['mensaje_error_crear_usuario'] = "Este correo electrónico ya está registrado.";
                require __DIR__ . '/../../views/adminUser/form_Crear.php';
                return;
            }

            $idUser = $usuario->registrarUser($nombre, $apellidos, $email, $telefono, $fechaNac, $direccion, $sexo);

            if ($idUser) {
                $usuario->registrarLogin($idUser, $email, $contrasena, $rol);
                header('Location: index.php?controller=admin&action=usuarios_admin');
                exit();
            } else {
                $_SESSION['mensaje_error_crear_usuario'] = "Hubo un error al registrar el usuario.";
                require __DIR__ . '/../../views/adminUser/form_Crear.php';
                return;
            }
        }

        require __DIR__ . '/../../views/adminUser/form_Crear.php';
    }


            /*$usuario = new usuario();
            $idUser = usuario::registrarUser($nombre, $apellidos, $email, $telefono, $fechaNac, $direccion, $sexo);
            if ($idUser) {
                usuario::registrarLogin($idUser, $email, $contrasena, $rol); 
                header('Location: index.php?controller=admin&action=usuarios_admin');

                exit();
            }
        }
        require __DIR__.'/../../views/adminUser/form_Crear.php';
    }*/

    //  Modificar un usuario
    public static function modificarUsuario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = adminUser::obtenerPorId($id); 

            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = trim(htmlspecialchars($_POST['nombre']));
                $apellidos = trim(htmlspecialchars($_POST['apellidos']));
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $telefono = trim(htmlspecialchars($_POST['telefono']));
                $fechaNac = trim(htmlspecialchars($_POST['fechaNac']));
                $direccion = trim(htmlspecialchars($_POST['direccion']));
                $sexo = $_POST['sexo'];
                $rol = $_POST['rol']; // Permite modificar el rol
                $contrasena = trim($_POST['contrasena']);

                $errores = validarRegistro([
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'fechaNac' => $fechaNac,
                    'direccion' => $direccion,
                    'sexo' => $sexo,
                    'rol' => $rol,
                    'contrasena' => $contrasena,
                ], false);
                if (!empty($errores)) {
                    // Mostrar errores si los hay
                    require __DIR__.'/../../views/adminUser/form_Crear.php';
                    return;
                }
                adminUser::actualizarUsuario($id, $nombre, $apellidos, $email, $telefono, $direccion, $fechaNac,$sexo, $rol, $contrasena);
               
                header('Location: index.php?controller=admin&action=usuarios_admin');
                exit();
            }

            require __DIR__. '/../../views/adminUser/form_Crear.php';
        }
    }
    // Eliminar un usuario
    public static function borrarUsuario() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            adminUser::eliminarUsuario($id);
            header('Location: index.php?controller=admin&action=usuarios_admin');
            exit();
        }
    }
}
