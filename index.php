<?php
//Index Pge

?>

<html>

	<link rel="stylesheet" href="./src/css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	
	<head>
		<title>Unnamed Website Project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<header>
		<div class="header_wrapper">
			<img class="fw_logo" alt="Logo" src="src/img/bannericn.png">
			<a href="javascript:void(0)" onclick="openuploadoptions()" class="fw_uploadicn"><i class="fa fa-plus"></i></a>
			<a href="javascript:void(0);" onclick="openAccountPage()"><img id="fw_userimg" class="fw_userimg" alt="Avatar" src="<?php if (isset($_COOKIE['FWPFP'])){ echo $_COOKIE['FWPFP']; }else echo "src/img/defaultpfp.jpg";?>"></a>
		</div>
		
		<div id="fw_accountpage" class="fw_accountpage">
			<img class="fw_accountpage-DisplayImage" alt="Avatar" src="<?php if (isset($_COOKIE['FWPFP'])){ echo $_COOKIE['FWPFP']; }else echo "src/img/defaultpfp.jpg";?>">
			<h3 class="fw_accountpage-DisplayName"><?php echo $_COOKIE['FWACNAME'];?></h3>
			<img class="fw_verifiedmark_accpage" alt="Verified" src="<?php echo "src/img/verified_mark.png";?>">
			<a href="#"><button class="fw_accountPageLink1">PROFILE</button></a>
			<a href="#"><button class="fw_accountPageLink2">SETTINGS</button></a>
			<form action="includes/logout.php" method="POST">
				<button type="submit" name="logout" class="fw_accountPageLink3">SIGN OUT</button>
			</form>
			
		</div>
	

	    <!--JS is a nightmare-->
		<script>
		var accpage = document.getElementById("fw_accountpage");
		if (accpage.className === "fw_accountpage visible"){
			accpage.className = "fw_accountpage";
		}
		</script>

		<script>
			function clearmenus(){
				var accpage = document.getElementById("fw_accountpage");
				var uploadpage = document.getElementById("fw_uploadoptions");
				
				
			}
			
			function openAccountPage() {
				var displayname = "<?php if (!isset($_COOKIE['FWACNAME'])){ echo "nil";}else echo $_COOKIE['FWACNAME']; ?>";
				var accpage = document.getElementById("fw_accountpage");
				
				if (displayname === 'nil'){
					window.location.href = "https://dev.sda.one/project_examples/art_thing/account/login.php";

			} else{
				if (accpage.className === "fw_accountpage"){
					accpage.className += " visible";
				} else{
					accpage.className = "fw_accountpage";
				}
			}
			}
			
			function openuploadoptions(){
				clearmenus()
				
			}
		</script>
		
	</header>
	
	
	<body>
		
		<div class="fw_featuredcontainer">
			<img class="fw_featured fw_featuredimg" alt="Featured Post" src="https://dev.sda.one/project_examples/art_thing/src/img/fw-testimg.png">
			<h1 class="fw_featured fw_title">FEATURED</h1>
			<h3 class="fw_featured fw_artname">%ArtworkName%</h3>
			<h4 class="fw_featured fw_artmaker">%Creator%</h4>
			<p class="fw_featured fw_editornote">%editornote%</p>
			
			<br>
			<?php
				if (isset($_COOKIE['FWACNAME'])){
					echo "<h1>Currently logged in</h1>";
				}
			?>
		</div>
</body>
	
	
	
	
	
	
</html>
