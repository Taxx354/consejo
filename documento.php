<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";
$table = "documento";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla "documento"
$sql = "SELECT id_documento, id_escuela, detalle_documento, url_documento FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Documentos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Documentos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Documento</th>
                    <th>ID Escuela</th>
                    <th>Detalle</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id_documento"]; ?></td>
                            <td><?php echo $row["id_escuela"]; ?></td>
                            <td><?php echo $row["detalle_documento"]; ?></td>
                            <td><a href="<?php echo $row["url_documento"]; ?>"><?php echo $row["url_documento"]; ?></a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No se encontraron datos en la tabla.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
