<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (empty($correo) || empty($contrasena)) {
        header("Location: vista/login.php?error=campos_vacios");
        exit();
    }

    try {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['correo'];
            header("Location: vista/lista.php");
            exit();
        } else {
            header("Location: vista/login.php?error=credenciales_invalidas");
            exit();
        }

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

} else {
    header("Location: vista/login.php");
    exit();
}