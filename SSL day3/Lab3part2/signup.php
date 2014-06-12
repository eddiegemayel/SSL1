<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/

	session_start();
	ob_start();

	//store user inputs into variables
	$newuser = $_POST["username"];
	$newpass = $_POST["password"];
	$_SESSION['thecap'] = $_POST["captcha"];
	

	//upload directiory for their avatar
	$uploaddir = "./uploads/";
	$_SESSION["uploadfile"] = $uploaddir . basename($_FILES["filename"]["name"]);


	//if the captcha is right
	if($_SESSION['thecap'] == $_SESSION["captcha-word"]){
		//and if the file uploads successfully
		if(move_uploaded_file($_FILES["filename"]["tmp_name"], $_SESSION["uploadfile"])){
			//store all their new info into the database
			$user="root";
			$pass="root";
			$dbh = new PDO("mysql:host=localhost; dbname=Lab3_db; port=8889;", $user,$pass);
			$stmt = $dbh->prepare("INSERT INTO users_table (username, password, avatar)
				VALUES (:name, :value, :image)");
			$stmt->bindParam(":name",$newuser);
			$stmt->bindParam(":value",$newpass);
			$stmt->bindParam(":image",$_SESSION["uploadfile"]);

			$stmt->execute();
			$user_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//tell them it worked
			echo "<p>DONE!!</p>";

			//redirect them to login page
			header("Location: login.html");
		}

		else{
		//if the upload failed	
		echo "Failed to upload.";
		}

	}else{
		//if the captcha was wrong
		header("Location: index.html");
		echo "<p>Error - captcha wrong</p>";
	}
?>