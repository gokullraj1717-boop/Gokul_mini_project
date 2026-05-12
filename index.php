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

<title>Customer Intelligence System</title>

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

/* HERO SECTION */
.hero{
text-align:center;
padding:100px 20px;
background:#007BFF;
color:white;
}

.hero h1{
font-size:50px;
margin-bottom:20px;
}

.hero p{
font-size:20px;
}

/* BUTTONS */
.buttons{
margin-top:30px;
}

.btn{
background:white;
color:#007BFF;
padding:12px 20px;
text-decoration:none;
font-weight:bold;
border-radius:5px;
margin:10px;
display:inline-block;
}

.btn:hover{
background:#ddd;
}

/* FEATURES */
.features{
width:90%;
margin:50px auto;
text-align:center;
}

.card{
display:inline-block;
width:250px;
background:white;
padding:20px;
margin:15px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.card h3{
color:#007BFF;
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

<!-- HERO -->
<div class="hero">

<h1>Customer Intelligence System</h1>

<p>
Manage customers and interactions easily using analytics and reports.
</p>

<div class="buttons">

<a href="dashboard.php" class="btn">
Open Dashboard
</a>

<a href="add_customer.php" class="btn">
Add Customer
</a>

</div>

</div>

<!-- FEATURES -->
<div class="features">

<div class="card">
<h3>Customer Management</h3>
<p>
Add, edit, delete and manage customer records easily.
</p>
</div>

<div class="card">
<h3>Interaction Tracking</h3>
<p>
Track calls, emails, meetings and purchases.
</p>
</div>

<div class="card">
<h3>Analytics Dashboard</h3>
<p>
View charts, reports and customer interaction analytics.
</p>
</div>

</div>

<!-- FOOTER -->
<div class="footer">
Customer Intelligence System © 2026
</div>

</body>
</html>