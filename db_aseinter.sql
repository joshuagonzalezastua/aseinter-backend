create database aseinter;
use aseinter;

create table usuario(
	nombre_usuario varchar(50) primary key not null,
	contrasena varchar(15) not null
);

create table actividad(
	id_actividad int primary key not null AUTO_INCREMENT,
    titulo varchar(40) not null,
    descripcion varchar(255),
    color varchar(40),
    startDate datetime not null,
    endDate datetime not null
);

create table tiquete(
	id_tiquete int primary key not null AUTO_INCREMENT,
	id_persona varchar(50),
    fecha date not null,
    motivo varchar(255) not null
);
