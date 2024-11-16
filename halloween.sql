CREATE DATABASE halloween;

USE halloween;

-- Tabla disfraces
CREATE TABLE disfraces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    votos INT NOT NULL DEFAULT 0,
    foto VARCHAR(20) NOT NULL,
    foto_blob BLOB NOT NULL,
    eliminado INT NOT NULL DEFAULT 0
);

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    clave TEXT NOT NULL
);

-- Tabla votos
CREATE TABLE votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_disfraz INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_disfraz) REFERENCES disfraces(id)
);

