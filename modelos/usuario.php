<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/DB.php';
class usuario{
    //creo el metodo para registrar un nuevo ususario
    public static function registrarUser($nombre, $apellidos, $email, $telefono, $fechaNac, $direccion, $sexo)
    {
        try {
            //conectamos a la base de datos
            $conexion = DB::conn();
            //sentencia SQL para insertar el ususario
            $sql = 'INSERT INTO users_data (nombre, apellidos, email, telefono, fechaNac, direccion, sexo) 
                VALUES (:nombre, :apellidos, :email, :telefono, :fechaNac, :direccion, :sexo)';
            //preparo y ejecuto la sentencia
            $sentencia = $conexion->prepare($sql);
            error_log("Datos enviados para registrarUser: nombre: $nombre, $apellidos, $email, $telefono, $direccion, $fechaNac, $sexo");
            $sentencia->bindParam(':nombre', $nombre);
            $sentencia->bindParam(':apellidos', $apellidos);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':telefono', $telefono);
            $sentencia->bindParam(':fechaNac', $fechaNac);
            $sentencia->bindParam(':direccion', $direccion);
            $sentencia->bindParam(':sexo', $sexo);

            $sentencia->execute();
            $sentencia->closeCursor();

            //obtenemos el ultimo id insertado
            $idUser = $conexion->lastInsertId(); 
            error_log("Usuario registrado con exito. ID: $idUser");

            return $idUser; 
        
        } catch (PDOException $e) {
            //manejamos los errores
            error_log('Error al registrar el ususario: ' . $e->getMessage());
        return false;
        }
    }
    public static function registrarLogin($idUser, $email, $contrasena)
    {
        try {
            $conexion = DB::conn();
            $sqLogin = 'INSERT INTO users_login (idUser, usuario, contrasena, rol) VALUES (:idUser, :usuario, :contrasena, :rol)';
            $rol = "USER";
            $sentencia = $conexion->prepare($sqLogin);
            $passEncript = password_hash($contrasena, PASSWORD_BCRYPT);

            error_log("Datos a isnertar en users_login: idUser: $idUser, email: $email, y contraseña: $contrasena");
            $sentencia->bindParam(':idUser', $idUser);
            $sentencia->bindParam(':usuario', $email);
            $sentencia->bindParam(':contrasena', $passEncript);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->execute();
            $sentencia->closeCursor();
            return true;
        } catch (PDOException $e) {
            error_log("Error al registrar en login: " . $e->getMessage());
            return false;
        }
    }
    public static function verificarLogin($email, $contrasena){
        try {
            $conexion = DB::conn();
            $sql = 'SELECT idUser, usuario AS email, rol, contrasena FROM users_login WHERE usuario = :email';
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':email', $email);
            $sentencia->execute();
            $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    
            // Verificamos si el usuario existe y la contraseña coincide
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                // Guardamos los datos del usuario en la sesión
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['usuario'] = [
                    'idUser' => $usuario['idUser'],  // Asegúrate de que 'idUser' sea el campo correcto
                    'email' => $usuario['email'],
                    'rol' => $usuario['rol']
                ];
                return $usuario;
            } else {
                if (!$usuario) {
                    error_log("Intento de inicio de sesión fallido: usuario no encontrado para el $email");
                } elseif (!password_verify($contrasena, $usuario['contrasena'])) {
                    error_log("Intento de inicio de sesión fallido: contraseña incorrecta para el $email");
                }
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error en la verificación: " . $e->getMessage());
            return false;
        }
    }
    public function existeUsuario($email) {
        try {
            $conexion = DB::conn();
            $sql = "SELECT COUNT(*) FROM users_data WHERE email = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn(); 
            // Obtener el resultado directamente
            error_log("Resultado de la consulta: " . $count);
            return $count > 0;
        } catch (PDOException $e) {
            // Manejar el error de la base de datos
            error_log("Error en existeUsuario: " . $e->getMessage());
            return false; // O lanzar una excepción personalizada
        }
    }
    public static function datosUser($idUsuario){
        try{
            $conexion = DB::conn();
            $sql = 'SELECT nombre, apellidos, email, telefono, fechaNac, direccion, sexo FROM users_data where
            idUser = :idUsuario';
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(':idUsuario', $idUsuario);
            $sentencia->execute();
            $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            //Devolver los datos del usuario si existen
            if($usuario){
                return $usuario;
            }else{
                error_log("No se encontraron datos para el usuario con ID: $idUsuario");
                return false;
            }
        }catch(PDOException $e){
            error_log("Error al obtener los datos del usuario: ".$e->getMessage());
            return false;
        }
    }
    public function actualizarContrasena($idUsuario, $nuevaContrasena) {
        try {
            $conexion = DB::conn();
            $sql = "UPDATE users_login SET contrasena = :nuevaContrasena WHERE idUser = :idUsuario";
            $sentencia = $conexion->prepare($sql);
    
            // Encriptar la nueva contraseña
            $passEncriptada = password_hash($nuevaContrasena, PASSWORD_BCRYPT);
    
            // Depurar la contraseña encriptada
            var_dump($passEncriptada);  // Verificar la contraseña encriptada
    
            $sentencia->bindParam(':nuevaContrasena', $passEncriptada);
            $sentencia->bindParam(':idUsuario', $idUsuario);
    
            // Ejecutar la consulta
            $resultado = $sentencia->execute();
    
            if ($resultado) {
                return true;
            } else {
                // Verificar si hay errores en la ejecución de la consulta
                $error = $sentencia->errorInfo();
                var_dump($error);  // Mostrar posibles errores de la consulta
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al actualizar la contraseña: " . $e->getMessage());
            return false;
        }
    }
    public static function actualizarDatosUsuario($idUsuario, $nombre, $apellidos, $telefono, $fechaNac, $direccion, $sexo) {
        try {
            $conexion = DB::conn();
            $sql = "UPDATE users_data SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, fechaNac = :fechaNac, direccion = :direccion, sexo = :sexo WHERE idUser = :idUser";
            $sentencia = $conexion->prepare($sql);
    
            $sentencia->bindParam(':nombre', $nombre);
            $sentencia->bindParam(':apellidos', $apellidos);
            $sentencia->bindParam(':telefono', $telefono);
            $sentencia->bindParam(':fechaNac', $fechaNac);
            $sentencia->bindParam(':direccion', $direccion);
            $sentencia->bindParam(':sexo', $sexo);
            $sentencia->bindParam(':idUser', $idUsuario);
    
            $resultado = $sentencia->execute();
            $sentencia->closeCursor();
    
            return $resultado;
        } catch (PDOException $e) {
            error_log("Error al actualizar los datos del usuario: " . $e->getMessage());
            return false;
        }

}
}
?>
