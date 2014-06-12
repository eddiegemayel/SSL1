<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
session_start();
ob_start();	
				//take username and password from session
				$username = $_SESSION['username'];
				$password = $_SESSION['password'];
				//take what they typed into the input fields
				$_SESSION['title'] = $_POST['blog_title'];
				$_SESSION['text'] = $_POST['blog_content'];
				
				//connect to database
				$user="root";
				$pass="root";
				$dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
				$stmt = $dbh->prepare("SELECT id FROM users_table WHERE name = :name AND password = :password LIMIT 1");
				$stmt->bindParam(':name',$username, PDO::PARAM_STR);
				$stmt->bindParam(':password',$password, PDO::PARAM_STR);
				$stmt->execute();
				$results= $stmt->fetchAll(PDO::FETCH_ASSOC);
				$id = $results[0]['id'];
				//selecting their id from the databsae

				//var_dump($id);
				//now insert thier blog entry with all the collected information
				$stmt1 = $dbh ->prepare("INSERT INTO blog_table (user_id, blog_title, blog_content) VALUES (:user_id,:blog_title, :blog_content)");
				$stmt1 ->bindParam(':user_id', $_SESSION['user_id']);
				$stmt1 ->bindParam(':blog_title', $_SESSION['title']);
				$stmt1 ->bindParam(':blog_content', $_SESSION['text']);
				$stmt1->execute();
				//if its not empty push into database and then move back to their profile page
				if (!empty ($stmt1)){
					$_SESSION['title'] = $_SESSION['title'];
					$_SESSION['text'] =  $_SESSION['text'];
					header('Location: profile.php');
				}
				else{
					//if its empty just display this
					$_SESSION['title'] = "You entered no title";
					$_SESSION['text'] = "You entered no content";
				}
				
				
?>