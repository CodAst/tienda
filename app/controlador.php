<?php
require_once "modelo.php";

class Controller
{
    public function inicio()
    {
        $dao = new ProductoDAO();
        $productos = $dao->obtenerProductosPorCategoria();

        // Agrupar por categoría
        $agrupados = [];
        foreach ($productos as $p) {
            $agrupados[$p['categoria']][] = $p;
        }

        include "vista/tienda.php";
    }

    public function detalle($id)
    {
        if (!$id || !is_numeric($id)) {
            http_response_code(400);
            echo "ID de producto inválido.";
            return;
        }

        $dao = new ProductoDAO();
        $producto = $dao->obtenerPorId($id);

        if (!$producto) {
            http_response_code(404);
            echo "Producto no encontrado.";
            return;
        }

        include "vista/detalle.php";
    }
}

if ($_GET['action'] == 'agregar_carrito') {
    session_start();
    $usuario_id = $_SESSION['usuario_id']; // Asumiendo que ya manejas sesiones
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    require_once "modelo.php";
    $modelo = new Modelo();
    $modelo->agregarAlCarrito($usuario_id, $producto_id, $cantidad);

    header("Location: carrito.php");
    exit;
}