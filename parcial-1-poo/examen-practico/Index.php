<?php
require_once 'Usuario.php';
require_once 'Admin.php';
require_once 'Alumno.php';

$objusuarios = [];
$errorMsg = "";

try {
    $objusuarios[] = new Admin("Abdel Gonzalez", "abdelalvarez55@gmail.com");
    $objusuarios[] = new Alumno("Jose Castillo", "joseca@universidad.edu", "93172487");
    $uError = new Alumno("Juan Perez", "juan@universidaddu", "2024-001");

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Examen POO</title>
</head>
<body>

    <h2>Lista de Usuarios Registrados</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Matrícula</th>
        </tr>

        <?php
        foreach($objusuarios as $u) {
      
            $matricula = method_exists($u, "getMatricula") ? $u->getMatricula() : "-";

            echo "<tr>";
            echo "<td>" . $u->getNombre() . "</td>";
            echo "<td>" . $u->getCorreo() . "</td>";
            echo "<td>" . $u->getRol() . "</td>";
            echo "<td>" . $matricula . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php if ($errorMsg): ?>
        <p style="color: red;">
            <b>Error:</b> <?php echo $errorMsg; ?>
        </p>
    <?php endif; ?>

</body>
</html>