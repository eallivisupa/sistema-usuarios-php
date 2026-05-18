<?php
require_once '../config/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo   = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if (empty($correo) || empty($password)) {
        header("Location: ../index.php?error=" . urlencode("Por favor, llena todos los campos."));
        exit();
    }

    try {
        $query = "SELECT * FROM usuarios WHERE correo = :correo";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_cedula'] = $usuario['cedula'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_correo'] = $usuario['correo'];

            header("Location: ../perfil.php");
            exit();
        } else {
            header("Location: ../index.php?error=" . urlencode("Credenciales incorrectas."));
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../index.php?error=" . urlencode("Error: " . $e->getMessage()));
        exit();
    }
}