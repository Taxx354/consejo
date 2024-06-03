<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";
$table = "obra";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla "obra"
$sql = "SELECT id_obra, id_escuela, tipo_obra, estado_obra, fechainicio_obra, id_proveedor FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Obras</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Obras</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Obra</th>
                    <th>ID Escuela</th>
                    <th>Tipo de Obra</th>
                    <th>Estado de Obra</th>
                    <th>Fecha de Inicio</th>
                    <th>ID Proveedor</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id_obra"]; ?></td>
                            <td><?php echo $row["id_escuela"]; ?></td>
                            <td><?php echo $row["tipo_obra"]; ?></td>
                            <td><?php echo $row["estado_obra"]; ?></td>
                            <td><?php echo $row["fechainicio_obra"]; ?></td>
                            <td><?php echo $row["id_proveedor"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No se encontraron datos en la tabla.</td></tr>
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
