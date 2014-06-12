<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
session_start();
ob_start();

//display their profile page populated with their unique information
echo '<html> 
    <head> 
        <link href = "css/main.css" rel= "stylesheet" />
        <link href="http://fonts.googleapis.com/css?family=Domine|New+Rocker" rel="stylesheet" type="text/css"/>
        <title>Profile Page</title>
    </head>
    <body>        
        <header> 
            <h1>Profile Home</h1>
        </header>
        <div id="wrapper">
            <h2><a href ="index.html">Log Out</a></h2>
            <p> Welcome, <strong>'.$_SESSION['username'].'</strong>!</p>
            <p>This is your password: '.$_SESSION['password'].'</p>
            <img id="avatar_image" src ="'. $_SESSION['avatarpic'].'"/>
            <form method="POST" action="blog.php">
                <div>  
                    <h2>Blog Posts</h2>
                        <div class="labels">
                         <p>Title: </p>
                         <p>Blog Post: </p>
                         </div>

                         <div class="inputss">
                         <input type="text" name = "blog_title" required />
                         <textarea name = "blog_content" required>
                         </textarea>
                         <p><input class="btn"  type = "submit" value ="Post!"/></p> 
                         </div>          
                    </div>    
            </form>';
             
        //collect blogtable info from this specific user
        $user="root";
        $pass="root";
        $dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        //select everything in the blog table where the user id equals the id of logged in user    
        $stmt = $dbh ->prepare("SELECT * from blog_table  WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_STR);
        $stmt->execute();     
        //fetch all the results and put them into an associative arraay
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($results);
        
        //loop through each blog post the user has (as shown in class)
        foreach($results  as $key){
         
            echo '<div class="blogs">';
            echo ' <a href="edit.php?blogid='.$key["id"].'">Edit</a>';
            echo ' <BR><a href="delete.php?blogid='.$key["id"].'">Delete</a>';    
            echo '<h2>'.$key["blog_title"].'</h2>';
            echo '<p>'.$key["blog_content"].'</p>';
            echo '</div>';
         
        }
        //echo closing tags   
        echo '  
        </div>
         
    </body>';
?>