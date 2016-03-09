<?php 
session_start();
if(!isset($_SESSION["sess_surname"])){
	header("location:index.php");
	
} 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>. <?=$_SESSION['sess_systemid'];?></title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?>.</h1>

<h2 > 1 <i> 2 </i> 3 4</h2>

<form action="" method="post">
<p>Car Brand:</p> 
<input type="text" name="brand"  size="15" maxlength="15" />
<p>Car Model:</p>
<input type="text" name="model" size="15" maxlength="15" />
<p>Car Color:</p>
<input type="text" name="color"  size="15" maxlength="15" />
<p>License Plate:</p> 
<input type="text" name="plate"  size="15" maxlength="9" />

<input type="submit" name="submit" value="submit" />
</form>

<a href="student.php">Previous Page: Personal Information Page | </a>
<a href="student3.php">Next Page: Document Upload Page</a>


<?php
if(isset($_POST["submit"])){

$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());

$id = $_SESSION['sess_systemid'];

    $sql =mysqli_query($con, "INSERT INTO HGS_Application VALUES ('$id', '$_POST[brand]','$_POST[model]','$_POST[color]','$_POST[plate]') ");

echo " added succesfully";
}
?>

</body>
</html>