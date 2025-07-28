<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php?error=acceso_denegado");
    exit();
}

require_once('../../config/conexion.php');
require_once('../modelo/ProductoDAO.php');

$productoDAO = new ProductoDAO();
$productos = $productoDAO->listar(); // ← CORREGIDO AQUÍ
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="/tienda/assets/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="top-bar">
        <h1>Productos Registrados</h1>
        <p class="text-muted">👋 Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></p>
        <div class="contenedor-boton">
            <a href="../../index.php" class="btn-custom">Cerrar Sesión</a>
        </div>
    </div>

    <a href="formulario.php" class="registrar-btn">+ Registrar Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $prod): ?>
                <tr>
                    <td><?= $prod['id'] ?></td>
                    <td>
                        <?php if ($prod['foto']): ?>
                            <img src="../imagenes/<?= htmlspecialchars($prod['foto']) ?>" alt="foto" style="width: 100px;">
                        <?php else: ?>
                            <em>Sin imagen</em>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($prod['descripcion']) ?></td>
                    <td><?= htmlspecialchars($prod['categoria']) ?></td>
                    <td>
                    <a class="op" href="index.php?action=editar&id=<?= $prod['id'] ?>">✏️ Editar</a>
                    <br>
                        <a class="op" href="index.php?action=eliminar&id=<?= $prod['id'] ?>"
                           onclick="return confirm('¿Estás seguro de eliminar este producto?');">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
