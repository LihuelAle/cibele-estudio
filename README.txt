# Cibele Estudio - Tienda online migrada a Supabase + HTML/JS

Este proyecto es la versión estática de la tienda Cibele Estudio, originalmente en PHP/MySQL, ahora funcionando con Supabase como backend y listo para ser desplegado en Cloudflare Pages.

## 📁 Estructura de archivos
- `index.html` - Página principal de la tienda
- `confirmacion.html` - Página de agradecimiento tras un pedido
- `admin/` - Panel de administración (productos y pedidos)
- `css/` - Estilos (idénticos a los originales)
- `js/` - Código JavaScript con lógica y configuración de Supabase
- `_headers` - Configuración de seguridad para Cloudflare Pages

## 🔧 Configuración inicial (solo una vez)

### 1. Crear las tablas en Supabase
Ejecutá el siguiente SQL en el editor SQL de tu proyecto Supabase (https://supabase.com/dashboard/project/tu-proyecto/sql):

```sql
CREATE TABLE productos (
  id SERIAL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL,
  imagen VARCHAR(255),
  cantidad_disponible INT DEFAULT 0,
  creado_en TIMESTAMP DEFAULT NOW(),
  activo BOOLEAN DEFAULT TRUE
);

CREATE TABLE pedidos (
  id SERIAL PRIMARY KEY,
  email_cliente VARCHAR(100) NOT NULL,
  nombre_cliente VARCHAR(100) NOT NULL,
  telefono VARCHAR(20),
  direccion TEXT,
  total DECIMAL(10,2),
  estado VARCHAR(20) DEFAULT 'pendiente',
  creado_en TIMESTAMP DEFAULT NOW()
);

CREATE TABLE detalles_pedido (
  id SERIAL PRIMARY KEY,
  pedido_id INT REFERENCES pedidos(id) ON DELETE CASCADE,
  producto_id INT REFERENCES productos(id),
  cantidad INT,
  precio_unitario DECIMAL(10,2)
);

-- Opcional: insertar productos de ejemplo
INSERT INTO productos (nombre, descripcion, precio, cantidad_disponible) VALUES
('Anillo de Plata', 'Anillo elegante de plata 925', 45.99, 10),
('Collar de Cuarzo', 'Collar con piedra de cuarzo natural', 55.50, 8),
('Pulsera de Perlas', 'Pulsera artesanal con perlas de agua dulce', 65.00, 5);