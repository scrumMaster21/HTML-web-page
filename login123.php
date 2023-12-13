<?php
// login123.php

session_start();
$timeout = 240; // 4 minutes
$_SESSION['timeout'] = time() + $timeout;
$_SESSION['LAST_ACTIVITY'] = time();
// Retrieve the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to the database
$con = mysqli_connect("localhost","root","","help_city1");

if(!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }


// Query the database to check if the username and password combination exists
$sql = "SELECT * FROM administrator WHERE username = '$username' AND password = '$password'";
$result = $con->query($sql);

// If a row is returned, the combination exists
if ($result->num_rows > 0) {
   $_SESSION['username'] = $username;
  
 if (isset($_SESSION['username'])) {
     include "administration_choose_products.php"; 
 
     include"delete_id.html";
     }
else {echo "Invalid username or password.";}
} else {
    echo "Invalid username or password.";
    
}


// Close the database connection
$con->close();
?>
