<?php
	
	session_start();

	//take word from txt file
	$word = file("dict.txt", FILE_IGNORE_NEW_LINES);

	//get a random word and store into variable
	$words = $word[array_rand($word)];

	//test var
	//$message = "Hello";



	
	// $rand_keys = array_rand($words, 1);
	// $random = $words[$rand_keys[0]];

//this makes captcha
function message($msg){
	$container = imagecreate(190, 130);
	//$container = imagecreate(300, 300);
	$black = imagecolorallocate($container, 0,0,0);
	$white = imagecolorallocate($container, 255, 255, 255);
	$font = 'fonts/Verdana.ttf';
	imagefilledrectangle($container, 0, 0, 250, 150, $black);
	imagerectangle($container, 0,0,300,200,$white);
	imagefttext($container, 12,0,70,70,$white,$font,$msg);
	header("Content-Type: image/png");
	imagepng($container, null);
	imagedestroy($container);
};

//call captcha function
message($words);

//store it into a global session variable
$_SESSION["captcha-word"] = $words;

?>