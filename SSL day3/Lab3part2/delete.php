<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
		//delete php
		//connect to database
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		//delete based on blogid in the GET
		$stmt = $dbh ->prepare("delete from blog_table where id = :id");
		$stmt->bindParam(':id', $_GET["blogid"], PDO::PARAM_STR);
        $stmt->execute();     
    	//push them back to profile php with updated information
		header("location: profile.php");
?>