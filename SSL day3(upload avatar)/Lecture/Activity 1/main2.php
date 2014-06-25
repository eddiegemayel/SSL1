<?php
	$user="root";
	$pass="root";
	$dbh = new PDO("mysql:host=localhost; dbname=Lab3_db; port=8889", $user,$pass);
	$sql = "SELECT * FROM users";

	$query = $dbh->prepare( $sql );
    $query->execute();
    $results = $query->fetchAll( PDO::FETCH_ASSOC );

// username and password sent from form 
$myusername="eddieisawesome"; 
$mypassword="password"; 

// To protect MySQL injection (more detail about MySQL injection)
$sql="SELECT * FROM $user_table WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
echo "Right Username or Password";
}
else {
echo "Wrong Username or Password";
}

?>