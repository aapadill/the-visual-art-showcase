DROP DATABASE IF EXISTS social;

CREATE DATABASE social;
USE social;

CREATE TABLE usuarios (
  usuario_id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(64) NOT NULL UNIQUE,
  email VARCHAR(64) NOT NULL UNIQUE,
  password VARCHAR(64) NOT NULL,
  nombre VARCHAR(256) NOT NULL,
  img_usuario VARCHAR(128)
);

CREATE TABLE posts (
  post_id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  texto VARCHAR(512),
  img_post VARCHAR(64),
  fecha_creacion DATETIME NOT NULL DEFAULT NOW(),
  FOREIGN KEY(usuario_id) REFERENCES usuarios(usuario_id)
);

CREATE TABLE usuario_seguidor (
  seg_id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  seguidor_id INT NOT NULL,
  fecha_inicio DATETIME NOT NULL DEFAULT NOW(),
  fecha_fin DATETIME,
  FOREIGN KEY(usuario_id) REFERENCES usuarios(usuario_id),
  FOREIGN KEY(seguidor_id) REFERENCES usuarios(usuario_id),
  UNIQUE(usuario_id, seguidor_id)
);



-- Inserts
INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES
  ('leon', 'Hola1234', 'test@test.com', 'Leon', 'img/usuarios/user.png')
;
INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES
  ('jose', 'Hola1234', 'test2@test.com', 'Jose', 'img/usuarios/user.png')
;
INSERT INTO usuarios (nombre_usuario, password, email, nombre, img_usuario) VALUES
  ('yavana', 'Hola1234', 'test3@test.com', 'Yavana', 'img/usuarios/user.png')
;

INSERT INTO posts(usuario_id, texto, img_post) VALUES
  (1, 'Mobydick', 'img/post/post.png')
;
INSERT INTO posts(usuario_id, texto, img_post) VALUES
  (2, 'Red', 'img/post/red.png')
;
INSERT INTO posts(usuario_id, texto, img_post) VALUES
  (3, 'StarWars', 'img/post/starwars.png')
;
INSERT INTO posts(usuario_id, texto, img_post) VALUES
  (1, 'Resident Evil', 'img/post/re.png')
;

INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
  (1,2)
;
INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
  (3,1)
;
INSERT INTO usuario_seguidor(usuario_id, seguidor_id) VALUES
  (2,3)
;
