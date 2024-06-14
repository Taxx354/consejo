<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Documentos</title>
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
        <h1 class="mt-5">Lista de Documentos</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Escuela</th>
                    <th>Número Documento</th>
                    <th>Fecha</th>
                    <th>Título</th>
                    <th>Link</th>
                    <th>CUIT/CUIL Personal</th>
                    <th>Tipo Servicio</th>
                    <th>Estado</th>
                    <th>Expediente</th>
                    <th>Historial Legajo</th>
                    <th>Acciones</th>
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
                $sql = "SELECT id_documento, id_escuela, numero_documento, fecha, titulo, link, cuit_cuil_personal, tipo_servicio, estado, expediente, historial_legajo FROM documentos";
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Mostrar datos por cada fila
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_escuela"] . "</td>";
                        echo "<td>" . $row["numero_documento"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td><a href='" . $row["link"] . "'>Ver Documento</a></td>";
                        echo "<td>" . $row["cuit_cuil_personal"] . "</td>";
                        echo "<td>" . $row["tipo_servicio"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "<td>" . $row["expediente"] . "</td>";
                        echo "<td>" . $row["historial_legajo"] . "</td>";
                        echo "<td><a href='eliminar_documento.php?id=" . $row["id_documento"] . "' class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No hay datos disponibles</td></tr>";
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo documento -->
        <h2>Agregar Nuevo Documento</h2>
        <form method="post" action="insertar_documento.php">
            <div class="mb-3">
                <label for="id_escuela" class="form-label">ID Escuela</label>
                <input type="text" class="form-control" id="id_escuela" name="id_escuela" required>
            </div>
            <div class="mb-3">
                <label for="numero_documento" class="form-label">Número Documento</label>
                <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="url" class="form-control" id="link" name="link" required>
            </div>
            <div class="mb-3">
                <label for="cuit_cuil_personal" class="form-label">CUIT/CUIL Personal</label>
                <input type="text" class="form-control" id="cuit_cuil_personal" name="cuit_cuil_personal" required>
            </div>
            <div class="mb-3">
                <label for="tipo_servicio" class="form-label">Tipo Servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>
            <div class="mb-3">
                <label for="expediente" class="form-label">Expediente</label>
                <input type="text" class="form-control" id="expediente" name="expediente" required>
            </div>
            <div class="mb-3">
                <label for="historial_legajo" class="form-label">Historial Legajo</label>
                <input type="text" class="form-control" id="historial_legajo" name="historial_legajo" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
