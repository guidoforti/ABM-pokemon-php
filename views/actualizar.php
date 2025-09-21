<?php
session_start();
include_once("shared/conexionBd.php");


$idPokemon = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$tipoUno = $conexion->obtenerIdDeTipoSegunDescripcion($_POST["tipoUno"]);
$tipoDos = $conexion->obtenerIdDeTipoSegunDescripcion($_POST["tipoDos"]);


$sePudoActualizar = $conexion->updatePokemon($idPokemon, $nombre , $descripcion , $tipoUno , $tipoDos);

if ($sePudoActualizar) {
header("Location: pokedexList.php");
exit;
}elseif(!$sePudoActualizar) {
    $_SESSION["errorActualizar"] = "No se pudo actualizar el Pokemon";
    header("Location: pokedexList.php");
    exit;
}

