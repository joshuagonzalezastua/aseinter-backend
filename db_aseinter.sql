create database aseinter;
use aseinter;

create table usuario(
	correo varchar(50) primary key not null,
    nombre varchar(25) null,
    apellidos varchar(40) null,
	contrasena varchar(15) not null,
	privilegio varchar(15) not null
);

create table actividad(
	id_actividad int primary key not null AUTO_INCREMENT,
    titulo varchar(40) not null,
    descripcion varchar(255),
    color varchar(40),
    startDate datetime not null,
    endDate datetime not null
);
