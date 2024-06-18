<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmail($precio, $codigo, $nombre) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'enviacodigosiesgrancapitan@gmail.com';
        $mail->Password   = 'hjjj jldt eiwm nllf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Habilitar la depuración SMTP
        $mail->SMTPDebug  = 3; // 0 = off (para producción), 1 = mensajes del cliente, 2 = mensajes del cliente y servidor, 3 = mensajes detallados del cliente y servidor
        $mail->Debugoutput = 'html'; // Salida de depuración en formato HTML

        // Destinatarios
        $mail->setFrom('enviacodigosiesgrancapitan@gmail.com', 'Tu Nombre');
        $mail->addAddress('jranchal3@gmail.com', 'Destinatario');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo producto agregado';
        $mail->Body    = "Se ha agregado un nuevo producto:<br><br>Precio: <b>$precio</b><br>Código: <b>$codigo</b><br>Nombre: <b>$nombre</b>";
        $mail->AltBody = "Se ha agregado un nuevo producto:\n\nPrecio: $precio\nCódigo: $codigo\nNombre: $nombre";

        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
    }
}
?>