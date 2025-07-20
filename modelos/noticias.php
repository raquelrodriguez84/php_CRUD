<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once  __DIR__ . '/DB.php';
//creacion modificacion y eliminar noticias
class noticias
{
    public static function creaNews($idNoticia, $titulo, $imagen, $texto, $fecha_noticia, $idUser)
    {
        try {
            $conexion = DB::conn();
            $sqlNews = "INSERT INTO noticias (titulo, imagen, texto, fecha_noticia, idUser)
                         VALUES (:titulo, :imagen, :texto, :fecha_noticia, :idUser)";
            $sentencia = $conexion->prepare($sqlNews);
            $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $sentencia->bindParam(':imagen', $imagen, PDO::PARAM_STR);
            $sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
            $sentencia->bindParam(':fecha_noticia', $fecha_noticia, PDO::PARAM_STR);
            $sentencia->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $resultado = $sentencia->execute();

            if (!$resultado) {
                error_log("Error al ejecutar la consulta: " . print_r($sentencia->errorInfo(), true));
            }
    
            $sentencia->closeCursor(); // Cerramos el cursor para liberar recursos
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error de PDO: " . $e->getMessage());
            return false;
        }
    }
    public static function obtenerNews(){
        try{
            $conexion = DB::conn();
            $sqlShow = "SELECT * FROM noticias";
            $sentencia = $conexion->prepare($sqlShow);
            $sentencia->execute();
            $noticias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            $sentencia->closeCursor();
            return $noticias;
        }catch (PDOException $e) {
            error_log("Error al obtener noticias: " . $e->getMessage()); // Registro del error
            return []; // Devuelve un array vacío en caso de error
        }
    }
    public static function buscarNews($query = null, $fecha = null){
        $conexion = DB::conn();
        $sqlBuscar = "SELECT * FROM noticias WHERE 1=1";
        $params = [];

        if(!empty($query)){
            $sqlBuscar .= " AND (titulo LIKE ? OR texto LIKE ?)";
            $param = "%" .$query. "%";
            array_push($params, $param, $param);
            }
        if(!empty($fecha)){
            $sqlBuscar .= " AND fecha_noticia = ?";
            array_push($params, $fecha);
        }

        $sentencia = $conexion->prepare($sqlBuscar);
        $sentencia->execute($params);
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia -> closeCursor();

        return $resultados;
    }
    public static function buscarNewsId($idNoticias){
        $conexion = DB::conn();
        $sqlBuscarNews = "SELECT * FROM noticias WHERE idNoticias = ?";
        $sentencia = $conexion->prepare($sqlBuscarNews);
        $sentencia->execute([$idNoticias]);

         
    if ($sentencia->rowCount() > 0) {
        return $sentencia->fetch(PDO::FETCH_ASSOC); // Retorna la noticia como un array asociativo
    }

        $noticia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia -> closeCursor();

        return $noticia;
    }
    public static function actualizarNew($idNoticias, $titulo, $imagen, $texto, $fecha_noticia){
        try{
            $conexion = DB::conn();
            $sqlUpdate = "UPDATE noticias SET titulo = ?, imagen = ?, texto = ?, fecha_noticia = ? WHERE idNoticias = ?";
            $sentencia = $conexion ->prepare($sqlUpdate);
            
            $resultado = $sentencia ->execute([$titulo, $imagen, $texto, $fecha_noticia, $idNoticias]);
            if (!$resultado) {
                print_r($sentencia->errorInfo()); // Ver errores SQL
                die("Error al ejecutar la consulta.");
            }
            return true;
        }catch(PDOException $e){
            error_log("Error al actualizar la noticia: " . $e->getMessage());
            return false;
        }
    }
    public static function borrarNoticia($idNoticias){

        try{
            $conexion = DB::conn();
            $sqlDelete = "DELETE FROM noticias WHERE idNoticias = :idNoticias";
            $sentencia = $conexion->prepare($sqlDelete);
            $sentencia->bindParam(':idNoticias', $idNoticias, PDO::PARAM_INT);
            $resultado = $sentencia->execute();

            $sentencia->closeCursor();

        return $resultado;
    } catch (PDOException $e) {
        error_log("Error al borrar la noticia: " . $e->getMessage());
        return false;
    }
  }    
}

?>