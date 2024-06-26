<?php
// Verificar si se enviaron los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron todos los datos necesarios
    if (isset($_POST['id_legajo']) && isset($_POST['cuit_cuil']) && isset($_POST['historial_legajo'])) {
        $id_legajo = $_POST['id_legajo'];
        $cuit_cuil = $_POST['cuit_cuil'];
        $historial_legajo = $_POST['historial_legajo'];

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

        // Preparar la consulta SQL para actualizar el legajo
        $sql = "UPDATE legajo SET cuit_cuil='$cuit_cuil', historial_legajo='$historial_legajo' WHERE id_legajo=$id_legajo";

        // Ejecutar la consulta y verificar si fue exitosa
        if ($conn->query($sql) === TRUE) {
            // Redireccionar a legajo.php después de actualizar
            header("Location: legajo.php");
            exit(); // Asegurar que se detiene la ejecución después de la redirección
        } else {
            echo "Error al actualizar el legajo: " . $conn->error;
        }

        // Cerrar conexión
        $conn->close();
    } else {
        echo "No se recibieron todos los datos necesarios para actualizar el legajo";
    }
} else {
    echo "Acceso no autorizado";
}
?>
