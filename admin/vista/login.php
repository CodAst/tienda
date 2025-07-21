<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión | ASA SHOP</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h1>ASA SHOP</h1>
            <p>ASA SHOP te ayuda a gestionar productos y categorías con facilidad.</p>
        </div>
        <div class="right-panel">
            <?php if (isset($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST" action="index.php?action=login">
                <input type="email" name="correo" placeholder="Correo electrónico" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Iniciar sesión</button>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </form>
            <hr>
            <a href="../index.php" class="btn btn-secondary mb-3">Regresar a la tienda</a>
        </div>
    </div>
</body>
</html>
