-- Crear base de datos
CREATE DATABASE IF NOT EXISTS cibele_estudio;
USE cibele_estudio;

-- Tabla de Productos
CREATE TABLE IF NOT EXISTS productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255),
    cantidad_disponible INT DEFAULT 0,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE,
    INDEX idx_activo (activo),
    INDEX idx_nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email_cliente VARCHAR(100) NOT NULL,
    nombre_cliente VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT,
    total DECIMAL(10, 2),
    estado ENUM('pendiente', 'confirmado', 'enviado', 'entregado') DEFAULT 'pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_estado (estado),
    INDEX idx_email (email_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Detalles del Pedido
CREATE TABLE IF NOT EXISTS detalles_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT,
    precio_unitario DECIMAL(10, 2),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    INDEX idx_pedido (pedido_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo
INSERT INTO productos (nombre, descripcion, precio, cantidad_disponible) VALUES
('Anillo de Plata', 'Anillo elegante de plata 925', 45.99, 10),
('Collar de Cuarzo', 'Collar con piedra de cuarzo natural', 55.50, 8),
('Pulsera de Perlas', 'Pulsera artesanal con perlas de agua dulce', 65.00, 5);