<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/Desafío2/public/css/estiloadmin.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Desafío2/app/controllers/ProductoController.php">
            <img src="/Desafío2/public/img/logo.png" alt="Logo" width="50" height="50">
            TextilExport - Portal Administrativo
        </a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center">Modificar Producto</h2>

    <!-- Mostrar errores -->
    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Formulario para modificar producto -->
    <form method="POST" enctype="multipart/form-data" action="/Desafío2/app/controllers/ProductoController.php">
        <input type="hidden" name="action" value="editar">
        <input type="hidden" name="id" value="<?php echo isset($producto['id']) ? $producto['id'] : ''; ?>">

        <div class="mb-3">
            <label class="form-label">Código del Producto</label>
            <input type="text" class="form-control" name="codigo" value="<?php echo isset($producto['codigo']) ? $producto['codigo'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" required><?php echo isset($producto['descripcion']) ? $producto['descripcion'] : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen (Opcional)</label>
            <input type="file" class="form-control" name="imagen">
            <small class="text-muted">Formatos permitidos: .jpg, .png</small>
            <?php if (isset($producto['imagen'])): ?>
                <p><strong>Imagen actual:</strong> <img src="/Desafío2/public/img/<?php echo $producto['imagen']; ?>" width="100" alt="Imagen producto"></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select class="form-select" name="categoria" required>
                <option value="Textil" <?php echo (isset($producto['categoria']) && $producto['categoria'] === 'Textil') ? 'selected' : ''; ?>>Textil</option>
                <option value="Promocional" <?php echo (isset($producto['categoria']) && $producto['categoria'] === 'Promocional') ? 'selected' : ''; ?>>Promocional</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Existencias</label>
            <input type="number" class="form-control" name="existencias" value="<?php echo isset($producto['existencias']) ? $producto['existencias'] : ''; ?>" min="0" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar Producto</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>