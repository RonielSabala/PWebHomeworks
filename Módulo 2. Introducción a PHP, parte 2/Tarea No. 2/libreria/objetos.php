<?php

class Obra
{
    public $codigo;
    public $foto_url;
    public $tipo;
    public $nombre;
    public $descripcion;
    public $pais;
    public $autor;
    public $personajes = array();
}

class Personaje
{
    public $cedula;
    public $foto_url;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $sexo;
    public $habilidades;
    public $comida_favorita;
}

$tipos_de_obra = array(
    "pelicula" => "Pelicula",
    "serie" => "Serie",
    "documental" => "Documental"
);

function tipo_de_obra($tipo)
{
    global $tipos_de_obra;
    return $tipos_de_obra[$tipo] ?? null;
}
