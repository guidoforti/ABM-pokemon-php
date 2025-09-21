<?php

class User
{

    private $id;

    private $nombre;
    private $contrasenia;
    private $rol;

    /**
     * @param $id
     * @param $nombre
     * @param $contrasenia
     * @param $rol
     */
    public function __construct($id, $nombre, $contrasenia, $rol)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contrasenia = $contrasenia;
        $this->rol = $rol;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * @param mixed $contrasenia
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
}