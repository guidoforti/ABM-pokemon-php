<?php
session_start();
include_once("../views/shared/conexionBd.php");

$_SESSION['busquedaFiltrada'] = true;

$tiposAceptados = $conexion->obtenerTodosLosTiposDescripcion();
$filtro = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';
$pokemonesFiltrados = [];

// Si el filtro está vacío, devolvemos todos los Pokémon
if (empty($filtro)) {
    $_SESSION['filtradosPorNombre'] = $conexion->findAllPokemons();
    header("Location:pokedexList.php");
    exit;
}

// Validar caracteres especiales
if (preg_match('/[^a-zA-Z0-9]/', $filtro)) {
    $_SESSION['errorFiltrado'] = "No es posible filtrar por caracteres especiales";
    header("Location:pokedexList.php");
    exit;
}

// Filtrar por tipo
if (in_array(strtolower($filtro), $tiposAceptados)) {
    $pokemonesFiltrados = $conexion->findPokemonsByTipo($filtro);
    if (empty($pokemonesFiltrados)) {
        $_SESSION['errorFiltrado'] = "No se encontraron pokemons de ese tipo";
        header("Location:pokedexList.php");
        exit;
    }
    $_SESSION['filtradosPorTipo'] = $pokemonesFiltrados;
    header("Location:pokedexList.php");
    exit;
}

// Filtrar por ID
elseif (filter_var($filtro, FILTER_VALIDATE_INT)) {
    $pokemon = $conexion->findPokemonById($filtro); // devuelve un objeto o null
    if (!$pokemon) {
        $_SESSION['errorFiltrado'] = "No se encontraron pokemons con ese ID";
        header("Location:pokedexList.php");
        exit;
    }
    $_SESSION['filtradosPorId'] = [$pokemon]; // Siempre guardamos un array
    header("Location:pokedexList.php");
    exit;
}

// Filtrar por nombre
else {
    $pokemonesFiltrados = $conexion->findPokemonByName($filtro);
    if (empty($pokemonesFiltrados)) {
        $_SESSION['errorFiltrado'] = "No se encontraron pokemons con ese nombre";
        header("Location:pokedexList.php");
        exit;
    }
    $_SESSION['filtradosPorNombre'] = $pokemonesFiltrados;
    header("Location:pokedexList.php");
    exit;
}
