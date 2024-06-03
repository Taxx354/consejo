<?php
$servername = "192.168.100.143";
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
$sql = "SELECT * FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la tabla Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos de la tabla: Proveedores</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <?php
                        // Mostrar encabezados de columnas
                        while ($fieldinfo = $result->fetch_field()) {
                            echo "<th>{$fieldinfo->name}</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar datos de las filas
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $cell) {
                            echo "<td>{$cell}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron datos en la tabla.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</body>
</html>
