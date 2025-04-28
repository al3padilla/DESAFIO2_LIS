<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Desafío2/public/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="/Desafío2/public/img/logo.png" alt="Logo" width="50" height="50">
            TextilExport
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/Desafío2/app/views/home">Inicio</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Formulario de Login Admin -->
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Login Cliente</h2>

    <!-- Mostrar mensaje de error o éxito si existe -->
    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php elseif (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form method="POST" action="/Desafío2/app/controllers/LoginClienteController.php">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave">
        </div>
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
</div>

<!-- FOOTER -->
<footer class="text-center mt-5 py-4 bg-dark text-light">
    <div class="mb-2">
        <a href="https://facebook.com/UDBelsalvador" class="text-light me-3" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="https://x.com/UDBelsalvador" class="text-light me-3" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
        <a href="https://instagram.com/UDBelsalvador" class="text-light me-3" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="https://linkedin.com/school/udbelsalvador" class="text-light" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
    </div>
    <div>
        &copy; TextilExport 2025. Todos los derechos reservados.
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
?>