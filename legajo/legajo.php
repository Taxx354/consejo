<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Legajos</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Legajos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Legajo</th>
                    <th>Cuit / Cuil</th>
                    <th>Documentos Legajo</th>
                </tr>
            </thead>
            <tbody>
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

                // Consulta SQL
                $sql = "SELECT id_legajo, cuit_cuil, historial_legajo FROM legajo"; // Asegúrate de que la tabla se llama 'legajo' y tiene estas columnas
                $result = $conn->query($sql);

                // Verificar si la consulta fue exitosa
                if ($result === false) {
                    echo "<tr><td colspan='3'>Error en la consulta: " . $conn->error . "</td></tr>";
                } else {
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar datos por cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_legajo"] . "</td>";
                            echo "<td>" . $row["cuit_cuil"] . "</td>";
                            echo "<td>" . $row["historial_legajo"] . "</td>";
                            echo "<td><a href='eliminar_legajo.php?id=" . $row["id_legajo"] . "' class='btn btn-danger'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay datos disponibles</td></tr>";
                    }
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo legajo -->
        <h2>Agregar Nuevo Legajo</h2>
        <form method="post" action="insertar_legajo.php">
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" required>
            </div>
            <div class="mb-3">
                <label for="historial_legajo" class="form-label">Documento Legajo</label>
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
