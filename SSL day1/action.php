<?php 

//phpinfo();
/*
	Eddie Gemayel
	June 3 2014
	Lab 1
*/

//this function gets the info submitted
function form_get_function(){

	//making variables and collecting each input data
	$firstname = $_POST["f-name"];
	$lastname = $_POST["l-name"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$url = $_POST["url"];

	//array of the information stored  
	$info = array(
		"First Name" => $firstname,
		"Last Name" => $lastname,
		"Address" => $address,
		"City" => $city,
		"State" => $state,
		"Zipcode" => $zip,
		"Email" => $email,
		"Phone Number" => $phone,
		"URL" => $url
		);

	//return the array of stored information
	return $info;
};

//var_dump();


//storing function into a variables
$form_data = form_get_function();

//this for each loop loops through the given data and displays it on the next page 
foreach ($form_data as $key => $value) {
	$temp = strtoupper($value);
	if($temp == "FL")
		echo $key, " : " , strtoupper($value) . " - The Sunshine State", "<br/>";
	else if ($temp  == "NY")
		echo $key, " : " , strtoupper($value) . " - The Empire State", "<br/>";
	else if($temp == "")
		echo $key, "  : <strong> Error - nothing entered. </strong>", "<br/>";
	else
		echo $key, " : ", $value, "<br/>";
}

?>