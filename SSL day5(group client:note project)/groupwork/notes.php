<?php
	session_start();
	$_SESSION["clientId"] = $_GET["clientId"];

	$user="root";
	$pass="root";
	$dbh = new PDO('mysql:host=localhost;dbname=clients;port=8889', $user, $pass);
	$stmt = $dbh->prepare("SELECT * FROM notes WHERE clientId = :clientId");
	$stmt->bindParam(':clientId', $_SESSION["clientId"]);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//var_dump($_GET['clientId']);

	foreach($result as $key){
		echo '
			<div id="current-notes">
				<p><small>Added by <em>'.$key["createdBy"].'</em></small></p>
				<p>'.$key['content'].'</p>
			</div>
		';
	}


?>

<form method='POST' action='addNote.php'>
	<input type="text" name="note"/>
	<input type="submit" value="Add"/>
</form>