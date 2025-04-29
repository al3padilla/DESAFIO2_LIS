<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Ventas</title>
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
        <h2 class="text-center">Gestión de Ventas</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($ventas) && is_array($ventas)): ?>
                        <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td><?= htmlspecialchars($venta['cliente_nombre']) ?></td>
                                <td><?= htmlspecialchars($venta['fecha']) ?></td>
                                <td><?= number_format($venta['total'], 2) ?> USD</td>
                                <td><?= htmlspecialchars($venta['estado']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay ventas disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>