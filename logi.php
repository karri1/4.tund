<?php 

	require("../../config.php");
	require("functions.php");
	//echo hash("sha512", "b");
	
	//kui on juba sisse loginud siis suunan data lehele
	if(isset ($_SESSION["userID"])){
	
	//suunan sisselogimise lehele
	header("Location: data.php");
}
	
	
	//GET ja POSTi muutujad
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//echo strlen("äö");
	
	// MUUTUJAD
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	$signupGender = "";
	
	// on üldse olemas selline muutja
	if( isset( $_POST["signupEmail"] ) ){
		
		//jah on olemas
		//kas on tühi
		if( empty( $_POST["signupEmail"] ) ){
			
			$signupEmailError = "See väli on kohustuslik";
			
		} else {
			
			// email olemas 
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	} 
	
	if( isset( $_POST["signupPassword"] ) ){
		
		if( empty( $_POST["signupPassword"] ) ){
			
			$signupPasswordError = "Parool on kohustuslik";
			
		} else {
			
			// siia jõuan siis kui parool oli olemas - isset
			// parool ei olnud tühi -empty
			
			// kas parooli pikkus on väiksem kui 8 
			if ( strlen($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
			
			}
			
		}
		
	}
	
	
	// GENDER
	if( isset( $_POST["signupGender"] ) ){
		
		if(!empty( $_POST["signupGender"] ) ){
		
			$signupGender = $_POST["signupGender"];
			
		}
		
	} 
	
	// peab olema email ja parool
	// ühtegi errorit
	
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame andmebaasi
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		
		
		//echo $serverUsername;
		
		//ühenduse loomiseks kasutan funktsiooni, mis functions.php failis
		
		signUp($signupEmail, $password);
		
		/*ÜHENDUS
		$database = "if16_karin";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		//SQLI'I RIDA
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysqli -> error;   //see on igaks juhuks
		
		//stringina üks täht iga muutuja kohta (?, ?), mis tüüp
		// string - s
		// integer - i
		// float (double) - d
		//küsimärgid asendada muutujaga
		$stmt -> bind_param("ss", $signupEmail, $password ); 

		if ($stmt->execute()) {;
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
		//panen ühenduse kinni
		$stmt->close();
		$mysqli->close();
		*/
	}
	$error = "";
	if ( isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) && 
		!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
	  ) {
		  echo "siin";
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		  
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>

	<h1>Logi sisse</h1>
	<form method="POST">
		<p style="color:red;"><?=$error?> </p>
		<label>E-post</label>
		<br>
		
		<input name="loginEmail" type="text">
		<br><br>
		
		<input type="password" name="loginPassword" placeholder="Parool">
		<br><br>
		
		<input type="submit" value="Logi sisse">
		
		
	</form>
	
	
	<h1>Loo kasutaja</h1>
	<form method="POST">
		
		<label>E-post</label>
		<br>
		
		<input name="signupEmail" type="text" value="<?=$signupEmail;?>"> <?=$signupEmailError;?>
		<br><br>
		
		<?php if($signupGender == "male") { ?>
			<input type="radio" name="signupGender" value="male" checked> Male<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="male"> Male<br>
		<?php } ?>
		
		<?php if($signupGender == "female") { ?>
			<input type="radio" name="signupGender" value="female" checked> Female<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="female"> Female<br>
		<?php } ?>
		
		<?php if($signupGender == "other") { ?>
			<input type="radio" name="signupGender" value="other" checked> Other<br>
		<?php }else { ?>
			<input type="radio" name="signupGender" value="other"> Other<br>
		<?php } ?>
		
		
		<br>
		<input type="password" name="signupPassword" placeholder="Parool"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Loo kasutaja">
		
		
	</form>

</body>
</html>