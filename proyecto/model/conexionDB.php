<?php

class conexiondb
{
    public function initConex()
    {
        $servername = "localhost";
        $username = "proyectonfc";
        $password = "Root1234$";
        $bd = "grancapitan";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $bd);
        $conn->set_charset("utf8");
        // Check connection
        if ($conn->connect_error) {
            die("Conexion falla " . $conn->connect_error);
        }
        return $conn;
    }
}
