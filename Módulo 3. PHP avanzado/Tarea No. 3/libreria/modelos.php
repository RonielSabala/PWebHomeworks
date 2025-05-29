<?php

class Personaje
{
    public $idx = "";
    public $identificacion = "";
    public $nombre = "";
    public $apellido = "";
    public $fecha_nacimiento = "";
    public $foto_personaje = "";
    public $profesion = "";
    public $nivel_experiencia = 0;

    public function edad()
    {
        if (empty($this->fecha_nacimiento)) {
            return 0;
        }

        $fechaNacimiento = strtotime($this->fecha_nacimiento);
        $fechaActual = time();
        $edad = date('Y', $fechaActual) - date('Y', $fechaNacimiento);
        if (date('md', $fechaActual) < date('md', $fechaNacimiento)) {
            $edad--;
        }

        return $edad;
    }

    public function salario_mensual()
    {
        $profesion = Dbx::get("profesiones", $this->profesion);
        return $profesion ? $profesion->salario_mensual : 0;
    }

    public function __construct($data = [])
    {
        if (is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

class Profesion
{
    public $idx = "";
    public $codigo = "";
    public $nombre = "";
    public $categoria = "";
    public $salario_mensual = 0;

    public function __construct($data = [])
    {
        if (is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString()
    {
        return "{$this->nombre} - Salario: {$this->salario_mensual}";
    }
}
