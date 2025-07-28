<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ASA Shop</title>
    <link rel="stylesheet" href="/tienda/assets/css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- HEADER -->
<header class="asa-header">
  <div class="asa-topbar">
    <span>ASA Shop - Calidad garantizada</span>
  </div>
  <div class="asa-navbar">
    <div class="asa-logo">ASA Shop</div>
    <div class="asa-search">
      <input type="text" placeholder="Buscar...">
    </div>
    <div class="asa-icons">
      <span title="Favoritos">❤️</span>
      <a href="/tienda/admin/vista/login.php" title="Iniciar sesión">👤</a>
      <a href="#" id="toggleIconoCarrito" title="Ver carrito">🛒</a>
    </div>
  </div>
</header>

<!-- BANNER -->
<section class="asa-banner">
  <img src="assets/img/banner.jpg" alt="Banner ASA Shop">
</section>

<?php
/* ----- helpers ----- */
function slugify($txt){
    $txt = iconv('UTF-8', 'ASCII//TRANSLIT', $txt);
    $txt = strtolower(preg_replace('/[^a-z0-9]+/', '-', $txt));
    return trim($txt, '-');
}
$menuCategorias = ['Tecnología','Moda','Belleza','Libros','Hogar'];
?>

<!-- MENÚ DE CATEGORÍAS -->
<nav class="categoria-nav">
    <div class="container d-flex justify-content-center gap-4">
        <?php foreach ($menuCategorias as $cat): ?>
            <a class="cat-link" href="#<?= slugify($cat) ?>"><?= $cat ?></a>
        <?php endforeach; ?>
    </div>
</nav>

<!-- PRODUCTOS -->
<div class="container">
    <?php foreach ($agrupados as $categoria => $items): ?>
        <h2 id="<?= slugify($categoria) ?>" class="text-primary mt-4">
            <?= htmlspecialchars($categoria) ?>
        </h2>
        <div class="row">
            <?php foreach ($items as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if ($item['foto']): ?>
                            <img src="imagenes/<?= $item['foto'] ?>" class="card-img-top"
                                 alt="<?= htmlspecialchars($item['nombre']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['nombre']) ?></h5>
                            <p class="card-text">$<?= number_format($item['precio'], 2) ?></p>
                            <a href="index.php?action=detalle&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- FOOTER -->
<footer class="bg-light text-center py-3 mt-5">
    <p class="mb-0">© <?= date('Y') ?> ASA Shop</p>
</footer>

<!-- CARRITO FLOTANTE -->
<?php
session_start();
require_once __DIR__ . "/../../admin/modelo/ProductoDAO.php";
$productoDAO = new ProductoDAO();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<div id="carritoFlotante" style="position: fixed; right: 20px; bottom: 20px; width: 320px; background: white; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); z-index: 1000; padding: 15px; display: none;">
    <h5>🛍 Tu carrito</h5>
    <ul class="list-group mb-3">
        <?php if (empty($carrito)): ?>
            <li class="list-group-item">Tu carrito está vacío.</li>
        <?php else: ?>
            <?php foreach ($carrito as $id => $cantidad):
                $producto = $productoDAO->buscarPorId($id);
                $subtotal = $producto['precio'] * $cantidad;
                $total += $subtotal;
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($producto['nombre']) ?> x<?= $cantidad ?>
                    <span>$<?= number_format($subtotal, 2) ?></span>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <p class="fw-bold">Total: $<?= number_format($total, 2) ?></p>
    <button class="btn btn-success w-100" onclick="pagar()">Pagar</button>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/funciones.js"></script>

<script>
    const carrito = document.getElementById("carritoFlotante");
    const toggleIcono = document.getElementById("toggleIconoCarrito");

    toggleIcono.addEventListener("click", function(e) {
        e.preventDefault();
        carrito.style.display = carrito.style.display === "none" ? "block" : "none";
    });

    function pagar() {
        alert("✅ ¡Producto pagado con éxito!");
    }
</script>

</body>
</html>
