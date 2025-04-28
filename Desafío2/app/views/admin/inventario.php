<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Desafío2/public/css/estiloadmin.css">
</head>
<body>
<nav class="navbar custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold">TextilExport - Portal Administrativo</a>
        <div>
            <a class="btn btn-outline-light me-2" href="/Desafío2/app/controllers/UsuariosController.php">Usuarios</a>
            <a class="btn btn-outline-light" href="/Desafío2/app/controllers/logout.php">Cerrar Sesión</a>
        </div>
    </div>
</nav>
    
<div class="container mt-4">
    <h2 class="text-center">Gestión de Inventario</h2>
    
    <a href="/Desafío2/app/controllers/ProductoController.php?action=agregar" class="btn btn-outline-primary mb-3">Añadir Producto</a>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($productos) && is_array($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['codigo']) ?></td>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                            <td><img src="/Desafío2/public/img/<?= htmlspecialchars($producto['imagen']) ?>" width="50" height="50" alt="<?= htmlspecialchars($producto['nombre']) ?>"></td>
                            <td><?= htmlspecialchars($producto['categoria']) ?></td>
                            <td>$<?= number_format($producto['precio'], 2) ?></td>
                            <td><?= htmlspecialchars($producto['existencias']) ?></td>
                            <td>
                                <a href="/Desafío2/app/controllers/ProductoController.php?action=editar&id=<?php echo $producto['id']; ?>" class="btn btn-outline-primary mb-3">Modificar</a>
                                <a href="/Desafío2/app/controllers/ProductoController.php?action=eliminar&id=<?= $producto['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay productos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>