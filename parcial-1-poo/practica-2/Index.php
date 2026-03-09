<?php
include_once "Admin.php";

$admin = new Admin("Abdelalvarez55@gmail.com", "Abdel Gonzalez");

echo "Nombre: " . $admin->getNombre() . "<br>";
echo "Correo: " . $admin->getCorreo() . "<br>";
echo "Rol: " . $admin->getRol();
?>