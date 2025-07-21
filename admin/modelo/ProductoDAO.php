<link rel="stylesheet" href="css/estilos.css">
<?php
require_once __DIR__ . '/../../config/conexion.php';

if (!class_exists('ProductoDAO')) {
    class ProductoDAO {
        public function listar() {
            $conexion = Conexion::conectar();
            $sql = "SELECT p.*, c.nombre AS categoria FROM productos p
                    JOIN categoria c ON p.categoria_id = c.id
                    ORDER BY p.id DESC";
            $stmt = $conexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarPorId($id) {
            $conexion = Conexion::conectar();
            $sql = "SELECT p.*, c.nombre AS categoria FROM productos p
                    JOIN categoria c ON p.categoria_id = c.id
                    WHERE p.id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insertar($nombre, $precio, $descripcion, $foto, $categoria_id) {
            if (empty($categoria_id)) {
                throw new Exception("⚠️ Error: La categoría no puede ser vacía o nula.");
            }

            $conexion = Conexion::conectar();
            $sql = "INSERT INTO productos (nombre, precio, descripcion, foto, categoria_id)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            return $stmt->execute([$nombre, $precio, $descripcion, $foto, $categoria_id]);
        }

        public function actualizar($id, $nombre, $precio, $descripcion, $foto, $categoria_id) {
            $conexion = Conexion::conectar();
            $sql = "UPDATE productos
                    SET nombre = ?, precio = ?, descripcion = ?, foto = ?, categoria_id = ?
                    WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            return $stmt->execute([$nombre, $precio, $descripcion, $foto, $categoria_id, $id]);
        }

        public function eliminar($id) {
            $conexion = Conexion::conectar();
            $sql = "DELETE FROM productos WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            return $stmt->execute([$id]);
        }
    }
}
