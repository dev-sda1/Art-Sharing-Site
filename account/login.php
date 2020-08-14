<?php
session_start();

$errormsg = $_GET["e"];

$msgtodisplay = "&nbsp;";

if ($errormsg == "nouser"){
	$msgtodisplay = "User doesn't exist. Want to sign up using this name? <a href='/create_account.php'>Sign up</a> now!";
}

if ($errormsg == "passmismatch"){
	$msgtodisplay = "Password incorrect. <a href='#'>Forgotten Password?</a>";
}

if ($errormsg == "accnotverified"){
	$msgtodisplay = "Your account is not yet activated. Please check your email, or contact support if you have not recieved one";
}

if ($errormsg == "accdisabled"){
	$msgtodisplay = "Your account has been disabled. Please contact support";
}



?>


<html>
	
<link rel="stylesheet" href="../src/css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script src='https://www.google.com/recaptcha/api.js'></script>

</head>
	
<body>
<form action="../includes/login_tonetwork.php" method="post">
	<div class="loginform">
		<img class="fw_logo" alt="Logo" src="../src/img/bannericn.png">
		<h3 class="subnotice" style="margin-left: 0; text-align: center; font-size: 30px;">Welcome back!</h3>
		<input class="emailinput" type="email" required autocomplete="off" name="email" placeholder="Email Address"><br>
		<input class="pwordinput" type="password" required autocomplete="off" name="passwrd" placeholder="Password"><br>
		<p style="color: red; text-align: center; font-family: Questrial"><?php echo $msgtodisplay;?></p>
		<p style="color: red; text-align: center; font-family: Questrial">A Default user account has been pre-made. Email: example@sda.one Password: test</p>
		
		<div class="g-recaptcha fw_capt" data-sitekey=" "></div>
		
		<button class="button" name="login">Login</button>
		<a href="#"><h3 class="forgottenpass">Forgotten password?</h3></a><br>
	</div>
</form>
	

</body>
</html>
