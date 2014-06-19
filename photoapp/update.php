<?php
/*
Eddie Gemayel
Lab 7
individual challenge
*/		
session_start();

		//update.php
		//connect to database
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		//update photo title
		$stmt = $dbh ->prepare("UPDATE photos SET photoName = :title WHERE id = :id");
		//push new info entered by user
		$stmt->bindParam(':title', $_POST["photoName"], PDO::PARAM_STR);
		$stmt->bindParam(':id', $_SESSION["photoId"], PDO::PARAM_STR);
		// var_dump($_POST["photoName"]);
        $stmt->execute();
        // var_dump($stmt);     
    	//push user back to their profile
		header("Location: profile.php");
?>