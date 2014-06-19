<?php
/*
Eddie Gemayel
Lab 7
individual challenge
*/
	//log them out, destroy session
	session_start();

	session_destroy();

	// var_dump($_SESSION['username']);
	header("Location: index.php");

?>