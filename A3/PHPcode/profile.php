<?php
//class
require('class.php');

//Start session
//session_start();

//Get updated user info
$fname = $_POST['FN'];
$lname = $_POST['LN'];
$dob = $_POST['birthday'];
$phone = $_POST['TN'];
$add1 = $_POST['A1'];
$add2 = $_POST['A2'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$state = $_POST['whichstate'];

//Create Object
$u = $_SESSION["pass_user"];
$profileObj = new update;
$profileObj->updateInfo($u, $fname, $lname, $dob, $phone, $add1, $add2, $city, $zip, $state);
?>


