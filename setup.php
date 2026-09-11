<?php

require "db.php";

//creating the database

$conn->query("CREATE DATABASE IF NOT EXISTS expense_tracker");
$conn->select_db("expense_tracker");

$sql="CREATE TABLE IF NOT EXISTS expenses(
id INT AUTO_INCREMENT PRIMARY KEY,
category ENUM('Food','Transport','School','Entertainment','Other') NOT NULL,
amount DECIMAL(10,2) NOT NULL,
expense_date DATE NOT NUll,
created_at TIMESTAMp DEFAULT CURRENT_TIMESTAMP)";

if ($conn->query($sql)==TRUE){
    echo "<h2>Setup complete!</h2>";
    echo "<p><a href='index.php'>Go to Expense App </a>";
}
else{
    echo "Error creating table:".$conn->error;
}


?>