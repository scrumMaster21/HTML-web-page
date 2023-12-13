<?php


// delete_id.php
$con = mysqli_connect("localhost","root","","help_city1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        
        // Check if database connection is open
        if ($con) {
            // Send MySQL query to delete customer with the given ID
            $sql3 = "DELETE FROM product WHERE `product`.`id`= $id";
            $sql4 = "DELETE FROM `details` WHERE  `details`.`id`= $id";
            if ($con->query($sql4) === TRUE) {
            echo "Detail record deleted successfully";
            echo "<br>";
	    echo "<br>"; 
                                             }
            else {
            echo "Error deleting detail record: " . $con->error; 
            echo "<br>";
	    echo "<br>"; 
                                                      }
           
if ($con->query($sql3) === TRUE) { 
            echo "Product record deleted successfully";
                                 } else {
            echo "Error deleting record: " . $con->error;
                                        }
        }
$con->close();
include"web_initial_page.html";



 }

?>
