<?php
session_start();

require_once __DIR__ . '/../admin/modelo/ProductoDAO.php';

$productoDAO = new ProductoDAO();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h1>🛒 Carrito de Compras</h1>
    <a href="../index.php" class="btn btn-secondary mb-3">← Seguir comprando</a>
    <hr>

    <?php if (empty($carrito)): ?>
        <div class="alert alert-info">El carrito está vacío.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
                        <a href="carrito.php?accion=eliminar&id=<?= $id ?>" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php
            $iva = $total * 0.15;
            $totalConIVA = $total + $iva;
        ?>

        <h4 class="mt-3">Subtotal: $<?= number_format($total, 2) ?></h4>
        <h5>IVA (15%): $<?= number_format($iva, 2) ?></h5>
        <h3 class="mt-2 text-success">Total a pagar: $<?= number_format($totalConIVA, 2) ?></h3>

        <form method="post" action="procesar_compra.php">
            <button type="submit" class="btn btn-success">Finalizar Compra</button>
        </form>
    <?php endif; ?>

    <?php
    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $idEliminar = $_GET['id'];
        unset($_SESSION['carrito'][$idEliminar]);
        header("Location: carrito.php");
        exit();
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btn = document.querySelector("form button[type='submit']");
            if (btn) {
                btn.addEventListener("click", function (e) {
                    e.preventDefault();
                    alert("📦 Tu pedido ha sido registrado y está pendiente de pago.");
                    window.location.href="../index.php";
                });
            }
        });
    </script>

</body>
</html>
