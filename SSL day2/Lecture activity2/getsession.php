<?php 
	session_start();
	ini_set("session.gc_maxlifetime", 60);
	var_dump($_SESSION);
?>