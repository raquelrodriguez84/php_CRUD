<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='/phpFinal/assets/stilos/stilo_registro.css'>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <title>Crear ususario</title>
</head>
<body>
  <?php include_once __DIR__ . '/../includes/menuNav.php'; ?>
<?php
$accion = $_GET['action'] ?? 'listar'; // Acción por defecto
?>

<h1>Panel de Administración de Usuarios</h1>
<div class="volver"><a href="index.php?controller=admin&action=usuarios_admin" class="btn-secondary">Volver</a></div>

<hr>
<?php if (isset($_SESSION['mensaje_error_crear_usuario'])): ?>
    <p style="color: red;"><?= $_SESSION['mensaje_error_crear_usuario'] ?></p>
    <?php unset($_SESSION['mensaje_error_crear_usuario']); ?>
<?php endif; ?>

<?php
$esEdicion = isset($usuario);
?>

<h2><?= $esEdicion ? 'Modificar Usuario' : 'Crear Usuario' ?></h2>

<form class="formularioUser" action="index.php?controller=admin&action=<?= $esEdicion ? 'modificarUsuario&id=' . $usuario['idUser'] : 'crearUsuario' ?>" method="POST">
    <fieldset>
        <legend>Datos Personales</legend>
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input class="formUser" type="text" id="nombre" name="nombre" value="<?= $esEdicion ? ($usuario['nombre'] ?? '') : '' ?>" required>
            <?php if (isset($errores['nombre'])): ?>
                <span class="error"><?= $errores['nombre'] ?></span>
            <?php endif; ?>

        </div>

        <div class="campo">
            <label for="apellidos">Apellidos:</label>
            <input class="formUser" type="text" id="apellidos" name="apellidos" value="<?= $usuario['apellidos'] ?? '' ?>" required>
            <?php if (isset($errores['apellidos'])): ?>
                <span class="error"><?= $errores['apellidos'] ?></span>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="email">Email:</label>
            <input class="formUser" type="email" id="email" name="email" value="<?= $usuario['email'] ?? '' ?>" required>
            <?php if (isset($errores['email'])): ?>
                <span class="error"><?= $errores['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input class="formUser" type="text" id="telefono" name="telefono" value="<?= $usuario['telefono'] ?? '' ?>" required>
            <?php if (isset($errores['telefono'])): ?>
                <span class="error"><?= $errores['telefono'] ?></span>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="fechaNac">Fecha de Nacimiento:</label>
            <input class="formUser" type="date" id="fechaNac" name="fechaNac" value="<?= $usuario['fechaNac'] ?? '' ?>">
            <?php if (isset($errores['fechaNac'])): ?>
                <span class="error"><?= $errores['fechaNac'] ?></span>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="direccion">Dirección:</label>
            <input class="formUser" type="text" id="direccion" name="direccion" value="<?= $usuario['direccion'] ?? '' ?>">
            <?php if (isset($errores['direccion'])): ?>
                <span class="error"><?= $errores['direccion'] ?></span>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo">
                <option value="Femenino" <?= (isset($usuario['sexo']) && $usuario['sexo'] === 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                <option value="Masculino" <?= (isset($usuario['sexo']) && $usuario['sexo'] === 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                <option value="No contesta" <?= (isset($usuario['sexo']) && $usuario['sexo'] === 'No contesta') ? 'selected' : '' ?>>No contesta</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Datos de Usuario</legend>
        <div class="campo">
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="USER" <?= (isset($usuario['rol']) && $usuario['rol'] === 'USER') ? 'selected' : '' ?>>Usuario</option>
                <option value="ADMIN" <?= (isset($usuario['rol']) && $usuario['rol'] === 'ADMIN') ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <div class="campo">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" <?= !$esEdicion ? 'required' : '' ?>>
            <?php if (isset($errores['contrasena'])): ?>
                <span class="error"><?= $errores['contrasena'] ?></span>
            <?php endif; ?>
            <?php if ($esEdicion): ?>
                <small>Si no desea cambiar la contraseña, deje el campo en blanco,de lo contrario introduzca un minimo de 8 caracterres.</small>
                <input type="hidden" name="es_modificacion" value="1">
            <?php endif; ?>
        </div>
    </fieldset>

    <button type="submit" name="accion" value="<?= isset($usuario) ? 'modificar' : 'crear' ?>">
        <?= isset($usuario) ? 'Guardar Cambios' : 'Crear Usuario' ?>
    </button>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
<script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>