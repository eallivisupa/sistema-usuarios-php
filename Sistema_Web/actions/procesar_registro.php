<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula   = trim($_POST['cedula']);
    $nombre   = trim($_POST['nombre']);
    $correo   = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if (empty($cedula) || empty($nombre) || empty($correo) || empty($password)) {
        header("Location: ../registro.php?error=" . urlencode("Todos los campos son obligatorios."));
        exit();
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../registro.php?error=" . urlencode("El formato de correo no es válido."));
        exit();
    }

    try {
        $query_check = "SELECT correo FROM usuarios WHERE correo = :correo";
        $stmt_check = $pdo->prepare($query_check);
        $stmt_check->execute(['correo' => $correo]);

        if ($stmt_check->rowCount() > 0) {
            header("Location: ../registro.php?error=" . urlencode("El correo ya se encuentra registrado."));
            exit();
        }

        $password_segura = password_hash($password, PASSWORD_DEFAULT);

        $query_insert = "INSERT INTO usuarios (cedula, nombre, correo, password) VALUES (:cedula, :nombre, :correo, :password)";
        $stmt_insert = $pdo->prepare($query_insert);
        $stmt_insert->execute(['cedula' => $cedula, 'nombre' => $nombre, 'correo' => $correo, 'password' => $password_segura]);

        header("Location: ../index.php?success=" . urlencode("Usuario registrado con éxito. ¡Inicia sesión!"));
        exit();
    } catch (PDOException $e) {
        header("Location: ../registro.php?error=" . urlencode("Error: " . $e->getMessage()));
        exit();
    }
}