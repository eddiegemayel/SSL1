<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
		//update.php
		//connect to database
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		//update specific blogpost with unique id
		$stmt = $dbh ->prepare("update blog_table set blog_title = :blogtitle , blog_content = :blogcontent
								where id = :id");
		//push new info entered by user
		$stmt->bindParam(':blogtitle', $_POST["blog_title"], PDO::PARAM_STR);
		$stmt->bindParam(':blogcontent', $_POST["blog_text"], PDO::PARAM_STR);
		$stmt->bindParam(':id', $_POST["blogid"], PDO::PARAM_STR);
        $stmt->execute();     
    	//push user back to their profile
		header("location: profile.php");
?>