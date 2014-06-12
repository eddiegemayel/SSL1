<?php
	session_start();
	// $_SESSION['user_name'] = $_POST['user_name'];
	// 	$_SESSION['user_password'] = $_POST['user_password'];
	$username = $_POST['username'];
	$userpassword =$_POST['userpassword'];
	// makes the connection and query to the database
	try{
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=users; port=8889', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets the error mode to exceptions        
		$stmt = $dbh ->prepare("SELECT id,name, password, avatar FROM users_table WHERE name = :username and password = :userpassword");
		$stmt->bindParam(':username', $user_name , PDO::PARAM_STR);
        $stmt->bindParam(':userpassword', $user_password, PDO::PARAM_STR);
        //var_dump($stmt);
        $stmt->execute();     
        //$user_id = $stmt->fetchAll();
        $user_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
       // var_dump($user_id);    
        if($user_id == false){
                echo 'Login Failed';
       	}
        else{
        		//$_SESSION['user_avatar']=$avatar;
                $_SESSION['user_id'] = $user_id[0]['id'];
                $_SESSION['username'] = $username;
                $_SESSION['password']= $userpassword;
                $_SESSION['user_avatar']= $user_id[0]['avatar'];
                //var_dump($_SESSION['user_picture']);
               header('Location: profile.php'); 
        }//closes the else
	} catch(Exception $e) {
    	print 'Caught exception'. $e->getMessage();
    }
?>