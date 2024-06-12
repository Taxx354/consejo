<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escuelas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Escuelas</h1>
        <table class="table table-bordered">
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
                $sql = "SELECT id, nombre_escuela, tipo_escuela, nro_escuela, director, vicedirector, direccion_escuela, cel_escuela, email_escuela, fundacion_escuela FROM escuela";
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
                        echo "<td><a href='eliminar_escuela.php?id=" . $row["id"] . "' class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No hay datos disponibles</td></tr>";
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nueva escuela -->
        <h2>Agregar Nueva Escuela</h2>
        <form method="post" action="insertar_escuela.php">
            <div class="mb-3">
                <label for="nombre_escuela" class="form-label">Nombre Escuela</label>
                <input type="text" class="form-control" id="nombre_escuela" name="nombre_escuela" required>
            </div>
            <div class="mb-3">
                <label for="tipo_escuela" class="form-label">Tipo Escuela</label>
                <input type="text" class="form-control" id="tipo_escuela" name="tipo_escuela" required>
            </div>
            <div class="mb-3">
                <label for="nro_escuela" class="form-label">Nro Escuela</label>
                <input type="text" class="form-control" id="nro_escuela" name="nro_escuela" required>
            </div>
            <div class="mb-3">
                <label for="director" class="form-label">Director</label>
                <input type="text" class="form-control" id="director" name="director" required>
            </div>
            <div class="mb-3">
                <label for="vicedirector" class="form-label">Vicedirector</label>
                <input type="text" class="form-control" id="vicedirector" name="vicedirector" required>
            </div>
            <div class="mb-3">
                <label for="direccion_escuela" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion_escuela" name="direccion_escuela" required>
            </div>
            <div class="mb-3">
                <label for="cel_escuela" class="form-label">Celular</label>
                <input type="text" class="form-control" id="cel_escuela" name="cel_escuela" required>
            </div>
            <div class="mb-3">
                <label for="email_escuela" class="form-label">Email</label>
                <input type="email" class="form-control" id="email_escuela" name="email_escuela" required>
            </div>
            <div class="mb-3">
                <label for="fundacion_escuela" class="form-label">Fundación</label>
                <input type="text" class="form-control" id="fundacion_escuela" name="fundacion_escuela" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
