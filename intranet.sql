DROP DATABASE IF EXISTS intranet;

CREATE DATABASE intranet;
USE intranet;

CREATE TABLE usuarios (
	usuario varchar(45) PRIMARY KEY,
	clave varchar(45) NOT NULL,
	admin boolean NOT NULL
);

CREATE TABLE datosPersonales(
	usuario varchar(45) PRIMARY KEY,
	nombre varchar(65),
	email varchar(45),
	FOREIGN KEY (usuario) REFERENCES usuarios(usuario)
);

CREATE TABLE categorias (
	ID_Categoria int AUTO_INCREMENT PRIMARY KEY,
	categoria varchar(45) NOT NULL,
	descripcion varchar(155) NOT NULL,
	ruta varchar(40) NOT NULL
);

CREATE TABLE permisos(
	usuario varchar(45),
	ID_Categoria int,
	PRIMARY KEY (usuario,ID_Categoria),
	FOREIGN KEY (ID_Categoria) REFERENCES categorias(ID_Categoria),
	FOREIGN KEY (usuario) REFERENCES usuarios(usuario)
);

INSERT categorias VALUES
(NULL, 'Sección Multimedia','En esta sección encontraras una variedad de videos explicativos.','multimedia.php'),
(NULL, 'Material Académico','En esta sección encontraras el material académico para descargarlo.','material.php'),
(NULL, 'Tareas','En esta sección se presentan una serie de tareas para los alumnos.','tareas.php'),
(NULL, 'Curiosidades','En esta sección encontraras datos curiosos e interesantes.','curiosidades.php');

INSERT usuarios VALUES
('UsuarioTest','654321', 0),
('UsuarioPrueba','665544', 0),
('Admin','159951',1);

INSERT permisos VALUES
('UsuarioTest',1), ('UsuarioTest',4),
('UsuarioPrueba',2), ('UsuarioPrueba',3);
