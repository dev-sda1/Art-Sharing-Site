<?php
if (isset($_POST['logout'])){
    $displaynamecookie = "FWACNAME";
	$pfpcookie = "FWPFP";
						
	setcookie($displaynamecookie, $row['displayname'], time() - 3600, "/");
	setcookie($pfpcookie, $row['profileImage'], time() - 3600 , "/");
    header("Location: ../index.php");
    exit();
}