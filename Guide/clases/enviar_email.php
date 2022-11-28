<?php 
	use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

	require '../phpmailer/src/PHPMailer.php';
	require '../phpmailer/src/SMTP.php';
	require '../phpmailer/src/Exception.php';

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  //SMTP::DEBUG_OFF;                    //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'milher.poma@gmail.com';                     //SMTP username
	    $mail->Password   = 'zhgtedxsywygdkxx';                               //SMTP password
	    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
	    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('milher.poma@gmail.com', 'Tienda Urbana');
	    $mail->addAddress('u2usery2@gmail.com');     //Add a recipient
	    #$mail->addAddress('ellen@example.com');               //Name is optional
	    #$mail->addReplyTo('milher.poma@gmail.com', 'Information');
	    #$mail->addCC('cc@example.com');
	    #$mail->addBCC('bcc@example.com');

	    //Attachments
	    #$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Detalles de su compra';

	    $cuerpo = '<h4>¡Gracias por su compra!</h4>';
	    $cuerpo .= '<p>EL ID de su compra es <b>'.$id_trade.'</b></p>';
	    $cuerpo .= '<a href="http://localhost/TiendaUrbana/Guide/vistas/pagado.php?key='.$id_trade.'">Ver detalles de su compra</a>';

	    $mail->Body    =  $cuerpo;

	    $mail->AltBody = 'Se remite los detalles de compra';

	    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

	    $mail->send();
	    #echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

?>