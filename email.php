<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

require 'phpmailer/PHPMailerAutoload.php';

$errors = array();  	// array to hold validation errors
$data = array(); 		// array to pass back data

// validate the variables ======================================================
	//if (empty($_POST['name']))
	//	$errors['name'] = 'Name is required.';

	//if (empty($_POST['superheroAlias']))
	//	$errors['superheroAlias'] = 'E-mail is required.';

	if (empty($_POST['content']))
		$errors['content'] = 'Message is required.';

// return a response ===========================================================

	// response if there are errors
	if ( ! empty($errors)) {

		// if there are items in our errors array, return those errors
		//$data['success'] = false;
		//$data['errors']  = $errors;
		
	} else {
		$mail = new PHPMailer(); // create a new object
		$mail->isSMTP(); // enable SMTP
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->addAttachment('pdfs/PyxisProjectPlan.pdf');  

		$mail->Username = "pyxisemployeerecognition@gmail.com"; //Email that you setup
		$mail->Password = "Student@OSU"; // Password
		$mail->Subject = "Great Job! Attached is an Award For Your Awesome Contributions! ";
		$mail->Body = $_POST['content'];
		$mail->AddAddress("hesseljo@oregonstate.edu"); //Pass the e-mail that you setup

		

		 if(!$mail->Send())
		    {
		    		echo "Mailer Error: " . $mail->ErrorInfo;
		    }
		    else
		    {
		    	$data['success'] = true;
	    		$data['message'] = 'Thank you for sending e-mail.';
		    }

		
	}
	echo json_encode($data);







//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'user@example.com';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    // TCP port to connect to

//$mail->setFrom('from@example.com', 'Mailer');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

//$mail->Subject = 'Here is the subject';
//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//if(!$mail->send()) {
 //   echo 'Message could not be sent.';
 //   echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}