<?php

require_once 'Usuario.php';

/**
 * Clase Alumno.
 * @package Usuarios
 * @author Abdel
 */
class Alumno extends Usuario {
    
    /** @var string */
    private $vMatricula;

    /**
     * Constructor del Alumno.
     * @param string $nombre
     * @param string $correo
     * @param string $matricula
     */
    public function __construct($nombre, $correo, $matricula)
    {
        parent::__construct($nombre, $correo);
        $this->vMatricula = $matricula;
    }

    
    public function getMatricula(){
        return $this->vMatricula;
    }

   
    public function getRol(){
        return "Alumno";
    }
}
