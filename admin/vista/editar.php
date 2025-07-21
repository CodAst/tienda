<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="form-container">
    <div class="form-card">
        <h1 class="titulo">Editar Producto</h1>

        <form method="POST" action="index.php?action=actualizar" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($producto['nombre']) ?>">

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required value="<?= htmlspecialchars($producto['precio']) ?>">

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>

            <label>Foto actual:</label><br>
            <?php if (!empty($producto['foto'])): ?>
                <img src="imagenes/<?= htmlspecialchars($producto['foto']) ?>" alt="Foto del producto" style="width:120px;border-radius:8px;margin:10px 0;">
            <?php else: ?>
                <p><em>Sin imagen</em></p>
            <?php endif; ?>

            <label for="foto">Nueva foto (opcional):</label>
            <input type="file" name="foto" id="foto" accept="image/*">

            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <option value="1" <?= $producto['categoria_id'] == 1 ? 'selected' : '' ?>>Tecnología</option>
                <option value="2" <?= $producto['categoria_id'] == 2 ? 'selected' : '' ?>>Moda</option>
                <option value="3" <?= $producto['categoria_id'] == 3 ? 'selected' : '' ?>>Libros</option>
                <option value="4" <?= $producto['categoria_id'] == 4 ? 'selected' : '' ?>>Hogar</option>
                <option value="5" <?= $producto['categoria_id'] == 5 ? 'selected' : '' ?>>Belleza</option>
            </select>

            <button type="submit" class="btn">Actualizar Producto</button>
            <a href="index.php?action=listar" class="cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>
