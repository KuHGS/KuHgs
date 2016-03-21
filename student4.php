<?php 
session_start();
if(!isset($_SESSION["sess_username"])){
	header("location:index.php");
	
} 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_surname'];?>.</title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_name'];?> <?=$_SESSION['sess_surname'];?>! </h1>

<h2 >1 2 3 <i> 4 </i> </h2>


<a href="student3.php">Previous Page: Document Upload Page | </a>




</body>
</html>