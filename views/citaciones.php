<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_nav.css">
    <link rel="stylesheet" href="/phpFinal/assets/stilos/stilo_citas.css">
</head>

<body>

    <?php include_once __DIR__ . '/includes/menuNav.php';?>
    <?php
    // Verificar si el usuario ha iniciado sesión
    if (isset($_SESSION['usuario']['idUser'])) {
        $idUser = $_SESSION['usuario']['idUser'];

        // Incluir el modelo y obtener la cita
        require_once __DIR__ . '/../modelos/citas.php';
        $cita = citas::obtenerCita($idUser);

        if ($cita) {
    ?>
            <div class="cita-container">
                <h2>Tu cita reservada:</h2>
                <div class="cita-info">
                    <p><strong>Fecha:</strong> <?php echo htmlspecialchars($cita['fecha_cita']); ?></p>
                    <p><strong>Motivo:</strong> <?php echo htmlspecialchars($cita['motivo_cita']); ?></p>
                </div>

                <div class="cita-form">
                    <h3>Actualizar cita</h3>
                    <form method="POST" action="index.php?controller=citaciones&action=actualizarCita">
                        <input type="hidden" name="idCita" value="<?php echo htmlspecialchars($cita['idCita']); ?>" />
                        <div class="form-group">
                            <label for="fecha_cita">Nueva fecha:</label>
                            <input type="date" name="fecha_cita" value="<?php echo htmlspecialchars($cita['fecha_cita']); ?>" required>
                            <?php if (isset($_SESSION['errores']['fecha_cita'])): ?>
                                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_cita']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="motivo_cita">Nuevo motivo:</label>
                            <input type="text" name="motivo_cita" value="<?php echo htmlspecialchars($cita['motivo_cita']); ?>" required>
                            <?php if (isset($_SESSION['errores']['motivo_cita'])): ?>
                                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['motivo_cita']); ?></span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar cita</button>
                    </form>
                </div>

                <div class="cita-form">
                    <h3>Eliminar cita</h3>
                    <form method="POST" action="index.php?controller=citaciones&action=eliminarCita">
                        <input type="hidden" name="idCita" value="<?php echo htmlspecialchars($cita['idCita']); ?>" />
                        <button type="submit" class="btn btn-danger">Eliminar cita</button>
                    </form>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="cita-container">
                <p>No tienes ninguna cita reservada.</p>
                <div class="cita-form">
                    <h3>Reservar una cita</h3>
                    <form method="POST" action="index.php?controller=citaciones&action=reservarCita">
                        <div class="form-group">
                            <label for="fecha_cita">Fecha:</label>
                            <input type="date" name="fecha_cita" required>
                            <?php if (isset($_SESSION['errores']['fecha_cita'])): ?>
                                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['fecha_cita']); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="motivo_cita">Motivo:</label>
                            <input type="text" name="motivo_cita">
                            <?php if (isset($_SESSION['errores']['motivo_cita'])): ?>
                                <span class="error"><?php echo htmlspecialchars($_SESSION['errores']['motivo_cita']); ?></span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-success">Reservar cita</button>
                    </form>
                </div>
            </div>
        <?php
        }
        unset($_SESSION['errores']);
    } else {
        ?>
        <div class="cita-container">
            <p>Debes iniciar sesión para ver o modificar tus citas.</p>
        </div>
    <?php
    }
    ?>
    <?php include_once __DIR__ . '/includes/footer.php'; ?>
    <script type="module" src="/phpFinal/script/currentPge.js"></script>
</body>

</html>