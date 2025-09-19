CREATE DATABASE FitControl;
USE FitControl;

drop database FitControl



-- Tabla USUARIO
CREATE TABLE USUARIO (
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    apellido VARCHAR(255),
    direccion VARCHAR(255),
    edad INT,
    foto_perfil VARCHAR(255),
    posicion VARCHAR(255) NULL,
    categoria VARCHAR(255) NULL,
    documento_identidad VARCHAR(255),
    tel_usu BIGINT,
    email_usu VARCHAR(255),
    contra_usu varchar (255),
    rol ENUM('admin','jugador','entrenador') NOT NULL
);
SET FOREIGN_KEY_CHECKS = 1;

drop table usuario

SET CHECK_FOREIG


-- Tabla NOTIFICACION
CREATE TABLE NOTIFICACION (
    id_notificacion INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    mensaje TEXT,
    fecha DATETIME,
    id_usuario_destinatario_fk INT,
    FOREIGN KEY (id_usuario_destinatario_fk) REFERENCES USUARIO(id_usu)
);

-- Tabla HISTORIAL_MEDICO
CREATE TABLE HISTORIAL_MEDICO (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    observaciones TEXT,
    fecha DATE,
    id_usu_fk INT,
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu)
);

-- Tabla EQUIPO
CREATE TABLE EQUIPO (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100),
    logo_equipo VARCHAR(100),
    ubi_equipo VARCHAR(200),
    contacto_equipo BIGINT,
    categoria_equipo BIGINT
);

-- Tabla TORNEO
CREATE TABLE TORNEO (
    id_torneo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    premio BIGINT,
    descripcion VARCHAR(200),
    fecha_inicio DATE,
    fecha_fin DATE,
    id_equipo_fk INT,
    FOREIGN KEY (id_equipo_fk) REFERENCES EQUIPO(id_equipo)
);

-- Tabla PARTIDO
CREATE TABLE PARTIDO (
    id_partido INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    rival VARCHAR(100),
    resultado VARCHAR(50),
    id_torneo_fk INT,
    id_equipo_fk INT,
    FOREIGN KEY (id_torneo_fk) REFERENCES TORNEO(id_torneo),
    FOREIGN KEY (id_equipo_fk) REFERENCES EQUIPO(id_equipo)
);

-- Tabla ESTADISTICA_PARTIDO
CREATE TABLE ESTADISTICA_PARTIDO (
    id_estadistica INT AUTO_INCREMENT PRIMARY KEY,
    goles INT,
    asistencias INT,
    tarjetas_amarillas INT,
    tarjetas_rojas INT,
    id_partido_fk INT,
    id_usu_fk INT,
    FOREIGN KEY (id_partido_fk) REFERENCES PARTIDO(id_partido),
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu)
);

-- Tabla ENTRENAMIENTO
CREATE TABLE ENTRENAMIENTO (
    id_entrenamiento INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    ubicacion VARCHAR(100),
    id_equipo_fk INT,
    FOREIGN KEY (id_equipo_fk) REFERENCES EQUIPO(id_equipo)
);

-- Tabla RENDIMIENTO
CREATE TABLE RENDIMIENTO (
    id_rendimiento INT AUTO_INCREMENT PRIMARY KEY,
    evaluacion VARCHAR(100),
    comentarios VARCHAR(80),
    id_usu_fk INT,
    id_entrenamiento_fk INT,
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu),
    FOREIGN KEY (id_entrenamiento_fk) REFERENCES ENTRENAMIENTO(id_entrenamiento)
);

-- Tabla PAGO
CREATE TABLE PAGO (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    fecha_pago DATE,
    monto DECIMAL(10,2),
    estado VARCHAR(20),
    recibo_pdf VARCHAR(200),
    id_usu_fk INT,
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu)
);

-- Tabla ASISTENCIA_ENTRENAMIENTO
CREATE TABLE ASISTENCIA_ENTRENAMIENTO (
    id_asistencia INT AUTO_INCREMENT PRIMARY KEY,
    presente TINYINT(1),
    id_usu_fk INT,
    id_entrenamiento_fk INT,
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu),
    FOREIGN KEY (id_entrenamiento_fk) REFERENCES ENTRENAMIENTO(id_entrenamiento)
);

-- Tabla INSCRIPCION
CREATE TABLE INSCRIPCION (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_usu_fk INT,
    id_torneo_fk INT,
    fecha_inscripcion DATE,
    estado VARCHAR(20),
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu),
    FOREIGN KEY (id_torneo_fk) REFERENCES TORNEO(id_torneo)
);

-- Tabla INSCRIPCION_EQUIPO
CREATE TABLE INSCRIPCION_EQUIPO (
    id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
    id_usu_fk INT,
    id_equipo_fk INT,
    fecha_inscripcion DATE,
    estado VARCHAR(20),
    FOREIGN KEY (id_usu_fk) REFERENCES USUARIO(id_usu),
    FOREIGN KEY (id_equipo_fk) REFERENCES EQUIPO(id_equipo)
);


INSERT INTO USUARIO (nombre, apellido, direccion, edad, foto_perfil, posicion, categoria, documento_identidad, tel_usu, email_usu, rol) VALUES
('Carlos', 'Pérez', 'Calle 123', 25, 'carlos.jpg', 'Delantero', 'Sub-23', '12345678', 3014567890, 'carlos@fit.com', 'jugador'),
('Ana', 'Gómez', 'Av. Central 45', 30, 'ana.jpg', NULL, NULL, '98765432', 3021234567, 'ana@fit.com', 'admin'),
('Luis', 'Martínez', 'Cra 10 #20-15', 28, 'luis.jpg', 'Defensa', 'Sub-23', '11122333', 3109876543, 'luis@fit.com', 'jugador'),
('María', 'Rodríguez', 'Calle 50 #12', 35, 'maria.jpg', NULL, NULL, '22233444', 3151112222, 'maria@fit.com', 'entrenador'),
('Pedro', 'López', 'Av. Norte 99', 22, 'pedro.jpg', 'Mediocampista', 'Sub-20', '33344555', 3205556666, 'pedro@fit.com', 'jugador');


INSERT INTO USUARIO 
(nombre, apellido, direccion, edad, foto_perfil, posicion, categoria, documento_identidad, tel_usu, email_usu, contra_usu, rol) 
VALUES
('Ana', 'Gómez', 'Calle 10 #45-23', 28, 'ana.jpg', NULL, NULL, 'CC12345678', 3001234567, 'ana@club.com', '123', 'admin'),

('Luis', 'Martínez', 'Carrera 20 #11-34', 22, 'luis.jpg', 'Delantero', 'Sub-23', 'CC87654321', 3109876543, 'luis@club.com', '123', 'jugador'),

('Pedro', 'Ramírez', 'Av. Siempre Viva 742', 35, 'pedro.jpg', 'Defensa', 'Mayores', 'CC45678912', 3201112233, 'pedro@club.com', '123', 'jugador'),

('María', 'López', 'Calle 50 #33-21', 40, 'maria.jpg', NULL, NULL, 'CC78945612', 3014445566, 'maria@club.com', '123', 'entrenador'),

('Carlos', 'Torres', 'Carrera 15 #66-14', 30, 'carlos.jpg', 'Arquero', 'Mayores', 'CC96385274', 3127778899, 'carlos@club.com', '123', 'jugador'),

('Laura', 'Fernández', 'Calle 80 #12-09', 26, 'laura.jpg', NULL, NULL, 'CC15975348', 3059998877, 'laura@club.com', '123', 'admin');

INSERT INTO NOTIFICACION (titulo, mensaje, fecha, id_usuario_destinatario_fk) VALUES
('Bienvenida', 'Bienvenido a la plataforma', '2025-09-17 09:00:00', 5),
('Actualización', 'La aplicación ha sido actualizada', '2025-09-16 15:30:00', 5),
('Recordatorio', 'No olvides completar tu perfil', '2025-09-15 08:00:00', 5),
('Evento', 'Nuevo torneo disponible', '2025-09-14 12:00:00', 5),
('Alerta', 'Tu suscripción expira pronto', '2025-09-13 18:00:00', 5),
('Promoción', 'Descuento especial esta semana', '2025-09-12 10:00:00', 6),
('Mantenimiento', 'Mantenimiento programado para mañana', '2025-09-11 22:00:00', 6),
('Felicitación', 'Felicidades por tu progreso', '2025-09-10 14:00:00', 5),
('Encuesta', 'Por favor, completa esta encuesta', '2025-09-09 11:00:00', 6),
('Soporte', 'Tu solicitud ha sido recibida', '2025-09-08 09:30:00', 6);

SELECT id_usu FROM USUARIO;

