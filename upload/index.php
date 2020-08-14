<?php
$uploadToken = $_SESSION['token'] = md5(uniqid(mt_rand(), true));

//if (!isset($_SESSION['displayname'])){
//	header("Location: ../account/login.php");
//}
?>

<html>

	<link rel="stylesheet" href="../src/css/main.css">
	<link rel="stylesheet" href="../src/css/upload.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	
	<head>
		<title>Create Submission</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<header>
		<div class="header_wrapper">
			<img class="fw_logo" alt="Logo" src="../src/img/bannericn.png">
			<a href="/upload" class="fw_uploadicn"><i class="fa fa-arrow-up"></i></a>
			<a href="javascript:void(0);" onclick="openAccountPage()"><img id="fw_userimg" class="fw_userimg" alt="Avatar" src="<?php if (isset($_SESSION['displaypicture'])){ echo $_SESSION['displaypicture']; }else echo "../src/img/defaultpfp.jpg";?>"></a>
		</div>
		
		<div id="fw_accountpage" class="fw_accountpage">
			<img class="fw_accountpage-DisplayImage" alt="Avatar" src="<?php if (isset($_SESSION['displaypicture'])){ echo $_SESSION['displaypicture']; }else echo "../src/img/defaultpfp.jpg";?>">
			<h3 class="fw_accountpage-DisplayName"><?php echo $_SESSION['displayname'];?></h3>
			<img class="fw_verifiedmark_accpage" alt="Verified" src="<?php if($_SESSION['verifiedusr'] == "True"){ echo "../src/img/verified_mark.png";} else{ echo "";}?>">
			<a href="#"><button class="fw_accountPageLink1">PROFILE</button></a>
			<a href="#"><button class="fw_accountPageLink2">SETTINGS</button></a>
			<form action="includes/logout.php" method="POST">
				<button type="submit" name="logout" class="fw_accountPageLink3">SIGN OUT</button>
			</form>
			
		</div>
	

	    <!--You won't find anything special in this JS lemme tell you that-->
		<script>
		var accpage = document.getElementById("fw_accountpage");
		if (accpage.className === "fw_accountpage visible"){
			accpage.className = "fw_accountpage";
		}
		</script>

		<script>
			function openAccountPage() {
				var name = "<?php if (isset($_SESSION['displayname'])){ echo $_SESSION['displayname']; }else echo "nil";?>";
				var accpage = document.getElementById("fw_accountpage");
				
				if (name === 'nil'){
					window.location.href = "https://dev.sda.one/project_examples/art_thing/account/login.php";

			} else{
				if (accpage.className === "fw_accountpage"){
					accpage.className += " visible";
				} else{
					accpage.className = "fw_accountpage";
				}
			}
			}
		</script>
		
	</header>

	<body>
		<div class="fw_uploadfield hide">
			<form action="../includes/upload_imgsubmission.php" method="post">
				<input class="fw_filechooser" type="file" name="artwork">
				<input class="fw_continuebtn" type="submit" name="upload" value="Continue">
				<p class="fw_errormsg">Error: File not a valid image format</p>
			</form>
		</div>
		
		<div class="fw_publishsection">
			<form action="../includes/createsubmission.php">
				<h2 class="fw_title" style="font-size: 30px;">Enter information about your submission</h2>
				<input class="fw_publish" type="submit" name="publishwork" value="Publish"><br>
				<img src="../src/img/defaultavi.jpg" alt="Submission Preview" class="fw_submissionprev">
				
				<!--Information about the upload-->
				
				<h2 class="fw_title">Name</h2>
				<input class="fw_subname" type="text" name="subtitle" placeholder="Submission Name">
				<h2 class="fw_title">Description</h2>
				<input class="fw_subdesc" type="text" name="subtitle" placeholder="Enter a description about your submission">
			</form>
			
		
		</div>
		
	</body>
	
	
	
</html>