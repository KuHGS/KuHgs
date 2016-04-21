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
<div class="step-active"><p>2</p> </div>
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
<p>Car Brand: <?=$dbbrand?></p>
<select name="brand">
<option value="">Select a Brand</option>
<option value="Alfa Romeo">Alfa Romeo</option>
<option value="Aston Martin">Aston Martin</option>
<option value="Audi">Audi</option>
<option value="Bentley">Bentley</option>
<option value="BMW">BMW</option>
<option value="Bugatti">Bugatti</option>
<option value="Cadillac">Cadillac</option>
<option value="Chevrolet">Chevrolet</option>
<option value="Chrysler">Chrysler</option>
<option value="Citroën">Citroën</option>
<option value="Dacia">Dacia</option>
<option value="Daewoo">Daewoo</option>
<option value="Daihatsu">Daihatsu</option>
<option value="Dodge">Dodge</option>
<option value="Ferrari">Ferrari</option>
<option value="FIAT">FIAT</option>
<option value="Ford">Ford</option>
<option value="GMC">GMC</option>
<option value="Honda">Honda</option>
<option value="Hummer">Hummer</option>
<option value="Hyundai">Hyundai</option>
<option value="Infiniti">Infiniti</option>
<option value="Isuzu">Isuzu</option>
<option value="Jaguar">Jaguar</option>
<option value="Jeep">Jeep</option>
<option value="Kia">Kia</option>
<option value="Lamborghini">Lamborghini</option>
<option value="Land Rover">Land Rover</option>
<option value="Lexus">Lexus</option>
<option value="Lincoln">Lincoln</option>
<option value="Lotus">Lotus</option>
<option value="Maserati">Maserati</option>
<option value="Maybach">Maybach</option>
<option value="Mazda">Mazda</option>
<option value="McLaren">McLaren</option>
<option value="Mercedes-Benz">Mercedes-Benz</option>
<option value="MG">MG</option>
<option value="MINI">MINI</option>
<option value="Mitsubishi">Mitsubishi</option>
<option value="Nissan">Nissan</option>
<option value="Opel">Opel</option>
<option value="Peugeot">Peugeot</option>
<option value="Pontiac">Pontiac</option>
<option value="Porsche">Porsche</option>
<option value="Ram">Ram</option>
<option value="Renault">Renault</option>
<option value="Rolls-Royce">Rolls-Royce</option>
<option value="Saab">Saab</option>
<option value="Smart">Smart</option>
<option value="SsangYong">SsangYong</option>
<option value="Seat">Seat</option>
<option value="Skoda">Skoda</option>
<option value="Subaru">Subaru</option>
<option value="Suzuki">Suzuki</option>
<option value="Tesla">Tesla</option>
<option value="Toyota">Toyota</option>
<option value="Volkswagen">Volkswagen</option>
<option value="Volvo">Volvo</option>
</select> 
</div>

<div class="information-form-row">
<p>Car Model:</p>
<input placeholder="<?=$dbmodel?>" type="text" name="model" size="15" maxlength="15" />
</div>

<div class="information-form-row">
<p>Car Color:</p>
<input placeholder="<?=$dbcolor?>" type="text" name="color"  size="15" maxlength="15" />
</div>

<div class="information-form-row">
<p>License Plate:</p> 
<input placeholder="<?=$dbplate?>" type="text" name="plate"  size="15" maxlength="9" />
</div>

<div class="information-form-row">
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
<a href="student.php" id="information-form-prev-button" >  Previous Page:</br> Personal Information Page  </a>
<a href="student3.php" id="information-form-next-button" >   Next Page:</br> Document Upload Page  </a>
</div>
</div>



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