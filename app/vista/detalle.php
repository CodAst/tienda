<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre']) ?> | ASA Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="/tienda/assets/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <div class="container py-5">
        <a href="index.php" class="btn btn-secondary mb-4">← Volver a la tienda</a>

        <section class="detalle-producto p-4">
            <div class="row align-items-center">
                <!-- Imagen del producto -->
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <?php if ($producto['foto']): ?>
                        <img src="imagenes/<?= $producto['foto'] ?>" alt="<?= $producto['nombre'] ?>" class="img-fluid detalle-img">
                    <?php else: ?>
                        <div class="p-5 text-center">Sin imagen</div>
                    <?php endif; ?>
                </div>

                <!-- Detalles del producto -->
                <div class="col-md-6">
                    <h1 class="detalle-titulo"><?= htmlspecialchars($producto['nombre']) ?></h1>
                    <p class="detalle-categoria text-muted">Categoría: <?= htmlspecialchars($producto['categoria']) ?></p>
                    <h3 class="text-success my-3">$<?= number_format($producto['precio'], 2) ?></h3>

                    <p><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?></p>

                    <!-- Formulario para agregar al carrito -->
                    <form method="post" action="/tienda/app/agregar_carrito.php" class="mt-4">
                        <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                        <div class="cantidad-box mb-3">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" value="1" min="1" class="form-control w-25">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            🛒 Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
