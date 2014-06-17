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
            <a href="login.html">Log In</a>
            <a href="signup.html">Sign Up</a>
            <form method="POST" action="logout.php">
                <button class="btn">Log Out</button>
            </form>
            <div class="hr">
            <!-- <hr/> -->
            </div>
        </header>
        <div id="wrapper">
            <p> Welcome, <strong><em>'.$_SESSION['username'].'</em></strong>!</p>
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <p>Upload a Picture </p>
                <p><input type="file" name="filename"/></p>
                <p>Picture Title </p>
                <p><input type="text" name="title"/></p>
                <p>Tags</p>
                <p><input type="text" name="tags"/></p>
                <button class="btn">Submit</button>
            </form>';
        
         //collect blogtable info from this specific user
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the blog table where the user id equals the id of logged in user    
        $stmt = $dbh ->prepare("SELECT * from photos  WHERE createdBy = :username");
        $stmt->bindParam(':username', $_SESSION["username"], PDO::PARAM_STR);
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($results);
        
        //loop through each blog post the user has (as shown in class)
        foreach($results  as $key){
         
            echo '<div>'; 
            echo '<h2>'.$key['photoName'].'</h2>';
            echo '<p><a href="edit.php?photoId='.$key['id'].'">Edit</a> |';
            echo ' <a href="delete.php?photoId='.$key['id'].'">Delete</a></p>';
            echo '<img src="'.$key['photoUrl'].'"/>';
            echo '<p><strong>Uploaded By:</strong> '.$key['createdBy'].'</p>';
            echo '<p><strong>Tags:</strong> '.$key['tags'].'</p>';
            echo '</div>';
         
        }


        //echo closing tags   
        echo '  
        </div>
         
    </body>';
?>