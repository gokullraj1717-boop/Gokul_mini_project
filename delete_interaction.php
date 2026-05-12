<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

$id = $_GET['id'];

// DELETE INTERACTION
mysqli_query($conn,
"DELETE FROM interactions WHERE id='$id'");

// REDIRECT
header("Location: view_interactions.php");
?>