<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_noticias.css">
    <title>Lista de noticias</title>
</head>
<body>
    <?php include_once __DIR__. '/../includes/menuNav.php';?>
    <div class="lista"><a href="index.php?controller=newsAdmin">VOLVER</a></div>
    <div class=buscar>
    <form action="index.php" method="GET">
    <input type="hidden" name="controller" value="newsAdmin">
    <input type="hidden" name="action" value="buscarNoticia">
    
    <input type="text" name="query" placeholder="Buscar por título o contenido...">
    <input type="date" name="fecha">
    <button type="submit">Buscar</button>
</form>
</div>

<h2>Lista de noticias</h2>
<main>
    <?php if (empty($noticias)): ?>
        <p>No hay noticias disponibles.</p>
    <?php else: ?>
        <div class="news-container">
            <?php foreach ($noticias as $noticia): ?>
                <div class="news-item" data-noticia-id="<?php echo $noticia['idNoticias']; ?>">
                    <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                    <img src="/phpFinal/assets/files/<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" class="noticia-imagen">
                    <p class="noticia-texto texto-completo" data-texto-corto="<?php 
                    $textoCorto = substr(htmlspecialchars($noticia['texto']), 0, 100);
                    echo nl2br($textoCorto);
                    if (strlen(htmlspecialchars($noticia['texto'])) > 100) {
                        echo '...';
                    }
                    ?>">
                        <?php echo nl2br(htmlspecialchars($noticia['texto'])); ?>
                    </p>
                    <button class="ver-menos-btn">Ver menos</button>
                    <p class="fecha-noticia">Fecha: <?php echo htmlspecialchars($noticia['fecha_noticia']); ?></p>
                    <div class="news-actions">
                        <a href="index.php?controller=newsAdmin&action=modificarNew&idNoticia=<?php echo $noticia['idNoticias']; ?>" class="button button-edit">Modificar</a>
                        <a href="index.php?controller=newsAdmin&action=borrarNew&idNoticia=<?php echo $noticia['idNoticias']; ?>" class="button button-delete">Borrar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

    
    <?php
    include_once __DIR__.'/../includes/footer.php';?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script> 
   <script type="module" src="/phpFinal/script/newForm.js"></script>
</body>
</html>