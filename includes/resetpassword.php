<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'datanetwork.php';

if (isset($_POST['attemptreset'])) {
	//RECAPTCHA by Google Information
	
	$secret = ' ';
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
		header("Location: https://dev.sda.one/project_examples/art_thing/account/reset.php?email=$email&resetcode=$resethash&e=captchafail");
		exit();
	} else if($captcha_success->success == true){
		
		$email = mysqli_real_escape_string($con, $_POST['email']); 
		$hash = mysqli_real_escape_string($con, $_POST['resetkey']); 
		
		// Make sure user email with matching hash exist
		$sql = ("SELECT * FROM userbase WHERE email='$email' AND passwordResetToken='$hash'");
		$result = mysqli_query($con, $sql);
		if ( $result->num_rows == 0 ){
			//echo $email;
			//echo $hash;
			//echo "<h1>we couldn't find the account, look at these just to check the vars pls</h1>";
			header("Location: https://dev.sda.one/project_examples/art_thing/account/login.php?e=resetfailnoaccount");
			exit();
		} else{
			$pword = $_POST['pword'];
			$pword_conf = $_POST['pword_conf'];
		
			$pword = mysqli_real_escape_string($con, $pword);
			$pword_conf = mysqli_real_escape_string($con, $pword_conf);
	
			if ($pword == $pword_conf){
				//Le encryption
				$pwordhashed = password_hash($pword, PASSWORD_DEFAULT);
			
				//SQL
				$sql = "UPDATE `userbase` SET `passwordResetToken`='null' WHERE `email` = '$email';";
				$result = mysqli_query($con, $sql);
			
				$sql = "UPDATE `userbase` SET `password`='$pwordhashed' WHERE `email` = '$email';";
				$result = mysqli_query($con, $sql);
				header("Location: https://dev.sda.one/project_examples/art_thing/account/login.php?e=resetcomplete");
				exit();
			
			}else{
				header("Location: https://dev.sda.one/project_examples/art_thing/account/reset.php?email=$email&resetcode=$resethash&e=passwordmismatch");
				exit();
		}
	}	
}
}