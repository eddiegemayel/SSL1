<?php
	session_start();

	$client = $_GET["clientId"];

	//connect to database
	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=clients; port=8889;", $user,$pass);
	$stmt = $dbh->prepare("UPDATE clients_table SET clientStatusId = 0 WHERE clientId =  :client");
	$stmt->bindParam(":client",$client);
	$stmt->execute();

	header("location: admins.php");
?>