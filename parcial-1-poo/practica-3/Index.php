<?php

require_once "clase/Admin.php";
require_once "clase/Alumno.php";

try {

    $admin = new Admin("abdel Gonzalez", "abdel@empresa.com");
    $alumno = new Alumno("jose  Castillo", "castillo99@correo.com", "9746525");

    echo "<h2>Usuarios válidos</h2>";

    echo $admin->getNombre() . " - " . $admin->getRol() . "<br>";
    echo $alumno->getNombre() . " - " . $alumno->getRol() . "<br>";
    echo "Matrícula: " . $alumno->getMatricula();

    $error = new Admin("Pedro", "correo-mal");

} catch (Exception $e) {

    echo "<h3>Error detectado:</h3>";
    echo $e->getMessage();

}
?>