<?php
//class
require('class.php');

//Start session
//session_start();

//Create object
$errorObj = new redirect;
$errorObj->goto_login();
?>