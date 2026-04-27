<?php

spl_autoload_register(function ($clase) {
    $ruta = str_replace(['App\\', '\\'], ['', '/'], $clase) . '.php';
    if (file_exists($ruta)) require_once $ruta;
});

use App\Controllers\ProductoController;
use App\Models\Producto;

$controller = new ProductoController();
$mensaje = "";
$productoEditar = null;
$terminoBusqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if (isset($_GET['eliminar'])) {
    if ($controller->eliminar($_GET['eliminar'])) {
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el producto.";
    }
}

if (isset($_GET['editar'])) {
    $productoEditar = $controller->obtenerPorId($_GET['editar']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = new Producto();
    $producto->setId(!empty($_POST['id']) ? $_POST['id'] : null);
    $producto->setNombre(trim($_POST['nombre']));
    $producto->setDescripcion(trim($_POST['descripcion']));
    $producto->setExistencia((int)$_POST['existencia']);
    $producto->setPrecio((float)$_POST['precio']);

    if ($producto->getId()) {
        $mensaje = $controller->actualizar($producto) ? "Producto actualizado correctamente." : "Error al actualizar.";
    } else {
        $mensaje = $controller->crear($producto) ? "Producto agregado correctamente." : "Error al agregar.";
    }
}

$productos = ($terminoBusqueda !== '') ? $controller->buscar($terminoBusqueda) : $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">CRUD de Productos con PHP, PDO y POO</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white"><?php echo $productoEditar ? "Editar producto" : "Agregar producto"; ?></div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $productoEditar['id'] ?? ''; ?>">
                    <div class="row">
                        <div class="col-md-3 mb-3"><label class="form-label">Nombre</label><input type="text" name="nombre" class="form-control" value="<?php echo $productoEditar['nombre'] ?? ''; ?>" required></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Descripción</label><input type="text" name="descripcion" class="form-control" value="<?php echo $productoEditar['descripcion'] ?? ''; ?>" required></div>
                        <div class="col-md-2 mb-3"><label class="form-label">Existencia</label><input type="number" name="existencia" class="form-control" value="<?php echo $productoEditar['existencia'] ?? ''; ?>" required></div>
                        <div class="col-md-2 mb-3"><label class="form-label">Precio</label><input type="number" step="0.01" name="precio" class="form-control" value="<?php echo $productoEditar['precio'] ?? ''; ?>" required></div>
                        <div class="col-md-2 mb-3 d-flex align-items-end"><button type="submit" class="btn btn-success w-100"><?php echo $productoEditar ? "Actualizar" : "Guardar"; ?></button></div>
                    </div>
                    <?php if ($productoEditar): ?><a href="index.php" class="btn btn-secondary">Cancelar edición</a><?php endif; ?>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">Lista de productos</div>
            <div class="card-body">
                <form method="GET" action="" class="row g-2 mb-3">
                    <div class="col-md-10"><input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="<?php echo htmlspecialchars($terminoBusqueda); ?>"></div>
                    <div class="col-md-2 d-grid"><button type="submit" class="btn btn-primary">Buscar</button></div>
                </form>
                <table class="table table-bordered table-striped">
                    <thead class="table-secondary">
                        <tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Existencia</th><th>Precio</th><th>Acciones</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td><?php echo $p['id']; ?></td>
                                <td><?php echo $p['nombre']; ?></td>
                                <td><?php echo $p['descripcion']; ?></td>
                                <td><?php echo $p['existencia']; ?></td>
                                <td>$<?php echo number_format($p['precio'], 2); ?></td>
                                <td>
                                    <a href="index.php?editar=<?php echo $p['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="index.php?eliminar=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>