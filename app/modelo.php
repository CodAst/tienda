<link rel="stylesheet" href="css/estilos.css">
<?php
require_once __DIR__ . "/../config/conexion.php";

class ProductoDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function obtenerProductosPorCategoria()
    {
        $sql = "SELECT p.*, c.nombre AS categoria 
                FROM productos p 
                JOIN categoria c ON p.categoria_id = c.id 
                ORDER BY c.nombre, p.nombre";
        $stmt = $this->conexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT p.*, c.nombre AS categoria
            FROM productos p
            INNER JOIN categoria c ON p.categoria_id = c.id
            WHERE p.id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function agregarAlCarrito($usuario_id, $producto_id, $cantidad) {
        $stmt = $this->conexion->prepare("SELECT id FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $stmt->execute([$usuario_id, $producto_id]);
        
        if ($fila = $stmt->fetch()) {
            // Ya está en el carrito → actualizar cantidad
            $stmt = $this->conexion->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE usuario_id = ? AND producto_id = ?");
            $stmt->execute([$cantidad, $usuario_id, $producto_id]);
        } else {
            // Insertar nuevo
            $stmt = $this->conexion->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
            $stmt->execute([$usuario_id, $producto_id, $cantidad]);
        }
    }
    
}
