<?php
    session_start();
    if(!isset($_SESSION["sess_username"])){
        header("location:login.php");
        
    }
    
    
    $dbusername = $_SESSION['sess_username'];
    
    $con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    $query = mysqli_query($con,"SELECT * FROM Students WHERE UserName='$dbusername'");
    
    $row=mysqli_fetch_assoc($query);
    
    $dbName=$row['StudentName'];
    $dbSurname=$row['StudentSurname'];
    $dbStdID = $row['School_ID'];
    $dbStdEmail = $row['email'];
    $dbPhoneNo = $row['PhoneNo'];
    
    $id = $_SESSION['sess_systemid'];
    
    $result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
    
    $row2=mysqli_fetch_assoc($result);
    
    $dbbrand = $row2['Car_Brand'];
    $dbmodel = $row2['Car_Model'];
    $dbcolor = $row2['Car_Color'];
    $dbplate = $row2['License_Plate'];
    $dbdriverlicenseFront = $row2['Drivers_License_Front'];
	$dbdriverlicenseBack = $row2['Drivers_License_Back'];
	$dbcarRegistration1 = $row2['Car_Registration_P1'];
	$dbcarRegistration2 = $row2['Car_Registration_P2'];	
	$dbstdIDCardFront = $row2['std_ID_Card_Front'];
	$dbstdIDCardBack = $row2['std_ID_Card_Back'];	
	$dbpaymnetDocument = $row2['Payment_Document'];
	
	$DBAPPLICATIONSTATUS = $row2['ApplicationStatus'];

    function isItEmpty($variable) {
	if (strlen($variable) == 0)
	echo '<img src="cross.png"> <br/>';
	else 
	echo '<img src="tick.png"> <br/>';
	}
	
	function isCompatible($variable) {
	if (strlen($variable) == 0)
	return false;
	else 
	return true;
	}
	
	function isLocked($variable) {
	if ($variable == 1)
	echo 'onclick="return false"';
	else 
	echo 'onclick="return true"';
	}
    
    ?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>.</title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?> ! </h1>
<p align="right" ><a href="logout.php">Logout</a></p>

<form action="" method="post">

<h2 >1 2 3 <i> 4 </i> </h2>
<p> Information Confirmation </p>
<p> Name : <?=$dbName?> </p>
<p> Surname : <?=$dbSurname?> </p>
<p> ID: <?=$dbStdID?> </p>
<p> Mail : <?=$dbStdEmail?> </p>
<p> Phone Number : <?=$dbPhoneNo?> </p>
<p> Car Brand : <?=$dbbrand?> </p>
<p> Car Model : <?=$dbmodel?> </p>
<p> Car Color : <?=$dbcolor?> </p>
<p> Car Plate : <?=$dbplate?> </p>
<p> Drivers License Front :  <?=isItEmpty($dbdriverlicenseFront);?> </p>
<p> Drivers License Back : <?=isItEmpty($dbdriverlicenseBack);?> </p>
<p> Car Registration Page 1 :  <?=isItEmpty($dbcarRegistration1);?> </p>
<p> Car Registration Page 2 : <?=isItEmpty($dbcarRegistration2);?> </p>
<p> Student ID Card Front :  <?=isItEmpty($dbstdIDCardFront);?> </p>
<p> Student ID Card Back : <?=isItEmpty($dbstdIDCardBack);?> </p>
<p> Payment Document :  <?=isItEmpty($dbpaymnetDocument);?> </p>


<p> SUBMIT YOUT APPLICATION IF INFORMATIONS ABOVE IS CORRET! </p>

<input type="submit" name="submit" value="submit" />
<br/>

<a href="student3.php"  <?=isLocked($DBAPPLICATIONSTATUS);?> >Previous Page: Document Upload Page </a>


<?php


if(isset($_POST["submit"])){

	if (isCompatible($dbName) && isCompatible($dbSurname) && isCompatible($dbStdID) 
	&& isCompatible($dbStdEmail) && isCompatible($dbPhoneNo) && isCompatible($dbbrand) 
	&& isCompatible($dbmodel) && isCompatible($dbcolor) && isCompatible($dbplate) 
	&& isCompatible($dbdriverlicenseFront) && isCompatible($dbdriverlicenseBack) && isCompatible($dbcarRegistration1) 
	&& isCompatible($dbcarRegistration2) && isCompatible($dbstdIDCardFront) && isCompatible($dbstdIDCardBack) && isCompatible($dbpaymnetDocument) ) {

	$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `ApplicationStatus` = 1 WHERE `Sys_ID` = '$id'"); 
	echo("<script type=\"text/javascript\" > alert('Your Application Has Been Locked And Sent For Approval Succesfully'); </script>");
	echo("<meta http-equiv='refresh' content='1'>"); // Refresh Page
	} else {
	echo("<script type=\"text/javascript\" > alert('There Cannot Be Empty Fields In Your Application'); </script>");
	}

}


?>


</body>
</html>