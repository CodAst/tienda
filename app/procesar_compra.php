<?php
session_start();
require_once "../../admin/modelo/ProductoDAO.php";
require_once "../../admin/config/conexion.php";

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    echo "<div style='padding:20px'><h3>El carrito está vacío.</h3><a href='tienda.php'>Volver a tienda</a></div>";
    exit;
}

$conexion = Conexion::conectar();

try {
    $conexion->beginTransaction();

    $total = 0;
    $productoDAO = new ProductoDAO();

    foreach ($carrito as $id => $cantidad) {
        $producto = $productoDAO->buscarPorId($id);
        if (!$producto) {
            throw new Exception("Producto con ID $id no encontrado.");
        }
        $total += $producto['precio'] * $cantidad;
    }

    // Insertar en tabla compra
    $stmt = $conexion->prepare("INSERT INTO compra (total) VALUES (?)");
    $stmt->execute([$total]);
    $compraId = $conexion->lastInsertId();

    // Insertar en tabla detalle_compra
    $stmtDetalle = $conexion->prepare("INSERT INTO detalle_compra (compra_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");

    foreach ($carrito as $id => $cantidad) {
        $producto = $productoDAO->buscarPorId($id);
        $stmtDetalle->execute([$compraId, $id, $cantidad, $producto['precio']]);
    }

    $conexion->commit();
    unset($_SESSION['carrito']);

    echo "<div style='padding:20px'><h3>✅ Compra registrada con éxito.</h3><a href='tienda.php'>Volver a tienda</a></div>";

    // Opcional: redireccionar automáticamente
    // header("Location: tienda.php");
    // exit;

} catch (Exception $e) {
    $conexion->rollBack();
    echo "<div style='padding:20px'><strong>Error al procesar la compra:</strong> " . $e->getMessage() . "</div>";
}