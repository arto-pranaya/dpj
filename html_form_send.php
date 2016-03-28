<?php

	//////////////////////////////////
	//Validate the form inputs
	/////////////////////////////////
	
	if(isset($_POST['submitted'])) {
		//initialize to validate the input
		$pattern_string = "/^[A-Za-z .'-]+$/";
		$pattern_email = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		$pattern_phone = "/^[0-9 .'-]+$/";
		$pattern_subject = "/^[a-zA-Z0-9\_]{2,20}/";
		
		//get the data from html
		$name = $_POST['name']; // required
		$email_from = $_POST['email']; // required
		$telephone = $_POST['telephone']; // required
		$subject = $_POST['subject']; // required
		$message = $_POST['message']; // required
		
		//all field must be filled and validated
		if(!empty($name) && !empty($email_from) && !empty($telephone) && !empty($subject) && !empty($message)){
			if(!preg_match($pattern_string,$name)){
				echo "<script>alert('Nama yang anda gunakan tidak valid.');window.history.go(-1);</script>";
				exit;
			}
			elseif(!preg_match($pattern_email,$email_from)){
				echo "<script>alert('Email yang anda gunakan tidak valid.');window.history.go(-1);</script>";
				exit;
			}
			elseif(!preg_match($pattern_phone,$telephone)){
				echo "<script>alert('Anda hanya dapat mempergunakan nomor untuk kolom telepon.');window.history.go(-1);</script>";
				exit;
			}
			elseif(!preg_match($pattern_subject,$subject)){
				echo "<script>alert('Subject yang anda gunakan tidak valid.');window.history.go(-1);</script>";
				exit;
			}
			elseif(strlen($message) < 10){
				echo "<script>alert('Pesan yang anda tulis terlalu singkat.');window.history.go(-1);</script>";
				exit;
			}
		} else {
			echo "<script>alert('Tolong masukin semua informasi yang dibutuhkan.');window.history.go(-1);</script>";
			exit;
		}
		
		
		/////////////////////////////////////////////
		//Sends the email if validation passes
		////////////////////////////////////////////
		
		$from = "Email from DiamondPrimaJaya website";
		$to = "info@diamondprimajaya.com";
		
		$email_message = "Message from: ". $name .
						"\nEmail: ". $email_from .
						"\nTelephone: ". $telephone .
						"\nSubject: ". $subject .
						"\n\nMessage: \n". $message;
		
		mail($to,$subject,$email_message,$from);
		
		
		/////////////////////////////////////
		//Return to contact-success.html
		/////////////////////////////////////
				
		header("Location: contact-success.html");
		exit;
				
	}
?>
