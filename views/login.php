<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body class="inicio">
    <?php include_once __DIR__. '/includes/menuNav.php'; ?>               
    <div class="container">
    <main>
    <?php if (isset($_SESSION['mensaje_exito_registro'])): ?>
        <p style="color: green;"><?= $_SESSION['mensaje_exito_registro'] ?></p>
        <?php unset($_SESSION['mensaje_exito_registro']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <span class="error"><?= $_SESSION['mensaje_error'] ?></span>
        <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>
            <form class="login" action="index.php?controller=login" method="POST" id="loginForm">
            <fieldset>
            
            <div>
                <div><label>Correo electrónico:</label></div>
                <div>
                    <input type="email" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" required>
                </div>
            </div>
            <div>
                <div><label>Contraseña:</label></div>
                <div>
                    <input type="password" name="contrasena" id="contrasena" value="<?= $_POST['contrasena'] ?? '' ?>" required>
                </div>
            </div>
            <button type="submit">Iniciar sesión</button>
        </fieldset>
            </form>
        </main>
    </div>
    <?php include_once __DIR__. '/includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script> 
    <script type="module" src="/phpFinal/script/validacion.js"></script>
</body>
</html>

