<?php
/*
Eddie Gemayel
Lab 7
individual challenge
*/
session_start();
ob_start();

//display their profile page populated with their unique information
echo '<html> 
    <head> 
        <link href = "css/main.css" rel= "stylesheet" />
        <title>PhotoApp | Profile</title>
    </head>
    <body>        
        <header>
            <h1><a href="index.php">PhotoApp</a></h1>
            <a class="right" href="login.html">Log In</a>
            <a class="right" href="signup.html">Sign Up</a>
            <form class="right" method="POST" action="logout.php">
                <button class="btn">Log Out</button>
            </form>
            <div class="hr">
            <!-- <hr/> -->
            </div>
        </header>
        <div id="wrapper">
            <p> Welcome, <strong><em>'.$_SESSION['username'].'</em></strong>!</p>
            <form id="log" method="POST" action="upload.php" enctype="multipart/form-data">
                <p class="form">Upload a Picture (300px By 300px)</p>
                <p class="form"><input type="file" name="filename"/></p>
                <p class="form">Picture Title </p>
                <p class="form"><input type="text" name="title"/></p>
                <p class="form">Tags (SEPERATE BY SPACES)</p>
                <p class="form"><input type="text" name="tags"/></p>
                <button class="btn form">Submit</button>
            </form>
            <h2>'.$_SESSION['username'].'&#39;s Photos</h2>'
            ;
        
         //connect to database
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the photo table where created by equals currently logged in user   
        $stmt = $dbh ->prepare("SELECT * from photos  WHERE createdBy = :username ORDER BY id DESC");
        $stmt->bindParam(':username', $_SESSION["username"], PDO::PARAM_STR);
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($results);
        
        //loop and display
        foreach($results  as $key){
         
            echo '<div class="image">'; 
            echo '<h3>'.$key['photoName'].'</h3>';
            echo '<p><a href="edit.php?photoId='.$key['id'].'">Edit</a> |';
            echo ' <a href="delete.php?photoId='.$key['id'].'">Delete</a></p>';
            echo '<img height="300px" width="300px" src="'.$key['photoUrl'].'"/>';
            echo '<p><strong>Uploaded By:</strong> '.$key['createdBy'].'</p>';
            echo '<p><strong>Tags:</strong> '.$key['tags'].'</p>';
            echo '</div>';
         
        }

?>

<div>
        <p class="center">Created by Eddie Gemayel | 
        PhotoApp</p>
    </div>
    </body>
    
</html>