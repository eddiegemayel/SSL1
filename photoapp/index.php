<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PhotoApp | Home</title>
		<link rel="stylesheet" href="css/main.css"/>
	</head>
	<body>
		<header>
			<h1 id="clear"><a  href="index.php">PhotoApp</a></h1>
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
		<h2>Welcome! Here are some recent posts!</h2>
		
		<?php
		 //collect blogtable info from this specific user
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the blog table where the user id equals the id of logged in user    
        $stmt = $dbh ->prepare("SELECT * from photos LIMIT 6");
       
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($results);
        
        //loop through each blog post the user has (as shown in class)
        foreach($results  as $key){
         
            echo '<div class="image">'; 
            echo '<h3>'.$key['photoName'].'</h3>';
            echo '<img height="300px" width="300px" src="'.$key['photoUrl'].'"/>';
            echo '<p><strong>Uploaded By:</strong> <a href="searchUser.php?q='.$key['createdBy'].'">'.$key['createdBy'].'</a></p>';
            echo '<p><strong>Tags:</strong> <a href="searchTag.php?q='.$key['tags'].'">'.$key['tags'].'</a></p>';
            echo '</div>';
         
        }
        ?>
		</div>
		
	</body>
</html>