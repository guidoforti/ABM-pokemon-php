<?php
session_start();
if (isset($_SESSION["error"])) { ?>
<?php if ( $_SESSION["error"] != null) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo  $_SESSION["error"];
        unset($_SESSION["error"]);
        ?>
    </div>
<?php }
} ?>
<?php
if (isset($_SESSION["exito"])) { ?>
    <?php if ( $_SESSION["exito"] != null) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo  $_SESSION["exito"];
            unset($_SESSION["exito"]);
            ?>
        </div>
    <?php }
} ?>





<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro - Pokedex</title>
    <style>
        body {
            min-height: 100vh;
            background-color: #212529;

        }
        .register-container {
            max-width: 500px;
            padding: 2rem;
            border-radius: 10px;
            background-color: #2b3035;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.3);
            margin: 0 auto;
        }
        .form-control, .form-control:focus {
            background-color: #343a40;
            border-color: #495057;
            color: #f8f9fa;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="register-container">
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <img src="/Pokedex/Files/logoPokedex.png" alt="Logo Pokédex" style="height: 50px;" class="me-3">
                    <h1 class="m-0">REGÍSTRATE</h1>
                </div>
                <form action="registerUser.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control form-control-lg" id="confirmPassword"  name="confirmPassword" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                        <p class="text-center mt-3 mb-0">
                            ¿Ya tienes una cuenta? <a href="../views/pokedexList.php" class="text-primary text-decoration-none">Inicia sesión</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>