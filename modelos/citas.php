<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once  __DIR__.'/DB.php';

class citas
{
    public static function agregarCita($idUser, $fecha_cita, $motivo_cita)
    {
        try {
            $conexion = DB::conn();
            $fecha_cita_formateada = date('Y-m-d', strtotime($fecha_cita));

            // Verificar si el usuario ya tiene una cita futura
            $sql = "SELECT 1 FROM citas WHERE idUser = :idUser AND fecha_cita >= CURDATE() LIMIT 1";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->execute();

            if ($sentencia->fetch()) {
                return false; // Ya tiene una cita futura
            }

            // Insertar la nueva cita
            $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (:idUser, :fecha_cita, :motivo_cita)";
            $sentencia = $conexion->prepare($sql);
            return $sentencia->execute([
                ":idUser" => $idUser,
                ":fecha_cita" => $fecha_cita_formateada,
                ":motivo_cita" => $motivo_cita
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar cita: " . $e->getMessage());
            return false;
        }
    }

    public static function obtenerCita($idUser)
    {
        try {
            $conexion = DB::conn();
            $sql = "SELECT * FROM citas WHERE idUser = :idUser AND fecha_cita >= CURDATE() ORDER BY fecha_cita ASC LIMIT 1";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener cita: " . $e->getMessage());
            return false;
        }
    }

    public static function actualizarCita($idCita, $fecha_cita, $motivo_cita)
    {
        try {
            $conexion = DB::conn();
            $fecha_cita_formateada = date('Y-m-d', strtotime($fecha_cita));

            $sql = "UPDATE citas SET fecha_cita = :fecha_cita, motivo_cita = :motivo_cita WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([
                ":idCita" => $idCita,
                ":fecha_cita" => $fecha_cita_formateada,
                ":motivo_cita" => $motivo_cita
            ]);

            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al actualizar cita: " . $e->getMessage());
            return false;
        }
    }

    public static function eliminarCita($idCita)
    {
        try {
            $conexion = DB::conn();

            // Obtener la fecha de la cita
            $sql = "SELECT fecha_cita FROM citas WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idCita", $idCita);
            $sentencia->execute();
            $cita = $sentencia->fetch(PDO::FETCH_ASSOC);

            if (!$cita) {
                return false; // No existe la cita
            }

            // Verificar si la cita ha pasado
            if (strtotime($cita['fecha_cita']) < time()) {
                return false; // Cita pasada, no se puede eliminar
            }

            // Eliminar la cita
            $sql = "DELETE FROM citas WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idCita", $idCita);
            $sentencia->execute();

            return $sentencia->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error al eliminar cita: " . $e->getMessage());
            return false;
        }
    }

    public static function obtenerCitasPorUsuario($idUser)
    {
        try {
            $conexion = DB::conn();
            $sql = "SELECT * FROM citas WHERE idUser = :idUser ORDER BY fecha_cita ASC"; // Obtener todas las citas del usuario
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC); // Devolver todas las citas
        } catch (PDOException $e) {
            error_log("Error al obtener citas por usuario: " . $e->getMessage());
            return []; // Devolver un array vacío en caso de error
        }
    }

    public static function obtenerCitaPorId($idCita)
    {
        // Conexión a la base de datos
        $conexion = DB::conn(); // Aquí adapta según cómo tengas la conexión
        $sql = "SELECT * FROM citas WHERE idCita = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$idCita]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve la cita como un array asociativo
    }
}




/*class citas{
    public static function agregarCita($idUser, $fecha_cita, $motivo_cita) {
        try {
            $conexion = DB::conn();
            // Solo guardar la fecha (sin hora)
            $fecha_cita_formateada = date('Y-m-d', strtotime($fecha_cita)); // Solo la fecha, sin la hora
    
            // Verificar si el usuario ya tiene una cita futura
            $sql = "SELECT * FROM citas WHERE idUser = :idUser AND fecha_cita >= CURDATE() LIMIT 1";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->execute();
            $cita_existente = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            if ($cita_existente) {
                // Si ya existe una cita futura, no permitir la nueva cita
                return false;
            }
    
            // Si no existe ninguna cita futura, procedemos con la inserción
            $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (:idUser, :fecha_cita, :motivo_cita)";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->bindParam(":fecha_cita", $fecha_cita_formateada);
            $sentencia->bindParam(":motivo_cita", $motivo_cita);
    
            $sentencia->execute();
            $sentencia->closeCursor();
            return true;
        } catch (PDOException $e) {
            error_log("Error al registrar en citas: " . $e->getMessage());
            return false;
        }
    }
    public static function obtenerCita($idUser) {
        try {
            $conexion = DB::conn();
            // Solo obtener citas futuras (sin hora)
            $sql = "SELECT * FROM citas WHERE idUser = :idUser AND fecha_cita >= CURDATE() ORDER BY fecha_cita ASC LIMIT 1";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idUser", $idUser);
            $sentencia->execute();
            $citas = $sentencia->fetch(PDO::FETCH_ASSOC);
            $sentencia->closeCursor();
            return $citas;
        } catch (PDOException $e) {
            error_log("Error al obtener cita: " . $e->getMessage());
            return false;
        }
    }
    
    public static function actualizarCita($idCita, $fecha_cita, $motivo_cita) {
        try {
            $conexion = DB::conn();
            // Solo actualizar la fecha (sin hora)
            $fecha_cita_formateada = date('Y-m-d', strtotime($fecha_cita)); // Solo la fecha
    
            $sql = "UPDATE citas SET fecha_cita = :fecha_cita, motivo_cita = :motivo_cita WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idCita", $idCita);
            $sentencia->bindParam(":fecha_cita", $fecha_cita_formateada);
            $sentencia->bindParam(":motivo_cita", $motivo_cita);
    
            $sentencia->execute();
            $sentencia->closeCursor();
    
            if ($sentencia->rowCount() > 0) {
                return true;
            } else {
                return false; // Si no se actualizó ninguna fila
            }
        } catch (PDOException $e) {
            error_log("Error al actualizar cita: " . $e->getMessage());
            return false;
        }
    }
    
    public static function eliminarCita($idCita)
    {
        try {
            $conexion = DB::conn();

            // Obtener la información de la cita
            $sql = "SELECT fecha_cita FROM citas WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idCita", $idCita);
            $sentencia->execute();
            $cita = $sentencia->fetch(PDO::FETCH_ASSOC);
            $sentencia->closeCursor();

            if (!$cita) {
                die("Error: La cita no existe.");
            }

            // Verificar si la cita ya pasó (comparar fecha y hora)
            $fecha_cita = $cita['fecha_cita'];
            if (strtotime($fecha_cita) < time()) {
                die("Error: No puedes eliminar una cita que ya ha pasado.");
            }

            // Si la cita no ha pasado, eliminarla
            $sql = "DELETE FROM citas WHERE idCita = :idCita";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindParam(":idCita", $idCita);
            $sentencia->execute();

            if ($sentencia->rowCount() > 0) {
                return true; // Cita eliminada con éxito
            } else {
                return false; // No se eliminó ninguna cita
            }
        } catch (PDOException $e) {
            error_log("Error al eliminar la cita: " . $e->getMessage());
            return false;
        }
    }
   
}*/