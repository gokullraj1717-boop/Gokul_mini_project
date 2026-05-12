<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

$id = $_GET['id'];

$msg = "";

// FETCH INTERACTION
$result = mysqli_query($conn,"
SELECT * FROM interactions
WHERE id='$id'
");

$data = mysqli_fetch_assoc($result);

// FETCH CUSTOMERS
$customers = mysqli_query($conn,
"SELECT * FROM customers");

// UPDATE
if(isset($_POST['submit']))
{
$customer_id = $_POST['customer_id'];
$type = $_POST['type'];
$notes = $_POST['notes'];

$sql = "
UPDATE interactions SET
customer_id='$customer_id',
type='$type',
notes='$notes'
WHERE id='$id'
";

mysqli_query($conn,$sql);

$msg = "Interaction Updated Successfully";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Interaction</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

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

.container{
width:45%;
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

select, textarea{
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
text-align:center;
color:green;
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

<a href="view_interactions.php">View Interactions</a>

<a href="logout.php" style="color:red;">Logout</a>

</div>

<div class="container">

<h2>Edit Interaction</h2>

<form method="POST">

<select name="customer_id" required>

<?php while($c = mysqli_fetch_assoc($customers)) { ?>

<option value="<?php echo $c['id']; ?>"
<?php
if($c['id'] == $data['customer_id'])
{
echo "selected";
}
?>>

<?php echo $c['name']; ?>

</option>

<?php } ?>

</select>

<select name="type" required>

<option value="Call"
<?php if($data['type']=="Call") echo "selected"; ?>>
Call
</option>

<option value="Email"
<?php if($data['type']=="Email") echo "selected"; ?>>
Email
</option>

<option value="Meeting"
<?php if($data['type']=="Meeting") echo "selected"; ?>>
Meeting
</option>

<option value="Purchase"
<?php if($data['type']=="Purchase") echo "selected"; ?>>
Purchase
</option>

</select>

<textarea
name="notes"
rows="5"
required><?php echo $data['notes']; ?></textarea>

<button type="submit" name="submit">
Update Interaction
</button>

</form>

<div class="success">
<?php echo $msg; ?>
</div>

<a class="back" href="view_interactions.php">
← Back to Interactions
</a>

</div>

</body>
</html>