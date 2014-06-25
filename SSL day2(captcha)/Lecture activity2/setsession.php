<?php

	// session_start();
	// $_SESSION["name"] = $_POST["firstname"];
	// echo $_SESSION["name"];

	var_dump($_FILES["filename"]["name"]);

	$uploaddir = "./uploads/";
	$uploadfile = $uploaddir . basename($_FILES["filename"]["name"]);

	if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploadfile)){
		echo "File uploaded";
	}
	else{
		echo "failed ";
	}

?>