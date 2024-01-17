DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
USE tienda;

CREATE TABLE roles (
  rol_id INT AUTO_INCREMENT PRIMARY KEY, 
  nombre VARCHAR(64) NOT NULL
);

CREATE TABLE usuarios (
  usuario_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(64) NOT NULL,
  email VARCHAR(64),
  password VARCHAR(256) NOT NULL,
  nombre VARCHAR(256) NOT NULL,
  img_usuario VARCHAR(128),
  rol_id INT NOT NULL,
  FOREIGN KEY(rol_id) REFERENCES roles(rol_id)
);

CREATE TABLE direcciones (
  direccion_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(64) NOT NULL,
  calle_numero VARCHAR(128) NOT NULL,
  cp VARCHAR(32) NOT NULL,
  colonia VARCHAR(64) NOT NULL,
  municipio VARCHAR(64) NOT NULL,
  estado VARCHAR(64) NOT NULL,
  usuario_id INT NOT NULL,
  UNIQUE(usuario_id, nombre),
  FOREIGN KEY(usuario_id) REFERENCES usuarios(usuario_id)
);

CREATE TABLE tipo_producto (
  tipo_producto_id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_producto_nombre VARCHAR(64) NOT NULL
);

CREATE TABLE productos (
  producto_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(64) NOT NULL,
  descripcion VARCHAR(64),
  img_producto VARCHAR(128),
  precio FLOAT,
  vendedor_id INT NOT NULL,
  FOREIGN KEY(vendedor_id) REFERENCES usuarios(usuario_id)
);

CREATE TABLE producto_clasificacion (
  producto_clasificacion_id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_producto_id INT NOT NULL,
  producto_id INT NOT NULL,
  FOREIGN KEY(tipo_producto_id) REFERENCES tipo_producto(tipo_producto_id),
  FOREIGN KEY(producto_id) REFERENCES productos(producto_id),
  UNIQUE(tipo_producto_id, producto_id)
);

CREATE TABLE ordenes (
  orden_id INT AUTO_INCREMENT PRIMARY KEY,
  comprador_id INT NOT NULL,
  status VARCHAR(64),
  direccion_id int,
  fecha_compra DATE DEFAULT NOW(),
  fecha_entrega DATE DEFAULT DATE_ADD(NOW(), INTERVAL 10 DAY),
  FOREIGN KEY(comprador_id) REFERENCES usuarios(usuario_id),
  FOREIGN KEY(direccion_id) REFERENCES direcciones(direccion_id)

);

CREATE TABLE orden_producto(
  orden_producto_id INT AUTO_INCREMENT PRIMARY KEY,
  orden_id INT NOT NULL,
  producto_id INT NOT NULL,
  precio_final FLOAT,
  cantidad INT DEFAULT 1,
  FOREIGN KEY(orden_id) REFERENCES ordenes(orden_id)
);

-- Catalogos
INSERT INTO roles(nombre) VALUES('Administardor');
INSERT INTO roles(nombre) VALUES('Vendedor');
INSERT INTO roles(nombre) VALUES('Comprador');

INSERT INTO tipo_producto(tipo_producto_nombre) VALUES ('Libro');
INSERT INTO tipo_producto(tipo_producto_nombre) VALUES ('Disco de música');
INSERT INTO tipo_producto(tipo_producto_nombre) VALUES ('Película');
INSERT INTO tipo_producto(tipo_producto_nombre) VALUES ('Videojuego');

INSERT INTO usuarios(nombre_usuario, password, email, nombre, img_usuario, rol_id) VALUES
  ('admin', 'Hola1234', 'test@test.com', 'Admin', 'usuarios/user.png', 1)
;
INSERT INTO usuarios(nombre_usuario, password, email, nombre, img_usuario, rol_id) VALUES
  ('vendedor', 'Hola1234', 'test@test.com', 'Vendedor', 'usuarios/user.png', 2)
;
INSERT INTO usuarios(nombre_usuario, password, email, nombre, img_usuario, rol_id) VALUES
  ('comprador', 'Hola1234', 'test@test.com', 'Comprador', 'usuarios/user.png', 3)
;

INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
  ('Primario', 'Av. Siempre viva 300', '1234', 'Linda', 'Tlalpan', 'CdMx.', 3)
;
INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
  ('Casa', 'Av. Siempre 400', '1235', 'Linda', 'Guadalajara', 'Jalisco', 2)
;
INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
  ('Casa', 'Av. Siempre 400', '1236', 'Linda', 'Monterrey', 'Nuevo Leon', 1)
;
INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
  ('Casa', 'Av. Siempre 400', '1235', 'Linda', 'Guadalajara', 'Jalisco', 3)
;
INSERT INTO direcciones(nombre, calle_numero, cp, colonia, municipio, estado, usuario_id) VALUES
  ('Oficina', 'Av. Siempre 400', '1236', 'Linda', 'Monterrey', 'Nuevo Leon', 3)
;

INSERT INTO productos(nombre, img_producto, descripcion, precio, vendedor_id) VALUES
  ('Mobydick', 'productos/producto.png', 'Mobydick', 99.99, 2)
;
INSERT INTO productos(nombre, img_producto, descripcion, precio, vendedor_id) VALUES
  ('Red', 'productos/producto.png', 'KC Red', 299.99, 2)
;
INSERT INTO productos(nombre, img_producto, descripcion, precio, vendedor_id) VALUES
  ('StarWars', 'productos/producto.png', 'Pelicula StarWars', 300, 2)
;
INSERT INTO productos(nombre, img_producto, descripcion, precio, vendedor_id) VALUES
  ('Resident Evil', 'productos/productos.png', 'RE VII', 199.99, 2)
;

INSERT INTO producto_clasificacion(tipo_producto_id, producto_id) VALUES
  (1,1)
;
INSERT INTO producto_clasificacion(tipo_producto_id, producto_id) VALUES
  (2,2)
;
INSERT INTO producto_clasificacion(tipo_producto_id, producto_id) VALUES
  (3,3)
;
INSERT INTO producto_clasificacion(tipo_producto_id, producto_id) VALUES
  (4,4)
;


INSERT INTO ordenes(comprador_id, status, direccion_id, fecha_compra, fecha_entrega) VALUES
  (3, 'Pagada', 1,  DATE_ADD(NOW(), INTERVAL 5 DAY),  DATE_ADD(NOW(), INTERVAL 5 DAY))
;

INSERT INTO ordenes(comprador_id, status, direccion_id, fecha_compra, fecha_entrega) VALUES
  (3, 'Pagada', 4,  DATE_ADD(NOW(), INTERVAL 3 DAY),  DATE_ADD(NOW(), INTERVAL 5 DAY))
;

INSERT INTO ordenes(comprador_id, status, direccion_id, fecha_compra, fecha_entrega) VALUES
  (3, 'Pagada', 5,  DATE_ADD(NOW(), INTERVAL 2 DAY),  DATE_ADD(NOW(), INTERVAL 10 DAY))
;

INSERT INTO ordenes(comprador_id, status, direccion_id, fecha_compra, fecha_entrega) VALUES
  (3, 'Pagada', 1,  NOW(),  DATE_ADD(NOW(), INTERVAL 15 DAY))
;

INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (1, 1, 89.99, 5)
;
INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (2, 1, 99.99, 1)
;
INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (2, 2, 189.99, 2)
;
INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (3, 3, 99.99, 5)
;
INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (3, 4, 200.99, 2)
;
INSERT INTO orden_producto(orden_id, producto_id, precio_final, cantidad) VALUES
  (4, 4, 189.99, 10)
;
