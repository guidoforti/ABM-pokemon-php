<?php

class Pokemon
{

    private $id;
    private $nombre;
    private $imagenRuta;
    private $tipoUno;
    private $tipoDos;
    private $descripcion;


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
    public function getTipoUno()
    {
        return $this->tipoUno;
    }

    /**
     * @param mixed $tipoUno
     */
    public function setTipoUno($tipoUno)
    {
        $this->tipoUno = $tipoUno;
    }

    /**
     * @return mixed
     */
    public function getTipoDos()
    {
        return $this->tipoDos;
    }

    /**
     * @param mixed $tipoDos
     */
    public function setTipoDos($tipoDos)
    {
        $this->tipoDos = $tipoDos;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }






}