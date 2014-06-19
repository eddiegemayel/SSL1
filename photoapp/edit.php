<?php
session_start();
/*
Eddie Gemayel
Lab 7
individual challenge
*/
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

        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select current photo user wants to edit from the GET
        $stmt = $dbh ->prepare("SELECT * from photos  WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION["photoId"], PDO::PARAM_STR);
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($results);
        
        // //loop and display
        foreach($results  as $key){
         

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