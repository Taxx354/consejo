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
$nombre_escuela = $_POST['nombre_escuela'];
$direccion_escuela = $_POST['direccion_escuela'];
$director = $_POST['director'];
$vicedirector = $_POST['vicedirector'];
$telefono_director = $_POST['telefono_director'];
$telefono_escuela = $_POST['telefono_escuela'];
$rama_escuela = $_POST['rama_escuela'];
$numero_escuela = $_POST['numero_escuela'];
$cantidad_alumnos = $_POST['cantidad_alumnos'];
$fecha_fundacion = $_POST['fecha_fundacion'];

// Consulta SQL para insertar datos
$sql = "INSERT INTO escuela (nombre_escuela, direccion_escuela, director, vicedirector, telefono_director, telefono_escuela, rama_escuela, numero_escuela, cantidad_alumnos, fecha_fundacion)
VALUES ('$nombre_escuela', '$direccion_escuela', '$director', '$vicedirector', '$telefono_director', '$telefono_escuela', '$rama_escuela', '$numero_escuela', '$cantidad_alumnos', '$fecha_fundacion')";

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
