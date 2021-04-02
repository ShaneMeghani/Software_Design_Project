<?php
//class
require('class.php');

//Start session
//session_start();

//Get login info
$user = $_POST['user_name'];
$pass = $_POST['password'];

//set session var
$_SESSION["pass_user"] = $user;

//Create Object
$login1Obj = new log;
$login1Obj->user_login($user, $pass);
?>