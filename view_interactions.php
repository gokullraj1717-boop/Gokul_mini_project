<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

// FILTER + SEARCH
$where = [];

$search = "";
$type = "";
$from = "";
$to = "";

if(!empty($_GET['search']))
{
$search = $_GET['search'];

$where[] = "(c.name LIKE '%$search%' 
OR i.type LIKE '%$search%' 
OR i.notes LIKE '%$search%')";
}

if(!empty($_GET['type']))
{
$type = $_GET['type'];

$where[] = "i.type='$type'";
}

// DATE FILTER
if(!empty($_GET['from']) && !empty($_GET['to']))
{
$from = $_GET['from'];
$to = $_GET['to'];

$where[] = "DATE(i.interaction_date)
BETWEEN '$from' AND '$to'";
}

$whereSQL = "";

if(count($where) > 0)
{
$whereSQL = "WHERE " . implode(" AND ", $where);
}

$sql = "
SELECT i.*, c.name as customer_name
FROM interactions i
LEFT JOIN customers c
ON i.customer_id = c.id

$whereSQL

ORDER BY i.interaction_date DESC
";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>View Interactions</title>

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

<h2>Customer Interactions</h2>

<!-- FILTER -->
<div class="filter-box">

<form method="GET">

<input type="text"
name="search"
placeholder="Search interactions..."
value="<?php echo $search; ?>">

<select name="type">

<option value="">All Types</option>

<option value="Call"
<?php if($type=="Call") echo "selected"; ?>>
Call
</option>

<option value="Email"
<?php if($type=="Email") echo "selected"; ?>>
Email
</option>

<option value="Meeting"
<?php if($type=="Meeting") echo "selected"; ?>>
Meeting
</option>

<option value="Purchase"
<?php if($type=="Purchase") echo "selected"; ?>>
Purchase
</option>

</select>

From:

<input type="date"
name="from"
value="<?php echo $from; ?>">

To:

<input type="date"
name="to"
value="<?php echo $to; ?>">

<button type="submit">
Search
</button>

</form>

</div>

<!-- EXPORT BUTTONS -->
<div class="export-buttons">

<a class="excel" href="export_interactions.php">
Export to Excel
</a>

<a class="pdf" href="export_pdf.php">
Export to PDF
</a>

</div>

<!-- TABLE -->
<table>

<tr>
<th>ID</th>
<th>Customer</th>
<th>Type</th>
<th>Notes</th>
<th>Date</th>
<th>Actions</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['customer_name']; ?></td>

<td><?php echo $row['type']; ?></td>

<td><?php echo $row['notes']; ?></td>

<td>
<?php echo date("d-m-Y", strtotime($row['interaction_date'])); ?>
</td>

<td>

<a class="edit"
href="edit_interaction.php?id=<?php echo $row['id']; ?>">
Edit
</a>

|

<a class="delete"
href="delete_interaction.php?id=<?php echo $row['id']; ?>"
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