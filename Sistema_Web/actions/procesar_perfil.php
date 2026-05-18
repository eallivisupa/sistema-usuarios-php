<?php
require_once '../config/conexion.php';
session_start();

if (!isset($_SESSION['usuario_cedula'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula   = $_SESSION['usuario_cedula'];
    $nombre   = trim($_POST['nombre']);
    $correo   = trim($_POST['correo']);

    if (empty($nombre) || empty($correo)) {
        header("Location: ../perfil.php?error=" . urlencode("Los campos no pueden estar vacíos."));
        exit();
    }

    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../perfil.php?error=" . urlencode("El formato de correo no es válido."));
        exit();
    }

    try {
        // Verificar si el correo ya existe
        $query_check = "SELECT cedula FROM usuarios WHERE correo = :correo AND cedula != :cedula";
        $stmt_check = $pdo->prepare($query_check);
        $stmt_check->execute(['correo' => $correo, 'cedula' => $cedula]);

        if ($stmt_check->rowCount() > 0) {
            header("Location: ../perfil.php?error=" . urlencode("El correo ya está siendo usado por otro usuario."));
            exit();
        }

        // Actualizar los datos del usuario actual
        $query_update = "UPDATE usuarios SET nombre = :nombre, correo = :correo WHERE cedula = :cedula";
        $stmt_update = $pdo->prepare($query_update);
        $stmt_update->execute([
            'nombre' => $nombre,
            'correo' => $correo,
            'cedula' => $cedula
        ]);

        // REFRESCAR LAS VARIABLES DE SESIÓN 
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_correo'] = $correo;

        header("Location: ../perfil.php?success=" . urlencode("Datos actualizados correctamente."));
        exit();

    } catch (PDOException $e) {
        header("Location: ../perfil.php?error=" . urlencode("Error al actualizar: " . $e->getMessage()));
        exit();
    }
} else {
    header("Location: ../perfil.php");
    exit();
}