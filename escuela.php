<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escuelas</title>
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
    <h1>Lista de Escuelas</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre Escuela</th>
                <th>Tipo Escuela</th>
                <th>Nro Escuela</th>
                <th>Director</th>
                <th>Vicedirector</th>
                <th>Dirección</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Fundación</th>
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
            $sql = "SELECT nombre_escuela, tipo_escuela, nro_escuela, director, vicedirector, direccion_escuela, cel_escuela, email_escuela, fundacion_escuela FROM escuela";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar datos por cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre_escuela"] . "</td>";
                    echo "<td>" . $row["tipo_escuela"] . "</td>";
                    echo "<td>" . $row["nro_escuela"] . "</td>";
                    echo "<td>" . $row["director"] . "</td>";
                    echo "<td>" . $row["vicedirector"] . "</td>";
                    echo "<td>" . $row["direccion_escuela"] . "</td>";
                    echo "<td>" . $row["cel_escuela"] . "</td>";
                    echo "<td>" . $row["email_escuela"] . "</td>";
                    echo "<td>" . $row["fundacion_escuela"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay datos disponibles</td></tr>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
