<?php

if (isset($_POST['login'])) {
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
	if ($captcha_success->success == false){
		echo "Captcha Fail";
		echo $captcha_success;
	} else if($captcha_success->success == true){
		include 'datanetwork.php';

    $username = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['passwrd']);

	$salt = base64_encode(substr(str_shuffle("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 12));
    //Error Handlers

    if(empty($username || $password)){
        header('Location: ../account/login.php');
        exit();
    } else{
        $sql = "SELECT * FROM userbase WHERE email = '$username'";
        $result = mysqli_query($con, $sql);

        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 1){
            header("Location: ../account/login.php?e=nouser");
            exit();
        } else{

            if($row = mysqli_fetch_assoc($result)) {
                //Unhasing Password
                if (hash('sha512', $pword . $salt) == !$row['password']){
                    header("Location: ../account/login.php?e=passmismatch");
                    exit();
                } else{
                    if ($row['Activated'] == 0){
                        header("Location: ../account/login.php?e=accnotverified");
                        exit();
                    } elseif ($row['Disabled'] == 1){
                        header("Location: ../account/login.php?e=accdisabled");
                        exit();
                    }
                        //Logging in the user to the site
						$displaynamecookie = "FWACNAME";
						$pfpcookie = "FWPFP";
						
						setcookie($displaynamecookie, $row['displayname'], time() + (86400*30), "/");
						setcookie($pfpcookie, $row['profileImage'], time() + (86400*30), "/");
						
                        header("Location: ../index.php");
                        exit();
                    }
                    }
                }
            }

        }

    }
		


else{
    header("Location: ../account/login.php");
    exit();
}
