<?php
include_once("../views/shared/conexionBd.php");
require_once("../Domain/Pokemon.php");
include_once("../views/shared/header.php");

if (isset($_SESSION["errorAlLoguear"])) { ?>
    <?php if ( $_SESSION["errorAlLoguear"] != null) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo  $_SESSION["errorAlLoguear"];
            unset($_SESSION["errorAlLoguear"]);
            ?>
        </div>
    <?php }
} ?>
<?php

if (isset($_SESSION["errorActualizar"])) { ?>
    <?php if ( $_SESSION["errorActualizar"] != null) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo  $_SESSION["errorActualizar"];
            unset($_SESSION["errorActualizar"]);
            ?>
        </div>
    <?php }
} ?>

<?php

if (isset($_SESSION["errorFiltrado"])) { ?>
    <?php if ( $_SESSION["errorFiltrado"] != null) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo  $_SESSION["errorFiltrado"];
            unset($_SESSION["errorFiltrado"]);
            ?>
        </div>
    <?php }
} ?>



<?php
$pokemons = $conexion->findAllPokemons();
$username = null;

$esAdmin = false;
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"] ;
}
if (isset($_SESSION["rol"])) {

    if ( $_SESSION["rol"] === "ADMIN") {
        $esAdmin = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-img {
            max-width: 100px;
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
<body class="bg-dark">

<?php if ($logueado == true) : ?>
    <div class="card-body p-3">
        <form method="GET" action="filtrarPokemons.php" class="mb-4">
            <div class="input-group">
                <input type="text"
                       name="busqueda"
                       class="form-control"
                       placeholder="Buscar por nombre, ID o tipo de Pokémon"
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php if(!isset($_SESSION['busquedaFiltrada'])): ?>
    <div class="container mt-4">
        <div class="card bg-dark-subtle">
            <div class="card-header bg-primary bg-gradient">
                <h2 class="h4 mb-0 text-white">Pokédex</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover table-striped-columns m-0">
                        <thead class="table-primary">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Pokemon</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo uno</th>
                            <th scope="col">Tipo dos</th>
                            <?php if($esAdmin) : ?>
                            <th scope="col">Acciones</th>
                            <?php endif;?>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        <?php foreach ($pokemons as $pokemon) : ?>
                            <tr>
                                <td class="align-middle"><?php echo $pokemon->getId(); ?></td>
                                <td class="align-middle">
                                    <img src="<?php echo $pokemon->getImagenRuta(); ?>" class="pokemon-img img-fluid">
                                </td>
                                <td class="align-middle"><?php echo $pokemon->getNombre(); ?></td>
                                <td class="align-middle">
                                    <img src="<?php echo $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoUno()); ?>"
                                         class="type-img">
                                </td>
                                <td class="align-middle">
                                    <?php
                                    $ruta = $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoDos());
                                    ?>
                                    <img
                                            <?php if ($ruta !== null) {
                                                echo 'src="' . $ruta . '"';
                                            } ?>
                                            class="type-img">
                                </td>
                                <?php if($esAdmin) : ?>
                                    <td class="align-middle">
                                        <a href="detalle.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-success btn-sm me-1">Detalle</a>
                                        <a href="modificarPokemon.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-warning btn-sm me-1">Modificar</a>
                                        <a href="darDeBajaPokemon.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-danger btn-sm">Baja</a>
                                    </td>
                                <?php endif;?>



                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php if(isset($_SESSION['busquedaFiltrada']) && !isset($_SESSION['errorFiltrado']) ): ?>

        <?php
        if(isset($_SESSION['filtradosPorTipo'])) {
            $pokemonesFiltrados  =  $_SESSION['filtradosPorTipo'];
        }elseif (isset($_SESSION['filtradosPorId'])) {
            $pokemonesFiltrados = $_SESSION['filtradosPorId'];
        }elseif (isset($_SESSION['filtradosPorNombre'])) {
            $pokemonesFiltrados = $_SESSION['filtradosPorNombre'];
        }else {
            $pokemonesFiltrados = $pokemons;
        }
        ?>

        <div class="container mt-4">
            <div class="card bg-dark-subtle">
                <div class="card-header bg-primary bg-gradient">
                    <h2 class="h4 mb-0 text-white">Pokédex</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-striped-columns m-0">
                            <thead class="table-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Pokemon</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo uno</th>
                                <th scope="col">Tipo dos</th>
                                <?php if($esAdmin) : ?>
                                    <th scope="col">Acciones</th>
                                <?php endif;?>
                            </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <?php foreach ($pokemonesFiltrados as $pokemon) : ?>
                                <tr>
                                    <td class="align-middle"><?php echo $pokemon->getId(); ?></td>
                                    <td class="align-middle">
                                        <img src="<?php echo $pokemon->getImagenRuta(); ?>" class="pokemon-img img-fluid">
                                    </td>
                                    <td class="align-middle"><?php echo $pokemon->getNombre(); ?></td>
                                    <td class="align-middle">
                                        <img src="<?php echo $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoUno()); ?>"
                                             class="type-img">
                                    </td>
                                    <td class="align-middle">
                                        <?php
                                        $ruta = $conexion->obtenerRutaImagenTipoSegunId($pokemon->getTipoDos());
                                        ?>
                                        <img
                                                <?php if ($ruta !== null) {
                                                    echo 'src="' . $ruta . '"';
                                                } ?>
                                                class="type-img">
                                    </td>
                                    <?php if($esAdmin) : ?>
                                        <td class="align-middle">
                                            <a href="detalle.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-success btn-sm me-1">Detalle</a>
                                            <a href="modificarPokemon.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-warning btn-sm me-1">Modificar</a>
                                            <a href="darDeBajaPokemon.php?id=<?php echo $pokemon->getId(); ?>" class="btn btn-danger btn-sm">Baja</a>
                                        </td>
                                    <?php endif;?>



                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php
                        if(isset($_SESSION['filtradosPorTipo'])) {
                            unset($_SESSION['filtradosPorTipo']);
                        }elseif (isset($_SESSION['filtradosPorId'])) {
                            unset($_SESSION['filtradosPorId']);
                        }elseif (isset($_SESSION['filtradosPorNombre'])) {
                            unset($_SESSION['filtradosPorNombre']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php endif;?>
    <div class="container mt-4 d-grid">
        <a href="guardarPokemonTipo.php" class="btn btn-primary w-100 text-center">Crear Nuevo Pokemon</a>
    </div>
<?php endif;?>


<?php if(!$logueado): ?>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <div class="alert alert-warning p-4" role="alert">
                <h4 class="alert-heading">¡Acceso Restringido!</h4>
                <p class="lead">Para ver la Pokédex, primero debe iniciar sesión.</p>
            </div>
        </div>
    </div>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>