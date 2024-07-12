<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <title>Proveedores</title>
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
        .navbar {
    margin-bottom: 20px;
}
.navbar-nav .nav-link {
    padding: 10px 15px;
    font-size: 16px;
}
nav {
    background-color: #eee;
    padding: 1em;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-around;
}

nav a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

section {
    padding: 2em;
}

footer {
    background-color: rgba(51, 51, 51, 0.9);
    color: #fff;
    text-align: center;
    padding: 1em;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 0;
}
    </style>

</head>
<body>
    <div class="container">
                <!-- Barra de navegación -->
                <nav>
        <ul>
            <li><a href="../index.php">Volver a inicio</a></li>
            <li><em>Proveedores</em></a></li>
            <li><a href="../escuela/escuela.php">Escuelas</a></li>
            <li><a href="../legajo/legajo.php">Legajos</a></li>
            <li><a href="../auxiliar/auxiliar.php">Auxiliares</a></li>
            <li><a href="../documento/documento.php">Documentos</a></li>
        </ul>
        </nav>
        <h1 class="mt-5">Lista de proveedores</h1>
        <h3>Buscar por nombre o DNI del proveedor:</h3>
        <br>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Buscar por DNI" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
            <input type="submit" value="Buscar">
            <input type="button" value="Reiniciar" onclick="window.location.href='?';" style="padding: 1px 16px; margin-left: 5px;">
            </form>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Proveedor</th>
                    <th>Nombre proveedor</th>
                    <th>DNI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Tipo de servicio</th>
                    <th>Observaciones servicio</th>
                    <th>Categoría AFIP</th>
                    <th>Cuit / Cuil</th>
                    <th>Email</th>
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
                $sql = "SELECT id_proveedor, nombre_proveedor, dni, direccion, telefono, tipo_servicio, observaciones_servicio, categoria_afip, cuit_cuil, mail FROM proveedor"; // Asegúrate de que la tabla se llama 'proveedor' y tiene estas columnas
                $result = $conn->query($sql);

                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                $sql = "SELECT * FROM proveedor WHERE nombre_proveedor or dni LIKE '%$search%'";
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
                            echo "<td>" . $row["id_proveedor"] . "</td>";
                            echo "<td>" . $row["nombre_proveedor"] . "</td>";
                            echo "<td>" . $row["dni"] . "</td>";
                            echo "<td>" . $row["direccion"] . "</td>";
                            echo "<td>" . $row["telefono"] . "</td>";
                            echo "<td>" . $row["tipo_servicio"] . "</td>";
                            echo "<td>" . $row["observaciones_servicio"] . "</td>";
                            echo "<td>" . $row["categoria_afip"] . "</td>";
                            echo "<td>" . $row["cuit_cuil"] . "</td>";
                            echo "<td>" . $row["mail"] . "</td>";
                            echo "<td>";
                            echo "<a href='eliminar_proveedor.php?id=" . $row["id_proveedor"] . "' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a> ";
                            echo "<a href='editar_proveedor.php?id=" . $row["id_proveedor"] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
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

        <!-- Formulario para agregar nuevo proveedor -->
        <h2>Agregar Nuevo proveedor</h2>
        <form method="post" action="insertar_proveedor.php">
            <div class="mb-3">
                <label for="nombre_proveedor" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="tipo_servicio" class="form-label">Tipo de servicio</label>
                <input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" required>
            </div>
            <div class="mb-3">
                <label for="observaciones_servicio" class="form-label">Observaciones de servicio</label>
                <input type="text" class="form-control" id="observaciones_servicio" name="observaciones_servicio" required>
            </div>
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
            <div class="mb-3">
                <label for="cuit_cuil" class="form-label">Cuit / Cuil</label>
                <input type="text" class="form-control" id="cuit_cuil" name="cuit_cuil" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>
