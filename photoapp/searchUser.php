<?php
	session_start();
	$search = $_GET["q"];

?>
<!DOCTYPE html>
	<html> 
    <head> 
        <link href = "css/main.css" rel= "stylesheet" />
        <title>PhotoApp | Search</title>
    </head>
    <body>        
        <header>
            <h1><a href="index.php">PhotoApp</a></h1>
            <a class="right" href="login.html">Log In</a>
            <a class="right" href="signup.html">Sign Up</a>
            <div class="hr">
            <!-- <hr/> -->
            </div>
            <form id="search" method="POST" action="getsearch.php">
			<input type="text" name="search" placeholder="Enter a keyword..."/>
			<button class="btn">Search</button>
		</form>
        </header>
        <h2>Results for user "<?=$search?>"</h2>
<?php
			
			$user="root";
			$pass="root";
			$dbh = new PDO("mysql:host=localhost; dbname=Photo_db; port=8889;", $user,$pass);
			$stmt = $dbh->prepare("SELECT * FROM photos WHERE createdBy = :name");
			$stmt->bindParam(":name",$search, PDO::PARAM_STR);

			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($results);

			foreach($results  as $key){

            echo '<div class="image">'; 
            echo '<h3>'.$key['photoName'].'</h3>';
            echo '<img height="300px" width="300px" src="'.$key['photoUrl'].'"/>';
            echo '<p><strong>Uploaded By:</strong> <a href="searchUser.php?q='.$key['createdBy'].'">'.$key['createdBy'].'</a></p>';
            echo '<p><strong>Tags:</strong> <a href="searchTag.php?q='.$key['tags'].'">'.$key['tags'].'</a></p>';
            echo '</div>';
         
        }

?>