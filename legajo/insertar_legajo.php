<?php
        // Conexión
        require_once '../conexion.php';

// Obtener datos del formulario
$cuit_cuil = $_POST['cuit_cuil'];
$historial_legajo = $_POST['historial_legajo'];
$proveedor_auxiliar = $_POST['proveedor_auxiliar'];


// Consulta SQL para insertar datos
$sql = "INSERT INTO legajo (cuit_cuil, historial_legajo, proveedor_auxiliar) VALUES ('$cuit_cuil', '$historial_legajo', '$proveedor_auxiliar')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo legajo agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: legajo.php");
exit();
?>
