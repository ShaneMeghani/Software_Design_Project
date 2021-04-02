<?php
use PHPUnit\Framework\TestCase;

require('class.php');

class FunctionTest extends TestCase {

    public function testRedirectToLogin() {
        $test1_Obj = new redirect;
        $this->assert($test1_Obj->goto_login());
    }

    public function testRedirectToError() {
        $test2_Obj = new redirect;
        $this->assert($test2_Obj->goto_error());
    }

    public function testRedirectToError2() {
        $test3_Obj = new redirect;
        $this->assert($test3_Obj->goto_error2());
    }

    public function testRedirectToMainpage() {
        $test4_Obj = new redirect;
        $this->assert($test4_Obj->goto_mainpage());
    }

    public function testRedirectToProfile() {
        $test5_Obj = new redirect;
        $this->assert($test5_Obj->goto_profile());
    }

    public function testRedirectToFuel() {
        $test6_Obj = new redirect;
        $this->assert($test6_Obj->goto_fuel());
    }

    public function testRedirectToNewaccount() {
        $test7_Obj = new redirect;
        $this->assert($test7_Obj->goto_newaccount());
    }

    public function testLoginWithUpdatedUser() {
        $user = "username";
        $pass = "12345678";
        $test8_Obj = new log;
        $this->assert($test8_Obj->user_login($user, $pass));
    }

    public function testLoginWithNonUpdatedUser() {
        $user = "username2";
        $pass = "12345678";
        $test9_Obj = new log;
        $this->assert($test9_Obj->user_login($user, $pass));
    }

    public function testLoginWithUserNotInDB() {
        $user = "username3";
        $pass = "12345678";
        $test10_Obj = new log;
        $this->assert($test10_Obj->user_login($user, $pass));
    }

    public function testMakeAccountWithUserAlreadyInDB() {
        $user_n = "username";
        $pass_n = "12345678";
        $test11_Obj = new update;
        $this->assert($test11_Obj->makeAccount($user_n, $pass_n));
    }

    public function testMakeAccountWithNewUser() {
        $user_n = "username3";
        $pass_n = "12345678";
        $test12_Obj = new update;
        $this->assert($test12_Obj->makeAccount($user_n, $pass_n));
    }

    public function testUpdateInfoWithUser() {
        $u = "username";
        $fname = "fname";
        $lname = "lname";
        $dob = "12/12/1997";
        $phone = "281-281-281";
        $add1 = "1203 cheap street drive";
        $add2 = "1204 cheap street drive";
        $city = "houston";
        $zip = "77777";
        $state = "TX"; 
        $test13_Obj = new update;
        $this->assert($test13_Obj->updateInfo($u, $fname, $lname, $dob, $phone, $add1, $add2, $city, $zip, $state));
    }

    public function testFuelCalc() {
        $GoF = 5;
        $DA = "1203 cheap street drive";
        $DD = "12/12/2021";
        $test14_Obj = new processFuel;
        $this->assert($test14_Obj->calcFuel($GoF, $DA, $DD));
    }

    public function testFinalizeFuelPurchase() {
        $f_user = "username";
        $f_gall = 1;
        $f_DA = "1203 cheap street drive";
        $f_DD = "12/12/2021";
        $f_sugg = 10;
        $f_final = 10.8;
        $test15_Obj = new processFuel;
        $this->assert($test15_Obj->finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final));
    }

    public function testGetHistoryOfUserWithNoPurchases() {
        $h_user = "username";
        $test16_Obj = new userHistory;
        $this->assert($test16_Obj->getHistory($h_user));
    }

    public function testGetHistoryOfUserWithPurchases() {
        $h_user = "username2";
        $test17_Obj = new userHistory;
        $this->assert($test17_Obj->getHistory($h_user));
    }

}
?>