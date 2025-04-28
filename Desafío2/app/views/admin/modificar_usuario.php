<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario - TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/Desafío2/public/css/estiloadmin.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="/Desafío2/public/img/logo.png" alt="Logo" width="50" height="50">
            TextilExport - Portal Administrativo
        </a>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="text-center">Modificar Usuario</h2>

    <!-- Mostrar errores -->
    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (isset($_SESSION['success']) && !empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Formulario para modificar usuario -->
    <form method="POST" action="/Desafío2/app/controllers/UsuariosController.php">
        <input type="hidden" name="action" value="actualizar">
        <input type="hidden" name="id" value="<?= isset($usuario['id']) ? $usuario['id'] : ''; ?>">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= isset($usuario['nombre']) ? htmlspecialchars($usuario['nombre']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?= isset($usuario['usuario']) ? htmlspecialchars($usuario['usuario']) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña Nueva (opcional)</label>
            <input type="password" class="form-control" name="clave">
            <small class="text-muted">Deja en blanco si no quieres cambiarla.</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de Usuario</label>
            <select class="form-select" name="tipo" required>
                <option value="Administrador" <?= (isset($usuario['tipo']) && $usuario['tipo'] === 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                <option value="Empleado" <?= (isset($usuario['tipo']) && $usuario['tipo'] === 'Empleado') ? 'selected' : ''; ?>>Empleado</option>
            </select>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="/Desafío2/app/controllers/UsuariosController.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-warning">Actualizar Usuario</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>