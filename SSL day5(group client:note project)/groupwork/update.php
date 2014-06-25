<?php
	session_start();
	//collect form varible client name
	$newName = $_POST["newName"];
	$clientId = $_SESSION["clientId"];
	

	// var_dump($clientId);
	// var_dump($newName);

	//connect to database
	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=clients; port=8889;", $user,$pass);
	$stmt = $dbh->prepare("UPDATE clients_table SET clientName = :newName WHERE clientId = :clientId");
	//var_dump($stmt);
	$stmt->bindParam(":newName",$newName, PDO::PARAM_STR);
	//var_dump($stmt);
	$stmt->bindParam(":clientId",$clientId, PDO::PARAM_INT);
	//var_dump($stmt);
//if clientname is empty, return error
	if($newName==" "){
		//var_dump($newName);
		echo "Invalid insert value.";
	}
	//otherwise push it to clients table and redirect to admins php
	else{
		$stmt->execute();
		header("location: admins.php");
	}
?>