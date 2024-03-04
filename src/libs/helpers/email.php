<?php

function send_forgot_password_email(string $recipient, string $code): void {

	$mail = smtp();

	$mail->setFrom('vinc3w59@gmail.com', 'Vincent');
	$mail->addAddress($recipient);

	$mail->isHTML(true);
	$mail->Subject = APP_NAME . ' | Change Password Code';
	$mail->Body = "Your code is <b>$code</b>.<br>You have one hour before this code expires!";

	$mail->send();

}
