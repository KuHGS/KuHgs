<?php 
session_start();
if(!isset($_SESSION["sess_user"])){
	header("location:index.php");
	
} 
?>

<!doctype html>
<html>
<head>
<title>Welcome <?=$_SESSION['sess_user'];?>.</title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_user'];?>. </h1>
	



<?php

?>

</body>
</html>