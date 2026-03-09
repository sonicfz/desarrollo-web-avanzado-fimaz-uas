<?php

/**
 * Clase base Usuario.
 * Aplica encapsulamiento y validación de datos en el constructor.
 *
 * @package Usuarios
 * @author Abdel
 */
class Usuario {

    /** @var string */
    protected $vNombre;
    
    /** @var string */
    protected $vCorreo;

    /**
     * @param string $nombre
     * @param string $correo
     * @throws Exception Si el correo no tiene un formato válido.
     */
    public function __construct($nombre, $correo)
    {
        $this->vNombre = $nombre;

        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            throw new Exception( "correo invalido: " . $correo);
        }

        $this->vCorreo = $correo;
    }

   
    public function getNombre() {
        return $this->vNombre;
    }

   
    public function getCorreo() {
        return $this->vCorreo;
    }

}
