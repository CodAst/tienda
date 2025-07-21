<link rel="stylesheet" href="css/estilos.css">
<?php
session_start();

// Obtener datos del formulario
$id = $_POST['producto_id'] ?? null;
$cantidad = $_POST['cantidad'] ?? 1;

if ($id) {
    // Si el carrito no existe aún, lo creamos como array
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si ya existe el producto, sumamos la cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = $cantidad;
    }

    header("Location: carrito.php");
    exit();
} else {
    echo "ID de producto no válido.";
}
