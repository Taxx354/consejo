<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ejecutar la consulta
$sql = "SELECT cuit_cuil, nombre_proveedor AS nombre FROM proveedores UNION SELECT cuit_cuil, nombre_auxiliar AS nombre FROM auxiliares";
$result = $conn->query($sql);

// Crear un array para almacenar los resultados
$options = array();

if ($result->num_rows > 0) {
    // Almacenar los datos en el array
    while($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Enviar los datos al frontend en formato JSON
echo json_encode($options);
?>
