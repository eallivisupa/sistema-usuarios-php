<?php
session_start();
if (!isset($_SESSION['usuario_cedula'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h2>Cambiar Contraseña</h2>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="msg success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="actions/procesar_password.php" method="POST">
        <div class="form-group">
            <label>Contraseña Actual:</label>
            <input type="password" name="password_actual" required>
        </div>
        <div class="form-group">
            <label>Nueva Contraseña:</label>
            <input type="password" name="password_nueva" required>
        </div>
        <div class="form-group">
            <label>Confirmar Nueva Contraseña:</label>
            <input type="password" name="password_confirmar" required>
        </div>
        <button type="submit">Actualizar Contraseña</button>
    </form>
    <p><a href="perfil.php">Volver al Perfil</a></p>
</div>

<button id="theme-toggle-btn" class="theme-toggle"><i class="fa-solid fa-moon"></i></button>
<script src="script.js"></script>
</body>
</html>