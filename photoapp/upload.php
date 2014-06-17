<?php
	session_start();
	// ob_start();
	$uploaddir = "./uploads/";
	$_SESSION["uploadfile"] = $uploaddir . basename($_FILES["filename"]["name"]);


	if(move_uploaded_file($_FILES["filename"]["tmp_name"], $_SESSION["uploadfile"])){

			//store all their new info into the database
			$user="root";
			$pass="root";
			$dbh = new PDO("mysql:host=localhost; dbname=Photo_db; port=8889;", $user,$pass);
			$stmt = $dbh->prepare("INSERT INTO photos (photoName, photoUrl, createdBy, tags)
				VALUES (:name, :image, :by, :tags)");
			$stmt->bindParam(":name",$_POST["title"]);
			$stmt->bindParam(":image",$_SESSION["uploadfile"]);
			$stmt->bindParam(":by",$_SESSION["username"]);
			$stmt->bindParam(":tags",$_POST["tags"]);

			$stmt->execute();
			$user_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//tell them it worked
			echo "<p>DONE!!</p>";

			// var_dump($_SESSION["username"]);
			//redirect them to login page
			header("Location: profile.php");
		}

		else{
		//if the upload failed	
		echo "Failed to upload.";
		}

?>