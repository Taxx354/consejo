<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escuelas</title>
    <link rel="stylesheet" href="../estilo.css">
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
        <h1 class="mt-5">Lista de Escuelas</h1>
        <h3>Selecciona una redireccion:</h3>
    <form action="../redireccionar.php" method="post">
        <select name="redireccion">
            <option value="documento/documento.php">Documentos</option>
            <option value="auxiliar/auxiliar.php">Auxiliares</option>
            <option value="proveedores/proveedores.php">Proveedores</option>
            <option value="legajo/legajo.php">Legajos</option>

        </select>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Escuela</th>
                    <th>Nombre Escuela</th>
                    <th>Dirección</th>
                    <th>Director</th>
                    <th>Vicedirector</th>
                    <th>Teléfono Director</th>
                    <th>Teléfono Escuela</th>
                    <th>Rama Escuela</th>
                    <th>Número Escuela</th>
                    <th>Cantidad Alumnos</th>
                    <th>Fecha Fundación</th>
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
                $sql = "SELECT id_esc, nombre_escuela, direccion_escuela, director, vicedirector, telefono_director, telefono_escuela, rama_escuela, numero_escuela, cantidad_alumnos, fecha_fundacion FROM escuela";
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Mostrar datos por cada fila
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_esc"] . "</td>";
                        echo "<td>" . $row["nombre_escuela"] . "</td>";
                        echo "<td>" . $row["direccion_escuela"] . "</td>";
                        echo "<td>" . $row["director"] . "</td>";
                        echo "<td>" . $row["vicedirector"] . "</td>";
                        echo "<td>" . $row["telefono_director"] . "</td>";
                        echo "<td>" . $row["telefono_escuela"] . "</td>";
                        echo "<td>" . $row["rama_escuela"] . "</td>";
                        echo "<td>" . $row["numero_escuela"] . "</td>";
                        echo "<td>" . $row["cantidad_alumnos"] . "</td>";
                        echo "<td>" . $row["fecha_fundacion"] . "</td>";
                        echo "<td><a href='eliminar_escuela.php?id=" . $row["id_esc"] . "' class='btn btn-danger'>Eliminar</a></td>";
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

        <!-- Formulario para agregar nueva escuela -->
        <h2>Agregar Nueva Escuela</h2>
        <form method="post" action="insertar_escuela.php">
            <div class="mb-3">
                <label for="nombre_escuela" class="form-label">Nombre Escuela</label>
                <input type="text" class="form-control" id="nombre_escuela" name="nombre_escuela" required>
            </div>
            <div class="mb-3">
                <label for="direccion_escuela" class="form-label">Dirección Escuela</label>
                <input type="text" class="form-control" id="direccion_escuela" name="direccion_escuela" required>
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
                <label for="telefono_director" class="form-label">Teléfono Director</label>
                <input type="text" class="form-control" id="telefono_director" name="telefono_director" required>
            </div>
            <div class="mb-3">
                <label for="telefono_escuela" class="form-label">Teléfono Escuela</label>
                <input type="text" class="form-control" id="telefono_escuela" name="telefono_escuela" required>
            </div>
            <div class="mb-3">
                <label for="rama_escuela" class="form-label">Rama Escuela</label>
                <input type="text" class="form-control" id="rama_escuela" name="rama_escuela" required>
            </div>
            <div class="mb-3">
                <label for="numero_escuela" class="form-label">Número Escuela</label>
                <input type="text" class="form-control" id="numero_escuela" name="numero_escuela" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_alumnos" class="form-label">Cantidad Alumnos</label>
                <input type="text" class="form-control" id="cantidad_alumnos" name="cantidad_alumnos" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fundacion" class="form-label">Fecha Fundación</label>
                <input type="date" class="form-control" id="fecha_fundacion" name="fecha_fundacion" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
