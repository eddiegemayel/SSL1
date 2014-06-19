<?php
session_start();
?>

<!DOCTYPE html>
	<html> 
    <head> 
        <link href = "css/main.css" rel= "stylesheet" />
        <title>PhotoApp | Edit</title>
    </head>
    <body>        
        <header>
            <h1><a href="index.php">PhotoApp</a></h1>
            <a class="right" href="login.html">Log In</a>
            <a class="right" href="signup.html">Sign Up</a>
            <a href="profile.php">Back to Profile</a>
            <form method="POST" action="logout.php">
                <button class="btn">Log Out</button>
            </form>
            <div class="hr">
            <!-- <hr/> -->
            </div>
        </header>


<?php	
	
	$_SESSION["photoId"] = $_GET["photoId"];
//collect blogtable info from this specific user
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the blog table where the user id equals the id of logged in user    
        $stmt = $dbh ->prepare("SELECT * from photos  WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION["photoId"], PDO::PARAM_STR);
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($results);
        
        // //loop through each blog post the user has (as shown in class)
        foreach($results  as $key){
         
        //     echo '<div>'; 
        //     echo '<h2>'.$key['photoName'].'</h2>';
        //     echo '<p><a href="edit.php?photoId='.$key['id'].'">Edit</a> |';
        //     echo ' <a href="delete.php?photoId='.$key['id'].'">Delete</a></p>';
        //     echo '<img src="'.$key['photoUrl'].'"/>';
        //     echo '<p><strong>Uploaded By:</strong> '.$key['createdBy'].'</p>';
        //     echo '<p><strong>Tags:</strong> '.$key['tags'].'</p>';
        //     echo '</div>';
         
        // }

?>

<h2>Your Photo</h2>
<form method="POST" action="update.php">
	
						 <input type="text" name ="photoName" value="<?=$key["photoName"]?>"/>
						 
						<p><input class='btn'  type = "submit" value ="Edit"/></p>	
					 
		
</form>
</body>
</html>

<?php

}

?>