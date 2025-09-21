<?php
session_start();
include_once("../views/shared/conexionBd.php");
$esAdmin = false;

if (isset($_SESSION["rol"])) {

    if ($_SESSION["rol"] === "ADMIN") {
        $esAdmin = true;
    }
}

$idPokemon = $_GET["id"];


if ($esAdmin) {
    $baja = $conexion->deletePokemonById($idPokemon);
    if ($baja) {
        $_SESSION['exitoAlBorrar'] = "se borro el pokemon correctamente";
        header("Location: pokedexList.php");
        exit;
    } elseif (!$baja) {
        $_SESSION['errorAlBorrar'] = "no se borro el pokemon";
        header("Location: pokedexList.php");
        exit;
    }
} else {
    header("Location: pokedexList.php");
    exit;
}