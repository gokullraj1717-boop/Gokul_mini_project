<?php
include "config.php";
session_start();

$msg = "";

if(isset($_POST['login']))
{
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users 
WHERE username='$username' 
AND password='$password'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0)
{
$_SESSION['user'] = $username;

header("Location: dashboard.php");
}
else
{
$msg = "Invalid Username or Password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
text-align:center;
margin-top:100px;
}

form{
background:white;
padding:30px;
display:inline-block;
border-radius:10px;
box-shadow:0 0 10px gray;
}

input{
padding:10px;
margin:10px;
width:250px;
}

button{
padding:10px 20px;
background:#007BFF;
color:white;
border:none;
cursor:pointer;
}

button:hover{
background:#0056b3;
}

</style>

</head>

<body>

<h2>Customer Intelligence Login</h2>

<form method="POST">

<input type="text" 
name="username" 
placeholder="Username" required>

<br>

<input type="password" 
name="password" 
placeholder="Password" required>

<br>

<button type="submit" name="login">
Login
</button>

<br><br>

<span style="color:red;font-weight:bold;">
<?php echo $msg; ?>
</span>

</form>

</body>
</html>