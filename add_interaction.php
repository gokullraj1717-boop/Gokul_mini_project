<?php
include "config.php";

$msg="";

if(isset($_POST['submit']))
{
    $customer_id = $_POST['customer_id'];
    $type = $_POST['type'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO interactions (customer_id,type,notes,interaction_date)
            VALUES ('$customer_id','$type','$notes',CURDATE())";

    mysqli_query($conn,$sql);

    $msg = "Interaction Added Successfully";
}

$customers = mysqli_query($conn,"SELECT * FROM customers");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Interaction</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<!-- MENU -->
<div style="background:#333;padding:15px;">

<a href="index.php" style="color:white;margin-right:20px;">Home</a>
<a href="add_customer.php" style="color:white;margin-right:20px;">Add Customer</a>
<a href="add_interaction.php" style="color:white;margin-right:20px;">Add Interaction</a>
<a href="dashboard.php" style="color:white;margin-right:20px;">Dashboard</a>
<a href="view_customers.php" style="color:white;">View Customers</a>

</div>

<h2>Add Customer Interaction</h2>

<form method="POST">

Customer:<br>
<select name="customer_id" required>
<?php
while($c = mysqli_fetch_assoc($customers))
{
?>
<option value="<?php echo $c['id']; ?>">
<?php echo $c['name']; ?>
</option>
<?php
}
?>
</select>

<br><br>

Type:<br>
<select name="type">
<option>Call</option>
<option>Email</option>
<option>Meeting</option>
<option>Purchase</option>
</select>

<br><br>

Notes:<br>
<textarea name="notes"></textarea>

<br><br>

<button type="submit" name="submit">Add Interaction</button>

<span style="color:green; font-weight:bold;">
<?php echo $msg; ?>
</span>

</form>

</body>
</html>