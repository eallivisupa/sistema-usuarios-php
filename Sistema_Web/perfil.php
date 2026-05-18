<?php
session_start();
if (!isset($_SESSION['usuario_cedula'])) {
    header("Location: index.php?error=" . urlencode("Debes iniciar sesión para acceder."));
    exit();
}
$nombre_actual = $_SESSION['usuario_nombre'];
$correo_actual = $_SESSION['usuario_correo'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="perfil-layout">

<div class="navbar">
    <span>Bienvenido/a, <strong><?php echo htmlspecialchars($nombre_actual); ?></strong></span>
    <div>
        <a href="cambiar_password.php">Cambiar Contraseña</a>
        <a href="cerrar_sesion.php" style="color: #ef4444;">Cerrar Sesión</a>
    </div>
</div>

<div class="container">
    <h2>Perfil de Usuario</h2>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="msg success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="actions/procesar_perfil.php" method="POST">
        <div class="form-group">
            <label>Cédula (No modificable):</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['usuario_cedula']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre_actual); ?>" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($correo_actual); ?>" required>
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>
</div>

<button id="theme-toggle-btn" class="theme-toggle"><i class="fa-solid fa-moon"></i></button>
<script src="script.js"></script>
</body>
</html>