<?php
session_start();
require_once "../../admin/modelo/ProductoDAO.php";
require_once "../../admin/config/conexion.php";

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    echo "El carrito está vacío.";
    exit;
}

$conexion = Conexion::conectar();

try {
    $conexion->beginTransaction();

    // Calcular total
    $total = 0;
    $productoDAO = new ProductoDAO();

    foreach ($carrito as $id => $cantidad) {
        $producto = $productoDAO->buscarPorId($id);
        $total += $producto['precio'] * $cantidad;
    }

    // Insertar compra
    $stmt = $conexion->prepare("INSERT INTO compra (total) VALUES (?)");
    $stmt->execute([$total]);
    $compraId = $conexion->lastInsertId();

    // Insertar detalles
    $stmt = $conexion->prepare("INSERT INTO detalle_compra (compra_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
    foreach ($carrito as $id => $cantidad) {
        $producto = $productoDAO->buscarPorId($id);
        $stmt->execute([$compraId, $id, $cantidad, $producto['precio']]);
    }

    $conexion->commit();
    unset($_SESSION['carrito']);
    echo "<h3>Compra registrada con éxito.</h3><a href='tienda.php'>Volver a tienda</a>";

} catch (Exception $e) {
    $conexion->rollBack();
    echo "Error al procesar la compra: " . $e->getMessage();
}
