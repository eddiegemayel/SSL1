<?php
	session_start();

	//collect form varible client name
	$_SESSION["clientname"] = $_POST["client-name"];

	//connect to database
	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=clients; port=8889;", $user,$pass);
	$stmt = $dbh->prepare("INSERT INTO clients_table (clientName, createdBy)
	VALUES (:name, :user)");
	$stmt->bindParam(":name",$_SESSION["clientname"]);
	$stmt->bindParam(":user",$_SESSION["username"]);

	//if clientname is empty, return error
	if($_SESSION["clientname"]==false){
		echo "Invalid insert value.";

	}
	//otherwise push it to clients table and redirect to admins php
	else{
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		header("location: admins.php");
	}
?>