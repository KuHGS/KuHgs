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
	$row2=mysqli_fetch_assoc($result);
	$DBAPPLICATIONSTATUS = $row2['ApplicationStatus'];
	if ($DBAPPLICATIONSTATUS == 1) header("location:student4.php");
	//End of the application lock
	
	$result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
		
	$row=mysqli_fetch_assoc($result);
	
	$dbDriversLicenseFront = $row['Drivers_License_Front'];
	
	
 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>. <?=$_SESSION['sess_systemid'];?></title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?>.</h1>
<p align="right" ><a href="logout.php">Logout</a></p>

<h2 > 1 2 <i> 3 </i> 4</h2>

<form action="" method="post" enctype="multipart/form-data">

<h3> <i> Maximum Allowed File Size is 500 KB! </i> </h3>

<p>Drivers License Front:</p> 
<?=showImage($id,"Drivers_License_Front");?>
<input type="file" name="driverLicenseFront" />

<p>Drivers License Back:</p> 
<?=showImage($id,"Drivers_License_Back");?>
<input type="file" name="driverLicenseBack" />

<p>Car Registration Page 1:</p> 
<?=showImage($id,"Car_Registration_P1");?>
<input type="file" name="CarRegistration1" />

<p>Car Registration Page 2:</p> 
<?=showImage($id,"Car_Registration_P2");?>
<input type="file" name="CarRegistration2" />

<p>Student ID Card Front:</p> 
<?=showImage($id,"std_ID_Card_Front");?>
<input type="file" name="stdIDCardFront" />

<p>Student ID Card Back:</p> 
<?=showImage($id,"std_ID_Card_Back");?>
<input type="file" name="stdIDCardBack" />

<p>Payment Document:</p> 
<?=showImage($id,"Payment_Document");?>
<input type="file" name="PaymentDocument" />


<input type="submit" name="submit" value="submit" />
</form>

<a href="student2.php">Previous Page: Car Information Page | </a>
<a href="student4.php">Next Page: Confirmation Page</a>


<?php
if(isset($_POST["submit"])){

$alertString = "";

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) { // There Exist Data Before

	//Drivers License Front
	$extension = strtolower(getExtension(stripslashes($_FILES['driverLicenseFront']['name']))); 
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Drivers License Front \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Drivers License Back \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Car Registration Page 1 \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Car Registration Page 2 \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Student ID Card Front \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Student ID Card Back \n';}
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
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) { $alertString .= 'Unsupported or No File is Choosen for Payment Document \n';}
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

 if (strlen($alertString) == 0) {$alertString = "All Fields Are Updated";}
  
 echo("<script type=\"text/javascript\" > alert('$alertString'); </script>");
 echo("<meta http-equiv='refresh' content='1'>"); // Refresh Page

}

function showImage($id,$rowName) {
	$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
	$result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE `Sys_ID` = '$id'");
	$row=mysqli_fetch_assoc($result);
	$dbItem = $row[$rowName];
			    
	echo '<img height="300" width="300" src="data:image;base64,'.$dbItem.' "> <br/>';
                
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