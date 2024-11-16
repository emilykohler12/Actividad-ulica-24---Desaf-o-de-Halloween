<?php
session_start();
$con = mysqli_connect("localhost", "root", "2602", "halloween");

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['clave'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = $_POST['clave'];

    $query = "SELECT * FROM usuarios WHERE nombre='$nombre'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            header("Location: index.php");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" value="Iniciar Sesión">
</form>
