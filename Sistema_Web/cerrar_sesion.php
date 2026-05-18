<?php
session_start();
session_unset();    // Limpia las variables de sesión
session_destroy();  // Destruye la sesión por completo

// Redirigir al login
header("Location: index.php?success=" . urlencode("Has cerrado sesión correctamente."));
exit();
?>