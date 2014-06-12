<?php
/*
Eddie Gemayel
June 10 2014
Lab 3(part2)
*/
		//connect to DB
		$user="root";
		$pass="root";
		$dbh=new PDO('mysql:host=localhost; dbname=Lab3_db; port=8889;', $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      
		//only select blog posts with unique blog id that is going to be edited
		$stmt = $dbh ->prepare("SELECT * from blog_table  WHERE id = :blog_id");
		$stmt->bindParam(':blog_id', $_GET["blogid"], PDO::PARAM_STR);
        $stmt->execute();     
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($results);
    	
    	//display the blog post with the blogid from the GET	 
		foreach($results  as $key){
?>
 <head> 
        <link href = "css/main.css" rel= "stylesheet" />
        <link href="http://fonts.googleapis.com/css?family=Domine|New+Rocker" rel="stylesheet" type="text/css"/>
        <title>Edit Page</title>
</head>
<form id="profile_form" method="POST" action="update.php">
				<div class="blog">	
					<h2>Your Blog</h2>
					<div class="labels">
						 <p>Title: </p>
						 <p>Blog Post: </p>
					</div>

					<div class="inputss">
						  <input name="blogid" type="hidden" value="<?=$key["id"]?>"/>
						 <input type="text" name = "blog_title" required  value="<?=$key["blog_title"]?>"/>
						 <textarea name = "blog_text" required>
							<?=$key["blog_content"]?>
						 </textarea>
						<p><input class='btn'  type = "submit" value ="Edit"/></p>	
					</div>	 
					</div>	
</form>

<? } ?>