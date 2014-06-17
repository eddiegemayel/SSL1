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
			<h1><a href="index.php">PhotoApp</a></h1>
			<a href="login.html">Log In</a>
			<a href="signup.html">Sign Up</a>
			<div class="hr">
			<!-- <hr/> -->
			</div>
		</header>
		<form method="POST" action="getsearch.php">
			<input type="text" name="search" placeholder="Enter a keyword..."/>
			<button class="btn">Search</button>
		</form>
		<?php
		 //collect blogtable info from this specific user
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the blog table where the user id equals the id of logged in user    
        $stmt = $dbh ->prepare("SELECT * from photos LIMIT 5");
       
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($results);
        
        //loop through each blog post the user has (as shown in class)
        foreach($results  as $key){
         
            echo '<div>'; 
            echo '<h2>'.$key['photoName'].'</h2>';
            // echo '<p><a href="edit.php">Edit</a> |';
            // echo ' <a href="delete.php">Delete</a></p>';
            echo '<img src="'.$key['photoUrl'].'"/>';
            echo '<p><strong>Uploaded By:</strong> '.$key['createdBy'].'</p>';
            echo '<p><strong>Tags:</strong> '.$key['tags'].'</p>';
            echo '</div>';
         
        }
        ?>
		</div>
		
	</body>
</html>