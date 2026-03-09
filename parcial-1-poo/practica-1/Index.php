<?php
include "Usuario.php";

$objUsuario1 = new Usuario("abdelalvarez55@gmail.com ", "Abdel Gonzalez ");

echo "nombre " . $objUsuario1->getNombre() . "<br>";
echo "correo " . $objUsuario1->getCorreo();

?>