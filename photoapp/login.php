<?php
/*
Eddie Gemayel
Lab 7
individual challenge
*/
	session_start();

	//collect login info
	$username = $_POST['usernameLogin'];
	$password = md5($_POST['passwordLogin']);
	
	try{
        //connnect to database, check login against users table in the database
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Photo_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		$stmt = $dbh ->prepare("SELECT id,username, password FROM users WHERE username = :usernameLogin and password = :passwordLogin");
		$stmt->bindParam(':usernameLogin', $username , PDO::PARAM_STR);
        $stmt->bindParam(':passwordLogin', $password, PDO::PARAM_STR);
        $stmt->execute();
        $results= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = $results[0]['id'];
        $user_name = $results[0]['username'];
        $pass_word =  $results[0]['password'];
      
        if($id == false){
                //if they are not in database tell them the error
                echo '<!DOCTYPE html>
<html>
	<head>
		<title>PhotoApp | Sign Up</title>
		<link rel="stylesheet" href="css/main.css"/>
	</head>
	<body>
		<header>
			<h1>PhotoApp</h1>
		</header>
		<p>You are not in our database.</p>
				<a href="login.html">Go Back to Log In</a>
				<div>
		<p class="center">Created by Eddie Gemayel | 
		PhotoApp</p>
	</div>

	</body>
</html>';
       	}
        else{
                //if the login is correct store into session variables for easy global access across all php files
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $user_name;
                // $_SESSION['password']= $pass_word;
               
               // var_dump($_SESSION['user_id']);
               // var_dump($_SESSION['username']);
               // var_dump($_SESSION['password']);
               //go their profile page
               header('Location: profile.php'); 
               //echo "Nice";
        }
	} catch(Exception $e) {
    	echo 'Error -'. $e->getMessage();
    }
	
?>