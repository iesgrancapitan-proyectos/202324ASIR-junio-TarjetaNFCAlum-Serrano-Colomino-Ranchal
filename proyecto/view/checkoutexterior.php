<?php
$numeroTarjeta = $_GET['numeroTarjeta'];
?>

<?php
session_start();

$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$dbname = "grancapitan";
$port = 3306;

// Establecer conexión
$conexion = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar información del usuario
$sql = "SELECT * FROM usuarios JOIN usuarios_tarjetas ON usuarios.idUsuario=usuarios_tarjetas.idUsuario WHERE usuarios_tarjetas.idTarjeta='$numeroTarjeta'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['idUsuario'];
} else {
    die("Usuario no encontrado.");
}

// Consultar productos en el carrito
$sql = "SELECT productos.precio, carro.cantidad FROM carro
        JOIN productos ON carro.idProducto=productos.idProducto
        WHERE carro.idUsuario='$user_id'";
$carro_productos = $conexion->query($sql);

$total = 0;
while ($item = $carro_productos->fetch_assoc()) {
    $total += $item['precio'] * $item['cantidad'];
}

// Convertir saldo y total a euros
$saldo_euros = $user['saldo'] / 100;
$total_euros = $total / 100;

// Verificar saldo del usuario y procesar la compra
if ($saldo_euros >= $total_euros) {
    $new_saldo = $user['saldo'] - $total;

    // Actualizar saldo del usuario
    $sql = "UPDATE usuarios SET saldo='$new_saldo' WHERE idUsuario='$user_id'";
    if ($conexion->query($sql) === TRUE) {
        // Eliminar productos del carrito
        $sql = "DELETE FROM carro WHERE idUsuario='$user_id'";
        if ($conexion->query($sql) === TRUE) {
            $message = "Compra realizada con éxito. Nuevo saldo: " . htmlspecialchars(number_format($new_saldo / 100, 2)) . " €";
        } else {
            $message = "Error al vaciar el carrito: " . $conexion->error;
        }
    } else {
        $message = "Error al actualizar el saldo: " . $conexion->error;
    }
} else {
    $message = "Saldo insuficiente. Saldo actual: " . htmlspecialchars(number_format($saldo_euros, 2)) . " €";
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 800px;
            width: 80%;
        }
        h1 {
            font-size: 36px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        p {
            font-size: 24px;
            margin: 20px 0;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #F44336;
        }
        a {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            color: #2196F3;
            font-weight: bold;
            font-size: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
        img {
            max-width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://uploads-ssl.webflow.com/648b77b4e12febfb254f0f1f/64ac2a8b4c6e50de8296c0ad_Check%201%20Big.png" alt="Imagen de verificación">
        <h1>Resultado de la Compra</h1>
        <p class="<?php echo ($saldo_euros >= $total_euros) ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
        <?php if ($saldo_euros >= $total_euros) { ?>
            <p class="success"><?php echo $new_saldo_message; ?></p>
        <?php } else { ?>
            <p class="error"><?php echo $new_saldo_message; ?></p>
        <?php } ?>
        <a href="indextienda.php">Volver al inicio</a>
    </div>
</body>
</html>