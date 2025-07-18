<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre']) ?> | Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
        <a href="index.php" class="btn btn-secondary mb-3">← Volver a la tienda</a>

        <div class="card mb-4 shadow">
            <div class="row g-0">
                <div class="col-md-5">
                    <?php if ($producto['foto']): ?>
                        <img src="imagenes/<?= $producto['foto'] ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <?php else: ?>
                        <div class="p-5 text-center">Sin imagen</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h3>
                        <p class="text-muted">Categoría: <?= htmlspecialchars($producto['categoria']) ?></p>
                        <h4 class="text-success">$<?= number_format($producto['precio'], 2) ?></h4>
                        <p><strong>Descripción:</strong> <?= $producto['descripcion'] ?></p>
                    </div>

                    <!-- ✅ FORMULARIO CORREGIDO -->
                    <form method="post" action="/tienda/app/agregar_carrito.php">
                        <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                        <label>Cantidad:</label>
                        <input type="number" name="cantidad" value="1" min="1" class="form-control w-25 d-inline">
                        <button type="submit" class="btn btn-primary mt-2">🛒 Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
