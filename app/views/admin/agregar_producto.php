<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - TextilExport</title>
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
    <h2 class="text-center">Agregar Producto</h2>

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

    <form method="POST" enctype="multipart/form-data" action="/Desafío2/app/controllers/AggProductoController.php">
        <div class="mb-3">
            <label class="form-label">Código del Producto</label>
            <input type="text" class="form-control" name="codigo" value="<?php echo isset($codigo) ? $codigo : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion"><?php echo isset($descripcion) ? $descripcion : ''; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen">
            <small class="text-muted">Formatos permitidos: .jpg, .png</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select class="form-select" name="categoria">
                <option value="Textil" <?php echo (isset($categoria) && $categoria === 'Textil') ? 'selected' : ''; ?>>Textil</option>
                <option value="Promocional" <?php echo (isset($categoria) && $categoria === 'Promocional') ? 'selected' : ''; ?>>Promocional</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" class="form-control" name="precio" value="<?php echo isset($precio) ? $precio : ''; ?>" step="0.01">
        </div>
        <div class="mb-3">
            <label class="form-label">Existencias</label>
            <input type="number" class="form-control" name="existencias" value="<?php echo isset($existencias) ? $existencias : ''; ?>" min="0">
        </div>
        <button type="submit" class="btn btn-success">Agregar Producto</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
