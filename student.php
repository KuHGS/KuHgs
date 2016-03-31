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

	$query = mysqli_query($con,"SELECT * FROM Students WHERE UserName='$dbusername'");
	
	$row=mysqli_fetch_assoc($query);
	
	$dbName=$row['StudentName'];
	$dbSurname=$row['StudentSurname'];
	$dbStdID = $row['School_ID'];
	$dbStdEmail = $row['email'];
	$dbPhoneNo = $row['PhoneNo'];
	
 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>. <?=$_SESSION['sess_systemid'];?></title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?>. </h1>
<p align="right" ><a href="logout.php">Logout</a></p>
	
<h2> <i>1</i> 2 3 4</h2>

<form action="" method="post">
<p>Name:</p> 
<input placeholder="<?=$dbName?>" type="text" name="name"  size="25" maxlength="150" />
<p>Surname:</p>
<input placeholder="<?=$dbSurname?>" type="text" name="surname" size="25" maxlength="255" />
<p>ID:</p>
<input placeholder="<?=$dbStdID?>" type="text" name="id" size="25" maxlength="255" />
<p>Email:</p>
<input placeholder="<?=$dbStdEmail?>" type="text" name="email"  size="25" maxlength="255" disabled/>
<p>Phone No:</p> 
<input placeholder="<?=$dbPhoneNo?>" type="text" name="phoneno"  size="25" maxlength="11" />

<input type="submit" name="submit" value="submit" />
</form>

<a href="student2.php">Next Page: Car Information Page</a>

<?php

session_start();
$dbusername = $_SESSION['sess_username'];

$_SESSION['sess_username']= $dbusername;


if(isset($_POST["submit"])){
$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());

$id = $_SESSION['sess_systemid'];

if(!empty($_POST[name]))
{
    $sql =mysqli_query($con, "UPDATE `Students` SET `StudentName` = '$_POST[name]' WHERE `System_ID` = '$id'");
}

if(!empty($_POST[surname]))
{
    $sql =mysqli_query($con, "UPDATE `Students` SET `StudentSurname` = '$_POST[surname]' WHERE `System_ID` = '$id'");
}

if(!empty($_POST[id]))
{
    $sql =mysqli_query($con, "UPDATE `Students` SET `School_ID` = '$_POST[id]' WHERE `System_ID` = '$id'");
}

if(!empty($_POST[phoneno]))
{
    $sql =mysqli_query($con, "UPDATE `Students` SET `PhoneNo` = '$_POST[phoneno]' WHERE `System_ID` = '$id'");
}


echo " added succesfully";
echo("<meta http-equiv='refresh' content='1'>");
}

?>

</body>
</html>