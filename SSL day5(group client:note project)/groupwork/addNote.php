<?php
	session_start();

	$_SESSION["newnote"] = $_POST["note"];
	$note = $_SESSION["newnote"];

	//var_dump($_SESSION["newnote"]);

	//connect to database
	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=clients; port=8889;", $user,$pass);
	$stmt = $dbh->prepare("INSERT INTO notes (content, createdBy) VALUES (:content, :user)");
	$stmt->bindParam(":content",$_SESSION['newnote']);
	$stmt->bindParam(":user",$_SESSION['username']);
	$stmt->execute();

	$stmt1 = $dbh->prepare("SELECT noteId FROM notes WHERE content = :noteContent");
	$stmt1->bindParam(":noteContent",$note);
	$stmt1->execute();
	$stmt1=$stmt1->FetchALL(PDO::FETCH_ASSOC);
	$noteId = $stmt1[0]['noteId'];


	$stmt2 = $dbh->prepare("UPDATE notes set clientId = :clientId  where noteId = :noteId");
	$stmt2->bindParam(":noteId",$noteId, PDO::PARAM_INT);
	$stmt2->bindParam(":clientId",$_SESSION["clientId"], PDO::PARAM_INT);
	$stmt2->execute();

	//var_dump($_SESSION["clientId"]);

	 header("location: admins.php");

?>