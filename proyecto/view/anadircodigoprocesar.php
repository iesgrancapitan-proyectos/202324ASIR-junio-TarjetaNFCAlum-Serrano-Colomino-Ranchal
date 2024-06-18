<?php
$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$database = "grancapitan";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

$precio = $conn->real_escape_string($_POST['precio']);
$codigo = $conn->real_escape_string($_POST['codigo']);
$nombre = $conn->real_escape_string($_POST['nombre']);

// Verificar si el código ya existe
$check_sql = "SELECT codigo FROM productos WHERE codigo = '$codigo'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // El código ya existe, mostrar error
    $result = false;
} else {
    // Preparar y ejecutar la consulta SQL de inserción
    $sql = "INSERT INTO productos (precio, codigo, nombre) VALUES ('$precio', '$codigo', '$nombre')";
    $result = $conn->query($sql);
}

$conn->close();
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
            margin-top: 180px;
        }
        p {
            font-size: 24px;
            margin: 20px 0;
        }
        p a{
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
        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
        .ejemplo {
            width: 461px;
            height: 416px;
        }
    </style>
</head>
<body>
    <?php
    include('function-SendMail.php');
    ?>
    <div class="container">
    <h1>Resultado de la operación</h1>
    <?php if ($result !== false): ?>
    <img class="logo" src="https://uploads-ssl.webflow.com/648b77b4e12febfb254f0f1f/64ac2a8b4c6e50de8296c0ad_Check%201%20Big.png" alt="Imagen de verificación">
    <p class="success">Código agregado exitosamente</p>
    <p>Ahora genere el código de barras <?php echo $precio ?> en el siguiente <a target="_blank" href="https://orcascan.com/tools/free-barcode-generator/code-128">enlace</a></p>
    <p>Ejemplo de creación del código:</p>
    <img class="ejemplo" src="ejemplo.png" alt="Ejemplo">
    <br>
    <a href="takeawaysecretario.php">Regresar al inicio</a>
<?php else: ?>
    <p class="error">Error: Ya existe el código</p>
    <a href="takeawaysecretario.php">Regresar al inicio</a>
<?php endif; ?>
    </div>
</body>
</html>