<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["redireccion"])) {
    $url = $_POST["redireccion"];
    header("Location: $url");
    exit();
}
?>