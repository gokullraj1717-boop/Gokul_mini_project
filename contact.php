<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Contact</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<!-- MENU -->
<div class="menu">

<a href="index.php">Home</a>

<a href="dashboard.php">Dashboard</a>

<a href="add_customer.php">Add Customer</a>

<a href="add_interaction.php">Add Interaction</a>

<a href="view_customers.php">View Customers</a>

<a href="view_interactions.php">View Interactions</a>

<a href="about.php">About</a>

<a href="contact.php">Contact</a>

<a href="logout.php" style="color:red;">Logout</a>

</div>

<div class="container">

<h1>Contact Information</h1>

<div class="info">

<p><b>Project Name:</b> Customer Intelligence System</p>

<p><b>Developer:</b> Gokul Raj V</p>

<p><b>Technology:</b> PHP & MySQL</p>

<p><b>Email:</b> gokulrajv@gmail.com</p>

<p><b>Phone:</b> +91 9876543210</p>

<p><b>Location:</b> India</p>

</div>

</div>

<div class="footer">
Customer Intelligence System © 2026
</div>

</body>
</html>