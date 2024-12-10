-- Tabla cita_servicios
CREATE TABLE cita_servicios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  cita_id INT(11) NOT NULL,
  servicio_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (cita_id) REFERENCES citas(id),
  FOREIGN KEY (servicio_id) REFERENCES servicios(id)
);

-- Tabla citas
CREATE TABLE citas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  cliente_id INT(11) NOT NULL,
  empleado_id INT(11) NOT NULL,
  fecha_hora DATETIME NOT NULL,
  estado ENUM('reservada', 'cancelada', 'completada') DEFAULT 'reservada',
  total INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);

-- Tabla clientes
CREATE TABLE clientes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(64) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  telefono VARCHAR(15) NOT NULL UNIQUE,
  fecha_nacimiento DATE,
  email_verificado TINYINT(1) DEFAULT 0,
  token_verificacion VARCHAR(100),
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  password VARCHAR(255),
  PRIMARY KEY (id)
);

-- Tabla empleados
CREATE TABLE empleados (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(64) NOT NULL,
  especialidad ENUM('peluquero', 'depilacion', 'maquilladora') DEFAULT 'peluquero',
  correo VARCHAR(255) NOT NULL UNIQUE,
  telefono VARCHAR(15) NOT NULL UNIQUE,
  activo TINYINT(1) DEFAULT 1,
  usuario_id INT(11),
  PRIMARY KEY (id),
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla historial_servicios
CREATE TABLE historial_servicios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  cliente_id INT(11) NOT NULL,
  cita_id INT(11) NOT NULL,
  servicio_id INT(11) NOT NULL,
  fecha DATETIME NOT NULL,
  notas TEXT,
  PRIMARY KEY (id),
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (cita_id) REFERENCES citas(id),
  FOREIGN KEY (servicio_id) REFERENCES servicios(id)
);

-- Tabla servicios
CREATE TABLE servicios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  duracion_minutos INT(11) NOT NULL,
  especialidad ENUM('peluquero', 'depilacion', 'maquilladora') DEFAULT 'peluquero',
  PRIMARY KEY (id)
);

-- Tabla usuarios
CREATE TABLE usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nombre VARCHAR(64) NOT NULL,
  rol ENUM('admin', 'empleado', 'cliente') DEFAULT 'cliente',
  cliente_id INT(11),
  empleado_id INT(11),
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ultima_conexion DATETIME,
  activo TINYINT(1) DEFAULT 1,
  PRIMARY KEY (id),
  FOREIGN KEY (cliente_id) REFERENCES clientes(id),
  FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);

INSERT INTO usuarios (email, password, nombre, rol, cliente_id, empleado_id, fecha_registro, ultima_conexion, activo)
VALUES ('pabletor0505@gmail.com', 'admin123', 'admin', 'admin', NULL, NULL, '2024-12-06 11:53:38', '2024-12-10 19:21:28', 1);

INSERT INTO servicios (id, nombre, precio, duracion_minutos, especialidad)
VALUES
(1, 'Corte de pelo', 15.99, 30, 'peluquero'),
(2, 'Peinado', 20.00, 45, 'peluquero'),
(3, 'Depilación facial', 10.50, 20, 'depilacion'),
(4, 'Depilación corporal', 25.00, 60, 'depilacion'),
(5, 'Maquillaje básico', 30.00, 40, 'maquilladora'),
(6, 'Maquillaje para eventos', 50.00, 60, 'maquilladora');
