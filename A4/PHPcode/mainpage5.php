<?php
//class
require('class.php');

//Start session
//session_start();

$e_user = $_SESSION["pass_user"];

//Create object
$mainpage5Obj = new stats;
$mainpage5Obj->getStats($e_user);
?>