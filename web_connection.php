<?php
$con = mysqli_connect("localhost","root","","help_city");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 

//$sql = "SELECT * FROM user";
//$result = mysqli_query($con, $sql);

// Fetch all
//$users=mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result set
//mysqli_free_result($result);

//print_r($users);
mysqli_close($con);
?>
