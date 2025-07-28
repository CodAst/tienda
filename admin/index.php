<<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Admin - ASA Shop</title>
</head>
</html>

<?php
define('APP_PATH', dirname(__DIR__)); // → C:\xampp\htdocs\tienda

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once APP_PATH . "/config/conexion.php";
require_once APP_PATH . "/admin/controlador/AuthController.php";
require_once APP_PATH . "/admin/controlador/ProductoController.php";

$action = $_GET['action'] ?? 'login';
$auth = new AuthController();
$controller = new ProductoController();

// Acciones públicas
$publicas = ['login', 'logout'];

// ✅ SOLO redirigir si NO estás en acción pública Y NO estás autenticado
if (!in_array($action, $publicas) && !isset($_SESSION['usuario'])) {
    header("Location: index.php?action=login");
    exit();
}



switch ($action) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
    case 'listar':
        $controller->listar();
        break;
    case 'registrar':
        $controller->registrar();
        break;
    case 'eliminar':
        $controller->eliminar(); 
        break;
    case 'editar':
        $controller->editar();
        break;
    // ...
    default:
        header("Location: index.php?action=login");
        break;
}

