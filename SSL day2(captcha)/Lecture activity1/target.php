<?php

$value = "C is for Cookie"
setcookie("TestCookie", $value);

//Print individual cookie
echo $_COOKIE["TestCookie"];

//In one hour cookie is gone
//setcookie("TestCookie", "", time() + 3600)

//Remove cookie for the current page load
//unset($_COOKIE['TestCookie']);

?>