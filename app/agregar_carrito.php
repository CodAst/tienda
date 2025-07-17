<?php
session_start();

$id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id] += $cantidad;
} else {
    $_SESSION['carrito'][$id] = $cantidad;
}

header("Location: carrito.php");
exit;
