<?php
	
	require "../vendor/autoload.php";
	ORM::configure("mysql:host=localhost;dbname=fruits");
	ORM::configure("username", "root");
	ORM::configure("password","root");

	$app = new \Slim\Slim(array(
		"mode" => "development",
		"debug" => true,
		"templates.path" => "../app/views/",
		"view" => new \Slim\Views\Twig()
		));


	//routes
	$app->get("/hello/:id", function($id) use ($app){
		//echo "Hello $id!";

		$fruits = ORM::for_table("fruit_table")->find_many();
		$app->render("hello.html", array("id" => $id, "fruits"=>$fruits));

		$app->post("/hello", function(){
			
			$_SESSION["fruitname"] = $_POST["fruitname"];
			$_SESSION["fruitcolor"] = $_POST["fruitcolor"];
			// var_dump($_SESSION["fruitname"]);
			// var_dump($_SESSION["fruitcolor"]);
			$user="root";
			$pass="root";
			$dbh = new PDO("mysql:host=localhost; dbname=fruits; port=8889;", $user,$pass);
			$stmt = $dbh->prepare("INSERT INTO fruit_table (name, color) VALUES (:name, :color)");
			$stmt->bindParam(":name",$_SESSION['fruitname']);
			$stmt->bindParam(":color",$_SESSION['fruitcolor']);
			$stmt->execute();

		});
		// $app->flashNow("info", "Your card is stupid");
		// $app->render("hello.html", array("id" => $id));
	});

	$app->run();


	// $app = new \Slim\Slim();
	// $app->get("/books/:id", function($id){
	// 	//show book identified by $id
	// 	echo $id;
	// });
	// $app->post("/books", function(){
	// 	//create book
	// });