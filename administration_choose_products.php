<?php
// administration_choose_products.php

// Check if there is an open database connection
if ($con) {
    // Query the database to retrieve all data from the "product" table
    $id='';
    $sql = "SELECT * FROM product WHERE name not like''";
    $result = $con->query($sql);
    $sql1 = "SELECT * FROM categories WHERE category_name not like''";
    // If there are rows returned, display the data
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display the data from each row
            $id=$row['id'];
            echo "Product ID: " . $row['id'] . "<br>";
            echo "Product Name: " . $row['name'] . "<br>";
            $sql2 = "SELECT * FROM categories  WHERE $id =id";
            $result1 = $con->query($sql2);
            if ($result->num_rows > 0) {
                 while ($row1 = $result1->fetch_assoc()) {
            echo "Product Category: " . $row1['category_name'] . "<br>"; 
            echo "<br>";
                     }}
            echo "<br>";
	    echo "<br>";
	    echo "<br>";
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "No open database connection.";
}
?>
