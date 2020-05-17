<?php
function MailTo($to){
	$subject = "University of the Aegean registration";
	$email = $_POST['email'];
	$message = "Welcome aboard !!!! :) To complete your registration click the link below:\n http://icsd12200wb16.netau.net/theoria/WebPro16/register2.php or http://localhost/WebPro16/register2.php";
	$headers = "From: noreplyUoTARegister@test.test.com";
	$sent = mail($to, $subject, $message, $headers);
	echo $to;
	if($sent){

		echo '<script language="javascript">';
		echo 'alert("message successfully sent")';
		echo '</script>';
	}
	else{
		echo '<script language="javascript">';
		echo 'alert("Error wrong email")';
		echo '</script>';
	}
}
?>