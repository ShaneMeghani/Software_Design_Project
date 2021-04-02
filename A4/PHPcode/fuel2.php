<?php
//class
require('class.php');

//Start session
//session_start();

//Store fuel info into var to be passed in function
 $f_user = $_SESSION["pass_user"];
 $f_gall = $_SESSION["pass_gallons"];
 $f_DA = $_SESSION["pass_fullDA"];
 $f_DD = $_SESSION["pass_DD"];
 $f_sugg = $_SESSION["pass_suggested"];
 $f_final = $_SESSION["pass_final"];

//Create object
$fuel2Obj = new processFuel;
$fuel2Obj->finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final);
?>