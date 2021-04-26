<?php
//class
require('class.php');

//Start session
//session_start();

//Get info
$GoF = $_POST['gallons'];
$DA = $_POST['DA'];
$DD = $_POST['DD'];
$UN = $_SESSION["pass_user"];

//set session var
$_SESSION["pass_gallons"] = $GoF;
$_SESSION["pass_DA"] = $DA;
$_SESSION["pass_DD"] = $DD;

//Create object
$fuel1Obj = new processFuel;
$fuel1Obj->calcFuel($GoF, $DA, $DD, $UN);
?>