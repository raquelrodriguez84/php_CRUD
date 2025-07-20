<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
class controller
{
    public static function index()
    {
        require_once __DIR__.'/../views/home.php';
    }

    public static function noticias()
{
    require_once __DIR__. '/../modelos/noticias.php';

    // Obtener las noticias desde el modelo
    $noticias = noticias::obtenerNews();

    // Pasar las noticias a la vista
    require_once __DIR__.'/../views/mostrar_noticias.php';
}

    public static function registro()
    {
        // Si el método no es POST, mostramos el formulario de registro
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require_once __DIR__.'/../views/registro.php';  // Mostrar formulario si no es un POST
        } else {
            // Si es un POST, delegar a controllerRegistro para procesar el registro
            require_once __DIR__.'/../controler/controllerRegistro.php';
            controllerRegistro::registro();
        }
    }
    public static function crearContrasena()
    {
        // Delegar el control al controllerLogin para manejar la creación de contraseña
        require __DIR__ . '/controllerLogin.php';
        controllerLogin::crearContrasena();
    }

    public static function login()
    {
        require_once __DIR__. '/../views/login.php';
        // Delegar el control al controllerLogin para manejar el login
        require_once __DIR__. '/controllerLogin.php';
        controllerLogin::login();
    }
    public static function perfil()
    {
        // Comprobamos si el usuario está autenticado
        session_start();
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['idUser'])) {
            header('Location: index.php?controller=login');
            exit;
        }

        // Obtener los datos del usuario desde la base de datos
        $usuarioId = $_SESSION['usuario']['idUser']; // Suponiendo que el ID del usuario está en la sesión
        $usuario = usuario::datosUser($usuarioId); // Método para obtener los datos

        // Pasar los datos del usuario a la vista
        require __DIR__.'/../views/perfil.php';
        return $usuario;
    }
    public static function reservar()
    {
        // Asegurar que la sesión está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Depuración: Verificar que la sesión contiene datos
        if (!isset($_SESSION['usuario'])) {
            die("Error: No hay datos en la sesión del usuario.");
        }
        // Si es un POST, procesar la reserva
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../modelos/Citas.php';

            // Verificar si el usuario está autenticado
            if (!isset($_SESSION['usuario']['idUser'])) {
                die("Error: Usuario no autenticado.");
            }

            $idUser = $_SESSION['usuario']['idUser'];
            $fecha_cita = $_POST['fecha_cita'] ?? null;
            $motivo_cita = $_POST['motivo_cita'] ?? null;

            // Depuración: Verificar que los datos se están obteniendo correctamente
            error_log("ID Usuario obtenido: " . print_r($_SESSION['usuario'], true));
            error_log("Datos recibidos: Fecha: $fecha_cita, Motivo: $motivo_cita");

            // Validar que los campos no sean nulos
            if (!$fecha_cita || !$motivo_cita) {
                die("Error: Todos los campos son obligatorios.");
            }

            // Llamar al modelo para insertar la cita
            $resultado = citas::agregarCita($idUser, $fecha_cita, $motivo_cita);

            if ($resultado) {
                header('Location: index.php?controller=perfil&mensaje=Cita reservada con éxito');
                exit;
            } else {
                die("Error al reservar la cita.");
            }
        }

        // Si no es un POST, simplemente cargar la vista de citaciones
        require __DIR__ . '/../views/citaciones.php';
    }  
}
