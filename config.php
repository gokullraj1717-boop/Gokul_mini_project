<?php

$conn = mysqli_connect(
"localhost",
"root",
"",
"customer_intelligence"
);

if(!$conn){
    die("Database Connection Failed");
}

?>