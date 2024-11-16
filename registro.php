<?php
$con = mysqli_connect("localhost", "root", "", "halloween");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['clave'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    $query = "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave')";
    if (mysqli_query($con, $query)) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" value="Registrarse">
</form>
