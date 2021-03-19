<?php
//Start session
session_start();

//Test if session var received
//echo $_SESSION["pass_user"];
//echo $_SESSION["pass_pass"];

//Get all user history from db, will be implemented in A4
$db_date = "2/16/2021";
$db_galoons = "10";
$db_delivery = "1203 Cheap Street Drive";
$db_price = "100";

//Display info to user
echo "<table>
          <tr>
            <th>Date:</th>
            <th>Amount Of Gallons</th>
            <th>Delivery Address</th>
            <th>Total Price</th>
          </tr>

          <tr>
            <td>2/16/2021</td>
            <td>10</td>
            <td>1203 Cheap Street Dr</td>
            <td>100$</td>
          </tr>

          <style>
              td, th {
              border: 1px solid #999;
              padding: 0.5rem;
              }
          </style>
          
        </table>"

?>