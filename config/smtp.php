<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Connect to SMTP server
 */
function smtp(): PHPMailer {

	static $mail;
	if (!$mail) {
		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = $_ENV['SMTP_HOST'];
		$mail->SMTPAuth = true;
		$mail->Username = $_ENV['SMTP_USERNAME'];
		$mail->Password = $_ENV['SMTP_PASSWORD'];
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = $_ENV['SMTP_PORT'];
	}
	return clone $mail;

}
