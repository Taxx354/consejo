<?php

        // Conexión
        require_once '../conexion.php';

// Obtener datos del formulario
$nombre_proveedor = $_POST['nombre_proveedor'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$tipo_servicio = $_POST['tipo_servicio'];
$observaciones_servicio = $_POST['observaciones_servicio'];
$categoria_afip = $_POST['categoria_afip'];
$cuit_cuil = $_POST['cuit_cuil'];
$mail = $_POST['mail'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO proveedor (nombre_proveedor, dni, direccion, telefono, tipo_servicio, observaciones_servicio, categoria_afip, cuit_cuil, mail)
VALUES ('$nombre_proveedor', '$dni', '$direccion', '$telefono', '$tipo_servicio', '$observaciones_servicio', '$categoria_afip', '$cuit_cuil', '$mail')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo proveedor agregada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: proveedores.php");
exit();
?>