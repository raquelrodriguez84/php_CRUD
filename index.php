<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Incluir el controlador principal
require_once './controler/controller.php';

// Crear instancia del controlador
$controller = new controller();

// Página predeterminada
define('DEFAULT_PAGE', 'index');
// Determinar qué controlador ejecutar
$control = isset($_GET['controller']) ? htmlspecialchars($_GET['controller']) : DEFAULT_PAGE;
$accion = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : null;
error_log("contrl: " .$control);
error_log("Accion: " . $accion);


// Páginas que no requieren autenticación
$paginasSinAutenticacion = ['index', 'noticias', 'registro', 'login'];

// Verificar si la página actual requiere autenticación
if (in_array($control, $paginasSinAutenticacion)) {
    // Páginas sin autenticación
    switch ($control) {
        case 'index':
            $controller = new controller();
            $controller::index();
            break;
        case 'noticias':
            $controller::noticias();
            break;
        case 'registro':
            require './controler/controllerRegistro.php';
            $controller::registro();
            break;
        case 'login':
            require './controler/controllerLogin.php';
            $controller::login();
            break;
    }
} else {
    // Páginas que requieren autenticación
    if (isset($_SESSION['usuario']['idUser'])) {
        switch ($control) {
            case 'perfil':
                require './controler/controllerPerfil.php';
                $controllerPerfil = new controllerPerfil();
            
                // Verificamos si estamos tratando de actualizar la contraseña
                if (isset($_GET['action']) && $_GET['action'] === 'updatePass') {
                    $controllerPerfil->updatePass(); // Llama a la acción de actualizar la contraseña
                } elseif (isset($_GET['action']) && $_GET['action'] === 'updateDatos') {
                    $controllerPerfil->updateDatos(); // Llama a la acción de actualizar datos
                } else {
                    // Si no estamos actualizando nada, mostramos el perfil normal
                    $controllerPerfil->perfil();
                }
                break;
            case 'citaciones':
                require './controler/controllerCitas.php';
                $controllerCitas = new controllerCita();

                // Verificar si se ha pasado una 'action' y gestionarla
                if (isset($_GET['action'])) {
                    $accion = $_GET['action'];

                    // Llamar a la acción correspondiente según el valor de 'action'
                    switch ($accion) {
                        case 'reservarCita':
                            error_log("Llamando a reservarCita()");
                            $controllerCitas::reservarCita();
                            break;
                        case 'eliminarCita':
                            error_log("Llamando a eliminarCita()");
                            $controllerCitas::eliminarCita();
                            break;
                        case 'actualizarCita':
                            error_log("Llamando a actualizarCita()");
                            $controllerCitas::actualizarCita();
                            break;
                        default:
                            error_log("Acción no válida para citaciones: $accion");
                            die("Error 404: Acción no encontrada en citaciones.");
                    }
                } else {
                    // Si no hay 'action', simplemente se muestra la página de citaciones
                    $controllerCitas::reservarCita();
                }
                break;
            // Rutas de ADMINISTRACIÓN
            case 'adminCitas':
                require_once './controler/admin/controllerAdminCitas.php';
                $controllerAdminCitas = new ControllerAdminCitas();
            
                if (isset($_GET['action'])) {
                    $accion = $_GET['action'];
            
                    switch ($accion) {
                        case 'selectUser':
                            $controllerAdminCitas::selectUser();
                            break;
                        case 'gestionarCitas':
                            $controllerAdminCitas::gestionarCitas();
                            break;
                        case 'crearCita':
                            $controllerAdminCitas::crearCita();
                            break;
                        case 'modificarCita':
                            $controllerAdminCitas::modificarCita();
                            break;
                        case 'eliminarCita':
                            $controllerAdminCitas::eliminarCita();
                            break;
                        default:
                            die("Error 404: Acción no encontrada para la administración de citas.");
                    }
                } else {
                    $controllerAdminCitas::selectUser(); // Página predeterminada
                }
                break;
            
            case 'admin':
                require_once './controler/admin/controllerUser.php';
                
                $controllerAdminUser = new controllerAdminUser();

               if (isset($_GET['action'])) {
                    $accion = $_GET['action'];

                    switch ($accion) {
                        case 'usuarios_admin':
                            $controllerAdminUser::listarUsuarios();
                            break;
                        case 'crearUsuario':
                            $controllerAdminUser::crearUsuario();
                            break;
                        case 'modificarUsuario':
                            $controllerAdminUser::modificarUsuario();
                            break;
                        case 'borrarUsuario':
                            $controllerAdminUser::borrarUsuario();
                            break;
                        default:
                            die("Error 404: Acción no encontrada para el administrador.");
                    }
                } else {
                    $controllerAdminUser::listarUsuarios(); // Página predeterminada del admin
                }
           
        break;
            case 'newsAdmin':
                require './controler/admin/controllerNews.php';
                $controllerNews = new controllerNews();
                if (isset($accion)) {
                    switch ($accion) {
                        case 'listar':
                            $controllerNews::listarNoticias();
                            break;
                        case 'crearNew':
                            $controllerNews::crearNoticia();
                            break;
                        case 'modificarNew':
                            // Aquí pasamos el idNoticia, que lo recibimos de la URL
                            if (isset($_GET['idNoticia'])) {
                                $idNoticia = $_GET['idNoticia'];
                                $controllerNews::modificarNoticia($idNoticia);
                            } else {
                                die("Error 404: ID de noticia no encontrado.");
                            }
                            break;
                        case 'procesarModificacion':
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idNoticia'])) {
                                $idNoticia = $_POST['idNoticia'];
                                $controllerNews::procesarModificacion($idNoticia);
                            } else {
                                die("Error: No se ha recibido el ID de la noticia.");
                            }
                            break;
                        case 'borrarNew':
                            if (isset($_GET['idNoticia'])) {
                                $idNoticias = $_GET['idNoticia'];
                                $controllerNews::borrarNoticia($idNoticias);
                            } else {
                                die("Error: No se ha recibido el ID de la noticia.");
                            }
                            break;


                        case 'buscarNoticia':
                            $controllerNews::buscarNew();
                            break;

                        default:
                            die("Error 404: Accionno encontrada en noticias");
                    }
                } else {
                    include './views/adminNews/noticias_admin.php';
                }
                break;

        case 'logout':
                // Destruir la sesión
                session_destroy();

                // Redirigir al usuario a la página de inicio
                header('Location: index.php?controller=index');
                exit;
            default:
                die("Error 404: Página no encontrada.");
        }
    } else {
        // Redirigir a login si no está autenticado
        header('Location: index.php?controller=login');
        exit;
    }
    

}

?>