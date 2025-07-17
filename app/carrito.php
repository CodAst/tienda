<?php
session_start();
require_once "../../admin/modelo/ProductoDAO.php";
$productoDAO = new ProductoDAO();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<h1>Carrito de Compras</h1>
<a href="tienda.php">← Seguir comprando</a>
<hr>

<?php if (empty($carrito)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($carrito as $id => $cantidad): 
            $producto = $productoDAO->buscarPorId($id);
            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($producto['nombre']) ?></td>
                <td>$<?= number_format($producto['precio'], 2) ?></td>
                <td><?= $cantidad ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
                <td>
                    <a href="carrito.php?accion=eliminar&id=<?= $id ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total: $<?= number_format($total, 2) ?></h3>
    <form method="post" action="procesar_compra.php">
        <button type="submit">Finalizar Compra</button>
    </form>
<?php endif; ?>

<?php
// Lógica para eliminar del carrito
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
    unset($_SESSION['carrito'][$_GET['id']]);
    header("Location: carrito.php");
}
?>
