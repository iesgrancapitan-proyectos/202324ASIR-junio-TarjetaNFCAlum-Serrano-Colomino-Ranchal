// Ejemplo llamada a SendMail()

require "modulos.php";

			$EmailTo = array();
			echo $nombre;
			echo $email;
			$EmailTo[] = [$nombre, $email];
			// SendMail( $ToEmail, $Subject, $MessageHTML, $MessageTEXT )
			$Send = SendMail( $EmailTo, "Nuevo codigo de etiqueta generado ", $text, $text );	
			if ( $Send ) {	
		
			    echo "<error>0</error>
	      			  <mensaje>Se ha enviado un email a la dirección ".$row[0].". Revisa tu bandeja de correo electrónico.</mensaje>";
            }
			else  {
				echo "<error>2</error>
	            	  <mensaje>Ocurrió un error al tratar de enviar un correo-e para el cambio de contraseña. Inténtalo de nuevo más tarde.</mensaje>";
        