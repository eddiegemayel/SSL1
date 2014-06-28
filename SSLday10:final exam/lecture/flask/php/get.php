<?php 


$user='root';
$pass='root';
$dbh= new PDO('mysql:host=localhost;dbname=ads;port=8889;', $user, $pass);

// QUERY FOR THE DATABASE TO FIND CITIES AND REGIONS
$stmt = $dbh->prepare("SELECT image, link FROM adItems ORDER BY RAND() LIMIT 0,1");

// RUNS QUERY
$stmt->execute();
// FETCHES THE RESULTS FROM THE QUERY AND MAKES IT EASIER TO READ
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);
echo json_encode($result);

?>


