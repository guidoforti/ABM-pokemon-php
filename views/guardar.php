<?php

require_once("../Domain/MyDataBase.php");
require_once("../Domain/Pokemon.php");
require_once("../Domain/Tipo.php");


$config = parse_ini_file("../Config.ini");

$conexion = new myDataBase(
    $config["host"],
    $config["user"],
    $config["pass"],
    $config["database"]
);

$pokemonACrear = new Pokemon();

$direccionBasePockemons = "../Files/Pockemons/";


$imagen = $_FILES["imagen"];
$tipoUno = isset($_POST["tipoUno"]) ? $_POST["tipoUno"] : null;
$tipoDos = isset($_POST["tipoDos"]) ? $_POST["tipoDos"] : null;
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];


// muevo la imagen a los files correctos y persisto el pokemon
if (isset($imagen) && $imagen['error'] == 0) {
    $nombreDeLaImagen = basename($imagen["name"]);
    $direccioFinal = $direccionBasePockemons . $nombreDeLaImagen;
    move_uploaded_file($imagen["tmp_name"], $direccioFinal);
} else
{
    echo "ERROR IMAGEN";
}

//obtengo la direccion de la imagen del tipo segun tipo que haya llegado
if ($tipoUno != null) {
    $idDeTipoUno = $conexion->obtenerIdDeTipoSegunNombre($tipoUno);
} else {
    $idDeTipoUno = null;
}

if ($tipoDos != null) {
    $idDeTipoDos = $conexion->obtenerIdDeTipoSegunNombre($tipoDos);
} else {
    $idDeTipoDos = null;
}


$pokemonACrear->setNombre($nombre);
$pokemonACrear->setImagenRuta($direccioFinal);
$pokemonACrear->setTipoUno($idDeTipoUno);
$pokemonACrear->setTipoDos($idDeTipoDos);
$pokemonACrear->setDescripcion($descripcion);

//PERSISTO EL POKEMON
$conexion->guardarPockemon($pokemonACrear);

header("Location: pokedexList.php");
exit;
?>






