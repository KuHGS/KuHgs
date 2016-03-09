<?php 
session_start();
if(!isset($_SESSION["sess_surname"])){
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

<h2 >1 2 <i>3 </i>4</h2>


<a href="student2.php">Previous Page: Car Information Page | </a>
<a href="student4.php">Next Page: Confirmation Page</a>

<?php
if(isset($_POST["submit"])){
$con = mysqli_connect("localhost","root","","HGS_Database") or die(mysqli_error());

$id = $_SESSION['sess_id'];

    $sql =mysqli_query($con, "INSERT INTO HGS_Application VALUES ('$id', '$_POST[brand]','$_POST[model]','$_POST[color]','$_POST[plate]') ");

echo " added succesfully";
}
?>

</body>
</html>