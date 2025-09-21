<?php
include_once("shared/header.php");
include_once("shared/conexionBd.php");

$esAdmin = false;
if (isset($_SESSION["rol"])) {
    if ($_SESSION["rol"] === "ADMIN") {
        $esAdmin = true;
    }
}

$idPokemon = $_GET["id"];
$pokemon = $conexion->findPokemonById($idPokemon);

$tipos = [
    "agua", "bicho", "dragon", "electrico", "fantasma", "fuego", "hada",
    "hielo", "lucha", "normal", "planta", "psiquico", "roca", "tierra",
    "veneno", "volador"
];
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-dark">

<?php if($esAdmin): ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card bg-dark-subtle border-secondary">
                    <div class="card-header bg-warning bg-gradient">
                        <h4 class="mb-0 text-dark">
                            <i class="bi bi-pencil-square"></i> Modificar Pokémon
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../views/actualizar.php" method="POST">
                            <input type="hidden" name="id" value="<?= $pokemon->getId(); ?>">

                            <div class="row g-4 align-items-center">

                                <div class="col-12 col-md-4 text-center">
                                    <img src="<?= $pokemon->getImagenRuta(); ?>"
                                         alt="Imagen de <?= $pokemon->getNombre(); ?>"
                                         class="img-fluid rounded shadow-sm">
                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="mb-3">
                                        <label for="nombre" class="form-label text-white">Nombre</label>
                                        <input type="text" class="form-control bg-dark text-white border-secondary"
                                               id="nombre" name="nombre"
                                               value="<?= $pokemon->getNombre(); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label text-white">Descripción</label>
                                        <textarea class="form-control bg-dark text-white border-secondary"
                                                  id="descripcion" name="descripcion"
                                                  rows="3" required><?= $pokemon->getDescripcion(); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipoUno" class="form-label text-white">Primer tipo</label>
                                        <select name="tipoUno" id="tipoUno" class="form-select bg-dark text-white border-secondary" required>
                                            <option value="" disabled>Selecciona un tipo</option>
                                            <?php foreach ($tipos as $tipo): ?>
                                                <option value="<?= $tipo ?>" <?= ($conexion->obtenerDescripcionTipoSegunId($pokemon->getTipoUno()) === $tipo) ? "selected" : "" ?>>
                                                    <?= ucfirst($tipo) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipoDos" class="form-label text-white">Segundo tipo (opcional)</label>
                                        <select name="tipoDos" id="tipoDos" class="form-select bg-dark text-white border-secondary">
                                            <option value="" <?= $pokemon->getTipoDos() === null ? "selected" : "" ?>>Ninguno</option>
                                            <?php foreach ($tipos as $tipo): ?>
                                                <option value="<?= $tipo ?>" <?= ($tipo == $conexion->obtenerDescripcionTipoSegunId($pokemon->getTipoDos())) ? "selected" : "" ?>>
                                                <?= ucfirst($tipo) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-warning btn-lg text-dark">
                                            <i class="bi bi-save"></i> Guardar cambios
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!$esAdmin): ?>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <div class="alert alert-danger p-4" role="alert">
                <h4 class="alert-heading">¡Acceso Restringido!</h4>
                <p class="lead">No tenés los permisos necesarios para esta acción</p>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
