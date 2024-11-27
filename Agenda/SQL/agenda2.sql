DROP DATABASE IF EXISTS agenda;
CREATE DATABASE agenda;

USE agenda;

-- Tabla para contactos
CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    telefono VARCHAR(15),
    email VARCHAR(100),
    direccion TEXT
);

-- Tabla para citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contacto_id INT,
    fecha_hora DATETIME NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (contacto_id) REFERENCES contactos(id) ON DELETE CASCADE
);

-- Tabla para usuarios (login)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
