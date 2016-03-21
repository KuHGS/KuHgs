<?php 

define ("MAX_FILE_SIZE","500");

session_start();
if(!isset($_SESSION["sess_username"])){
	header("location:login.php");
	
}

	$dbusername = $_SESSION['sess_username'];
	$id = $_SESSION['sess_systemid'];
	
	$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
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

<input type="submit" name="submit" value="submit" />
</form>

<a href="student2.php">Previous Page: Car Information Page | </a>
<a href="student4.php">Next Page: Confirmation Page</a>


<?php
if(isset($_POST["submit"])){

$alertString = "";

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) { // There Exist Data Before


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
			$alertString .= "Drivers License Front Updated Succesfully \n";}
	}
	
	
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
			$alertString .= "Drivers License Back Updated Succesfully \n";}
	}
	
	
}
else { // No Data Before Create New
  	//$sql =mysqli_query($con, "INSERT INTO HGS_Application VALUES ('$id', '$_POST[brand]','$_POST[model]','$_POST[color]','$_POST[plate]' , null, null) ");
}
   
 echo("<script>alert('$alertString');</script>");
 echo("<meta http-equiv='refresh' content='1'>");

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