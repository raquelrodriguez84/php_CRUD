<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <?php include_once __DIR__ . '/includes/menuNav.php'; ?>

    <main>
    <?php if (isset($_SESSION['mensaje_exito_login'])): ?>
        <p style="color: green;"><?= $_SESSION['mensaje_exito_login'] ?></p>
        <?php unset($_SESSION['mensaje_exito_login']); ?>
    <?php endif; ?>
        <div>
            <!--<?php
                include __DIR__ . '/../modelos/DB.php';
                ?>-->
        </div>
        <section id="banner">
            <img src="/phpFinal/assets/images/rosa.jpg" alt="Rosa" width="640" height="427">
            <div class="texto-banner">
                <h1>Bienvenido a Mi Sitio Web</h1>
                <p>Un espacio donde podrás gestionar tus citas, leer noticias y mucho más.</p>
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <!-- Solo mostrar el enlace de registro si el usuario no está autenticado -->
                    <a href="/phpFinal/index.php?controller=registro" class="boton-destacado">Regístrate ahora</a>
                <?php endif; ?>
            </div>
        </section>
        <!-- Sección de servicios -->
        <section id="servicios">
            <h2>¿Qué ofrecemos?</h2>
            <div class="contenedor-servicios">
                <div class="servicio">
                    <img src="/phpFinal/assets/images/navidad.jpg" width="426" height="640" alt="Navidad">
                    <h3>Noticias</h3>
                    <p>Consulta las últimas novedades y mantente informado.</p>
                </div>
                <div class="servicio">
                    <img src="/phpFinal/assets/images/niño.jpg" width="640" height="422" alt="Niño en el bosque">
                    <h3>Citas</h3>
                    <p>Solicita, modifica o cancela tus citas con facilidad.</p>
                </div>
                <div class="servicio">
                    <img src="/phpFinal/assets/images/paisaje2.jpg" width="6000" height="4000" alt="Paisaje">
                    <h3>Tu perfil</h3>
                    <p>Gestiona tu información personal de forma segura.</p>
                </div>
            </div>
        </section>

        <!-- Galería de imágenes -->
        <section id="galeria">
            <h2>Nuestra Galería</h2>
            <div class="contenedor-galeria">
                <img src="/phpFinal/assets/images/rosa.jpg" width="640" height="480" alt="Rosa">
                <img src="/phpFinal/assets/images/gato.jpg" width="640" height="427" alt="gato">
                <img src="/phpFinal/assets/images/navidad.jpg" width="640" height="427" alt="navidad">
                <img src="/phpFinal/assets/images/niño.jpg" width="426" height="640" alt="Niño">
                <img src="/phpFinal/assets/images/paisaje2.jpg" width="6000" height="4000" alt="paisaje">
                <img src="/phpFinal/assets/images/piña.jpg" width="640" height="427" alt="Piña">
                <img src="/phpFinal/assets/images/2p.jpg" width="72" height="72" alt="Torcal">
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include_once __DIR__ . '/includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>