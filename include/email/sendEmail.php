<?php
/*
 * https://code.google.com/a/apache-extras.org/p/phpmailer/
 */
if(isset($_SESSION['email']))
{
	require_once('phpmailer/class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
	
	$mail->IsSMTP(); // telling the class to use SMTP

	try {
		//$mail->Host       = "mail.yourdomain.com"; // SMTP server
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "technodevtest@gmail.com";  // GMAIL username
		$mail->Password   = "17lY41te";            // GMAIL password
		$mail->AddAddress($_SESSION['email'], $_SESSION['name']);
		$mail->SetFrom('technodevtest@gmail.com', 'Technological Developments Email Tester');
		//$mail->AddReplyTo('name@yourdomain.com', 'First Last');
		$mail->Subject = $_SESSION['subject'];
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		$mail->Body = ($_SESSION['body']);
		//$mail->Send();
		//echo "Message Sent OK</p>\n";
	} 
	catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} 
	catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}
}
?>
