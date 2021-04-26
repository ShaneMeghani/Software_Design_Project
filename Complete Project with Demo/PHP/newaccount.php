<?php
//class
require('class.php');

//Start session
//session_start();

//Get new user info
$user_n = $_POST['u-name'];
$pass_n = $_POST['newpassword'];

//Create Object
$newaccountObj = new update;
$newaccountObj->makeAccount($user_n, $pass_n);
?>