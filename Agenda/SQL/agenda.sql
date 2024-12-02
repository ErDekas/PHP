CREATE DATABASE IF NOT EXISTS agenda;
SET NAMES utf8mb4;
USE agenda;

DROP TABLE IF EXISTS contactos;
CREATE TABLE IF NOT EXISTS contactos( 
    id              int auto_increment not null,
    nombre          varchar(64) not null,
    apellidos       varchar(64) not null,
    correo          varchar(255) not null,
    direccion       varchar(255) not null,
    telefono        varchar(9) not null,
    fecha_nacimiento date default null,
    CONSTRAINT pk_contactos PRIMARY KEY(id),
    UNIQUE KEY telefono_UNIQUE (telefono),
    UNIQUE KEY correo_UNIQUE  (correo)
)ENGINE=InnoDb DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO contactos VALUES(null,"Marta","Martos Portellano","marta@marta.es","c/Jacinto, 5 Granada", "958123456",'1999-01-23');
INSERT INTO contactos VALUES(null,"Pedro","Moreno Prieto","pedro@pedro.es","c/Amapola, 3 Granada", "958673454",'1970-05-12');

DROP TABLE IF EXISTS reuniones;
CREATE TABLE IF NOT EXISTS reuniones( 
    id              int auto_increment not null,
    Fechahora       datetime not null,
    lugar           varchar(255) not null,
    contacto_id     int not null,
    CONSTRAINT pk_reuniones PRIMARY KEY(id),
    CONSTRAINT fk_cita_contacto FOREIGN KEY(contacto_id) REFERENCES contactos(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO reuniones VALUES(null,'2023-01-23 12:45:56',"sala Alhambra","1");
INSERT INTO reuniones VALUES(null,'2023-03-12 10:05:13',"sala Los cerezos","2");

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(64) NOT NULL,
    apellidos VARCHAR(64) NOT NULL,
    rol ENUM('super_admin', 'admin', 'usuario') DEFAULT 'usuario',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultima_conexion DATETIME DEFAULT NULL,
    activo BOOLEAN DEFAULT TRUE
)ENGINE=InnoDb DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Insertar un super administrador inicial
INSERT INTO usuarios 
(username, email, password, nombre, apellidos, rol) 
VALUES (
    'admin', 
    'pabletor05@gmail.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'Pablo', 
    'Linares', 
    'super_admin'
);