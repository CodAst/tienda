-- Crear la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

-- Tabla de categorías
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla de productos con clave foránea y campo para imagen
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    foto VARCHAR(255),
    categoria_id INT NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);
-- Poblado incial de categorías
INSERT INTO categoria (nombre) VALUES
('Tecnología'),
('Moda'),
('Hogar'),
('Libros');

-- Contraseña: 123456 (usaremos https://onlinephp.io/password-hash)
INSERT INTO usuarios (correo, contrasena)
VALUES ('admin@tienda.com', '$2y$10$LVy/4OipnchmJfiGD5DMiOUiQblfwt.Xv2cjvKSHYVa4j.Nj.T6eu');

-- Tabla que representa una compra realizada
CREATE TABLE compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),
    estado VARCHAR(50) DEFAULT 'pendiente'
);

-- Tabla detalle que guarda los productos comprados
CREATE TABLE detalle_compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compra_id INT,
    producto_id INT,
    cantidad INT,
    precio_unitario DECIMAL(10,2),
    FOREIGN KEY (compra_id) REFERENCES compra(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla temporal (carrito de compras) por usuario
CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad INT DEFAULT 1,
    session_id VARCHAR(255),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

