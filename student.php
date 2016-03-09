<?php 
session_start();
if(!isset($_SESSION["sess_username"])){
	header("location:index.php");
	
} 
?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>. <?=$_SESSION['sess_systemid'];?></title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?>. </h1>

	
<h2> <i>1</i> 2 3 4</h2>

<form action="" method="post">
<p>Name:</p> 
<input placeholder="Name" type="text" name="name"  size="15" maxlength="150" />
<p>Surname:</p>
<input placeholder="Surname" type="text" name="surname" size="15" maxlength="150" />
<p>ID:</p>
<input placeholder="School Number" type="text" name="id" size="15" maxlength="150" />
<p>Email:</p>
<input placeholder="<?=$_SESSION['sess_mail']?>" type="text" name="email"  size="15" maxlength="15" disabled/>
<p>Phone No:</p> 
<input placeholder="Phone Number" type="text" name="phoneno"  size="15" maxlength="9" />

<input type="submit" name="submit" value="submit" />
</form>

<a href="student2.php">Next Page: Car Information Page</a>


<?php
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
}
?>

</body>
</html>