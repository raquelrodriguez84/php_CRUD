<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_citas.css">
    <title>Gestion de citas</title>
</head>

<body>

    <?php include_once __DIR__ . '/../includes/menuNav.php'; ?>

    <div class="volver"><a href="index.php?controller=adminCitas&action=selectUser">VOLVER</a></div>
    <h2>Citas del usuario <?php echo htmlspecialchars($usuario['nombre']); ?></h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ordenar las citas por fecha (de más antigua a más reciente)
            usort($citas, function ($a, $b) {
                return strtotime($a['fecha_cita']) - strtotime($b['fecha_cita']);
            });

            $proximaCita = null; // Variable para almacenar la próxima cita
            $citasMostradas = []; // Array para almacenar las citas que ya se mostraron

            foreach ($citas as $cita) :
                $fechaCita = strtotime($cita['fecha_cita']);
                $esCitaPasada = $fechaCita < time();

                if (!$esCitaPasada && $proximaCita === null) {
                    $proximaCita = $cita; // Encontramos la próxima cita
                }
                // Solo mostrar en la tabla las citas que NO son la próxima
                if ($proximaCita === null || $cita['idCita'] != $proximaCita['idCita']) {
                    $citasMostradas[] = $cita['idCita']; // Agregar el idCita al array de citas mostradas
            ?>
                    <tr>
                        <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                        <td><?= htmlspecialchars($cita['motivo_cita']) ?></td>
                    </tr>
            <?php
                }
            endforeach;
            ?>
        </tbody>
    </table>
    <div class="cita">
        <h3>Próxima cita</h3>
        <?php
        if ($proximaCita) {
        ?>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($proximaCita['fecha_cita']); ?></p>
            <p><strong>Motivo:</strong> <?php echo htmlspecialchars($proximaCita['motivo_cita']); ?></p>
            <h3>Actualizar cita</h3>
            <form method="POST" action="index.php?controller=adminCitas&action=modificarCita">
                <input type="hidden" name="idCita" value="<?php echo htmlspecialchars($proximaCita['idCita']); ?>">
                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($idUser); ?>">
                <div class="form-group">
                    <label for="fecha_cita">Nueva fecha:</label>
                    <input type="date" name="fecha_cita" value="<?php echo htmlspecialchars($proximaCita['fecha_cita']); ?>" required>
                    <?php if (isset($_SESSION['errores']['fecha_cita'])) : ?>
                        <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_cita']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="motivo_cita">Nuevo motivo:</label>
                    <input type="text" name="motivo_cita" value="<?php echo htmlspecialchars($proximaCita['motivo_cita']); ?>" required>
                    <?php if (isset($_SESSION['errores']['motivo_cita'])) : ?>
                        <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['motivo_cita']); ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit">Actualizar cita</button>
            </form>

            <h3>Eliminar cita</h3>
            <form method="POST" action="index.php?controller=adminCitas&action=eliminarCita">
                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($idUser); ?>" />
                <input type="hidden" name="idCita" value="<?php echo htmlspecialchars($proximaCita['idCita']); ?>">
                <button class="btn btn-danger" type="submit">Eliminar cita</button>
            </form>
        <?php
        } else {
            echo "<p>No tienes ninguna cita programada.</p>";

            // Mostrar formulario de reserva solo si no tiene cita
        ?>
            <h3>Reservar una cita</h3>
            <form method="POST" action="index.php?controller=adminCitas&action=crearCita">
                <input type="hidden" name="idUser" value="<?php echo htmlspecialchars($idUser); ?>">
                <div class="form-group">
                    <label for="fecha_cita">Nueva fecha:</label>
                    <input type="date" name="fecha_cita" value="<?php echo htmlspecialchars($proximaCita['fecha_cita']); ?>" required>
                    <?php if (isset($_SESSION['errores']['fecha_cita'])) : ?>
                        <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_cita']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="motivo_cita">Nuevo motivo:</label>
                    <input type="text" name="motivo_cita" value="" required>
                    <?php if (isset($_SESSION['errores']['motivo_cita'])) : ?>
                        <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['motivo_cita']); ?></span>
                    <?php endif; ?>
                </div>

                <button class="btn-primary" type="submit">Reservar cita</button>
            </form>
        <?php
        }
        ?>
    </div>

    <?php include_once __DIR__ . '/../includes/footer.php'; ?>
    
    <script type="module" src="/phpFinal/script/currentPage.js"></script>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>