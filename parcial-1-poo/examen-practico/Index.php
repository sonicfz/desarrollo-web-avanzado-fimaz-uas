<?php
require_once 'Usuario.php';

$usuarios = [];
$errorMsg = "";

try {
    $usuarios[] = new Admin("Abdel Admin", "Abdelalvarez55@escuela.com",); 

    $usuarios[] = new Alumno("Jose Castillo", "Castillopa97@gmail.com", "23179445");

    $usuarios[] = new Alumno("Carlos Error", "Datos Incorrectos", "2024-999");

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        body { font-family: sans-serif; padding: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
        .alerta { color: red; font-weight: bold; border: 1px solid red; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>Lista de Usuarios Registrados</h1>

    <?php if ($errorMsg): ?>
        <div class="alerta">
            AVISO: <?php echo $errorMsg; ?>
        </div>
    <?php endif; ?>

    <table>
    <thead>
     <tr>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Rol</th>
    <th>Matrícula</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usuarios as $u): ?>
    <tr>
    <td><?php echo $u->getNombre(); ?></td>
    <td><?php echo $u->getCorreo(); ?></td>
    <td><?php echo $u->getRol(); ?></td>
    <td>
    <?php 
    echo ($u instanceof Alumno) ? $u->getMatricula() : "---"; 
    ?>
    </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

</body>
</html>