<?php
//echo "hola mundo";
include("./conexion.php");

/**0
* Metodo  Ruta
  GET     /permiso   Obtener permiso  o no para ir al aseo
*/

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

#Variable para respuesta.
$response['status_code_header']='HTTP/1.1 404 Not Found';
$response['body']=null;

#Metodo usado
$requestMethod = $_SERVER['REQUEST_METHOD'];

#Parsear direccion de entrada
#$request =parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH);
#var_dump($request);
#$uri = explode('/',$request);
#if(isset($uri[2]))    {   }

$nie=$_GET['nie'];
$result= "NO";
$error= "";

switch ($requestMethod){
case 'GET':
    // CONSULTA1:  sacar el profesor_nombre a partir de su user
         $sqlpuntos = "SELECT puntos, nombre, apellido1, apellido2 from alumno where nie =" . $nie ;
         //$result = $sqlpuntos;
         $result=mysqli_query($conn, $sqlpuntos);
         $data=mysqli_fetch_array($result);
        if( mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $nombre=$row['nombre'];
            $puntos=$row['puntos'];
            $apellido1=$row['apellido1'];
            $apellido2=$row['apellido2'];
        }
        else {
           $result="no hay datos";
        }

break;
default:

;
}

//  CONTROLAR ERRORES  DE BBDD
$result=$data;
 $response['body']=json_encode($result);
 if ($error=="") {
          $response['status_code_header']='HTTP/1.1 200 OK';
   }


#Escribir la salida
header($response['status_code_header']);
if ($response['body']){
   echo $response['body'];
}

?>
