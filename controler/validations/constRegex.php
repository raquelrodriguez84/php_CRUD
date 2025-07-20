<?php
    //constantes para la validacion del registro y login
    define('REGEX_NOMBRE', '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/u');
    define('REGEX_APELLIDOS', '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,150}$/u');
    define('REGEX_EMAIL', '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/');
    define('REGEX_TELEFONO', '/^\d{9}$/');
    define('REGEX_FECHA', '/^\d{4}-\d{2}-\d{2}$/');
    define('REGEX_DIRECCION', '/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\.,#\/-º]{5,255}$/u');
    define('REGEX_CONTRASENA', '/^.{8,}$/');
    
    define('REGEX_TITULO', '/^.{5,100}$/u');
?>