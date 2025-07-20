<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__. '/DB.php';

class adminUser{
    //obtener listado de todos los usuarios
    public static function obtenerTodos(){
        $conexion = DB::conn();
        $sql = "SELECT * FROM users_data INNER JOIN users_login 
        ON users_data.idUser = users_login.idUser";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    //obtener el usuario por ID
    public static function obtenerPorId($idUser) {
        $conexion = DB::conn();
        $sql = "SELECT * FROM users_data 
                INNER JOIN users_login ON users_data.idUser = users_login.idUser 
                WHERE users_data.idUser = :idUser"; // Agregado WHERE
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(':idUser', $idUser, PDO::PARAM_INT); // Corregido el tipo de dato
        $sentencia->execute();
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }
    //actualizamos o modificamos los usuarios
    public static function actualizarUsuario($idUser, $nombre, $apellidos, $email, $telefono, $direccion, $fechaNac, $sexo, $rol, $contrasena = null) {
        try {
            $conexion = DB::conn();
            $conexion->beginTransaction();
            // Actualización de datos del usuario en users_data
            $sqlData = "UPDATE users_data 
                        SET nombre = :nombre, 
                            apellidos = :apellidos, 
                            email = :email,
                            telefono = :telefono, 
                            fechaNac = :fechaNac,
                            direccion = :direccion,
                            sexo = :sexo
                        WHERE idUser = :idUser";
        
            $stmtData = $conexion->prepare($sqlData);
            $stmtData->execute([
                ':nombre'    => $nombre,
                ':apellidos' => $apellidos,
                ':email'     => $email,
                ':telefono'  => $telefono,
                ':fechaNac'  => $fechaNac,
                ':direccion' => $direccion,
                ':sexo'      => $sexo,
                ':idUser'    => $idUser
            ]);
        
            // Actualización del usuario (email) y rol en users_login
            $params = [
                ':usuario' => $email,
                ':rol'     => $rol,
                ':idUser'  => $idUser
            ];
        
                 $sqlLogin = "UPDATE users_login SET usuario = :usuario, rol = :rol";
    
        // Si se proporciona una nueva contraseña, la actualizamos
        if (!empty($contrasena)) {
            $contrasenaHashed = password_hash($contrasena, PASSWORD_DEFAULT);
            echo "Contraseña Cifrada: " . $contrasenaHashed;  // Verifica el valor cifrado
            $params[':contrasena'] = $contrasenaHashed;
            $sqlLogin .= ", contrasena = :contrasena";
        }
        
    
        $sqlLogin .= " WHERE idUser = :idUser";
    
        $stmtLogin = $conexion->prepare($sqlLogin);
        $stmtLogin->execute($params);
    
        $conexion->commit();
        return true;
    } catch (PDOException $e) {
        error_log("Error al actualizar usuario con ID $idUser: " . $e->getMessage());
        $conexion->rollBack();
        return false;
    }
    
    } 
    //eliminamos usuario
    public static function eliminarUsuario($id) {
    $conexion = DB::conn();

    try {
        $conexion->beginTransaction();

        $stmtLogin = $conexion->prepare("DELETE FROM users_login WHERE idUser = ?");
        $stmtLogin->execute([$id]);

        $stmtData = $conexion->prepare("DELETE FROM users_data WHERE idUser = ?");
        $stmtData->execute([$id]);

        $conexion->commit();
        return true;
    } catch (PDOException $e) {
        $conexion->rollBack();
        error_log("Error en la transacción de borrado: " . $e->getMessage());
        return false;
    }
}
    
}