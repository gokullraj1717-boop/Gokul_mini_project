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

<title>About Project</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f6f9;
}

/* MENU */
.menu{
background:#333;
padding:15px;
}

.menu a{
color:white;
text-decoration:none;
margin-right:20px;
font-weight:bold;
}

.menu a:hover{
color:yellow;
}

/* CONTENT */
.container{
width:80%;
margin:40px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

h1{
text-align:center;
color:#007BFF;
}

h2{
color:#333;
margin-top:30px;
}

p{
line-height:1.8;
font-size:17px;
}

ul{
line-height:1.8;
font-size:17px;
}

.footer{
background:#333;
color:white;
text-align:center;
padding:15px;
margin-top:40px;
}

</style>

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

<h1>Customer Intelligence System</h1>

<h2>Project Description</h2>

<p>
Customer Intelligence System is a web-based application developed using PHP and MySQL.
The system helps organizations manage customer information and track customer interactions efficiently.
</p>

<h2>Objectives</h2>

<ul>
<li>Manage customer records</li>
<li>Track customer interactions</li>
<li>Generate analytics and reports</li>
<li>Improve customer relationship management</li>
<li>Provide export features using Excel and PDF</li>
</ul>

<h2>Technologies Used</h2>

<ul>
<li>PHP</li>
<li>MySQL</li>
<li>HTML</li>
<li>CSS</li>
<li>JavaScript</li>
<li>Chart.js</li>
<li>XAMPP</li>
</ul>

<h2>Modules</h2>

<ul>
<li>User Login System</li>
<li>Customer Management</li>
<li>Interaction Management</li>
<li>Dashboard Analytics</li>
<li>Search and Filter</li>
<li>Export Reports</li>
</ul>

<h2>Future Enhancements</h2>

<ul>
<li>Email Notification System</li>
<li>AI-based Customer Prediction</li>
<li>SMS Integration</li>
<li>Cloud Database Support</li>
<li>Mobile Application Version</li>
</ul>

<h2>Conclusion</h2>

<p>
This project demonstrates how customer data can be managed efficiently using web technologies.
It provides useful analytics, reporting features, and interaction tracking for better decision making.
</p>

</div>

<div class="footer">
Customer Intelligence System © 2026
</div>

</body>
</html>