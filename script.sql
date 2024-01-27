drop database t2p1;
create database t2p1;

use t2p1;
-- Tabla de Productos
CREATE TABLE productos (
    id INT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT,
    precio DECIMAL(10, 2),
    stock INT
);

-- Tabla de Clientes
CREATE TABLE clientes (
    id INT PRIMARY KEY,
    dni VARCHAR(20),
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    correo VARCHAR(255),
    direccion TEXT
);

-- Tabla de Pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY,
    fecha DATE,
    id_cliente INT,
    direccion_entrega TEXT,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

-- Tabla de Pedidos_has_Productos
CREATE TABLE pedidos_has_productos (
    id_pedido INT,
    id_producto INT,
    cantidad INT,
    precio_unitario DECIMAL(10, 2),
    PRIMARY KEY (id_pedido, id_producto),
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- Tabla de Estado
CREATE TABLE estado (
    id INT PRIMARY KEY,
    nombre VARCHAR(255)
);

-- Tabla de Pedido_has_Estado
CREATE TABLE pedido_has_estado (
    id_pedido INT,
    id_estado INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_pedido, id_estado),
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_estado) REFERENCES estado(id_estado)
);


-- Inserciones en la tabla de Productos
INSERT INTO productos (id, nombre, descripcion, precio, stock) VALUES
(1, 'Laptop HP', 'Portátil de última generación', 1200.00, 50),
(2, 'Monitor Dell', 'Pantalla LED de 27 pulgadas', 300.00, 30),
(3, 'Teclado mecánico', 'Teclado gaming retroiluminado', 80.00, 100),
(4, 'Mouse inalámbrico', 'Sensor óptico de alta precisión', 40.00, 120),
(5, 'Disco Duro SSD', 'Almacenamiento rápido y confiable', 150.00, 40),
(6, 'Impresora láser', 'Impresora de alta calidad', 250.00, 20),
(7, 'Tarjeta gráfica gaming', 'Tarjeta gráfica potente para juegos', 400.00, 15),
(8, 'Router inalámbrico', 'Router de doble banda', 80.00, 30),
(9, 'Auriculares Bluetooth', 'Auriculares inalámbricos con cancelación de ruido', 100.00, 25),
(10, 'Cámara web HD', 'Cámara web para videoconferencias', 60.00, 18),
(11, 'Monitor curvo', 'Pantalla curva para una experiencia inmersiva', 350.00, 10),
(12, 'Impresora multifunción', 'Impresora con funciones de escaneo y copiado', 180.00, 25),
(13, 'Teclado inalámbrico', 'Teclado sin cables para mayor comodidad', 60.00, 30),
(14, 'Tarjeta de memoria SD', 'Almacenamiento adicional para dispositivos', 25.00, 50),
(15, 'Adaptador USB-C a HDMI', 'Convierte USB-C a HDMI para proyectar en pantallas externas', 30.00, 15);

-- Inserciones en la tabla de Clientes
INSERT INTO clientes (id, dni, nombre, apellido, correo, direccion) VALUES
(1, '12345678A', 'Juan', 'Pérez', 'juan@gmail.com', 'Calle A, Ciudad'),
(2, '87654321B', 'María', 'Gómez', 'maria@gmail.com', 'Calle B, Ciudad'),
(3, '98765432C', 'Carlos', 'Rodríguez', 'carlos@gmail.com', 'Calle C, Ciudad'),
(4, '23456789D', 'Ana', 'Martínez', 'ana@gmail.com', 'Calle D, Ciudad'),
(5, '34567890E', 'Pedro', 'López', 'pedro@gmail.com', 'Calle E, Ciudad');

-- Inserciones en la tabla de Pedidos
INSERT INTO pedidos (id, fecha, id_cliente, direccion_entrega, total) VALUES
(1, '2024-01-13', 1, 'Calle A, Ciudad', 1600.00),
(2, '2024-01-14', 2, 'Calle B, Ciudad', 380.00),
(3, '2024-01-15', 3, 'Calle C, Ciudad', 120.00),
(4, '2024-01-16', 4, 'Calle D, Ciudad', 80.00),
(5, '2024-01-17', 5, 'Calle E, Ciudad', 360.00);

-- Inserciones en la tabla de Pedidos_has_Productos
INSERT INTO pedidos_has_productos (id_pedido, id_producto, cantidad, precio_unitario) VALUES
(1, 1, 2, 1200.00),
(1, 3, 1, 80.00),
(2, 2, 1, 300.00),
(3, 4, 2, 40.00),
(4, 5, 3, 150.00),
(2, 1, 1, 1200.00),
(3, 3, 3, 80.00),
(4, 2, 2, 300.00),
(5, 4, 1, 40.00),
(1, 5, 2, 150.00),
(2, 3, 2, 80.00),
(3, 2, 1, 300.00),
(4, 4, 1, 150.00),
(5, 1, 1, 1200.00),
(1, 4, 2, 40.00);

-- Inserciones en la tabla de Estado
INSERT INTO estado (id, nombre) VALUES
(1, 'En proceso'),
(2, 'Enviado'),
(3, 'Entregado'),
(4, 'Cancelado'),
(5, 'En preparación'),
(6, 'En camino'),
(7, 'Listo para envío'),
(8, 'En revisión'),
(9, 'Devolución solicitada'),
(10, 'Recibido con éxito'),
(11, 'En espera de pago'),
(12, 'En revisión técnica'),
(13, 'En preparación para envío'),
(14, 'Entregado parcialmente'),
(15, 'En cuarentena');

-- Inserciones en la tabla de Pedido_has_Estado
INSERT INTO pedido_has_estado (id_pedido, id_estado, fecha) VALUES
(1, 1, '2024-01-13 10:00:00'),
(1, 2, '2024-01-13 14:30:00'),
(2, 1, '2024-01-14 09:45:00'),
(3, 3, '2024-01-15 12:20:00'),
(4, 4, '2024-01-16 16:00:00'),
(2, 6, '2024-01-18 11:15:00'),
(3, 7, '2024-01-19 14:00:00'),
(4, 8, '2024-01-20 09:30:00'),
(5, 9, '2024-01-21 16:45:00'),
(1, 10, '2024-01-22 10:30:00');
