<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
</head>

  <body>
    <?php
    include __DIR__ . '/includes/menuNav.php';
    ?>
    <main>
    <?php
    
    if (isset($_SESSION['mensaje_error_registro'])): ?>
        <p style="color: red;"><?= $_SESSION['mensaje_error_registro'] ?></p>
        <?php unset($_SESSION['mensaje_error_registro']); endif; ?>
        <form class="registro" action="index.php?controller=registro" method="POST">
            <fieldset class="register">
                <div class="datos">
                    <div><label for="nombre">Nombre:</label></div>
                    <div>
                        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
                        <?php if (isset($errores['nombre'])): ?>
                            <span class="error"><?= $errores['nombre'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <div><label for="apellidos">Apellidos:</label></div>
                    <div>
                        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($_POST['apellidos'] ?? '') ?>" required>
                        <?php if (isset($errores['apellidos'])): ?>
                            <span class="error"><?= $errores['apellidos'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <div><label for="email">Email:</label></div>
                    <div>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        <?php if (isset($errores['email'])): ?>
                            <span class="error"><?= $errores['email'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <div><label for="telefono">Teléfono:</label></div>
                    <div>
                        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                        <?php if (isset($errores['telefono'])): ?>
                            <span class="error"><?= $errores['telefono'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <div><label for="fechaNac">Fecha de nacimiento:</label></div>
                    <div>
                        <input type="date" id="fechaNac" name="fechaNac" value="<?= htmlspecialchars($_POST['fechaNac'] ?? '') ?>" required>
                        <?php if (isset($errores['fechaNac'])): ?>
                            <span class="error"><?= $errores['fechaNac'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <div><label for="direccion">Dirección:</label></div>
                    <div>
                        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($_POST['direccion'] ?? '') ?>">
                        <?php if (isset($errores['direccion'])): ?>
                            <span class="error"><?= $errores['direccion'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datos">
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo">
                        <option value="Masculino" <?= ($_POST['sexo'] ?? '') == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Femenino" <?= ($_POST['sexo'] ?? '') == 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                        <option value="No contesta" <?= ($_POST['sexo'] ?? '') == 'No contesta' ? 'selected' : '' ?>>No contesta</option>
                    </select>
                    <?php if (isset($errores['sexo'])): ?>
                        <span class="error"><?= $errores['sexo'] ?></span>
                    <?php endif; ?>
                </div>

                <h2 class="register">CREE SU CONTRASEÑA</h2>

                <div class="datos">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required>

                    <?php if (isset($errores['contrasena'])): ?>
                        <span class="error"><?= $errores['contrasena'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="datos">
                    <label for="confirm_password">Confirmar contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>

                    <?php if (isset($errores['confirm_password'])): ?>
                        <span class="error"><?= $errores['confirm_password'] ?></span>
                    <?php endif; ?>
                </div>
                <button type="submit">Registrarse</button>
            </fieldset>
        </form>
        <?php
        include_once __DIR__. '/includes/footer.php';
        ?>
        <script type="module" src="/phpFinal/script/currentPge.js"></script>
  </body>

</html>