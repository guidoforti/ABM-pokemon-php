<?php
include_once("shared/header.php");
$esAdmin = false;

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
    <title>Nuevo Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<?php if($esAdmin): ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card bg-dark-subtle border-secondary">
                <div class="card-header bg-primary bg-gradient">
                    <h4 class="mb-0 text-white">Nuevo Tipo de Pokémon</h4>
                </div>
                <div class="card-body">
                    <form action="guardar.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label text-white">Nombre</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" 
                                   id="nombre" name="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipoUno" class="form-label text-white">Primer tipo</label>
                            <select name="tipoUno" id="tipoUno" class="form-select bg-dark text-white border-secondary" required>
                                <option value="" selected disabled>Selecciona un tipo</option>
                                <option value="agua">agua</option>
                                <option value="bicho">bicho</option>
                                <option value="dragon">dragón</option>
                                <option value="electrico">eléctrico</option>
                                <option value="fantasma">fantasma</option>
                                <option value="fuego">fuego</option>
                                <option value="hada">hada</option>
                                <option value="hielo">hielo</option>
                                <option value="lucha">lucha</option>
                                <option value="normal">normal</option>
                                <option value="planta">planta</option>
                                <option value="psiquico">psíquico</option>
                                <option value="roca">roca</option>
                                <option value="tierra">tierra</option>
                                <option value="veneno">veneno</option>
                                <option value="volador">volador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipoDos" class="form-label text-white">Segundo tipo (opcional)</label>
                            <select name="tipoDos" id="tipoDos" class="form-select bg-dark text-white border-secondary">
                                <option value="" selected disabled>Selecciona un tipo</option>
                                <option value="agua">agua</option>
                                <option value="bicho">bicho</option>
                                <option value="dragon">dragón</option>
                                <option value="electrico">eléctrico</option>
                                <option value="fantasma">fantasma</option>
                                <option value="fuego">fuego</option>
                                <option value="hada">hada</option>
                                <option value="hielo">hielo</option>
                                <option value="lucha">lucha</option>
                                <option value="normal">normal</option>
                                <option value="planta">planta</option>
                                <option value="psiquico">psíquico</option>
                                <option value="roca">roca</option>
                                <option value="tierra">tierra</option>
                                <option value="veneno">veneno</option>
                                <option value="volador">volador</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label text-white">Imagen del Pokémon</label>
                            <input type="file" class="form-control bg-dark text-white border-secondary" 
                                   id="imagen" name="imagen" accept="image/*" required>
                            <div class="form-text text-white-50">Formatos aceptados: JPG, PNG, GIF</div>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="form-label text-white">Descripción</label>
                            <textarea class="form-control bg-dark text-white border-secondary" 
                                     id="descripcion" name="descripcion" 
                                     rows="3" placeholder="Describe las características del Pokémon"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save"></i> Guardar Tipo
                            </button>
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
                <p class="lead">No tenes los permisos necesarios para esta accion</p>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Scripts de Bootstrap con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Iconos de Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>