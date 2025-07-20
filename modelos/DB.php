<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//incluimos los parametros de conexion 
require_once __DIR__.'/.env.php';
;
class DB {
    private static $conexion;

    public static function conn() {
        if (!isset(self::$conexion)) {
            try {
            
                self::$conexion = new PDO(
                    "mysql:host=" . HOST . ";dbname=" . BD . ";charset=utf8mb4",USER, PASS);    
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
                return self::$conexion;
            } catch (PDOException $e) {
                error_log("Error de conexión a la base de datos: " . $e->getMessage());
                throw new Exception("Error al conectar con la base de datos.");
            }
        }
        return self::$conexion;
    }
}