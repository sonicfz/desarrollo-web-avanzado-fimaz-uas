<?php
class Usuario {
    protected $nombre;
    protected $correo;

    public function __construct($nombre, $correo) {
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Error '$correo' al intentar poner tu correo");
        }
        $this->nombre = $nombre;
        $this->correo = $correo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }
}

class Admin extends Usuario {
    public function getRol() {
        return "Administrador";
    }
}

class Alumno extends Usuario {
    private $matricula;

    public function __construct($nombre, $correo, $matricula) {
        parent::__construct($nombre, $correo);
        $this->matricula = $matricula;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getRol() {
        return "Alumno";
    }
}