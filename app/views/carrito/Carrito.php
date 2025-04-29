<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Desafío2/public/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Desafío2/app/views/home">
            <img src="/Desafío2/public/img/logo.png" alt="Logo" width="50" height="50">
            TextilExport
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/Desafío2/app/views/home">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="/Desafío2/app/views/catalogo">Catalogo</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- CARRITO -->
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Mi Carrito</h2>
    <?php if (!empty($productosCarrito)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productosCarrito as $producto): ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td>
                        <form action="/Desafío2/app/controllers/CarritoController.php" method="POST" style="display:inline;">
                            <input type="hidden" name="carrito_id" value="<?php echo $producto['carrito_id']; ?>">
                            <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" min="1" max="100" required>
                            <button type="submit" name="actualizar_cantidad" class="btn btn-warning btn-sm">Actualizar</button>
                        </form>
                    </td>
                    <td><?php echo '$' . number_format($producto['precio'], 2); ?></td>
                    <td><?php echo '$' . number_format($producto['precio'] * $producto['cantidad'], 2); ?></td>
                    <td>
                        <a href="/Desafío2/app/controllers/CarritoController.php?eliminar=<?php echo $producto['carrito_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info text-center">
        No tienes productos en el carrito.
    </div>
<?php endif; ?>

<?php
$totalCarrito = 0;
foreach ($productosCarrito as $producto) {
    $totalCarrito += $producto['precio'] * $producto['cantidad'];
}
?>

<?php if (!empty($productosCarrito)): ?>
    <div class="text-end">
        <h4>Total a Pagar: <span class="text-success">$<?php echo number_format($totalCarrito, 2); ?></span></h4>
        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalPago">Continuar Compra</button>
    </div>
<?php endif; ?>
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

<!-- Modal de Pago -->
<div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="/Desafío2/app/controllers/PagoController.php" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPagoLabel">Pago con Tarjeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Número de Tarjeta</label>
                    <input type="text" name="tarjeta" class="form-control" required maxlength="16">
                </div>
                <div class="mb-3">
                    <label>Nombre del Titular</label>
                    <input type="text" name="titular" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Fecha de Expiración</label>
                    <input type="text" name="expiracion" class="form-control" placeholder="MM/AA" required maxlength="5">
                </div>
                <div class="mb-3">
                    <label>CVC</label>
                    <input type="text" name="cvc" class="form-control" required maxlength="3">
                </div>
                <input type="hidden" name="total" value="<?php echo $totalCarrito; ?>">
            </div>
            <div class="modal-footer">
                <button type="submit" name="procesar_pago" class="btn btn-success">Pagar</button>
            </div>
        </div>
    </form>
  </div>
</div>
</body>
</html>