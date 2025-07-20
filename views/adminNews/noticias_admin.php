<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_creaNews.css">
    <title>Noticias - Administración</title>
</head>

<body>

    <?php include_once __DIR__ . '/../includes/menuNav.php'; ?>

    <h1>Panel de administración de noticias</h1>

    <div class="lista">
        <a href="index.php?controller=newsAdmin&action=listar" class="news-list-link">Ver lista de noticias</a>
    </div>
    </div>
    <h2>Crear nueva noticia</h2>

    <div class="news-form-container">
        <form action="index.php?controller=newsAdmin&action=crearNew" method="POST" enctype="multipart/form-data" class="news-form">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
                <?php if (isset($_SESSION['errores']['titulo'])): ?>
                    <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['titulo']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen">
                <?php if (isset($_SESSION['errores']['imagen'])): ?>
                    <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['imagen']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="texto">Contenido:</label>
                <textarea name="texto" id="texto" rows="10" required></textarea>
                <?php if (isset($_SESSION['errores']['texto'])): ?>
                    <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['texto']); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="fecha_noticia">Fecha:</label>
                <input type="date" name="fecha_noticia" id="fecha_noticia" required>
                <?php if (isset($_SESSION['errores']['fecha_noticia'])): ?>
                    <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_noticia']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit" class="submit-button">Guardar Noticia</button>
        </form>
    </div>

    <?php include_once __DIR__ . '/../includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>