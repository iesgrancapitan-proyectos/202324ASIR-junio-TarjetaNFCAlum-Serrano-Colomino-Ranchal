<?php
session_start();
$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$dbname = "grancapitan";
$port = 3306;

$conexion = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conexion) {
    die("Conexi  n fallida: " . mysqli_connect_error());
}

if (!isset($_SESSION['user']['email'])) {
    die("Por favor, inicie sesi  n con un usuario.");
}

$correo = mysqli_real_escape_string($conexion, $_SESSION['user']['email']);

$consulta = "SELECT idTarjeta FROM usuarios_tarjetas JOIN usuarios ON usuarios_tarjetas.idUsuario=usuarios.idUsuario WHERE usuarios.email='$correo';";
$result = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $idTarjeta = $row['idTarjeta'];
} else {
    die("User not found.");
}
?>
