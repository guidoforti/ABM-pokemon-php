<?php
include_once("../views/shared/header.php");
include_once("../views/shared/conexionBd.php");

$idPokemon = $_GET["id"];
$pokemon = $conexion->findPokemonById($idPokemon);
?>

<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle Pokémon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-img {
            max-width: 500px;
            height: auto;
            transition: transform 0.6s ease;
        }

        .pokemon-img:hover {
            transform: scale(1.3);
        }

        .type-img {
            width: 50px;
            height: auto;
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-dark text-light">

<!-- Header fijo -->
<header class="mb-4">
    <?php include_once("../views/shared/header.php"); ?>
</header>

<!-- Contenedor detalle Pokémon -->
<main class="d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-secondary rounded shadow-lg p-4">
        <div class="row g-4 align-items-center">

            <!-- Columna izquierda: Imagen -->
            <div class=" pokemon-img col-12 col-md-4 text-center">
                <img src="<?= $pokemon->getImagenRuta(); ?>"
                     alt="Imagen de <?= $pokemon->getNombre(); ?>"
                     class="img-fluid">
            </div>

            <!-- Columna derecha -->
            <div class="col-12 col-md-8">
                <!-- Nombre -->
                <div class="row mb-3">
                    <h2 class="fw-bold text-center text-md-start">
                        <?= $pokemon->getNombre(); ?>
                    </h2>
                </div>

                <!-- Descripción -->
                <div class="row mb-3">
                    <p class="text-center text-md-start">
                        <?= $pokemon->getDescripcion(); ?>
                    </p>
                </div>

                <!-- Tipos -->
                <div class="row justify-content-center justify-content-md-start">
                    <?php
                    $ruta = $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoUno());
                    ?>
                    <img
                        <?php if ($ruta !== null) {
                            echo 'src="' . $ruta . '"';
                        } ?>
                        class="type-img">
                    <?php if ($pokemon->getTipoDos() !== null): ?>
                        <?php
                        $ruta = $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoDos());
                        ?>
                        <img
                            <?php if ($ruta !== null) {
                                echo 'src="' . $ruta . '"';
                            } ?>
                            class="type-img">
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
