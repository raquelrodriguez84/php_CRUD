<?php
require_once './modelos/citas.php';
require_once './modelos/adminUser.php';
require_once './modelos/usuario.php';
require_once __DIR__. '/../validations/v_citas.php';


class controllerAdminCitas {
    
    // Función para seleccionar un usuario
    public static function selectUser() {
       
        $usuarios = adminUser::obtenerTodos(); // Obtener todos los usuarios
        require './views/adminCitas/user_citas.php'; // Vista para seleccionar un usuario
    }

    // Función para gestionar las citas del usuario
    public static function gestionarCitas() {
        require_once './modelos/citas.php';
        // Verificar si se ha pasado el idUser por GET
        if (!isset($_GET['idUser'])) {
            $_SESSION['error'] = "Faltan datos de usuario.";
            header("Location: index.php?controller=adminCitas&action=selectUser");
            exit();
        }

        $idUser = $_GET['idUser'];

        // 2. Obtener datos del usuario
        $usuario = adminUser::obtenerPorId($idUser);

        if (!$usuario) {
            $_SESSION['error'] = "Usuario no encontrado.";
            header("Location: index.php?controller=adminCitas&action=selectUser");
            exit();
        }

        // 3. Obtener las citas del usuario
        $citas = citas::obtenerCitasPorUsuario($idUser);

        // 4. Incluir la vista gestionar_citas.php
        require './views/adminCitas/gestionar_citas.php';
        unset($_SESSION['errores']);
    }


    // Función para modificar una cita
    public static function modificarCita() {
        if (!isset($_POST['idCita']) || !isset($_POST['idUser'])) {
            $_SESSION['error'] = "Faltan datos para modificar la cita.";
            header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $_GET['idUser']);
            exit();
        }
    
        $idCita = $_POST['idCita'];
        $idUser = $_POST['idUser'];
    
        // Obtener los datos del usuario
        $usuario = usuario::datosUser($idUser); // Asegúrate de que esta función exista y esté definida correctamente
        if (!$usuario) {
            $_SESSION['error'] = "Usuario no encontrado.";
            header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $idUser);
            exit();
        }
    
        // Obtener la cita actual
        $cita = citas::obtenerCitaPorId($idCita); // Usar el mismo nombre de función que en el modelo
        if (!$cita) {
            $_SESSION['error'] = "Cita no encontrada.";
            header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $idUser);
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errores = validarCitas($_POST); // Validar datos
    
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $idUser);
                exit();
            }
    
            $fecha_cita = $_POST['fecha_cita'];
            $motivo_cita =  htmlspecialchars($_POST['motivo_cita'] ?? '', ENT_QUOTES, 'UTF-8');
            
    
            // Actualizar la cita
            try {
                $usuario = usuario::datosUser($idUser);
                if (!$usuario) {
                    throw new Exception("Usuario no encontrado.");
                }
    
                // Obtener la cita actual
                $cita = citas::obtenerCitaPorId($idCita);
                if (!$cita) {
                    throw new Exception("Cita no encontrada.");
                }
    
                $resultado = citas::actualizarCita($idCita, $fecha_cita, $motivo_cita);
    
                if ($resultado) {
                    $_SESSION['mensaje'] = "Cita modificada con éxito.";
                } else {
                    $_SESSION['error'] = "Error al modificar la cita.";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Error al modificar la cita: " . $e->getMessage();
                error_log("Error al modificar la cita: " . $e->getMessage());
            }
    
            header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $idUser);
            exit();
            unset($_SESSION['errores']);
        }
    }

    // Función para eliminar una cita
    public static function eliminarCita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica que se haya enviado por POST
            if (!isset($_POST['idCita']) || !isset($_POST['idUser'])) { // Valida que los datos estén definidos
                $_SESSION['error'] = "Faltan datos para eliminar la cita.";
                header("Location: index.php?controller=adminCitas&action=selectUser"); // Redirige a la página de selección de usuario
                exit();
            }
    
            $idCita = $_POST['idCita'];
            $idUser = $_POST['idUser'];
    
            $resultado = citas::eliminarCita($idCita);
    
            if (is_string($resultado)) { // Verifica si $resultado es un mensaje de error
                $_SESSION['error'] = $resultado; // Muestra el mensaje de error específico
            } elseif ($resultado) {
                $_SESSION['mensaje'] = "Cita eliminada con éxito.";
            } else {
                $_SESSION['error'] = "Error al eliminar la cita (desconocido).";
            }
    
            header("Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=" . $idUser); // Redirección corregida
            exit();
        } else {
            $_SESSION['error'] = "Solicitud no válida.";
            header("Location: index.php?controller=adminCitas&action=selectUser");
            exit();
        }
    }

    // Función para crear una nueva cita
    public static function crearCita() {
        // Verificar si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $fecha_cita = $_POST['fecha_cita'];
            $motivo_cita = $_POST['motivo_cita'];
            $idUser = $_POST['idUser']; // ID del usuario asociado

            $errores = validarCitas($_POST);

            if(!empty($errores)){
                $_SESSION['errores'] = $errores;
                header('Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=' . $_POST['idUser']);
                exit();
            }
           
            
                require_once __DIR__ . '/../../modelos/citas.php';
                $resultado = citas::agregarCita($idUser, $fecha_cita, $motivo_cita);

                // Verificar si la cita se ha guardado correctamente
                if ($resultado) {
                    header('Location: index.php?controller=adminCitas&action=gestionarCitas&idUser=' . $idUser); // Redirigir a la página de citas
                    exit;
                    unset($_SESSION['errores']);
                } 
            
       }
    }
}

?>


    
    
    