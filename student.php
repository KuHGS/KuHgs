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
<title>Welcome, <?=$_SESSION['sess_username'];?>.</title>
<meta charset="utf-8">
<link href="style/student.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div id="header">

<div id="logout"> <a id="logout-button" href="logout.php">Logout</a> </div>
<div id="logo"> <img src="/style/images/ku_logo_2.png" alt="Koc University"> </div>
<div id="title"> <h1>Welcome, <?=$_SESSION['sess_username'];?>. </h1> </div>

</div>
	
<div id="steps">

<div class="step-active"><p>1</p></div>
<div class="step-inactive"><p>2</p> </div>
<div class="step-inactive"><p>3</p> </div>
<div class="step-inactive"><p>4</p> </div>

</div>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

<div id="titlebar"> &nbsp; </div>

<div id="center">
<div id="information-form">

<form action="" method="post">
<div class="information-form-row">
<p>Name:</p> 
<input placeholder="<?=$dbName?>" type="text" name="name"  size="25" maxlength="150" />
</div>

<div class="information-form-row">
<p>Surname:</p>
<input placeholder="<?=$dbSurname?>" type="text" name="surname" size="25" maxlength="255" />
</div>

<div class="information-form-row">
<p>ID:</p>
<input placeholder="<?=$dbStdID?>" type="text" name="id" size="25" maxlength="255" />
</div>

<div class="information-form-row">
<p>Email:</p>
<input placeholder="<?=$dbStdEmail?>" type="text" name="email"  size="25" maxlength="255" disabled/>
</div>

<div class="information-form-row">
<p>Phone No:</p> 
<input placeholder="<?=$dbPhoneNo?>" type="text" name="phoneno"  size="25" maxlength="11" />
<p>&nbsp;</p>
</div>

<input id="information-form-submit-button" type="submit" name="submit" value="submit" />
</form>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

</div>
</div>

<div id="titlebar"> &nbsp; </div>

<div id="center-2">
<div class="information-form-row"><p>&nbsp;</p></div>
<div id="nav-buttons">
<a href="student2.php" id="information-form-next-button" >   Next Page:</br> Car Information Page  </a>
</div>
</div>



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