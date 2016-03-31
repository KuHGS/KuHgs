<?php 
session_start();
if(!isset($_SESSION["sess_username"])){
	header("location:login.php");
	
}

	$dbusername = $_SESSION['sess_username'];
	$id = $_SESSION['sess_systemid'];
	
	$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
	
	//Start of the application lock
	$result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
	$row2=mysqli_fetch_assoc($result);
	$DBAPPLICATIONSTATUS = $row2['ApplicationStatus'];
	if ($DBAPPLICATIONSTATUS != 0) header("location:studentSummary.php");
	//End of the application lock
		
	
	$result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
		
	$row=mysqli_fetch_assoc($result);
	
	$dbbrand = $row['Car_Brand'];
	$dbmodel = $row['Car_Model'];
	$dbcolor = $row['Car_Color'];
	$dbplate = $row['License_Plate'];
	
 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>. <?=$_SESSION['sess_systemid'];?></title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?>.</h1>
<p align="right" ><a href="logout.php">Logout</a></p>

<h2 > 1 <i> 2 </i> 3 4</h2>

<form action="" method="post">
<p>Car Brand:</p> 
<input placeholder="<?=$dbbrand?>" type="text" name="brand"  size="15" maxlength="15" />
<p>Car Model:</p>
<input placeholder="<?=$dbmodel?>" type="text" name="model" size="15" maxlength="15" />
<p>Car Color:</p>
<input placeholder="<?=$dbcolor?>" type="text" name="color"  size="15" maxlength="15" />
<p>License Plate:</p> 
<input placeholder="<?=$dbplate?>" type="text" name="plate"  size="15" maxlength="9" />

<input type="submit" name="submit" value="submit" />
</form>

<a href="student.php">Previous Page: Personal Information Page | </a>
<a href="student3.php">Next Page: Document Upload Page</a>


<?php
if(isset($_POST["submit"])){

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) { // There Exist Data Before

	if(!empty($_POST[brand])){
     $sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Car_Brand` = '$_POST[brand]' WHERE `Sys_ID` = '$id'"); }

	if(!empty($_POST[model])){
    $sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Car_Model` = '$_POST[model]' WHERE `Sys_ID` = '$id'"); }
    
    if(!empty($_POST[color])){
    $sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Car_Color` = '$_POST[color]' WHERE `Sys_ID` = '$id'"); }

    if(!empty($_POST[plate])){
    $sql =mysqli_query($con, "UPDATE `HGS_Application` SET `License_Plate` = '$_POST[plate]' WHERE `Sys_ID` = '$id'"); }

}
else { // No Data Before Create New
  	$sql =mysqli_query($con, "INSERT INTO HGS_Application VALUES ('$id', '$_POST[brand]','$_POST[model]','$_POST[color]','$_POST[plate]' ,null ,null ,null ,null ,null ,null ,null,0) ");
}
   
echo " added succesfully";
echo("<meta http-equiv='refresh' content='1'>"); // Refresh Page

}
?>

</body>
</html>