<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "halloween");

if ($_SESSION['nombre'] !== 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['descripcion'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    $archivo = $_FILES['foto']['name'];
    $extension = explode(".", $archivo);
    $foto = time() . "." . end($extension);

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        copy($_FILES['foto']['tmp_name'], "fotos/" . $foto);
        $query = "INSERT INTO disfraces (nombre, descripcion, votos, foto) VALUES ('$nombre', '$descripcion', 0, '$foto')";
        mysqli_query($con, $query);
    }
}
?>

<form method="post" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" required><br>
    Descripción: <textarea name="descripcion" required></textarea><br>
    Foto: <input type="file" name="foto" required><br>
    <input type="submit" value="Agregar Disfraz">
</form>
