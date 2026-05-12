<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

// SEARCH
$search = "";

if(isset($_GET['search']))
{
$search = $_GET['search'];

$sql = "SELECT * FROM customers
WHERE name LIKE '%$search%'
OR email LIKE '%$search%'
OR phone LIKE '%$search%'";
}
else
{
$sql = "SELECT * FROM customers";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>View Customers</title>

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

<a href="logout.php" style="color:red;">Logout</a>

</div>

<h1>View Customers</h1>

<!-- SEARCH -->
<div class="search-box">

<form method="GET">

<input type="text"
name="search"
placeholder="Search customer..."
value="<?php echo $search; ?>">

<button type="submit">
Search
</button>

</form>

</div>

<!-- TABLE -->
<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>City</th>
<th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['city']; ?></td>

<td>

<a href="edit_customer.php?id=<?php echo $row['id']; ?>">
Edit
</a>

|

<a href="delete_customer.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure?')">
Delete
</a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>