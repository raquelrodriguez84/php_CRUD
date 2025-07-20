<?php
// Datos predeterminados o del usuario en sesión
$datos = $_SESSION['usuario'] ?? [
    'nombre' => '',
    'apellidos' => '',
    'email' => '',
    'telefono' => '',
    'fechaNac' => '',
    'direccion' => '',
    'sexo' => ''
];
$datos['sexo'] = strtolower($datos['sexo'] ?? '');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_perfil.css">
    <title>Mi perfil</title>
</head>

<body>
    <?php include_once __DIR__ . '/includes/menuNav.php'; ?>
    <div class="profile-container">
        <div class="profile-info">
            <?php if ($datosUser): ?>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($datosUser['nombre']); ?></p>
                <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($datosUser['apellidos']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($datosUser['email']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($datosUser['telefono']); ?></p>
                <p><strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($datosUser['fechaNac']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($datosUser['direccion']); ?></p>
                <p><strong>Sexo:</strong> <?php echo htmlspecialchars($datosUser['sexo']); ?></p>
            <?php else: ?>
                <p>No se encontraron datos para este usuario.</p>
            <?php endif; ?>
        </div>

        <div class="password-change">
            <?php if (isset($_SESSION['errores_perfil']) && !empty($_SESSION['errores_perfil'])) : ?>
                <div class="errores">
                    <h3>Se han encontrado los siguientes errores:</h3>
                    <ul>
                        <?php foreach ($_SESSION['errores_perfil'] as $campo => $error) : ?>
                            <li class="error"><strong><?php echo ucfirst($campo); ?>:</strong> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errores_perfil']); ?>
            <?php endif; ?>
            <button id="btnMostrarFormDatos" class="change-password-button">Cambiar datos </button>
            <form id="formDatosUsuario" action="index.php?controller=perfil&action=updateDatos" method="POST" class="<?php echo (isset($_SESSION['mostrar_formulario']) && $_SESSION['mostrar_formulario']) ? 'visible' : 'hidden'; ?>">
                <p><strong>Nombre:</strong>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($datosUser['nombre']); ?>" required>

                <p><strong>Apellidos:</strong>
                    <input type="text" name="apellidos" value="<?php echo htmlspecialchars($datosUser['apellidos']); ?>" required>

                </p>

                <p><strong>Email:</strong> <?php echo htmlspecialchars($datosUser['email']); ?> (No editable)</p>


                <p><strong>Teléfono:</strong>
                    <input type="text" name="telefono" value="<?php echo htmlspecialchars($datosUser['telefono']); ?>">

                </p>

                <p><strong>Fecha de Nacimiento:</strong>
                    <input type="date" name="fechaNac" value="<?php echo htmlspecialchars($datosUser['fechaNac']); ?>">

                </p>

                <p><strong>Dirección:</strong>
                    <input type="text" name="direccion" value="<?php echo htmlspecialchars($datosUser['direccion']); ?>">

                </p>

                <p><strong>Sexo:</strong>
                    <select name="sexo">
                        <option value="Masculino" <?php echo ($datosUser['sexo'] === 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="Femenino" <?php echo ($datosUser['sexo'] === 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                        <option value="Otro" <?php echo ($datosUser['sexo'] === 'Otro') ? 'selected' : ''; ?>>Otro</option>
                    </select>

                </p>

                <input type="submit" value="Actualizar Datos" class="submit-button">
            </form>
        </div>

        <div class="password-change">
            <button id="btnMostrarFormPass">Cambiar contraseña</button>
            <form id="formCambiarPass" action="index.php?controller=perfil&action=updatePass" method="POST" style="display: none;">
                <label for="nuevaContrasena">Nueva contraseña:</label>
                <input type="password" name="nuevaContrasena" id="nuevaContrasena" required>
                <label for="confirmarContrasena">Confirmar nueva contraseña:</label>
                <input type="password" name="confirmarContrasena" id="confirmarContrasena" required>
                <button type="submit">Cambiar</button>
            </form>
            <?php
            // Mostrar mensajes de error para contraseña
            $errores_contrasena = '';
            if (isset($_SESSION['errores_contrasena']) && !empty($_SESSION['errores_contrasena'])) {
                foreach ($_SESSION['errores_contrasena'] as $error) {
                    $errores_contrasena .= "<span style='color: red;'>" . $error . "</span><br>";
                }
                unset($_SESSION['errores_contrasena']); // Limpiar errores
            }

            // Mostrar mensaje de éxito para contraseña
            $mensaje_exito = '';
            if (isset($_SESSION['mensaje_exito'])) {
                $mensaje_exito = "<span style='color: green;'>" . $_SESSION['mensaje_exito'] . "</span>";
                // Limpiar mensaje de éxito
                unset($_SESSION['mensaje_exito']); 
            }
            ?>

            <?= $errores_contrasena ?>
            <?= $mensaje_exito ?>

        </div>
    </div>
    <?php include_once __DIR__ . '/includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
    <script type="module" src="/phpFinal/script/form_pass.js"></script>
 </body>

</html>