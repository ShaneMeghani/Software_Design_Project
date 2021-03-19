<?php
//Start session
session_start();

//This class helps redirect users to different html pages
class redirect {

    //Methods
    function goto_login() {
        header('Location: login.html');
    }

    function goto_error() {
        header('Location: error.html');
    }

    function goto_error2() {
        header('Location: error2.html');
    }

    function goto_mainpage() {
        header('Location: mainpage.html');
    }

    function goto_profile() {
        header('Location: profile.html');
    }

    function goto_fuel() {
        header('Location: fuel.html');
    }

    function goto_newaccount() {
        header('Location: newaccount.html');
    }
}


//This class helps users log in
class log {

    //Methods
    function user_login($user, $pass) {
        //if user within db & user has updated info
        if($user=="username" && $pass=="12345678") {
           header('Location: mainpage.html');
        }

        //if user within db & user deos not have updated info
        else if ($user=="username2" && $pass=="12345678") {
           header('Location: profile.html');
        }

        //if user not within db
        else {
           header('Location: error.html');
        }
    }
}


//This class helps process newaccount or update profile
class update {

    //Methods
    function makeAccount($user_n, $pass_n) {
        //check if user already exist in db
        if($user_n=="username") {
            header('Location: error2.html');
        }
        else {
            //Save the info to db

            //redirect user back to login
            header('Location: login.html');
        }
    }

    function updateInfo($u, $fname, $lname, $dob, $phone, $add1, $add2, $city, $zip, $state) {
        //Store information into DB based on username, will be done in A4
        //echo $u;

        //Redirect user to mainpage
        header('Location: mainpage.html');
    }
}


//This class helps calc and process fuel purchase
class processFuel {

    //Methods
    function calcFuel($GoF, $DA, $DD) {
        //get full DA from DB, will be made later with A4
        $full_DA = "1203 cheap street drive";

        //Get price info from db
        $tax = 0.08;
        $fuelP = 10;

        //Calc users price
        $suggested = $GoF * $fuelP;
        $final = $suggested + ($suggested * $tax);

        //set session var
        $_SESSION["pass_suggested"] = $suggested;
        $_SESSION["pass_final"] = $final;

        //display to user the price and finalize option
        echo "<link rel='stylesheet' href='styles.css'>";
        echo "<h3>Click 'Finalize' To Complete Your Purchase And Return To Main Page</h3>";

        //display full name of DA, will be done with A4
        echo "<h4>Delivery Address: " . $full_DA ."</h4>";
        echo "<h4>Delivery Date: " . $DD . "</h4>";

        echo 
        "<form id='process' action='fuel2.php' method='POST'>
        <label>Suggested Price:</label> <INPUT type='text' placeholder='" . $suggested . "' id='Suggested-Price' Size=8> 
        <br>
        <br>
        <label>Total Amount Due:</label> <INPUT type='text' placeholder='" . $final . "' id='Total-Amount-Due' Size=8> 
        <br>
        <br>
        <input type='submit' value='Finalize'>
        </form>";

        echo "
        <form id='nope2' action='fuel3.php' method='POST'>
        <input type='submit' value='Cancel'>
        </form>";
    }

    function finalizeFuel($f_user, $f_gall, $f_DA, $f_DD, $f_sugg, $f_final) {
        //Store info into db, will be done in A4 as a function within fuel class
        
        //redirect user back to main page
        header('Location: mainpage.html');
    }
}


//This class helps displays user history
class userHistory {

    //Methods
    function getHistory($h_user) {
        //Get all user history from db, will be implemented in A4 with Arrays holding data
        if ($h_user == "username") {
            $total_items = 2;
            $db_date = "2/16/2021";
            $db_galoons = "10";
            $db_delivery = "1203 Cheap Street Drive";
            $db_price = "100";
        }
        else {
            $total_items = 0;
        }
        
        //Create base html and table
        echo "<link rel='stylesheet' href='styles.css'>";
        echo "<h3>Click 'View' To See Your Past Orders Displayed Below:</h3>";
        echo 
        "<table>
            <tr>
                <th>Date:</th>
                <th>Amount Of Gallons:</th>
                <th>Delivery Address:</th>
                <th>Total Price:</th>
            </tr>"
        ;
        
        //if no history, create base html table
        if ($total_items == 0) {
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
        }
        
        //if history found, create html table
        else {
        
            //loop until no more items
            for ($x = 0; $x < $total_items; $x++) {
                echo 
                "<tr>
                <td>" . $db_date . "</td>
                <td>" . $db_galoons . "</td>
                <td>" . $db_delivery . "</td>
                <td>" . $db_price . "</td>
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
        }
        
        //add close button to redirect user back to mainpage
        echo 
        "<form id='go_gack' action='history2.php' method='POST'>
        <br>
        <br>
        <input type='submit' value='Go Back'>
        </form>";
    }
}
?>