<?php
session_start();
$logueado = false;
if (isset($_SESSION["logueado"])) {
    $logueado = $_SESSION["logueado"];
}
?>
<!doctype html>
<html lang="e">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokédex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/Pokedex/Files/logoPokedex.png" alt="Logo Pokédex" style="height: 50px;" class="me-2">
            <a  href="/Pokedex/views/pokedexList.php"  class="d-none d-sm-inline" style="text-decoration: none; color: inherit;">POKEDEX</a>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <?php if (!$logueado) { ?>
                <!-- Si NO está logueado, muestra el formulario de login -->
                <form class="d-flex flex-column flex-sm-row gap-2" action="../views/login.php" method="POST">
                    <div class="mb-2 mb-sm-0">
                        <input type="text" name="username" class="form-control form-control-sm" placeholder="Usuario" aria-label="Usuario">
                    </div>
                    <div class="mb-2 mb-sm-0">
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Contraseña" aria-label="Contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Ingresar</button>
                    <button type="button" class="btn btn-primary btn-sm"><a href="../views/register.php" style="text-decoration: none; color: #f8f9fa">Registrate</a></button>
                </form>
            <?php } else { ?>
                <!-- Si SÍ está logueado, muestra un saludo y un botón de logout -->
                <div class="d-flex align-items-center">
                    <span class="navbar-text me-3">
                        ¡Hola, <?php echo htmlspecialchars($_SESSION["username"]); ?>!
                        <button type="button" class="btn btn-primary btn-sm"><a href="../views/logout.php" style="text-decoration: none; color: #f8f9fa">Desloguearse</a></button>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>