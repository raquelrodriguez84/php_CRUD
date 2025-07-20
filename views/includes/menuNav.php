<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verificar si el usuario está autenticado
$isUser = isset($_SESSION['usuario']); // Si 'usuario' está en la sesión, el usuario está autentica
$isAdmin = isset($_SESSION['rol']) && $_SESSION['rol'] === 'ADMIN'; // Si 'rol' es ADMIN, es un administrador

// Depuración: Verificar el contenido de la sesión
?>
<header>
    <div class="nav">
        <div class="logo">
            <img src="/../phpFinal/assets/images/logo.png" alt="Logo">
        </div>
        <ul>
            <li data-page="inicio"><a href="index.php?controller=index">INICIO</a></li>
            <li data-page="noticias"><a href="index.php?controller=noticias">NOTICIAS</a></li>
            <?php
            if (!$isUser && !$isAdmin): ?>
                <!-- Opciones para visitantes (no autenticados) -->
                <li data-page="registro"><a href="index.php?controller=registro">REGISTRO</a></li>
                <li data-page="login"><a href="index.php?controller=login">INICIAR SESIÓN</a></li>
            <?php else: ?>
                <?php
                if ($isUser && !$isAdmin): ?>
                    <li data-page="citaciones"><a href="index.php?controller=citaciones&action=reservarCita">CITACIONES</a></li>
                    <li data-page="perfil"><a href="index.php?controller=perfil">PERFIL</a></li>
                <?php endif; ?>
                <!-- Opciones para usuarios autenticados -->
                
                <?php
                if ($isAdmin): ?>
                    <li data-page="usuarios_admin"><a href="index.php?controller=admin&action=usuarios_admin">GESTION USUARIOS</a></li>
                    <li data-page="citas_admin"><a href="index.php?controller=adminCitas&action=selectUser">GESTION CITAS</a></li>
                    <li data-page="noticias_admin"><a href="index.php?controller=newsAdmin">GESTION NOCTICIAS</a></li>
                    <li><a href="index.php?controller=perfil">PERFIL</a></li>
                <?php endif; ?>
                <li data-page="logout"><a href="index.php?controller=logout">CERRAR SESIÓN</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>
<hr>