<?php
/*
Eddie Gemayel
June 7 2014
Lab 3
*/

	session_start();
	ob_start();

	//var_dump($_FILES["filename"]["name"]);
	//store user inputs into session variables
	$_SESSION['username'] = $_POST["username"];
	$_SESSION["password"] = $_POST["password"];
	$salt1 = sha1("Thisissalted");
	$salt2 = sha1("Mmmsalty");
	$_SESSION['thecap'] = $_POST["captcha"];


	//$stmt = $dbh->prepare("SELECT id users_table (username, password, avatar);


	

	//upload directiory for avatar
	$uploaddir = "./uploads/";
	$_SESSION["$uploadfile"] = $uploaddir . basename($_FILES["filename"]["name"]);

	//echo the user profile page
	if($_SESSION['thecap'] == $_SESSION["captcha-word"]){


	//if statement for captcha
	if(move_uploaded_file($_FILES["filename"]["tmp_name"], $_SESSION["$uploadfile"])){
		$user="root" ;
		$pass="root";
		$dbh = new PDO("mysql:host=localhost; dbname=Lab3_db; port=8889", $user,$pass);
		$stmt = $dbh->prepare("INSERT INTO users_table (username, password, avatar)
		VALUES (:name, :value, :image)");
		$stmt->bindParam(":name",$_SESSION['username']);
		$stmt->bindParam(":value",$_SESSION["password"]);
		$stmt->bindParam(":image",$_SESSION["$uploadfile"]);
		$stmt->execute();
		echo "<p>DONE!!</p>";

		header("Location: login.html");

		// echo "Your Avatar: <img src='". $uploadfile . "'/><br/>";
		// echo "<p class='txt'>File uploaded!</p>";
		// echo "<p class='txt'>Username: ", $_SESSION['username'], "</p>";
		// echo "<p class='txt'>Salted and Hashed Password: ", $salt1.sha1($_SESSION['password']).$salt2, "</p>";
	}
	else{
		echo "Failed to upload";
	}

}else{
	header("Location: index.html");
	echo "<p>Error - captcha wrong</p>";
}
?>