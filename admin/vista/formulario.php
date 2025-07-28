<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="/tienda/assets/css/estilos.css">
</head>
<body class="form-container">
    <div class="form-card">
        <h1 class="titulo">Registrar Producto</h1>

        <form method="POST" action="index.php?action=registrar" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" cols="50" required><?= isset($producto) ? $producto['descripcion'] : '' ?></textarea>

            <label for="foto">Foto del producto:</label>
            <input type="file" name="foto" id="foto" accept="image/*">

            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" required>
                <option value="">Seleccione una categoría</option>
                <option value="1">Tecnología</option>
                <option value="2">Moda</option>
                <option value="3">Libros</option>
                <option value="4">Hogar</option>
                <option value="5">Belleza</option>
            </select>

            <button type="submit" class="btn">Guardar Producto</button>
        </form>
    </div>
</body>
</html>
