<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="card">
    <h2>Crear Cuenta</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <form action="actions/procesar_registro.php" method="POST">
        <div class="form-group">
            <label>Cédula:</label>
            <input type="text" name="cedula" required maxlength="10">
        </div>
        <div class="form-group">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" required>
        </div>
        <div class="form-group">
            <label>Correo Electrónico:</label>
            <input type="email" name="correo" required>
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <i class="fa-regular fa-eye toggle-password" id="togglePassword" style="color: var(--text-muted);"></i>
            </div>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión aquí</a></p>
</div>

<button id="theme-toggle-btn" class="theme-toggle"><i class="fa-solid fa-moon"></i></button>
<script src="script.js"></script>
</body>
</html>