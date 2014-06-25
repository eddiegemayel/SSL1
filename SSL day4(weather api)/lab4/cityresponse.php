<?php
	
	$cityentered=trim($_GET["cityget"])."%";
	$user = "root";
	$pass = "root";
	$dbh = new PDO("mysql:host=localhost;dbname=worldcities;port=8889;",
		$user, $pass);

	$stmt = $dbh->prepare("SELECT city, region 
			FROM cities 
			WHERE city_ascii LIKE :cityentered 
			AND country = 'us' 
			ORDER BY city_ascii LIMIT 20;");

	$stmt->bindParam(":cityentered", $cityentered);
	$stmt->execute();
	$result = $stmt->fetchAll();
	print_r($result);

	//echo json_encode($result);

?>