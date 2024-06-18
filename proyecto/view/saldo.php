<html>
<head>
<style>
body {
text-align: center;
}
</style>
</head>
<body>
<h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario <?php echo $_SESSION['user']['email'];?></h5>
<?php
$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$dbname = "grancapitan";
$port = 3306;

$conexion = mysqli_connect($servername, $username, $password, $dbname, $port);

// Verifica la conexion
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Obtiene el ID de tarjeta del formulario
$correo = mysqli_real_escape_string($conexion, $_SESSION['user']['email']);

// Consulta la base de datos para obtener el saldo de la tarjeta
$sql = "SELECT saldo FROM usuarios WHERE email = '$correo';";
$result = mysqli_query($conexion, $sql);

// Muestra el saldo de la tarjeta
if (mysqli_num_rows($result) > 0) {
    // Obtiene el saldo de la tarjeta
    $row = mysqli_fetch_assoc($result);
    $saldo = $row['saldo'];

    // Muestra el saldo de la tarjeta
    echo "El saldo de tu tarjeta es: $saldo Capitan Money";
} else {
    echo "No se ha encontrado ninguna tarjeta con ese ID.";
}

// Cierra la conexion
mysqli_close($conexion);
?>

<div class="mt-3">
        <a class='btn btn-primary' href='index.php'>Inicio</a>
</div>
</body>
</html>
