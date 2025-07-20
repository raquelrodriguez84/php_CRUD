<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../../modelos/noticias.php';
require __DIR__. '/../validations/v_noticia.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class controllerNews
{
    public static function crearNoticia()
    {
        require __DIR__.'/../../views/adminNews/noticias_admin.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = htmlspecialchars(trim($_POST['titulo']) ?? '', ENT_QUOTES, 'UTF-8');
            $imagen = $_FILES['imagen'] ?? null;
            $texto = htmlspecialchars($_POST['texto'] ?? '', ENT_QUOTES, 'UTF-8');
            $fecha_noticia = isset($_POST['fecha_noticia']) ? trim($_POST['fecha_noticia']) : '';

            // Verifica que idUser exista en la sesión
            if (!isset($_SESSION['usuario']['idUser'])) {
                error_log("Error: Usuario no autenticado.");
                $_SESSION['error'] = "Usuario no autenticado.";
                header("Location: index.php?controller=login");
                exit();
            }

            $errores = validarNoticia($_POST, $imagen);
    
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                header('Location: index.php?controller=newsAdmin&action=crearNew');
                exit();
            }
           
            $idUser = $_SESSION['usuario']['idUser'];
            
    
            // Manejo de imagen
            $nombre_imagen = null;
            if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
                $nombre_imagen = basename($imagen['name']);
                $ruta_destino = 'assets/files/' . $nombre_imagen;
    
                if (!move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
                    error_log("Error al mover la imagen a: $ruta_destino");
                    $_SESSION['error'] = "Error al subir la imagen.";
                    header("Location: index.php?controller=newsAdmin&action=crearNew");
                    exit();
                }
                error_log("Imagen subida correctamente: $ruta_destino");
            } else {
                error_log("No se subió ninguna imagen o hubo un error en la subida.");
            }
       
            // Llamada al modelo
            $resultado = noticias::creaNews(null, $titulo, $nombre_imagen, $texto, $fecha_noticia, $idUser);
            if ($resultado) {
                error_log("Noticia creada con éxito");
                $_SESSION['mensaje'] = "Noticia creada con éxito.";
            } else {
                error_log("Error al crear la noticia");
                $_SESSION['error'] = "Error al crear la noticia.";
            }
            header("Location: index.php?controller=newsAdmin&action=listar");
            exit();
        }
    }
    
    public static function listarNoticias() {
        error_log("Ejecutando listarNoticias()");
    
        $noticias = noticias::obtenerNews();
        error_log("Noticias obtenidas: " . print_r($noticias, true));
    
        require __DIR__. '/../../views/adminNews/listar_noticias.php';
    }
    public static function buscarNew(){
        $query = isset($_GET['query']) ? trim($_GET['query']) : null;
        $fecha = isset($_GET['fecha']) ? trim($_GET['fecha']) : null;

        if(empty($query) && empty($fecha)){
            $_SESSION['error'] = "Debe ingresar un termino de fecha correcto.";
            header("Location: index.php?controller=newsAdmin&action=listar");
            exit();
        }

        $noticias = noticias::buscarNews($query, $fecha);
        require __DIR__.'/../../views/adminNews/listar_noticias.php';

    }
    
    public static function modificarNoticia($idNoticia)
    {   // Obtener la noticia por su ID
        $noticia = noticias::buscarNewsId($idNoticia);
    
        // Verificar si se ha encontrado la noticia
        if (!$noticia) {
            $_SESSION['error'] = "Noticia no encontrada.";
            header('Location: index.php?controller=newsAdmin&action=listar');
            exit();
        }
        //buscamos la noticia por el idNoticia
        $noticia = noticias::buscarNewsId($idNoticia);  
        
        //si la noticia existe, se muestra el formulario
        if($noticia){
            require __DIR__.'/../../views/adminNews/modificar_noticias.php';
        }else{
            $_SESSION['error'] = "Noticia no encontrada";
            header("Location: index.php?controller=newsAdmin&action=listar");
            exit();
        }
    }
    public static function procesarModificacion(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $idNoticia = $_POST['idNoticia'];
            $titulo = trim(htmlspecialchars($_POST['titulo']) ?? '');
            $imagen = $_FILES['imagen'] ?? null;
            $texto = htmlspecialchars($_POST['texto'] ?? '', ENT_QUOTES, 'UTF-8');
            $fecha_noticia = isset($_POST['fecha_noticia']) ? trim($_POST['fecha_noticia']) : '';

            $errores = validarNoticia($_POST, $imagen);
    
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $noticia = noticias::buscarNewsId($idNoticia);
                require __DIR__.'/../../views/adminNews/modificar_noticias.php';
                exit();
            }
    
    
            // Verificar si hay una nueva imagen
            $nombre_imagen = null;
            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $tipos_permitidos = ['image/jpg', 'image/png', 'image/jpeg'];
                if (!in_array($imagen['type'], $tipos_permitidos)) {
                    $_SESSION['error'] = 'El tipo de archivo de la imagen no es correcto.';
                    header("Location: index.php?controller=newsAdmin&action=modificarNoticia&idNoticia=$idNoticia");
                    exit();
                }
    
                $nombre_imagen = $imagen['name'];
                $ruta_destino = 'assets/images/' . $nombre_imagen;
                if (!move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
                    $_SESSION['error'] = "Error al subir la imagen";
                    header("Location: index.php?controller=newsAdmin&action=modificarNoticia&idNoticia=$idNoticia");
                    exit();
                }
            } else {
                // Si no se sube una nueva imagen, recuperamos la anterior
                $noticia = noticias::buscarNewsId($idNoticia);
                $nombre_imagen = $noticia['imagen'];
            }
    
            // Actualizar la noticia
            $resultado = noticias::actualizarNew($idNoticia, $titulo, $nombre_imagen, $texto, $fecha_noticia);
    
            

        if ($resultado) {
            $_SESSION['mensaje'] = "Noticia modificada con éxito";
            error_log("Redirecting to list");
            header("Location: index.php?controller=newsAdmin&action=listar");
        } else {
            $_SESSION['error'] = "Error al modificar la noticia";
            error_log("Error updating news");
            require __DIR__.'/../../views/adminNews/modificar_noticias.php';
        }
        exit();
        }
    }
    
    public static function borrarNoticia($idNoticias){
    // Llamamos al modelo para eliminar la noticia
    $resultado = noticias::borrarNoticia($idNoticias);
    if ($resultado) {
        $_SESSION['mensaje'] = "Noticia eliminada con éxito";
    } else {
        $_SESSION['error'] = "Error al eliminar la noticia";
    }

    // Redirigimos de vuelta a la lista de noticias
    header("Location: index.php?controller=newsAdmin&action=listar");
    exit();
    }

 
   
}
?>



