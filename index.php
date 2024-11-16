<?php
session_start();
$con = mysqli_connect("localhost", "root", "2602", "halloween");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['disfraz_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $disfraz_id = (int)$_POST['disfraz_id'];

    $check_query = "SELECT * FROM votos WHERE id_usuario=$usuario_id AND id_disfraz=$disfraz_id";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) === 0) {
        $insert_vote = "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($usuario_id, $disfraz_id)";
        mysqli_query($con, $insert_vote);

        $update_votes = "UPDATE disfraces SET votos = votos + 1 WHERE id=$disfraz_id";
        mysqli_query($con, $update_votes);
    }
}

$query = "SELECT * FROM disfraces WHERE eliminado=0";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div>
        <h3>{$row['nombre']}</h3>
        <p>{$row['descripcion']}</p>
        <p>Votos: {$row['votos']}</p>
        <form method='post'>
            <input type='hidden' name='disfraz_id' value='{$row['id']}'>
            <button type='submit'>Votar</button>
        </form>
    </div>";
}
?>
