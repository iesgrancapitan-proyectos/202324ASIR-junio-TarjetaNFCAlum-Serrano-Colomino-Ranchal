<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "proyectonfc";
$password = "Root1234$";
$dbname = "grancapitan";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los códigos
$sql = "SELECT nombre FROM productos ORDER BY codigo";
$result = $conn->query($sql);

$nombres = [];
if ($result->num_rows > 0) {
    // Obtener todos los códigos
    while($row = $result->fetch_assoc()) {
        $nombres[] = $row["nombre"];
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>