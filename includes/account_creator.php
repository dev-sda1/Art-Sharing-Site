<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['join'])) {
	//RECAPTCHA by Google Information
	
	$secret = ' '; 
	$response = $_POST["g-recaptcha-response"];
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = array(
		'secret' => ' ',
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
	if($captcha_success->success == false){
		header("Location: ../account/create_account.php?e=captchafail");
	}else{

	include_once 'datanetwork.php';

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $uname = mysqli_real_escape_string($con, $_POST['usrname']);
    $pword = mysqli_real_escape_string($con, $_POST['passwrd']);
    $pword_conf = mysqli_real_escape_string($con, $_POST['confirm_passwrd']);
    $memberID = base64_encode(random_bytes(10));
    $emailHash = base64_encode(random_bytes(18));

		
	$salt = base64_encode(substr(str_shuffle("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 12));

    //Error Handlers

    //Check for empty fields

    if (empty($email) || empty($uname) || empty($pword) || empty($pword_conf)){
        header("Location: ../account/create_account.php?e=youmissedacolumn");
        exit();

    } else{
		
        if (strlen($uname) >100){
            header("Location: ../account/create_account.php?e=namelong");
            exit();
           } else{
                if (!$pword == $pword_conf){
                    header("Location: ../account/create_account.php?e=passwordmismatch");
                    exit();
                } else{
                    $sql = "SELECT * FROM userbase WHERE username ='$uname'";
                    $result = mysqli_query($con, $sql);
                    $resultCheck = mysqli_num_rows($result);
            
                    if ($resultCheck > 0){
                        header("Location: ../account/create_account.php?e=accountalreadyexists");
                        exit();
                    } else{
						
                        //Hashing Password
            
                        $hashedPw = hash('sha512', $pword . $salt);
        
                        //Insert User into DB
						
			echo  $memberID;
			echo $uname;
			echo $hashedPw;
			echo $email;
			echo  $uname;
			echo $emailHash;
                        $sql = "INSERT INTO `userbase` (memberID, username, password, email, displayname, tempToken) VALUES ('$memberID', '$uname', '$hashedPw','$email','$uname', '$emailHash');";
						$q = mysqli_query($con, $sql);
						if (!$q){
							echo "<h1>CRTICIAL: Backend error reported</h1>";
							echo $q;
							die();
						}
						
                        //Verification Email oWo
                        $to = $email;
                        $subject = "Account Verification";
                        $message_body = "https://dev.sda.one/project_examples/art_thing/account/verify.php?email=".$email.'&hash='.$emailHash."";
        
                        $headers = 'From: no-reply@sda.one' . "\r\n" .
                        'Reply-To: no-reply@sda.one' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                        mail('-f'.$to, $subject, $message_body, $headers);
						header("Location: ../account/login.php?e=creationsuccess");
                        exit();
            
                    }
                }
            }
            
        }
        
        
    }


	}
    
    
else{
    header("Location: ../account/create_account.php");
    exit();
}
