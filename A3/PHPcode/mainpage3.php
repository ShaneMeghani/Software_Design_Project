<?php
//class
require('class.php');

//Start session
//session_start();

//Get username from session
$h_user = $_SESSION["pass_user"];

//Create object
$mianpage3Obj = new userHistory;
$mianpage3Obj->getHistory($h_user);
?>