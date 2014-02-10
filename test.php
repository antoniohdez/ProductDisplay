<?php
	//require("vuforia/DeleteTarget.php");
	//$vuforiaRequest = new DeleteTarget("430ded29be64441b8d0f638ae44086a7");
	//list($width, $height, $type, $attr) = getimagesize("uploadedMedia/image/1-(1)a2Nw6p1_700b.jpg");
	//echo $width;
	if(isset($_GET["pass"])){
		$password = $_GET["pass"];
		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH){
	        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
	        echo crypt($password, $salt);
	    }
	}
	else{
		echo '<form action="test.php" method="get">
				<label>Pass:</label>
				<input name="pass" type="text">
			</form>';
		error_reporting(E_ALL);
 		ini_set('display_errors', 1);
		require("vuforia/PostNewTarget.php");
	}
?>
