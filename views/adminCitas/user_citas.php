<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_citas.css">
</head>

<body>

    <?php include_once __DIR__ . '/../includes/menuNav.php'; ?>

    <h2>Seleccionar Usuario para Gestionar Citas</h2>

    <?php if (!empty($usuarios)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <button type="button" class="btn-primary"><a href="index.php?controller=adminCitas&action=gestionarCitas&idUser=<?= urlencode($usuario['idUser']) ?>">Gestionar Citas</a>
                            </button>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay usuarios disponibles para gestionar citas.</p>
    <?php endif; ?>

    <?php include_once __DIR__ . '/../includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>