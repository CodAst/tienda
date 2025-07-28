<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - ASA Shop</title>
  <link rel="stylesheet" href="../assets/css/login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <p class="text-center mb-1 text-muted" style="font-weight: 500;">Bienvenido administrador</p>
    <h2 class="text-center mb-4" style="color: #00b3b3;">Inicia sesión en <br> <strong>ASA Shop</strong></h2>

    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger text-center">
        <?php
        if ($_GET['error'] === 'campos_vacios') {
            echo "Por favor, completa todos los campos.";
        } elseif ($_GET['error'] === 'credenciales_invalidas') {
            echo "Credenciales inválidas. Intenta de nuevo.";
        }
        ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="../verificar.php">
      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" name="correo" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" required>
      </div>

      <button type="submit" class="btn w-100" style="background-color: #00b3b3; color: white;">Ingresar</button>
    </form>

    <div class="text-center mt-3">
      <a href="/tienda/" class="text-muted" style="text-decoration: none;">← Regresar a la tienda</a>
    </div>
  </div>

</body>
</html>
