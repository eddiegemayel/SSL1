<?php

	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=fruits; port=8889", $user,$pass);
	$stmt = $dbh->prepare("select * from fruit_table");
	$stmt->execute();
	$fruits = $stmt->fetchAll();

	header("Content-type:application/json");
	echo json_encode($fruits);


?>