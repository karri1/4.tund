<?php

 /*funktsioonide näited
 
 function sum ($x, $y) {
	 
	 return $x + $y;	 
 }
 
 echo sum(20, 20);
 echo "<br>";
 echo sum(15, 15);

 function hello ($eesnimi, $perenimi) {
	 
	 return "Tere tulemast "  .$eesnimi . " " .$perenimi;
		
}
echo "<br>";
echo hello ("Peeter", "Puravik");

********************************************
*/


function signUp ($email, $password) {
	
	$database = "if16_karin";
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
	$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
	echo $mysqli -> error;   //see on igaks juhuks
		
	$stmt -> bind_param("ss", $email, $password ); 

		if ($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
		
	$stmt->close();
	$mysqli->close();
	
}
?>

