<?php

require_once __DIR__ . '../../variables/global.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '../../libraries/PHPMailer/src/Exception.php';
require_once __DIR__ . '../../libraries/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '../../libraries/PHPMailer/src/SMTP.php';

if(isset($_POST['data_order'])) {
	$mail = new PHPMailer(true);
	try {

		$mail->isSMTP();                                            
		$mail->Host       	= 	'dev.dental-design-clients.co.uk';             
		$mail->SMTPAuth   	= 	true;                                   
		$mail->SMTPSecure 	= 	'tls';
		$mail->Username   	= 	'no-reply@dev.dental-design-clients.co.uk';           
		$mail->Password   	= 	'Yn3U_uI{2G%J';                     
		// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
		$mail->Port       	= 	587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure PHPMailer::ENCRYPTION_STARTTLS`

		$mail->setFrom('no-reply@dev.dental-design-clients.co.uk', 'Dental Design');
		$mail->addAddress('jake@dental-design.co.uk');
		$mail->addCC('jake@dental-design.co.uk');

		$data_order = $_POST['data_order'];
		$fields = explode(',', $data_order);
		$content = "";
		foreach ($fields as $value) {
			$content .= str_replace("_"," ",$value) . ": " . $_POST[$value] . "<br>";
		}

		$body = file_get_contents($base_url . '/emails/plain.php');
		$title = $_POST['practice_name'] . ' - ' . $_POST['form_name'];

		$body = str_replace('{{title}}', $title, $body);
		$body = str_replace('{{content}}', $content, $body);

		//Content
		$mail->isHTML(true);
		$mail->Subject = $title;
		$mail->Body    = $body;
		$mail->send();
		
		if ($mail->ErrorInfo) {
			echo json_encode(array("error" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
		} else {
			echo json_encode(array("message" => "Message sent successfully"));
		}

	} catch (Exception $e) {
		echo json_encode(array("error" => "Message could not be sent. Mailer Error: {$e->getMessage()}"));
	}
	
}
