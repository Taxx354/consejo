<?php
// Verificar si se ha enviado un ID válido por POST

if (!isset($_POST['id_esc']) || empty($_POST['id_esc'])) {
    die("ID de escuela no válido");
}

$id_esc = $_POST['id_esc'];
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

// Consulta SQL para obtener los datos de la escuela por ID
$sql = "SELECT * FROM escuela WHERE id_esc = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_esc);
$stmt->execute();
$result = $stmt->get_result();
// Verificar si se encontró la escuela
if ($result->num_rows > 0) {
    $id_esc = $_POST['id_esc'];
$nombre_escuela = $_POST['nombre_escuela'];
$direccion_escuela = $_POST['direccion_escuela'];
$director = $_POST['director'];
$vicedirector = $_POST['vicedirector'];
$telefono_director = $_POST['telefono_director'];
$telefono_escuela = $_POST['telefono_escuela'];
$mail_escuela = $_POST['mail_escuela'];
$rama_escuela = $_POST['rama_escuela'];
$numero_escuela = $_POST['numero_escuela'];
$cantidad_alumnos = $_POST['cantidad_alumnos'];
$fecha_fundacion = $_POST['fecha_fundacion'];
}
// Consulta SQL para actualizar la escuela
$sql = "UPDATE escuela SET 
        nombre_escuela = '$nombre_escuela',
        direccion_escuela = '$direccion_escuela',
        director = '$director',
        vicedirector = '$vicedirector',
        telefono_director = '$telefono_director',
        telefono_escuela = '$telefono_escuela',
        mail_escuela = '$mail_escuela',
        rama_escuela = '$rama_escuela',
        numero_escuela = '$numero_escuela',
        cantidad_alumnos = '$cantidad_alumnos',
        fecha_fundacion = '$fecha_fundacion'
        WHERE id_esc = $id_esc";

if ($conn->query($sql) === TRUE) {
    echo "Escuela actualizada correctamente.";
    header("Location: escuela.php");
} else {
    echo "Error al actualizar la escuela: " . $conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
