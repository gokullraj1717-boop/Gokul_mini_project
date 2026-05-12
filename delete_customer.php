<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

$id = $_GET['id'];

// DELETE CUSTOMER
mysqli_query($conn,
"DELETE FROM customers WHERE id='$id'");

// REDIRECT
header("Location: view_customers.php");
?>