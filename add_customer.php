<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

$msg="";

if(isset($_POST['submit']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];

$sql = "INSERT INTO customers (name,email,phone,city,join_date)
VALUES ('$name','$email','$phone','$city',CURDATE())";

mysqli_query($conn,$sql);

$msg = "Customer Added Successfully";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Customer</title>

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

<h2>Add Customer</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Phone</label>
<input type="text" name="phone" required>

<label>City</label>
<input type="text" name="city" required>

<button type="submit" name="submit">
Add Customer
</button>

<br><br>

<span style="color:green;font-weight:bold;">
<?php echo $msg; ?>
</span>

</form>

<div class="footer">
Customer Intelligence System © 2026
</div>

</body>
</html>