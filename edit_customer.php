<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

$id = $_GET['id'];

$msg = "";

// Fetch customer data
$result = mysqli_query($conn,
"SELECT * FROM customers WHERE id='$id'");

$customer = mysqli_fetch_assoc($result);

// Update customer
if(isset($_POST['submit']))
{
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];

$sql = "
UPDATE customers SET
name='$name',
email='$email',
phone='$phone',
city='$city'
WHERE id='$id'
";

mysqli_query($conn,$sql);

$msg = "Customer Updated Successfully";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Customer</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
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

/* FORM BOX */
.container{
width:40%;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

h2{
text-align:center;
color:#007BFF;
}

input{
width:100%;
padding:12px;
margin-top:10px;
margin-bottom:20px;
border:1px solid #ccc;
border-radius:5px;
font-size:15px;
}

button{
width:100%;
padding:12px;
background:#007BFF;
color:white;
border:none;
border-radius:5px;
font-size:16px;
cursor:pointer;
font-weight:bold;
}

button:hover{
background:#0056b3;
}

.success{
color:green;
text-align:center;
font-weight:bold;
margin-top:15px;
}

.back{
display:block;
text-align:center;
margin-top:20px;
text-decoration:none;
font-weight:bold;
color:#007BFF;
}

</style>

</head>

<body>

<!-- MENU -->
<div class="menu">

<a href="index.php">Home</a>

<a href="dashboard.php">Dashboard</a>

<a href="view_customers.php">View Customers</a>

<a href="logout.php" style="color:red;">Logout</a>

</div>

<!-- FORM -->
<div class="container">

<h2>Edit Customer</h2>

<form method="POST">

<input type="text"
name="name"
value="<?php echo $customer['name']; ?>"
placeholder="Enter Name"
required>

<input type="email"
name="email"
value="<?php echo $customer['email']; ?>"
placeholder="Enter Email"
required>

<input type="text"
name="phone"
value="<?php echo $customer['phone']; ?>"
placeholder="Enter Phone"
required>

<input type="text"
name="city"
value="<?php echo $customer['city']; ?>"
placeholder="Enter City"
required>

<button type="submit" name="submit">
Update Customer
</button>

</form>

<div class="success">
<?php echo $msg; ?>
</div>

<a class="back" href="view_customers.php">
← Back to Customers
</a>

</div>

</body>
</html>