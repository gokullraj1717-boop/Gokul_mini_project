<?php
session_start();

if(!isset($_SESSION['user']))
{
header("Location: login.php");
}

include "config.php";

// Total customers
$customers = mysqli_query($conn,"SELECT COUNT(*) as total FROM customers");
$total_customers = mysqli_fetch_assoc($customers)['total'];

// Total interactions
$interactions = mysqli_query($conn,"SELECT COUNT(*) as total FROM interactions");
$total_interactions = mysqli_fetch_assoc($interactions)['total'];

// Calls
$calls = mysqli_query($conn,"SELECT COUNT(*) as total FROM interactions WHERE type='Call'");
$total_calls = mysqli_fetch_assoc($calls)['total'];

// Emails
$emails = mysqli_query($conn,"SELECT COUNT(*) as total FROM interactions WHERE type='Email'");
$total_emails = mysqli_fetch_assoc($emails)['total'];

// Meetings
$meetings = mysqli_query($conn,"SELECT COUNT(*) as total FROM interactions WHERE type='Meeting'");
$total_meetings = mysqli_fetch_assoc($meetings)['total'];

// Purchases
$purchases = mysqli_query($conn,"SELECT COUNT(*) as total FROM interactions WHERE type='Purchase'");
$total_purchases = mysqli_fetch_assoc($purchases)['total'];

// Recent interactions
$recent = mysqli_query($conn,"
SELECT i.*, c.name 
FROM interactions i
LEFT JOIN customers c ON i.customer_id = c.id
ORDER BY i.interaction_date DESC
LIMIT 5
");

// Top customers
$top = mysqli_query($conn,"
SELECT c.id, c.name, COUNT(i.id) as total
FROM customers c
LEFT JOIN interactions i 
ON c.id = i.customer_id
GROUP BY c.id, c.name
ORDER BY total DESC, c.name ASC
LIMIT 5
");

// Monthly analytics
$monthly = mysqli_query($conn,"
SELECT MONTH(interaction_date) as month,
COUNT(*) as total
FROM interactions
GROUP BY MONTH(interaction_date)
ORDER BY MONTH(interaction_date)
");

$months = [];
$totals = [];

while($m = mysqli_fetch_assoc($monthly))
{
$months[] = $m['month'];
$totals[] = $m['total'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
margin-right:20px;
text-decoration:none;
font-weight:bold;
}

.menu a:hover{
color:yellow;
}

/* CARDS */
.container{
width:90%;
margin:40px auto;
text-align:center;
}

.card{
display:inline-block;
width:220px;
background:white;
padding:20px;
margin:15px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.number{
font-size:32px;
color:#007BFF;
font-weight:bold;
}

h1{
text-align:center;
margin-top:20px;
color:#333;
}

/* TABLE */
table{
background:white;
border-collapse:collapse;
}

th,td{
padding:12px;
text-align:center;
}

th{
background:#007BFF;
color:white;
}

.section-title{
text-align:center;
margin-top:50px;
}

.chart-box{
width:60%;
margin:40px auto;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

#clock{
text-align:center;
font-size:20px;
font-weight:bold;
color:#333;
margin-top:10px;
}

.search-box{
width:50%;
margin:20px auto;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
text-align:center;
}

.search-box input{
padding:10px;
width:60%;
border:1px solid #ccc;
border-radius:5px;
}

.search-box button{
padding:10px 20px;
background:#007BFF;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

.search-box button:hover{
background:#0056b3;
}

</style>

</head>

<body>

<!-- MENU -->
<div class="menu">

<a href="index.php">Home</a>

<a href="add_customer.php">Add Customer</a>

<a href="add_interaction.php">Add Interaction</a>

<a href="dashboard.php">Dashboard</a>

<a href="view_customers.php">View Customers</a>

<a href="view_interactions.php">View Interactions</a>

<a href="about.php">About</a>

<a href="contact.php">Contact</a>

<a href="logout.php" style="color:red;">Logout</a>

</div>

<!-- WELCOME -->
<h1>
Welcome <?php echo $_SESSION['user']; ?>
</h1>

<h2 style="text-align:center;color:#007BFF;">
Customer Intelligence Dashboard
</h2>

<!-- CLOCK -->
<div id="clock"></div>

<!-- SEARCH CUSTOMER -->
<div class="search-box">

<h3>Search Customer</h3>

<form action="view_customers.php" method="GET">

<input type="text"
name="search"
placeholder="Enter customer name">

<button type="submit">
Search
</button>

</form>

</div>

<!-- CARDS -->
<div class="container">

<div class="card">
<h3>Total Customers</h3>
<div class="number"><?php echo $total_customers; ?></div>
</div>

<div class="card">
<h3>Total Interactions</h3>
<div class="number"><?php echo $total_interactions; ?></div>
</div>

<div class="card">
<h3>Total Calls</h3>
<div class="number"><?php echo $total_calls; ?></div>
</div>

<div class="card">
<h3>Total Emails</h3>
<div class="number"><?php echo $total_emails; ?></div>
</div>

<div class="card">
<h3>Total Meetings</h3>
<div class="number"><?php echo $total_meetings; ?></div>
</div>

<div class="card">
<h3>Total Purchases</h3>
<div class="number"><?php echo $total_purchases; ?></div>
</div>

</div>

<!-- BAR CHART -->
<div class="chart-box">

<h2 class="section-title">Interaction Statistics</h2>

<canvas id="barChart"></canvas>

</div>

<!-- PIE CHART -->
<div class="chart-box" style="width:40%;">

<h2 class="section-title">Interaction Distribution</h2>

<canvas id="pieChart"></canvas>

</div>

<!-- MONTHLY CHART -->
<div class="chart-box">

<h2 class="section-title">Monthly Interactions</h2>

<canvas id="monthlyChart"></canvas>

</div>

<!-- RECENT INTERACTIONS -->
<h2 class="section-title">Recent Interactions</h2>

<table border="1" style="width:90%;margin:20px auto;">

<tr>
<th>Customer</th>
<th>Type</th>
<th>Notes</th>
<th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($recent)) { ?>

<tr>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['type']; ?></td>

<td><?php echo $row['notes']; ?></td>

<td>
<?php echo date("d-m-Y", strtotime($row['interaction_date'])); ?>
</td>

</tr>

<?php } ?>

</table>

<!-- TOP CUSTOMERS -->
<h2 class="section-title">Top Customers</h2>

<table border="1" style="width:60%;margin:20px auto;">

<tr>
<th>Customer</th>
<th>Total Interactions</th>
</tr>

<?php while($t = mysqli_fetch_assoc($top)) { ?>

<tr>

<td><?php echo $t['name']; ?></td>

<td><?php echo $t['total']; ?></td>

</tr>

<?php } ?>

</table>

<script>

// LIVE CLOCK
setInterval(function(){

var now = new Date();

document.getElementById("clock").innerHTML =
now.toLocaleDateString() + " | " +
now.toLocaleTimeString();

},1000);


// BAR CHART
new Chart(document.getElementById('barChart'), {

type: 'bar',

data: {

labels: ['Calls', 'Emails', 'Meetings', 'Purchases'],

datasets: [{

label: 'Interactions',

data: [
<?php echo $total_calls; ?>,
<?php echo $total_emails; ?>,
<?php echo $total_meetings; ?>,
<?php echo $total_purchases; ?>
],

borderWidth: 1

}]

},

options: {

responsive:true,

scales: {
y: {
beginAtZero: true
}
}

}

});

// MONTHLY CHART
new Chart(document.getElementById('monthlyChart'), {

type: 'line',

data: {

labels: <?php echo json_encode($months); ?>,

datasets: [{

label: 'Monthly Interactions',

data: <?php echo json_encode($totals); ?>,

fill:false,
tension:0.1,
borderWidth:2

}]

}

});

// PIE CHART
new Chart(document.getElementById('pieChart'), {

type: 'pie',

data: {

labels: ['Calls', 'Emails', 'Meetings', 'Purchases'],

datasets: [{

data: [
<?php echo $total_calls; ?>,
<?php echo $total_emails; ?>,
<?php echo $total_meetings; ?>,
<?php echo $total_purchases; ?>
]

}]

}

});

</script>

</body>
</html>