<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="card">
    <h2>Iniciar Sesión</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="msg success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>

    <form action="actions/procesar_login.php" method="POST">
        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required>
                <i class="fa-regular fa-eye toggle-password" id="togglePassword" style="color: var(--text-muted);"></i>
            </div>
        </div>
        
        <button type="submit">Ingresar</button>
    </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</div>

<button id="theme-toggle-btn" class="theme-toggle"><i class="fa-solid fa-moon"></i></button>
<script src="script.js"></script>
</body>
</html>