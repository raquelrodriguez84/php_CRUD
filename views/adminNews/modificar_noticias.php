<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_creaNews.css">
    <title>Modificar noticias</title>
</head>

<body>
    <?php include_once __DIR__ . '/../includes/menuNav.php'; ?>

    <form action="index.php?controller=newsAdmin&action=procesarModificacion" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="idNoticia" value="<?php echo $noticia['idNoticias']; ?>">
        <div>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" value="<?php echo isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : htmlspecialchars($noticia['titulo']); ?>" required>
            <?php if (isset($_SESSION['errores']['titulo'])): ?>
                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['titulo']); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen">
            <?php if (isset($_SESSION['errores']['imagen'])): ?>
                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['imagen']); ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="texto">Texto:</label>
            <textarea name="texto" id="texto" required><?php echo isset($_POST['texto']) ? htmlspecialchars($_POST['texto']) : htmlspecialchars($noticia['texto']); ?></textarea>
            <?php if (isset($_SESSION['errores']['texto'])): ?>
                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['texto']); ?></span>
            <?php endif; ?>


        </div>
        <div>
            <label for="fecha_noticia">Fecha:</label>
            <input type="date" name="fecha_noticia" id="fecha_noticia" value="<?php echo isset($_POST['fecha_noticia']) ? htmlspecialchars($_POST['fecha_noticia']) : htmlspecialchars($noticia['fecha_noticia']); ?>" required>
            <?php if (isset($_SESSION['errores']['fecha_noticia'])): ?>
                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_noticia']); ?></span>
            <?php endif; ?>
        </div>
        <button type="submit">Modificar Noticia</button>
    </form>

    <?php require './views/includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>