<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <div class="top-bar">
        <h1>Productos Registrados</h1>
        <div class="contenedor-boton">
            <a href="../index.php" class="btn-custom">Regresar a la tienda</a>
        </div>
    </div>

    <a href="index.php?action=registrar">Registrar Nuevo Producto</a><br><br>

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
                            <img src="../imagenes/<?= htmlspecialchars($prod['foto']) ?>" alt="foto">
                        <?php else: ?>
                            <em>Sin imagen</em>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                    <td>$<?= number_format($prod['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($prod['descripcion']) ?></td>
                    <td><?= htmlspecialchars($prod['categoria']) ?></td>
                    <td>
                        <a class="op" href="index.php?action=editar&id=<?= $prod['id'] ?>">✏️ Editar</a><br>
                        <a class="op" href="index.php?action=eliminar&id=<?= $prod['id'] ?>"
                           onclick="return confirm('¿Estás seguro de eliminar este producto?');">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
