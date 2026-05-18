<?php
require_once '../config/conexion.php'; 
session_start();

if (!isset($_SESSION['usuario_cedula'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula             = $_SESSION['usuario_cedula'];
    $password_actual    = $_POST['password_actual'];
    $password_nueva     = $_POST['password_nueva'];
    $password_confirmar = $_POST['password_confirmar'];

    // Validar que las nuevas contraseñas coincidan
    if ($password_nueva !== $password_confirmar) {
        header("Location: ../cambiar_password.php?error=" . urlencode("Las contraseñas nuevas no coinciden."));
        exit();
    }

    try {
        // Traer la contraseña actual de la base de datos para verificarla
        $query = "SELECT password FROM usuarios WHERE cedula = :cedula";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['cedula' => $cedula]);
        $usuario = $stmt->fetch();

        // Verificar si la contraseña actual ingresada es correcta
        if (password_verify($password_actual, $usuario['password'])) {
            
            //Validar que la nueva no sea igual a la actual
            if (password_verify($password_nueva, $usuario['password'])) {
                header("Location: ../cambiar_password.php?error=" . urlencode("La nueva contraseña no puede ser igual a la actual."));
                exit(); // <-- Faltaba esto
            } 
            
            //Hashear la nueva contraseña y actualizar
            $nueva_password_hash = password_hash($password_nueva, PASSWORD_DEFAULT);
            
            $query_update = "UPDATE usuarios SET password = :password WHERE cedula = :cedula";
            $stmt_update = $pdo->prepare($query_update);
            $stmt_update->execute([
                'password' => $nueva_password_hash,
                'cedula'   => $cedula
            ]);

            header("Location: ../cambiar_password.php?success=" . urlencode("¡Contraseña actualizada con éxito!"));
            exit();

        } else {
            header("Location: ../cambiar_password.php?error=" . urlencode("La contraseña actual es incorrecta."));
            exit();
        }

    } catch (PDOException $e) {
        header("Location: ../cambiar_password.php?error=" . urlencode("Error en el sistema: " . $e->getMessage()));
        exit();
    }
}
?>