<?php
$con = mysqli_connect("localhost","root","","help_city1");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 



$detailValue='';
$detailName ='';
$details ='';
$detail ='';
$query = '';
$query1 = '';
$query2 = '';
$table_data = '';
$filename = "internet.json";
$data = file_get_contents($filename); //Read the JSON file in PHP
$array = json_decode($data, true); //Convert JSON String into PHP Array


if (is_array($array)){
foreach($array['items'] as $row) //Extract the Array Values by using Foreach Loop
          {
$id=$row['id'];
$name=$row['name'];
$category=$row['category'];
$query .= "INSERT INTO product(id, category, name ) VALUES ('$id','$category','$name'); ";  // Make Multiple Insert Query 

foreach($row['details'] as $detail)
{
$detailName =$detail['detail_name'];
$detailValue=$detail['detail_value'];
$query .= "INSERT INTO details(id,detail_name,detail_value ) VALUES ('$id','$detailName','$detailValue'); ";

}
}
}





if (is_array($array)){






foreach($array['categories'] as $row){
$id=$row['id'];
$category_name=$row['category_name'];
$query .= "INSERT INTO categories(id, category_name ) VALUES ('$id','$category_name'); ";  // Make Multiple Insert Query
                                     }

}






if(mysqli_multi_query($con, $query)) //Run Mutliple Insert Query
    		{ 
echo "<h3>Imported JSON Data</h3><br />";
     	
     	
                }

                       

else // If $myList was not an array, then this block is executed. 
{
  echo "Unfortunately, an error occured.";
}
