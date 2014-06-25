<?php
session_start();


echo '
<!DOCTYPE html>
<html>
	<head>
		<title>Admins</title>
	</head>
	<body>

		<div>
			
			<!-- the name can be changed when it gets its styles -->
			<h1>Admin Page</h1>

			<h2>Welcome, '.$_SESSION['username'].'</h2>

			<p>Clients</p>	

			<form id="add-client-form" method="post" action="addClient.php">
				<input type="text" name="client-name" placeholder="Add new client">
				<input type="submit" name="submit" value="Add Client">
			</form>
			
		</div>

';


	$user="root";
	$pass="root";
	$dbh = new PDO('mysql:host=localhost;dbname=clients;port=8889', $user, $pass);
	$stmt = $dbh->prepare("SELECT * FROM clients_table WHERE clientStatusId = 1");
	// $stmt->bindParam(':clientName', $_SESSION["clientname"]);
	// $stmt->bindParam(':clientId', $_SESSION["clientId"]);
	// $stmt->bindParam(':clientStatus', $_SESSION["clientStatus"]);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


	foreach($result as $key){
		echo '
			<div id="current-clients">
				<h3>'.$key['clientName'].'</h3>

				<p><small>Added by <em>'.$key["createdBy"].'</em></small></p>
				<p><a href="notes.php?clientId='.$key['clientId'].'" >View Notes</a></p>
				<div>
					<a id="edit" href="editClient.php?clientId='.$key['clientId'].'">Edit this client</a>
					<a id="delete" href="hideClient.php?clientId='.$key['clientId'].'">Delete this client</a>
				</div>
			</div>
		';
	}





echo '
	</body>
</html>
';

?>