<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../modelos/citas.php';
require_once __DIR__ . '/validations/v_citas.php';

class controllerCita
{
    public static function reservarCita()
    {
        
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario']['idUser'])) {
        // Redirigir a la página de login si no está logueado
        header('Location: index.php?controller=login');
        exit;
    }
   
        // Si es un POST, procesar la reserva
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario']['idUser'])) {
            $idUser = $_SESSION['usuario']['idUser'];
            $fecha_cita = trim($_POST['fecha_cita']) ?? null;
            $motivo_cita = htmlspecialchars($_POST['motivo_cita']) ?? null;
            // Validar que los datos 
            $errores = validarCitas($_POST);

            if(!empty($errores)){
                $_SESSION['errores'] = $errores;
                //header('Location: index.php?controller=citaciones&action=reservarCita');
                require __DIR__. '/../views/citaciones.php';
                exit();
            }
           // Llamar al modelo
            $resultado = citas::agregarCita($idUser, $fecha_cita, $motivo_cita);

            if ($resultado) {
                header('Location: index.php?controller=citaciones&action=reservarCita&mensaje=Cita%20reservada%20con%20éxito');
                exit;
            } else {
                die("Error al agregar la cita.");
            }
        }

        // Cargar la vista si no es un POST
        require __DIR__ . '/../views/citaciones.php';
    }
    public static function actualizarCita()
    {
        //iniciar session si no esta iniciada
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }

        //verificar si el usuario esta autenticado
        if (!isset($_SESSION['usuario']['idUser'])) {
            header('location: index.php?controller=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idCita = $_POST['idCita'] ?? null;
            $idUser = $_SESSION['usuario']['idUser'];
            $fecha_cita = trim($_POST['fecha_cita']) ?? null;
            $motivo_cita = htmlspecialchars($_POST['motivo_cita']) ?? null;

            //validar los datos
            $errores = validarCitas($_POST);
            //Si hay errores
            if(!empty($errores)){
                $_SESSION['errores'] = $errores;
                header('Location: index.php?controller=citaciones');
                exit();
            }
            // Llamar al método para actualizar la cita
            $resultado = citas::actualizarCita($idCita, $fecha_cita, $motivo_cita);

            if ($resultado) {
                //redirigir a al pagina de citaciones con mensaje de exito
                header('Location: index.php?controller=citaciones');
                exit;
            } else {
                echo "Error al actualizar la cita.";
            }
        }
    }

    public static function eliminarCita()
    {
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }

       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idCita'])) {
            $idCita = $_POST['idCita'];
            $idUser = $_SESSION['usuario']['idUser'];

            require_once __DIR__ .'/../modelos/citas.php';
            $cita = citas::obtenerCita($idUser);
            // Verificar que el idCita esté presente
            if (!$idCita) {
                die("Error: idCita no proporcionado.");
            }
            // Validar que la cita aún no ha ocurrido
        if ($cita['fecha_cita'] < date("Y-m-d")) {
            die("Error: No puedes eliminar una cita pasada.");
        }


            // Llamar al modelo para eliminar la cita
            $resultado = citas::eliminarCita($idCita);

            if ($resultado) {
                header('Location: index.php?controller=citaciones&mensaje=Cita eliminada con éxito');
                exit;
            } else {
                die("Solicitud no valida");
            }
        }
    }
}
