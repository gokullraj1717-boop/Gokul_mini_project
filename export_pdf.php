<?php
include "config.php";

$sql = "SELECT i.*, c.name as customer_name 
FROM interactions i
LEFT JOIN customers c 
ON i.customer_id = c.id
ORDER BY i.interaction_date DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>Interactions Report</title>

<style>

body{
font-family:Arial;
padding:20px;
}

h2{
text-align:center;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th,td{
border:1px solid black;
padding:10px;
text-align:center;
}

th{
background:#007BFF;
color:white;
}

</style>

</head>

<body onload="window.print()">

<h2>Customer Interactions Report</h2>

<table>

<tr>
<th>ID</th>
<th>Customer</th>
<th>Type</th>
<th>Notes</th>
<th>Date</th>
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
<?php echo date("d-m-Y",strtotime($row['interaction_date'])); ?>
</td>

</tr>

<?php
}
?>

</table>

</body>
</html>