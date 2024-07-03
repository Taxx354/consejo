<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--  Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <title>Auxiliares</title>
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
       <script>
        function validateForm() {
            var redireccion = document.forms["redireccionForm"]["redireccion"].value;
            if (redireccion == "") {
                alert("Por favor, seleccione una redirección.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de auxiliares</h1>
        <h3>Selecciona una redirección:</h3>
        <form name="redireccionForm" action="../redireccionar.php" method="post" onsubmit="return validateForm()">
            <select name="redireccion">
                <option value="">Seleccione una redirección</option>
                <option value="escuela/escuela.php">Escuelas</option>
                <option value="documento/documento.php">Documentos</option>
                <option value="legajo/legajo.php">Legajos</option>
                <option value="proveedores/proveedores.php">Proveedores</option>
            </select>
            <br><br>
            <input type="submit" value="Redireccionar">
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID auxiliar</th>
                    <th>Nombre auxiliar</th>
                    <th>DNI</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Observaciones del cargo</th>
                    <th>Categoria AFIP</th>
                    <th>Cuit / Cuil</th>
                    <th>Mail</th>
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
                $sql = "SELECT id_auxiliar, nombre_auxiliar, dni_auxiliar, direccion_auxiliar, telefono_auxiliar, cargo_auxiliar, observaciones_cargo, categoria_afip, cuit_cuil, mail_auxiliar FROM auxiliar";
                $result = $conn->query($sql);

                // Verificar si la consulta fue exitosa
                if ($result === false) {
                    echo "<tr><td colspan='11'>Error en la consulta: " . $conn->error . "</td></tr>";
                } else {
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar datos por cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id_auxiliar"] . "</td>";
                            echo "<td>" . $row["nombre_auxiliar"] . "</td>";
                            echo "<td>" . $row["dni_auxiliar"] . "</td>";
                            echo "<td>" . $row["direccion_auxiliar"] . "</td>";
                            echo "<td>" . $row["telefono_auxiliar"] . "</td>";
                            echo "<td>" . $row["cargo_auxiliar"] . "</td>";
                            echo "<td>" . $row["observaciones_cargo"] . "</td>";
                            echo "<td>" . $row["categoria_afip"] . "</td>";
                            echo "<td>" . $row["cuit_cuil"] . "</td>";
                            echo "<td>" . $row["mail_auxiliar"] . "</td>";
                            echo "<td>";
                            echo "<a href='eliminar_auxiliar.php?id=" . $row["id_auxiliar"] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> ";
                            echo "<a href='editar_auxiliar.php?id=" . $row["id_auxiliar"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                            
                        }
                    } else {
                        echo "<tr><td colspan='11'>No hay datos disponibles</td></tr>";
                    }
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevo auxiliar -->
        <h2>Agregar Nuevo auxiliar</h2>
        <form method="post" action="insertar_auxiliar.php">
            <div class="mb-3">
                <label for="nombre_auxiliar" class="form-label">Nombre completo:</label>
                <br>
                <input type="text" class="form-control" id="nombre_auxiliar" name="nombre_auxiliar" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="dni_auxiliar" class="form-label">DNI:</label>
                <br>
                <input type="text" class="form-control" id="dni_auxiliar" name="dni_auxiliar" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="direccion_auxiliar" class="form-label">Dirección:</label>
                <br>
                <input type="text" class="form-control" id="direccion_auxiliar" name="direccion_auxiliar" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="telefono_auxiliar" class="form-label">Teléfono:</label>
                <br>
                <input type="text" class="form-control" id="telefono_auxiliar" name="telefono_auxiliar" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="cargo_auxiliar" class="form-label">Cargo:</label>
                <br>
                <input type="text" class="form-control" id="cargo_auxiliar" name="cargo_auxiliar" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="observaciones_cargo" class="form-label">Observaciones del cargo:</label>
                <br>
                <input type="text" class="form-control" id="observaciones_cargo" name="observaciones_cargo" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="categoria_afip" class="form-label">Categoría AFIP</label>
                <select class="form-control" id="categoria_afip" name="categoria_afip" required>
                    <option value="">Seleccione categoría</option>
                    <option value="Monotributo">Monotributo</option>
                    <option value="Autónomo">Autónomo</option>
                    <option value="Responsable Inscripto">Responsable Inscripto</option>
                    <option value="IVA Exento">IVA Exento</option>
                </select>
            </div>
            <br>
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <br>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="mail_auxiliar" class="form-label">Mail</label>
                <br>
                <input type="email" class="form-control" id="mail_auxiliar" name="mail_auxiliar" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
