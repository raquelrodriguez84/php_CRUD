<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_noticias.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Noticias</title>
</head>

<body>
    <?php include_once __DIR__ . '/includes/menuNav.php'; ?>

    <main>

        <?php if (empty($noticias)): ?>
            <p>No hay noticias disponibles.</p>
        <?php else: ?>
            <div class="news-container">
                <?php foreach ($noticias as $noticia): ?>
                    <div class="news-item">
                        <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                        <img src="/phpFinal/assets/files/<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" class="noticia-imagen">
                        <p class="noticia-texto" data-full-text="<?php echo htmlspecialchars($noticia['texto']); ?>">
                            <?php
                            // Mostrar solo los primeros 100 caracteres del texto
                            $textoCorto = substr(htmlspecialchars($noticia['texto']), 0, 100);
                            echo nl2br($textoCorto);
                            if (strlen(htmlspecialchars($noticia['texto'])) > 100) {
                                echo '... ';
                                echo '<span class="ver-mas-btn">Ver más</span>'; // Botón "Ver más"
                            }
                            ?>
                        </p>
                        <p class="fecha-noticia">Fecha: <?php echo htmlspecialchars($noticia['fecha_noticia']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php
    include_once __DIR__. '/includes/footer.php';
    ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
    <script type="module" src="/phpFinal/script/newForm.js"></script>

</body>

</html>