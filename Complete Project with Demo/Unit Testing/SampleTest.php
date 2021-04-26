<?php
use PHPUnit\Framework\TestCase;
require('TestClass.php');

class SampleTest extends TestCase {
    
    public function testRedirectToLogin() {
        $test1_Obj = new redirect;
        $this->assertEquals("header('Location: login.html');", $test1_Obj->goto_login());
    }

    public function testRedirectToError() {
        $test2_Obj = new redirect;
        $this->assertEquals("header('Location: error.html');", $test2_Obj->goto_error());
    }

    public function testRedirectToError2() {
        $test3_Obj = new redirect;
        $this->assertEquals("header('Location: error2.html');", $test3_Obj->goto_error2());
    }

    public function testRedirectToMainpage() {
        $test4_Obj = new redirect;
        $this->assertEquals("header('Location: mainpage.html');", $test4_Obj->goto_mainpage());
    }

    public function testRedirectToProfile() {
        $test5_Obj = new redirect;
        $this->assertEquals("header('Location: profile.html');", $test5_Obj->goto_profile());
    }

    public function testRedirectToFuel() {
        $test6_Obj = new redirect;
        $this->assertEquals("header('Location: fuel.html');", $test6_Obj->goto_fuel());
    }

    public function testRedirectToNewaccount() {
        $test7_Obj = new redirect;
        $this->assertEquals("header('Location: newaccount.html');", $test7_Obj->goto_newaccount());
    }

    public function testLoginWithUpdatedUser() {
        $user = "username";
        $pass = "12345678";
        $test8_Obj = new log;
        $this->assertEquals("header('Location: mainpage.html');", $test8_Obj->user_login($user, $pass));
    }

    public function testLoginWithNonUpdatedUser() {
        $user = "username2";
        $pass = "12345678";
        $test9_Obj = new log;
        $this->assertEquals("header('Location: profile.html');", $test9_Obj->user_login($user, $pass));
    }

    public function testLoginWithUserNotInDB() {
        $user = "username3";
        $pass = "12345678";
        $test10_Obj = new log;
        $this->assertEquals("header('Location: error.html');", $test10_Obj->user_login($user, $pass));
    }

    public function testLoginWithWrongPassword() {
        $user = "username4";
        $pass = "12345678";
        $test11_Obj = new log;
        $this->assertEquals("header('Location: error.html');", $test11_Obj->user_login($user, $pass));
    }

    public function testMakeAccountWithUserAlreadyInDB() {
        $user_n = "username";
        $pass_n = "12345678";
        $test12_Obj = new update;
        $this->assertEquals("header('Location: error2.html');", $test12_Obj->makeAccount($user_n, $pass_n));
    }

    public function testMakeAccountWithNewUser() {
        $user_n = "username3";
        $pass_n = "12345678";
        $test13_Obj = new update;
        $this->assertEquals("header('Location: login.html');", $test13_Obj->makeAccount($user_n, $pass_n));
    }

    public function testUpdateInfoWithUpdatedUser() {
        $u = "username";
        $fname = "fname";
        $lname = "lname";
        $dob = "12/12/1997";
        $EM = "user@mail.com";
        $phone = "281-281-281";
        $add1 = "1203 cheap street drive";
        $add2 = "1204 cheap street drive";
        $city = "houston";
        $zip = "77777";
        $state = "TX";
        $CC = "9999 9999 9999 9999";
        $test14_Obj = new update;
        $this->assertEquals("Got into else", $test14_Obj->updateInfo($u, $fname, $lname, $dob, $EM, $phone, $add1, $add2, $city, $zip, $state, $CC));
    }

    public function testUpdateInfoWithNonUpdatedUser() {
        $u = "username2";
        $fname = "fname";
        $lname = "lname";
        $dob = "12/12/1997";
        $EM = "user@mail.com";
        $phone = "281-281-281";
        $add1 = "1203 cheap street drive";
        $add2 = "1204 cheap street drive";
        $city = "houston";
        $zip = "77777";
        $state = "TX";
        $CC = "9999 9999 9999 9999";
        $test15_Obj = new update;
        $this->assertEquals("Got into if", $test15_Obj->updateInfo($u, $fname, $lname, $dob, $EM, $phone, $add1, $add2, $city, $zip, $state, $CC));
    }

    public function testRedirectNonUpdatedUser() {
        $u = "username";
        $test16_Obj = new update;
        $this->assertEquals("header('Location: login.html');", $test16_Obj->goto_loginORmainpage($u));
    }

    public function testRedirectUpdatedUser() {
        $u = "username2";
        $test17_Obj = new update;
        $this->assertEquals("header('Location: mainpage.html');", $test17_Obj->goto_loginORmainpage($u));
    }

    public function testFuelCalcWithFakeAddress() {
        $GoF = 5;
        $DA = "fake";
        $DD = "12/12/2021";
        $UN = "usernamefake";
        $test18_Obj = new processFuel;
        $this->assertEquals("header('Location: error4.html');", $test18_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testFinalPriceCalculationWithInStateUser() {
        $GoF = 1;
        $DA = "1203 streetname";
        $DD = "12/12/2021";
        $UN = "username1";
        $test19_Obj = new processFuel;
        $this->assertEquals(1.725, $test19_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testFinalPriceCalculationWithNotInStateUser() {
        $GoF = 1;
        $DA = "1203 streetname";
        $DD = "12/12/2021";
        $UN = "username11";
        $test19_Obj = new processFuel;
        $this->assertEquals(1.755, $test19_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testFinalPriceCalculationWithUserThatHasHistory() {
        $GoF = 1;
        $DA = "1203 streetname";
        $DD = "12/12/2021";
        $UN = "username111";
        $test19_Obj = new processFuel;
        $this->assertEquals(1.71, $test19_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testFinalPriceCalculationWithUserThatGetsBigOrderDiscount() {
        $GoF = 1500;
        $DA = "1203 streetname";
        $DD = "12/12/2021";
        $UN = "username1111";
        $test19_Obj = new processFuel;
        $this->assertEquals(2542.50, $test19_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testIfGoodUserReachesEndOfFunction() {
        $GoF = 5;
        $DA = "1203 streetname";
        $DD = "12/12/2021";
        $UN = "username2";
        $test20_Obj = new processFuel;
        $this->assertTrue($test20_Obj->calcFuel($GoF, $DA, $DD, $UN));
    }

    public function testCompanyTotalGallons() {
        $f_user = "username";
        $f_gall = 1;
        $f_DA = "1203 cheap street drive";
        $f_DD = "12/12/2021";
        $f_sugg = 10;
        $f_final = 10.8;
        $test21_Obj = new processFuel;
        $this->assertEquals(2, $test21_Obj->finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final));
    }

    public function testCompanyTotalProfit() {
        $f_user = "username2";
        $f_gall = 5;
        $f_DA = "1203 cheap street drive";
        $f_DD = "12/12/2021";
        $f_sugg = 10;
        $f_final = 10.08;
        $test22_Obj = new processFuel;
        $this->assertEquals(0.9, $test22_Obj->finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final));
    }

    public function testCountInFuelClass() {
        $f_user = "username4";
        $f_gall = 1;
        $f_DA = "1203 cheap street drive";
        $f_DD = "12/12/2021";
        $f_sugg = 10;
        $f_final = 10.08;
        $test23_Obj = new processFuel;
        $this->assertEquals(3, $test23_Obj->finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final));
    }

    public function testGetHistoryOfUserWithNoPurchases() {
        $h_user = "username";
        $test24_Obj = new userHistory;
        $this->assertEquals("No History", $test24_Obj->getHistory($h_user));
    }

    public function testGetHistoryOfUserWithPurchases() {
        $h_user = "username2";
        $test25_Obj = new userHistory;
        $this->assertEquals("History", $test25_Obj->getHistory($h_user));
    }

    public function testGetCompanyStatsWhenNotEmployee() {
        $e_user = "username";
        $test26_Obj = new stats;
        $this->assertEquals("header('Location: error3.html');", $test26_Obj->getStats($e_user));
    }

    public function testGetCompanyStatsWhenEmployee() {
        $e_user = "username2";
        $test27_Obj = new stats;
        $this->assertTrue($test27_Obj->getStats($e_user));
    }
}
?>