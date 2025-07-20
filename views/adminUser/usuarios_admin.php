<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_adminUser.css">
    <title>Gestion usuarios</title>

</head>

<body>
    <?php include_once __DIR__ . '/../includes/menuNav.php';
    ?>


    <h1>Panel de Administración de Usuarios</h1>

    <hr>

    <div><h2>Gestión de Usuarios</h2>
    <a href="index.php?controller=admin&action=crearUsuario">+ Crear Nuevo Usuario</a>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['idUser'] ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td>
                    <a href="index.php?controller=admin&action=modificarUsuario&id=<?= $usuario['idUser'] ?>">Modificar</a> |
                    <a href="index.php?controller=admin&action=borrarUsuario&id=<?= $usuario['idUser'] ?>"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php include_once __DIR__ . '/../includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>