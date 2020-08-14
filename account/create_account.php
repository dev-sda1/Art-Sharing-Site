<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>

<html>
	
<link rel="stylesheet" href="../src/css/register.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
@media (max-width: 540px){
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	
<head>
<title>Create Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>


<body>
<form action="../includes/account_creator.php" method="post">
	<div class="loginform">
		<img class="fw_logo" alt="Logo" src="../src/img/bannericn.png">
		
		<h3 class="subnotice" style="font-size: 22px;">Create Account</h3>
		
		<input class="emailinput" type="email" required autocomplete="off" name="email" placeholder="Email Address"><br>
		
		<h3 class="subnotice">You will use your email to login. Make sure it is valid</h3>
		
		<input class="pwordinput" type="password" required autocomplete="off" name="passwrd" placeholder="Password">
		
		<input class="pwordinput2" type="password" required autocomplete="off" name="confirm_passwrd" placeholder="Confirm Password">
		
		<h3 class="subnotice">Choose a secure password to protect your account</h3>
		
		<input class="usernameinput" type="text" required autocomplete="off" name="usrname" placeholder="Username"><br>
		
		<h3 class="subnotice">Creation has been turned off for security and privacy concerns.</h3>		
		
		<div class="g-recaptcha fw_capt" data-sitekey=" "></div>
				
		<button class="button" name="join">Join</button>
		
		<a href="/login.php"><h3 class="forgottenpass">Sign in instead</h3></a>
		
		<div class="promobox">
			<img src="../src/img/fw-still.png" class="icn">
			<p style="text-align: center;">Subtext Example</p>
		</div>
	</div>
	
	
</form>
	

</body>
</html>
