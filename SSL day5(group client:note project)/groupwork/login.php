<?php
// Team Challenge 1 - Lab 5
// 6-12-14
// Nicole Carvalho
// Gabriel Ferraz
// Eddie Gemayel
// Julian Rodriguez


	session_start();
	$username = $_POST['username'];
	$_SESSION['username'] = $username;
	$password = $_POST['password'];
	// makes the connection and query to the database
	try{
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=clients;port=8889', $user, $pass);
		$stmt = $dbh->prepare("SELECT username, password FROM admin WHERE username = :username and password = :password");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	// var_dump($result);   
        if($result== false){
            echo 'Login Failed';
       	}
        else{
        	header('Location: admins.php');
			$_SESSION['username'] = $username;
			$_SESSION['password']= $password; 
        }//closes the else
	} catch(Exception $e) {
    	print 'Caught exception'. $e->getMessage();
    }



?>
