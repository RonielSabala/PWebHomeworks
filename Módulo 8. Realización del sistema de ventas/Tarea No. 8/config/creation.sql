DROP DATABASE IF EXISTS la_rubia_db;
CREATE DATABASE la_rubia_db;
USE la_rubia_db;

-- Tabla de usuarios
drop table if exists usuarios;
create table usuarios (
    id int auto_increment primary key,
    username varchar(50) not null unique,
    user_password varchar(255) not null
);

insert into usuarios (username, user_password)
values (
    'demo',
    'tareafacil25'
);

-- Tabla de artículos
drop table if exists articulos;
create table articulos (
    id int auto_increment primary key,
    nombre varchar(150) not null,
    descripcion text,
    precio_unitario decimal(10,2) not null
);

INSERT INTO articulos (nombre, descripcion, precio_unitario) VALUES
  ('Lapicero',   '', 2.50),
  ('Cuaderno',   '', 5.00),
  ('Borrador',   '', 1.20),
  ('Regla',      '', 3.00),
  ('Calculadora','', 15.00),
  ('Marcador',   '', 4.75),
  ('Mochila',    '', 25.00);


-- Tabla de facturas
drop table if exists facturas;
create table facturas (
    id int auto_increment primary key,
    fecha_emision datetime default current_timestamp,
    nombre_cliente varchar(50) not null,
    total decimal(12,2) not null,
    comentario text
);

-- Tabla de detalles de facturas
drop table if exists detalle_factura;
create table detalle_factura (
    factura_id int not null,
    articulo_id int not null,
    cantidad int not null,
    precio_unitario decimal(10,2) not null,
    total decimal(12,2) as (cantidad * precio_unitario) stored,
    primary key (factura_id, articulo_id),
    foreign key (factura_id) references facturas(id) on delete cascade,
    foreign key (articulo_id) references articulos(id) on delete cascade
);
