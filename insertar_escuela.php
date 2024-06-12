<?php
// Datos de conexión
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre_escuela = $_GET['nombre_escuela'];
$tipo_escuela = $_GET['tipo_escuela'];
$nro_escuela = $_GET['nro_escuela'];
$director = $_GET['director'];
$vicedirector = $_GET['vicedirector'];
$direccion_escuela = $_GET['direccion_escuela'];
$cel_escuela = $_GET['cel_escuela'];
$email_escuela = $_GET['email_escuela'];
$fundacion_escuela = $_GET['fundacion_escuela'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO escuela (nombre_escuela, tipo_escuela, nro_escuela, director, vicedirector, direccion_escuela, cel_escuela, email_escuela, fundacion_escuela)
VALUES ('$nombre_escuela', '$tipo_escuela', '$nro_escuela', '$director', '$vicedirector', '$direccion_escuela', '$cel_escuela', '$email_escuela', '$fundacion_escuela')";

if ($conn->query($sql) === TRUE) {
    echo "Nueva escuela agregada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: escuela.php");
exit();
?>
