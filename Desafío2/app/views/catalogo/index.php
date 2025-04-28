<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../../controllers/CatalogoController.php';
require_once '../../controllers/Sesioncontroller.php';
if (!isset($data['productos'])) {
    $data['productos'] = []; 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - TextilExport</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/al3padilla/DESAFIO2_LIS" target="_blank">
                        <img src="/Desafío2/public/img/git.png" width="25">
                    </a>
                </li>

                <?php if (Sesioncontroller::isLoggedIn()): ?>
                    <li class="nav-item">
                        <span class="navbar-text">
                        Bienvenido, <?= $_SESSION['usuario']['nombre']; ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#carritoModal" title="Carrito de Compras">
                            <i class="fas fa-shopping-cart" style="font-size: 22px;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Desafío2/app/controllers/logout.php" title="Cerrar sesión">
                            <i class="fas fa-sign-out-alt" style="font-size: 22px;"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Desafío2/app/views/cliente/LoginAdmin.php" title="Login Admin">
                            <i class="fas fa-user-shield" style="font-size: 22px;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Desafío2/app/views/cliente/LoginCliente.php" title="Login Cliente">
                            <i class="fas fa-user-circle" style="font-size: 22px;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Desafío2/app/views/cliente/RegistroCliente.php" title="Registro Cliente">
                            <i class="fas fa-user-plus" style="font-size: 22px;"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Catálogo -->
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Catálogo de Productos</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="productList">
        <?php if (isset($productos) && !empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="col product" data-category="<?= $producto['categoria'] ?>">
                    <div class="card producto-card">
                    <img src="/Desafío2/public/img/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['nombre'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                            <p class="card-text"><?= $producto['descripcion'] ?></p>
                            <p><strong>$<?= number_format($producto['precio'], 2) ?></strong></p>
                            <span class="badge bg-success"><?= $producto['categoria'] ?></span>
                        <?php if (Sesioncontroller::isLoggedIn()): ?>
                            <form method="POST" action="/Desafío2/app/controllers/CarritoController.php" class="d-grid">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">                            
                            <input type="hidden" name="cantidad" value="1">
                            <button type="submit" name="agregar_carrito" class="btn btn-primary w-100 mt-2">
                                Agregar al carrito
                            </button>
                            </form>
                        <?php else: ?>
                                <div class="alert alert-warning mt-2" role="alert">
                                    <a href="/Desafío2/app/views/cliente/LoginCliente.php" class="btn btn-warning w-100">
                                        Inicia sesión para comprar
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>