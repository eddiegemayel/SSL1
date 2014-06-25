<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
	session_start();
    ob_start();
	//get the login info
	$username = $_POST['usernameLogin'];
	$password =$_POST['passwordLogin'];
	
	try{
        //connnect to database, check login against users table in the database
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		$stmt = $dbh ->prepare("SELECT id,username, password, avatar FROM users_table WHERE username = :usernameLogin and password = :passwordLogin");
		$stmt->bindParam(':usernameLogin', $username , PDO::PARAM_STR);
        $stmt->bindParam(':passwordLogin', $password, PDO::PARAM_STR);
        $stmt->execute();
        $results= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $id = $results[0]['id'];
        $user_name = $results[0]['username'];
        $pass_word =  $results[0]['password'];
        $avatar =  $results[0]['avatar'];
      
        if($id == false){
                //if they are not in database tell them the error
                echo 'You are not in our database.';
       	}
        else{
                //if the login is correct store into session variables for easy global access across all php files
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $user_name;
                $_SESSION['password']= $pass_word;
               $_SESSION['avatarpic']= $avatar;
               //go their profile page
               header('Location: profile.php'); 
        }
	} catch(Exception $e) {
    	echo 'Error -'. $e->getMessage();
    }
?>