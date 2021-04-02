<?php
//class
require('class.php');

//Start session
//session_start();

$u = $_SESSION["pass_user"];

//Create object
$profile2Obj = new update;
$profile2Obj->goto_loginORmainpage($u);
?>