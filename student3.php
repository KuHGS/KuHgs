<?php 

define ("MAX_FILE_SIZE","500");

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
	
	
	$dbdriverlicenseFront = $row['Drivers_License_Front'];
	$dbdriverlicenseBack = $row['Drivers_License_Back'];
	$dbcarRegistration1 = $row['Car_Registration_P1'];
	$dbcarRegistration2 = $row['Car_Registration_P2'];	
	$dbstdIDCardFront = $row['std_ID_Card_Front'];
	$dbstdIDCardBack = $row['std_ID_Card_Back'];	
	$dbpaymnetDocument = $row['Payment_Document'];
	
	function isEmpty($variable) {
	if (strlen($variable) == 0)
	return true;
	else 
	return false;
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
<div class="step-active"><p>3</p> </div>
<div class="step-inactive"><p>4</p> </div>

</div>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

<div id="titlebar"> &nbsp; </div>

<div id="center">
<div id="information-form">

<form action="" method="post" enctype="multipart/form-data">

<h3> <i> Maximum Allowed File Size is <?= MAX_FILE_SIZE;?> KB! </i> </h3>

<div class="information-form-row">
<p>Drivers License Front:</p> 
<?=showImage($id,"Drivers_License_Front");?>
<input type="file" name="driverLicenseFront" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Drivers License Back:</p> 
<?=showImage($id,"Drivers_License_Back");?>
<input type="file" name="driverLicenseBack" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Car Registration Page 1:</p> 
<?=showImage($id,"Car_Registration_P1");?>
<input type="file" name="CarRegistration1" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Car Registration Page 2:</p> 
<?=showImage($id,"Car_Registration_P2");?>
<input type="file" name="CarRegistration2" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Student ID Card Front:</p> 
<?=showImage($id,"std_ID_Card_Front");?>
<input type="file" name="stdIDCardFront" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Student ID Card Back:</p> 
<?=showImage($id,"std_ID_Card_Back");?>
<input type="file" name="stdIDCardBack" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

<div class="information-form-row">
<p>Payment Document:</p> 
<?=showImage($id,"Payment_Document");?>
<input type="file" name="PaymentDocument" />
</div>

<div class="information-form-row"><p>&nbsp;</p></div>

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
<a href="student2.php" id="information-form-prev-button" >  Previous Page:</br> Car Information Page  </a>
<a href="student4.php" id="information-form-next-button" >   Next Page:</br> Confirmation Page  </a>
</div>
</div>


<?php
if(isset($_POST["submit"])){

$alertString = "";

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) { // There Exist Data Before

	//Drivers License Front
	$extension = strtolower(getExtension(stripslashes($_FILES['driverLicenseFront']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbdriverlicenseFront) ) $alertString .= 'Unsupported or No File is Choosen for Drivers License Front \n'; }
 	else {
 	
 		$size=filesize($_FILES['driverLicenseFront']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Drivers License Front is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['driverLicenseFront']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Drivers_License_Front` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Drivers License Front Updated Succesfully \n";
			}
	}
	
	//Drivers License Back
	$extension = strtolower(getExtension(stripslashes($_FILES['driverLicenseBack']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbdriverlicenseBack) ) $alertString .= 'Unsupported or No File is Choosen for Drivers License Back \n';}
 	else {
 	
 		$size=filesize($_FILES['driverLicenseBack']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Drivers License Back is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['driverLicenseBack']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Drivers_License_Back` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Drivers License Back Updated Succesfully \n";
			}
	}
	
	//Car Registration Page 1
	$extension = strtolower(getExtension(stripslashes($_FILES['CarRegistration1']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbcarRegistration1) ) $alertString .= 'Unsupported or No File is Choosen for Car Registration Page 1 \n';}
 	else {
 	
 		$size=filesize($_FILES['CarRegistration1']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Car Registration Page 1 is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['CarRegistration1']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Car_Registration_P1` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Car Registration Page 1 Updated Succesfully \n";
			}
	}
	
	//Car Registration Page 2
	$extension = strtolower(getExtension(stripslashes($_FILES['CarRegistration2']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbcarRegistration2) ) $alertString .= 'Unsupported or No File is Choosen for Car Registration Page 2 \n';}
 	else {
 	
 		$size=filesize($_FILES['CarRegistration2']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Car Registration Page 2 is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['CarRegistration2']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Car_Registration_P2` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Car Registration Page 2 Updated Succesfully \n";
			}
	}
	
	//Student ID Card Front
	$extension = strtolower(getExtension(stripslashes($_FILES['stdIDCardFront']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbstdIDCardFront) ) $alertString .= 'Unsupported or No File is Choosen for Student ID Card Front \n';}
 	else {
 	
 		$size=filesize($_FILES['stdIDCardFront']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Student ID Card Front is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['stdIDCardFront']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `std_ID_Card_Front` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Student ID Card Front Updated Succesfully \n";
			}
	}
	
	//Student ID Card Back
	$extension = strtolower(getExtension(stripslashes($_FILES['stdIDCardBack']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbstdIDCardBack) ) $alertString .= 'Unsupported or No File is Choosen for Student ID Card Back \n';}
 	else {
 	
 		$size=filesize($_FILES['stdIDCardBack']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Student ID Card Back is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['stdIDCardBack']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `std_ID_Card_Back` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Student ID Card Back Updated Succesfully \n";
			}
	}
	
	
	//Payment Document
	$extension = strtolower(getExtension(stripslashes($_FILES['PaymentDocument']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { 
 		if ( isEmpty($dbpaymnetDocument) ) $alertString .= 'Unsupported or No File is Choosen for Payment Document \n';}
 	else {
 	
 		$size=filesize($_FILES['PaymentDocument']['tmp_name']);
 		if ($size > MAX_FILE_SIZE*1024) { $alertString .= 'Payment Document is Bigger Than Maximum Allowed File Size \n';}
 		
 		else {
   			$image= addslashes($_FILES['PaymentDocument']['tmp_name']);
    		$image= file_get_contents($image);
    		$image= base64_encode($image);
			$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `Payment_Document` = '$image' WHERE `Sys_ID` = '$id'");
			//$alertString .= "Payment Document Updated Succesfully \n";
			}
	}
	
	
	
}
else { // No Data Before Create New
	$sql =mysqli_query($con, "INSERT INTO HGS_Application VALUES ('$id', '','','','' ,null ,null ,null ,null ,null ,null ,null,0) ");
}

 if (strlen($alertString) == 0) {$alertString = "Update Completed";}
  
 echo("<script type=\"text/javascript\" > alert('$alertString'); </script>");
 echo("<meta http-equiv='refresh' content='1'>"); // Refresh Page

}

function showImage($id,$rowName) {
	$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
	$result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE `Sys_ID` = '$id'");
	$row=mysqli_fetch_assoc($result);
	$dbItem = $row[$rowName];
		
	if ( isEmpty($dbItem) ) { echo '<img height="300" width="300" src="style/images/No_Image_Available.png"> <br/>'; }		    
	else { echo '<img height="300" width="300" src="data:image;base64,'.$dbItem.' "> <br/>'; };
                
	mysqli_close($con);  
}

function getExtension($str) {
	$i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

?>

</body>
</html>