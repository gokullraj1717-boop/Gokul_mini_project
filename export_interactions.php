<?php
include "config.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=interactions.xls");

$sql = "SELECT i.*, c.name as customer_name 
        FROM interactions i
        LEFT JOIN customers c ON i.customer_id = c.id
        ORDER BY i.interaction_date DESC";

$result = mysqli_query($conn,$sql);

echo "<table border='1'>";

echo "<tr>
<th>ID</th>
<th>Customer</th>
<th>Type</th>
<th>Notes</th>
<th>Date</th>
</tr>";

while($row = mysqli_fetch_assoc($result))
{
echo "<tr>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['customer_name']."</td>";
echo "<td>".$row['type']."</td>";
echo "<td>".$row['notes']."</td>";
echo "<td>".$row['interaction_date']."</td>";

echo "</tr>";
}

echo "</table>";
?>