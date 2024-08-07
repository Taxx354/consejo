<?php
// Conexión
require_once '../conexion.php';

// Obtener datos del formulario
$nombre_auxiliar = $_POST['nombre_auxiliar'];
$dni_auxiliar = $_POST['dni_auxiliar'];
$direccion_auxiliar = $_POST['direccion_auxiliar'];
$telefono_auxiliar = $_POST['telefono_auxiliar'];
$cargo_auxiliar = $_POST['cargo_auxiliar'];
$observaciones_cargo = $_POST['observaciones_cargo'];
$categoria_afip = $_POST['categoria_afip'];
$cuit_cuil = $_POST['cuit_cuil'];
$mail_auxiliar = $_POST['mail_auxiliar'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO auxiliar ( nombre_auxiliar, dni_auxiliar, direccion_auxiliar, telefono_auxiliar, cargo_auxiliar, observaciones_cargo, categoria_afip, cuit_cuil, mail_auxiliar)
VALUES ('$nombre_auxiliar', '$dni_auxiliar', '$direccion_auxiliar', '$telefono_auxiliar', '$cargo_auxiliar', '$observaciones_cargo', '$categoria_afip', '$cuit_cuil', '$mail_auxiliar')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo auxiliar agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: auxiliar.php");
exit();
?>