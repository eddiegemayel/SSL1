<?php
	session_start();

	$_SESSION["clientId"] =  $_GET["clientId"];

	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=clients; port=8889;", $user,$pass);
	$stmt = $dbh->prepare("SELECT * from clients_table WHERE clientId = :clientId");
	$stmt->bindParam(":clientId",$_SESSION["clientId"], PDO::PARAM_INT);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


	foreach($results as $key){

	?>

		<form method='POST' action='update.php'>
			<input type='text' name='newName' value='<?=$key["clientName"]?>'/>
			<input type='submit' value='Edit'/>
		</form>

<?}?>	