<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "consejo";
$table = "proveedores";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la tabla "proveedores"
$sql = "SELECT id_proveedor, nombre_proveedor, dni, dirección, telefono, tipo_servicio, observaciones_servicio, categoria_afip, cuit_cuil, mail FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la tabla Proveedores</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Datos de la tabla: Proveedores</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id Proveedor</th>
                    <th>Nombre Proveedor</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Tipo Servicio</th>
                    <th>Observaciones Servicio</th>
                    <th>Categoría AFIP</th>
                    <th>CUIT/CUIL</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id_proveedor"]; ?></td>
                            <td><?php echo $row["nombre_proveedor"]; ?></td>
                            <td><?php echo $row["dni"]; ?></td>
                            <td><?php echo $row["dirección"]; ?></td>
                            <td><?php echo $row["telefono"]; ?></td>
                            <td><?php echo $row["tipo_servicio"]; ?></td>
                            <td><?php echo $row["observaciones_servicio"]; ?></td>
                            <td><?php echo $row["categoria_afip"]; ?></td>
                            <td><?php echo $row["cuit_cuil"]; ?></td>
                            <td><?php echo $row["mail"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="10">No se encontraron datos en la tabla.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
