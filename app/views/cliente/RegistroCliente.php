<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Cliente - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                <li class="nav-item"><a class="nav-link" href="/Desafío2/app/views/catalogo">Catálogo</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Registro de Cliente</h2>

    <?php
    if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']);?>
    <?php elseif (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']);?>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="POST" action="/Desafío2/app/controllers/RegistroClienteController.php?action=registrar">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : (isset($_POST['nombre']) ? $_POST['nombre'] : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo isset($usuario) ? $usuario : (isset($_POST['usuario']) ? $_POST['usuario'] : ''); ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="cliente" <?php echo (isset($tipo) && $tipo == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="admin" <?php echo (isset($tipo) && $tipo == 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Registrar</button>
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
session_destroy();
?>