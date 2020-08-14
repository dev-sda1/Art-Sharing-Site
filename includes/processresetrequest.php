<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submitreset'])) {
	//RECAPTCHA by Google Information
	
	$secret = '';
	$response = $_POST["g-recaptcha-response"];
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = array(
		'secret' => '',
		'response' => $_POST["g-recaptcha-response"]
	);
	
	$options = array(
		'http' => array(
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	
	$context = stream_context_create($options);
	$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response");
	$captcha_success = json_decode($verify);
	if ($captcha_success->success == false){
		header("Location: ../account/forgot_password.php?e=captchafail");
		exit();
	} else if($captcha_success->success == true){
		include_once 'datanetwork.php';

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $resetCode = base64_encode(random_bytes(10));
    //Error Handlers

    //Check for empty fields

    if (empty($email)){
        header("Location: ../account/forgot_password.php.php?e=youmissedacolumn");
        exit();

    } else{
		$sql = "SELECT * FROM userbase WHERE email ='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);
            
        if ($resultCheck == 0){
			header("Location: ../account/forgot_account.php?e=noaccount");
            exit();
        } else{
			$sql = "UPDATE `userbase` SET `passwordResetToken`='$resetCode' WHERE email = '$email';";
			$q = mysqli_query($con, $sql);
			if (!$q){
				echo "<h1>CRITICAL: Backend error reported</h1>";
			}
						
            //Send email off oWo
            $to = $email;
            $subject = "Password Reset Request";
            $message_body = "Someone has requested an account password reset using your email address.
			
			To reset your password, click the link below.
			https://dev.sda.one/project_examples/art_thing/account/reset_password.php?email=".$email.'&resetcode='.$resetCode."
			
			
			If this wasn't you, you can ignore this message, your account details are still safe.";
        
            $headers = 'From: no-reply@sda.one' . "\r\n" .
                        'Reply-To: no-reply@sda.one' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message_body, $headers);
            //echo "Reset request generated! (and email hopefully sent uwu)";
            exit();
            
                    }
                }
            }
            
}   
else{
    header("Location: ../account/login.php");
    exit();
}