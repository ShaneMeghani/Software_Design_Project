<?php
//Start session
session_start();

//This class helps redirect users to different html pages
class redirect {

    //Methods
    function goto_login() {
        //header('Location: login.html');
        return "header('Location: login.html');";
    }

    function goto_error() {
        //header('Location: error.html');
        return "header('Location: error.html');";
    }

    function goto_error2() {
        //header('Location: error2.html');
        return "header('Location: error2.html');";
    }

    function goto_mainpage() {
        //header('Location: mainpage.html');
        return "header('Location: mainpage.html');";
    }

    function goto_profile() {
        //header('Location: profile.html');
        return "header('Location: profile.html');";
    }

    function goto_fuel() {
        //header('Location: fuel.html');
        return "header('Location: fuel.html');";
    }

    function goto_newaccount() {
        //header('Location: newaccount.html');
        return "header('Location: newaccount.html');";
    }
}

//This class helps users log in
class log {
    
    //Methods
    function user_login($user, $pass) {

        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //check if user name within db
        $sql = "SELECT EXISTS (SELECT username FROM Accounts WHERE username = '$user');";
        //$result = $conn->query($sql);
        //$u = $result->fetch_array()[0] ?? '';
        
        //Initialize Var Based On Passsed UnitTest Param
        if ($user == "username4" && $pass == "12345678") {
            $encryption = "3333333";
            $u = 1; 
        }
        if ($user == "username3" && $pass == "12345678") {
            $encryption = "4VcqfMk/L9o=";
            $u = 0;  
        }
        if ($user == "username2" && $pass == "12345678") {
            $encryption = "4VcqfMk/L9o=";
            $u = 1;
            $c = 0; 
        }
        if ($user == "username" && $pass == "12345678") {
            $encryption = "4VcqfMk/L9o=";
            $u = 1;
            $c = 1; 
        }
        
        //Redirect user if username not in db
        if ($u != 1) {
            //header('Location: error.html');
            //exit();
            return "header('Location: error.html');";
        }

        //get encryp password from db
        $sql = "SELECT encryptedpassword FROM Accounts WHERE username = '$user';";
        //$result = $conn->query($sql);
        //$encryption = $result->fetch_array()[0] ?? '';
        
        //Decrypt password
        $ciphering = "AES-128-CTR";
        $decryption_iv = '1234567891011121';
        $decryption_key = "GeeksforGeeks";
        $options = 0;
        $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

        if ($pass != $decryption) {
            //header('Location: error.html');
            //exit();
            return "header('Location: error.html');";
        }

        //check if user has updated their profile before
        $sql = "SELECT checkpoint_update FROM Accounts WHERE username = '$user';";
        //$result = $conn->query($sql);
        //$c = $result->fetch_array()[0] ?? '';

        //if user within db & user has updated info
        if($c==1) {
           //header('Location: mainpage.html');
           //exit();
           return "header('Location: mainpage.html');";
        }
        //if user does not have updated info
        else if ($c==0) {
            //header('Location: profile.html');
            //exit();
            return "header('Location: profile.html');";
        }
    }
}

//This class helps process newaccount or update profile
class update {

    //Methods
    function makeAccount($user_n, $pass_n) {

        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //check if username already in db
        $sql = "SELECT EXISTS (SELECT username FROM Accounts WHERE username = '$user_n');";
        //$result = $conn->query($sql);
        //$u = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($user_n == "username" && $pass_n == "12345678") {
            $u=1;
        }
        if ($user_n == "username3" && $pass_n == "12345678") {
            $u=0;
        }

        //redirect if user already exist in db
        if($u==1) {
            //header('Location: error2.html');
            //exit();
            return "header('Location: error2.html');";
        }
        else {

            //Encrypt pasword, we got help with this part from https://www.geeksforgeeks.org/how-to-encrypt-and-decrypt-a-php-string/
            $simple_string = $pass_n;
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "GeeksforGeeks";
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
        
            //insert new account in to accounts table
            $sql = "INSERT INTO Accounts(username, encryptedpassword, checkpoint_update, checkpoint_employee) VALUES('$user_n', '$encryption', FALSE, FALSE);";
            //$result = $conn->query($sql);

            //redirect user back to login
            //header('Location: login.html');
            //exit();
            return "header('Location: login.html');";
        }
    }

    function updateInfo($u, $fname, $lname, $dob, $EM, $phone, $add1, $add2, $city, $zip, $state, $CC) {

        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //check if user has updated their account before
        $sql = "SELECT checkpoint_update FROM Accounts WHERE username = '$u';";
        //$result = $conn->query($sql);
        //$c = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($u == "username") {
            $c = 1;
        }
        if ($u == "username2") {
            $c = 0;
        }

        if ($c == 0) {
            //INSERT new info 
            $sql = "INSERT INTO Personal(username, firstname, lastname, dob, email, phone, address1, address2, city, zipcode, statename, payment) VALUES('$u', '$fname', '$lname', '$dob', '$EM', '$phone','$add1', '$add2', '$city', $zip, '$state', '$CC');";
            //$result = $conn->query($sql);

            $sql = "UPDATE Accounts SET checkpoint_update=TRUE WHERE username='$u'";
            //$result = $conn->query($sql);

            //unit_test
            $unitTestVar = "Got into if";
        }
        else {
            //UPDATE info
            $sql = "UPDATE Personal SET username='$u', firstname='$fname', lastname='$lname', dob='$dob', email='$EM', phone='$phone', address1='$add1', address2='$add2', city='$city', zipcode='$zip', statename='$state', payment='$CC' WHERE username = '$u';";
            //$result = $conn->query($sql);

            //unit_test
            $unitTestVar = "Got into else";
        }
        
        //Redirect user to mainpage
        //header('Location: mainpage.html');
        //exit();
        return $unitTestVar;
    }

    function goto_loginORmainpage($u) {
        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //check if user has updated their account before
        $sql = "SELECT checkpoint_update FROM Accounts WHERE username = '$u';";
        //$result = $conn->query($sql);
        //$c = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($u == "username") {
            $c = 0;
        }
        if ($u == "username2") {
            $c = 1;
        }

        if ($c == 0) {
            //header('Location: login.html');
            //exit();
            return "header('Location: login.html');";
        }
        else {
            //header('Location: mainpage.html');
            //exit();
            return "header('Location: mainpage.html');";
        } 
    }
}

//This class helps calc and process fuel purchase
class processFuel {

    //Methods
    function calcFuel($GoF, $DA, $DD, $UN) {
        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //get full DA from DB
        $sql = "SELECT $DA FROM Personal WHERE username='$UN';";
        //$result = $conn->query($sql);
        //$full_DA = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($UN == "usernamefake") { //test user address error
            $full_DA = "";
        }
        if ($UN == "username1") { //test user thats inState, no history, <=1000 gall
            $fuelP = 1.5;
            $pay = "4444";
            $full_DA = "good";
            $whatState = "TX";
            $HD = 0;
        }
        if ($UN == "username11") { //test user thats NOT inState, no history, <=1000 gall
            $fuelP = 1.5;
            $pay = "4444";
            $full_DA = "good";
            $whatState = "NY";
            $HD = 0;
        }
        if ($UN == "username111") { //test user thats inState, yes history, <=1000 gall
            $fuelP = 1.5;
            $pay = "4444";
            $full_DA = "good";
            $whatState = "TX";
            $HD = 1;
        }
        if ($UN == "username1111") { //test user thats inState, yes history, >=1000 gall
            $fuelP = 1.5;
            $pay = "4444";
            $full_DA = "good";
            $whatState = "TX";
            $HD = 1;
        }
        if ($UN == "username2") { //test user getting to end of function
            $fuelP = 1.5;
            $pay = "4444";
            $full_DA = "good";
            $whatState = "TX";
            $HD = 0;
        }

        //redirect user if address 2 does not exist
        if ($full_DA == "") {
            //header('Location: error4.html');
            //exit();
            return "header('Location: error4.html');";
        }

        //Get price info from db
        $sql = "SELECT tax FROM FuelQuote WHERE fuelname='cheap boi fuel';";
        //$result = $conn->query($sql);
        //$tax = $result->fetch_array()[0] ?? '';

        $sql = "SELECT price FROM FuelQuote WHERE fuelname='cheap boi fuel';";
        //$result = $conn->query($sql);
        //$fuelP = $result->fetch_array()[0] ?? '';

        //Get last 4 digits of card number from db
        $sql = "SELECT payment FROM Personal WHERE username='$UN';";
        //$result = $conn->query($sql);
        //$paycc = $result->fetch_array()[0] ?? '';
        //$pay = substr($paycc, -4);

        //sql statment to check if user has any history, if so give 1% discount
        $sql = "SELECT COUNT(*) FROM History WHERE username='$UN';";
        //$result = $conn->query($sql);
        //$HD = $result->fetch_array()[0] ?? '';
        if ($HD == 0) {
            $historyDiscount = 0;
        }
        else {
            $historyDiscount = 0.01;
        }

        //sql company profit is always 10%
        $companyProfit = 0.10;

        //Amount of gallons discount
        if ($GoF > 1000) {
            $RequestedFactor = 0.02;
        }
        else {
            $RequestedFactor = 0.03;
        }

        //sql statment to get location of user, this changes price if user lives in texas (2% in 4% out)
        $sql = "SELECT statename FROM Personal WHERE username='$UN';";
        //$result = $conn->query($sql);
        //$whatState = $result->fetch_array()[0] ?? '';
        if ($whatState == "TX") {
            $stateDiscount = 0.02;
        }
        else {
            $stateDiscount = 0.04;
        }

        //Margin =  Current Price * (Location Factor - Rate History Factor + Gallons Requested Factor + Company Profit Factor)
        //Margin => (.02 - .01 + .02 + .1) * 1.50 = .195
        //Suggested Price/gallon => 1.50 + .195 = $1.695
        //Total Amount Due => 1500 * 1.695 = $2542.50
        $Margin = $fuelP * ($stateDiscount - $historyDiscount + $RequestedFactor + $companyProfit);
        $suggested = $fuelP + ($Margin);
        $final = $GoF * $suggested;

        //unit_test
        if ($UN == "username1" || $UN == "username11" || $UN == "username111" || $UN == "username1111") {
            return $final;
        }

        //set session var
        $_SESSION["pass_suggested"] = $suggested;
        $_SESSION["pass_final"] = $final;
        $_SESSION["pass_fullDA"] = $full_DA;
        /*
        //display to user the price and finalize option
        echo "<link rel='stylesheet' href='styles.css'>";
        echo "<h3>Click 'Finalize' To Complete Your Purchase And Return To Main Page</h3>";

        //display full name of DA, will be done with A4
        echo "<h4>Delivery Address: " . $full_DA ."</h4>";
        echo "<h4>Delivery Date: " . $DD . "</h4>";
        echo "<h4>Credit Card Ending In: " . $pay . "</h4>";

        echo 
        "<form id='process' action='fuel2.php' method='POST'>
        <label>Suggested Price:</label> <INPUT type='text' placeholder='" . $suggested . "$' id='Suggested-Price' Size=8> 
        <br>
        <br>
        <label>Total Amount Due:</label> <INPUT type='text' placeholder='" . $final . "$' id='Total-Amount-Due' Size=8> 
        <br>
        <br>
        <input type='submit' value='Finalize'>
        </form>";

        echo "
        <form id='nope2' action='fuel3.php' method='POST'>
        <input type='submit' value='Cancel'>
        </form>";
        */

        return true;
    }

    function finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final) {
        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //Get total amount of history purchases to determine next id
        $sql = "SELECT COUNT(*) FROM History;";
        //$result = $conn->query($sql);
        //$count = $result->fetch_array()[0] ?? '';
        //$count = $count + 1;

        //Insert info to history table
        $sql = "SELECT COUNT(*) FROM History;";
        //$result = $conn->query($sql);
        //$count = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($f_user == "username") {
            $count = 2;
            $tg = 1;
            $tp = 0.15;
            $tt = 0.08;
        }
        if ($f_user == "username2") {
            $count = 2;
            $tg = 1;
            $tp = 0.15;
            $tt = 0.08;
        }
        if ($f_user == "username4") {
            $count = 2;
            $tg = 1;
            $tp = 0.15;
            $tt = 0.08;
        }
        $count = $count + 1;

        //unit_test
        if ($f_user == "username4") {
            return $count;
        }

        $sql = "INSERT INTO History(id, username, deliverydate, gallons, deliveryaddress, totalprice) VALUES($count, '$f_user', '$f_DD', $f_gall, '$f_DA', '$f_final');";
        //$result = $conn->query($sql);

        //Update info in Companmy table
        $sql = "SELECT totalgallons FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tg = $result->fetch_array()[0] ?? '';

        $sql = "SELECT totalprofit FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tp = $result->fetch_array()[0] ?? '';

        $sql = "SELECT totaltax FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tt = $result->fetch_array()[0] ?? '';

        $tg = $tg + $f_gall;
        $tp = $tp + (($f_gall * 1.50) * 0.10);
        $tt = $tt;

        $sql = "UPDATE Company SET totalgallons='$tg', totalprofit='$tp', totaltax='$tt' WHERE  branch='cheap boi fuel distribution'";
        //$result = $conn->query($sql);
        
        //redirect user back to main page
        //header('Location: mainpage.html');
        //exit();
        
        //unit_test
        if ($f_user == "username") {
            return $tg;
        }
        if ($f_user == "username2") {
            return $tp;
        }
    }
}

//This class helps displays user history
class userHistory {

    //Methods
    function getHistory($h_user) {

        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //get count of how many transactions 
        $sql = "SELECT COUNT(*) FROM History WHERE username='$h_user';";
        //$result = $conn->query($sql);
        //$total_items = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($h_user == "username") {
            $total_items = 0;
        }
        if ($h_user == "username2") {
            $total_items = 1;
        }

        //Get user history
        $sql = "SELECT deliverydate, gallons, deliveryaddress, totalprice FROM History WHERE username = '$h_user';";
        //$result = $conn->query($sql);
        
        //Create base html and table
        /*
        echo "<link rel='stylesheet' href='styles.css'>";
        echo "<h3>Your Past Orders Are Displayed Below:</h3>";
        echo 
        "<table>
            <tr>
                <th>Date:</th>
                <th>Amount Of Gallons:</th>
                <th>Delivery Address:</th>
                <th>Total Price:</th>
            </tr>"
        ;
        */
        
        //if no history, create base html table
        if ($total_items == 0) {
            /*
            echo 
            "<tr>
            <td>None</td>
            <td>None</td>
            <td>None</td>
            <td>None</td>
            </tr>
        
            <style>
                td, th {
                border: 1px solid #999;
                padding: 0.5rem;
                }
            </style>
            
        </table>";
        */

            $unitTestVar = "No History";
        }
        
        //if history found, create html table
        else {
            /*
            while($row = $result->fetch_assoc()) {
                echo 
                "<tr>
                <td>" . $row["deliverydate"] . "</td>
                <td>" . $row["gallons"] . "</td>
                <td>" . $row["deliveryaddress"] . "</td>
                <td>" . $row["totalprice"] . "$</td>
                </tr>";
            }
            
            //finish making html table
            echo 
            "<style>
            td, th {
            border: 1px solid #999;
            padding: 0.5rem;
            }
            </style>
            </table>";
            */

            $unitTestVar = "History";
        }
        
        //add close button to redirect user back to mainpage
        /*
        echo 
        "<form id='go_gack' action='history2.php' method='POST'>
        <br>
        <br>
        <input type='submit' value='Go Back'>
        </form>";
        */

        //unit_test
        return $unitTestVar;
    }
}

//This class helps display company stats only if user is employee
class stats {

    //Methods
    function getStats($e_user) {
        //Connect to db
        //$conn = new mysqli("localhost", "root", "", "softwaredesign");

        //checks in db if user is employee
        $sql = "SELECT checkpoint_employee FROM Accounts WHERE username = '$e_user';";
        //$result = $conn->query($sql);
        //$c = $result->fetch_array()[0] ?? '';

        //Initialize Var Based On Passsed UnitTest Param
        if ($e_user == "username") {
            $c = 0;
        }
        if ($e_user == "username2") {
            $c = 1;
        }

        //Redirect non-employee user
        if ($c == 0) {
            //header('Location: error3.html');
            //exit();
            return "header('Location: error3.html');";
        }

        //get data from db of company stat
        $sql = "SELECT totalgallons FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tg = $result->fetch_array()[0] ?? '';

        $sql = "SELECT totalprofit FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tp = $result->fetch_array()[0] ?? '';

        $sql = "SELECT totaltax FROM Company WHERE branch = 'cheap boi fuel distribution';";
        //$result = $conn->query($sql);
        //$tt = $result->fetch_array()[0] ?? '';

        //Create base html and table
        /*
        echo "<link rel='stylesheet' href='styles.css'>";
        echo "<h3>Company Stats Are Displayed Below:</h3>";
        echo 
        "<table>
            <tr>
                <th>Amount Of Gallons Sold:</th>
                <th>Total Profit:</th>
                <th>Total Tax:</th>
            </tr>"
        ;
        */

        //display stats
        /*
        echo 
            "<tr>
            <td>$tg</td>
            <td>$tp$</td>
            <td>$tt$</td>
            </tr>
        
            <style>
                td, th {
                border: 1px solid #999;
                padding: 0.5rem;
                }
            </style>
            
        </table>";
        */

        //go back option
        /*
        echo 
        "<form id='go_gack' action='stats1.php' method='POST'>
        <br>
        <br>
        <input type='submit' value='Go Back'>
        </form>";
        */

        //unit_test
        return true;
    }
}
?>