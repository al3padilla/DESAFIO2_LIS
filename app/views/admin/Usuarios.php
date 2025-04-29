<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Desafío2/public/css/estiloadmin.css">
</head>
<body>
    <nav class="navbar custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/Desafío2/app/controllers/ProductoController.php">TextilExport - Portal Administrativo</a>
            <a class="navbar-brand fw-bold" href="/Desafío2/app/controllers/logout.php">Cerrar Sesión</a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2 class="text-center">Gestión de Usuarios</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($usuarios) && is_array($usuarios)): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                                <td><?= htmlspecialchars($usuario['tipo']) ?></td>
                                <td>
                                    <a href="/Desafío2/app/controllers/UsuariosController.php?action=editar&id=<?php echo $usuario['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="/Desafío2/app/controllers/UsuariosController.php?action=eliminar&id=<?php echo $usuario['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay usuarios disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>