<?php

class ModeloBase
{
    public $idx = "";
    public $nombre = "";
}

class Personaje extends ModeloBase
{
    public $identificacion = "";
    public $apellido = "";
    public $fecha_nacimiento = "";
    public $foto_personaje = "";
    public $profesion_idx = "";
    public $nivel_experiencia = 0;

    public function __get($name)
    {
        if ($name === 'edad') {
            if (empty($this->fecha_nacimiento)) {
                return 0;
            }

            $fechaActual = time();
            $fechaNacimiento = strtotime($this->fecha_nacimiento);
            $edad = date('Y', $fechaActual) - date('Y', $fechaNacimiento);
            if (date('md', $fechaActual) < date('md', $fechaNacimiento)) {
                $edad--;
            }

            return $edad;
        }

        $profesion = Dbx::get("profesiones", $this->profesion_idx);
        if ($name === 'profesion') {
            return $profesion ? $profesion->nombre : "N/A";
        }

        if ($name === 'salario_mensual') {
            return $profesion ? $profesion->salario_mensual : 0;
        }
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

class Profesion extends ModeloBase
{
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
