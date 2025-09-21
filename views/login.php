<?php
session_start();
include_once("../views/shared/conexionBd.php");

$username = $_POST['username'];
$password = $_POST['password'];


$usuarioObtenido = $conexion->obtenerUsuarioAlLoguear($username, $password);

if ($usuarioObtenido == null) {
    $_SESSION["errorAlLoguear"] = "El usuario no existe";
    $_SESSION["logueado"] = false;
    header("Location: pokedexList.php");
    exit;
}

$_SESSION["exitoAlLoguear"] = "Logueado con exito";
$_SESSION["username"] = $usuarioObtenido->getNombre();
$_SESSION["rol"] = $conexion->obtenerDescripcionRolParaIdUsuario($usuarioObtenido->getId());
$_SESSION["logueado"] = true;


header("Location: pokedexList.php");
exit;

?>