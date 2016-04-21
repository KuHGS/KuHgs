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
	$row=mysqli_fetch_assoc($result);
	$DBAPPLICATIONSTATUS = $row['ApplicationStatus'];
	if ($DBAPPLICATIONSTATUS != 0) header("location:studentSummary.php");
	//End of the application lock
    
    $query = mysqli_query($con,"SELECT * FROM Students WHERE UserName='$dbusername'");
    
    $row=mysqli_fetch_assoc($query);
    
    $dbName=$row['StudentName'];
    $dbSurname=$row['StudentSurname'];
    $dbStdID = $row['School_ID'];
    $dbStdEmail = $row['email'];
    $dbPhoneNo = $row['PhoneNo'];
    
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
	echo '<img src="style/images/cross.png"> <br/>';
	else 
	echo '<img src="style/images/tick.png"> <br/>';
	}
	
	function isCompatible($variable) {
	if (strlen($variable) == 0)
	return false;
	else 
	return true;
	}
	
	function isLocked($variable) {
	if ($variable != 0)
	echo 'onclick="return false"';
	else 
	echo 'onclick="return true"';
	}
    
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

<div class="step-passed"><p>1</p></div>
<div class="step-passed"><p>2</p> </div>
<div class="step-passed"><p>3</p> </div>
<div class="step-active"><p>4</p> </div>

</div>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

<div id="titlebar"> &nbsp; </div>

<div id="center">
<div id="information-form">

<form action="" method="post">

<h2> Information Confirmation </h2>

<div class="information-form-row">
<p> Name : <?=$dbName?> </p>
</div>

<div class="information-form-row">
<p> Surname : <?=$dbSurname?> </p>
</div>

<div class="information-form-row">
<p> ID: <?=$dbStdID?> </p>
</div>

<div class="information-form-row">
<p> Mail : <?=$dbStdEmail?> </p>
</div>

<div class="information-form-row">
<p> Phone Number : <?=$dbPhoneNo?> </p>
</div>

<div class="information-form-row">
<p> Car Brand : <?=$dbbrand?> </p>
</div>

<div class="information-form-row">
<p> Car Model : <?=$dbmodel?> </p>
</div>

<div class="information-form-row">
<p> Car Color : <?=$dbcolor?> </p>
</div>

<div class="information-form-row">
<p> Car Plate : <?=$dbplate?> </p>
</div>

<div class="information-form-row">
<p> Drivers License Front :  <?=isItEmpty($dbdriverlicenseFront);?> </p>
</div>

<div class="information-form-row">
<p> Drivers License Back : <?=isItEmpty($dbdriverlicenseBack);?> </p>
</div>

<div class="information-form-row">
<p> Car Registration Page 1 :  <?=isItEmpty($dbcarRegistration1);?> </p>
</div>

<div class="information-form-row">
<p> Car Registration Page 2 : <?=isItEmpty($dbcarRegistration2);?> </p>
</div>

<div class="information-form-row">
<p> Student ID Card Front :  <?=isItEmpty($dbstdIDCardFront);?> </p>
</div>

<div class="information-form-row">
<p> Student ID Card Back : <?=isItEmpty($dbstdIDCardBack);?> </p>
</div>

<div class="information-form-row">
<p> Payment Document :  <?=isItEmpty($dbpaymnetDocument);?> </p>
</div>

<p> SUBMIT YOUT APPLICATION IF INFORMATIONS ABOVE IS CORRECT! </p>

<input id="information-form-submit-button" type="submit" name="submit" value="submit" />
<br/>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

</div>
</div>


<div id="titlebar"> &nbsp; </div>

<div id="center-2">
<div class="information-form-row"><p>&nbsp;</p></div>
<div id="nav-buttons">
<a href="student3.php" id="information-form-prev-button" <?=isLocked($DBAPPLICATIONSTATUS);?> >  Previous Page:</br> Document Upload Page  </a>
</div>
</div>


<?php


if(isset($_POST["submit"])){

	if (isCompatible($dbName) && isCompatible($dbSurname) && isCompatible($dbStdID) 
	&& isCompatible($dbStdEmail) && isCompatible($dbPhoneNo) && isCompatible($dbbrand) 
	&& isCompatible($dbmodel) && isCompatible($dbcolor) && isCompatible($dbplate) 
	&& isCompatible($dbdriverlicenseFront) && isCompatible($dbdriverlicenseBack) && isCompatible($dbcarRegistration1) 
	&& isCompatible($dbcarRegistration2) && isCompatible($dbstdIDCardFront) && isCompatible($dbstdIDCardBack) && isCompatible($dbpaymnetDocument) ) {

	$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `ApplicationStatus` = 1 WHERE `Sys_ID` = '$id'"); 
	echo("<script type=\"text/javascript\" > alert('Your Application Has Been Locked And Sent For Approval Succesfully'); </script>");
	echo("<script type=\"text/javascript\">window.location=\"studentSummary.php\";</script>");
	} else {
	echo("<script type=\"text/javascript\" > alert('There Cannot Be Empty Fields In Your Application'); </script>");
	}

}


?>


</body>
</html>