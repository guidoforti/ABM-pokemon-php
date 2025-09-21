<?php
session_start();
include_once("../views/shared/conexionBd.php");

$nombreUsuario  = $_POST["username"];
$contrasenia = $_POST["password"];
$contraseniaConfirmacion = $_POST["confirmPassword"];

if ($contrasenia !== $contraseniaConfirmacion) {
    $_SESSION['error'] = "Las Contraseñas no coinciden";
    header ("Location: register.php");
    exit;
}


if ($conexion->usuarioExistByName($nombreUsuario)) {

    $_SESSION['error'] = "el nombre de usuario " . $nombreUsuario . " no esta disponible";
    header("Location: register.php");
    exit;
}


if ($nombreUsuario === 'guido') {
   $usuarioGuardado =  $conexion->guardarUsuario($nombreUsuario, $contrasenia,"ADMIN");
   if ($usuarioGuardado != null) {
       // Iniciamos sesión automáticamente
       $_SESSION["exitoAlLoguear"] = "Registrado e iniciado sesión con éxito";
       $_SESSION["username"] = $usuarioGuardado->getNombre();
       $_SESSION["rol"] = $conexion->obtenerDescripcionRolParaIdUsuario($usuarioGuardado->getId());
       $_SESSION["logueado"] = true;

       $_SESSION['exito'] = "el usuario con nombre " . $nombreUsuario . " se guardo correctamente con un Rol de : ADMIN";
       header ("Location: pokedexList.php");
       exit;
   }else {
       $_SESSION['error'] = "el usuario no se pudo guardar";
       header ("Location: register.php");
       exit;
   }

} else {
    $usuarioGuardado =  $conexion->guardarUsuario($nombreUsuario, $contrasenia,"USER");
    if ($usuarioGuardado != null) {
        // Iniciamos sesión automáticamente
        $_SESSION["exitoAlLoguear"] = "Registrado e iniciado sesión con éxito";
        $_SESSION["username"] = $usuarioGuardado->getNombre();
        $_SESSION["rol"] = $conexion->obtenerDescripcionRolParaIdUsuario($usuarioGuardado->getId());
        $_SESSION["logueado"] = true;

        $_SESSION['exito'] = "el usuario con nombre " . $nombreUsuario . " se guardo correctamente con un Rol de : USER";
        header ("Location: pokedexList.php");
        exit;
    }else {
        $_SESSION['error'] = " el usuario no se pudo guardar";
        header ("Location: register.php");
        exit;
    }
}
