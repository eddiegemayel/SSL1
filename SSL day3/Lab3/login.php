<?php
/*
Eddie Gemayel
June 7 2014
Lab 3
*/

	session_start();
	// ob_start();

	
	

    $username = $_POST["usernameLogin"];
    $password = $_POST["passwordLogin"];
    

	//var_dump($_SESSION["$uploadfile"]);
	
	if($username === $_SESSION['username'] and $password ===$_SESSION["password"]){

		echo "<h1> Welcome, ", $_SESSION["username"], "! </h1>";
		echo "<p>Your File uploaded!</p>";
		echo "Your Avatar: <img src='". $_SESSION["$uploadfile"] . "'/><br/>";
		echo "<p>", $_SESSION["password"], "</p>";

	}
	else{
		echo "Failed to login. Username/password incorrect. Go back to log in page and try again.";
	}

?>