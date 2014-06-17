<?php
/*
Eddie Gemayel
Lab 7
individual challenge
*/
	session_start();
	ob_start();

	$newusername = $_POST["username"];
	$newpassword = md5($_POST["password"]);
	$_SESSION['thecap'] = $_POST["captcha"];

	//if the captcha is right
	if($_SESSION['thecap'] == $_SESSION["captcha-word"]){
			//store all their new info into the database
			$user="root";
			$pass="root";
			$dbh = new PDO("mysql:host=localhost; dbname=Photo_db; port=8889;", $user,$pass);
			$stmt = $dbh->prepare("INSERT INTO users (username, password)
				VALUES (:name, :value)");
			$stmt->bindParam(":name",$newusername);
			$stmt->bindParam(":value",$newpassword);

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//tell them it worked
			echo "<p>DONE!!</p>";

			//redirect them to login page
			header("Location: login.html");
	}else{
		//if the captcha was wrong
		//header("Location: index.html");
		echo "
		<!DOCTYPE html>
<html>
	<head>
		<title>PhotoApp | Sign Up</title>
		<link rel='stylesheet' href='css/main.css'/>
	</head>
	<body>
		<header>
			<h1>PhotoApp</h1>
		</header>
		<p>Error - captcha wrong</p>
				<a href='signup.html'>Go Back to Sign Up</a>
	</body>
</html>
		";
	}
?>