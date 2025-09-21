<?php

class Tipo
{

    private $id;
    private $nombreTipo;
    private $imagenRuta;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImagenRuta()
    {
        return $this->imagenRuta;
    }

    /**
     * @param mixed $imagenRuta
     */
    public function setImagenRuta($imagenRuta)
    {
        $this->imagenRuta = $imagenRuta;
    }

    /**
     * @return mixed
     */
    public function getNombreTipo()
    {
        return $this->nombreTipo;
    }

    /**
     * @param mixed $nombreTipo
     */
    public function setNombreTipo($nombreTipo)
    {
        $this->nombreTipo = $nombreTipo;
    }







}