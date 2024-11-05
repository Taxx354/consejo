<?php
        // Conexión
        require_once '../conexion.php';

// Función para limpiar y validar datos
function validarDatos($datos) {
    // Limpia espacios en blanco y caracteres especiales
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

// Obtener datos del formulario y validarlos
$id_esc = validarDatos($_POST['id_esc']);
$fecha = validarDatos($_POST['fecha']);
$titulo = validarDatos($_POST['titulo']);
$link = validarDatos($_POST['link']);
$cuit_cuil = validarDatos($_POST['cuit_cuil']);
$tipo_servicio = validarDatos($_POST['tipo_servicio']);
$estado = validarDatos($_POST['estado']);
$expediente = validarDatos($_POST['expediente']);

// Manejo del archivo cargado (historial_legajo)
$target_dir = "uploads/"; // Directorio donde se guardarán los archivos cargados
$target_file = $target_dir . basename($_FILES["historial_legajo"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real o un archivo falso
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["historial_legajo"]["tmp_name"]);
    if ($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 0;
    } else {
        $uploadOk = 1;
    }
}

// Verificar si el archivo ya existe
if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}

// Verificar tamaño del archivo (500KB)
if ($_FILES["historial_legajo"]["size"] > 500000) {
    echo "Lo siento, su archivo es demasiado grande.";
    $uploadOk = 0;
}

// Permitir solo ciertos formatos de archivo (PDF, DOC, DOCX)
if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
    echo "Lo siento, solo se permiten archivos PDF, DOC y DOCX.";
    $uploadOk = 0;
}

// Verificar si $uploadOk está configurado en 0 por un error
if ($uploadOk == 0) {
    echo "Lo siento, su archivo no fue cargado.";

// Si todo está bien, intenta subir el archivo
} else {
    if (move_uploaded_file($_FILES["historial_legajo"]["tmp_name"], $target_file)) {
        echo "El archivo " . htmlspecialchars(basename($_FILES["historial_legajo"]["name"])) . " ha sido cargado correctamente.";
    } else {
        echo "Lo siento, hubo un error al cargar su archivo.";
    }
}

 // Obtener datos del formulario
 // $searchType = $_POST['search_type'];
 // $search = $_POST['search'];
//  $driveFileId = $_POST['drive_file_id'];
 

// Consulta SQL para insertar datos en la tabla documentos
$stmt = $conn->prepare("INSERT INTO documentos (id_documento, id_esc, fecha, titulo, link, cuit_cuil, tipo_servicio, estado, expediente, historial_legajo) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssss", $id_esc, $fecha, $titulo, $target_file, $cuit_cuil, $tipo_servicio, $estado, $expediente, $historial_legajo); 

if ($stmt->execute()) {
    echo "Nuevo documento agregado correctamente";
} else {
    echo "Error al insertar documento: " . $stmt->error;
}
$stmt = $conn->prepare($sql);

/* $stmt->bind_param("sss", $searchType, $search, $driveFileId);
if ($stmt->execute()) {
    echo "Datos guardados correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} */

// Cerrar conexión a la base de datos
$stmt->close();
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: documento.php");
exit();
?>

