<!doctype html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<link href="style/main.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div id="center">

<div id="login-form">

<br />
<img src="/style/images/ku_logo.png" alt="Koc University">
<br />

<h3>Log In</h3>

<form action="" method="POST" id="login-form-fields">

<div class="login-form-row"> <p>👤</p><input placeholder="Username" type="text" name="uname"><br/></div>
<div class="login-form-row"> <p>🔒</p><input placeholder="Password" type="password" name="passw"><br/></div>

<div class="login-form-row"> <p>🎓/👮</p> <select name="loginType"> </div>
<option value="1">Student</option> 
<option value="2">Staff</option> 
</select>

<p>&nbsp;</p>
<input type="submit" value="Login" name="submit" id="login-form-submit-button"/>
</form>

<p>&nbsp;</p>
<a class="login-form-link" href="signup.php">Sign </br> Up</a>
<a class="login-form-link" href="forget.php">Forget </br> Password</a>
<p>&nbsp;</p>

</div>
</div>


<?php
if(isset($_POST["submit"])){

if(!empty($_POST['uname']) && !empty($_POST['passw'])) {
	$type=$_POST['loginType'];
	$user=$_POST['uname'];
	$pass=$_POST['passw'];

 if($type == 1){


    $con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    
  
	$query=mysqli_query($con,"SELECT * FROM Students WHERE UserName='$user' AND Password='$pass' ");
	$numrows=mysqli_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysqli_fetch_assoc($query))
	{
	$dbusername=$row['UserName'];
	$dbpassword=$row['Password'];
	$dbStdID = $row['System_ID'];
	$dbStdEmail = $row['email'];
	
	}

	if($user == $dbusername && $pass == $dbpassword)
	{
		
	session_start();
	$_SESSION['sess_username']= $dbusername;
	$_SESSION['sess_systemid']= $dbStdID;
	$_SESSION['sess_mail']= $dbStdEmail;
	

	/* Redirect browser */
	header("Location: student.php");
	}
	} else {
	echo("<script type=\"text/javascript\" > alert('Invalid username or password for Student!'); </script>");

	}
	} 
	
	else {
	
	
	$con2 = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    
	$query2=mysqli_query($con2,"SELECT * FROM Security_Staff WHERE UserName='$user' AND Password='$pass'");
	$numrows2=mysqli_num_rows($query2);
	if($numrows2!=0)
	{
	while($row2=mysqli_fetch_assoc($query2))
	{
	$dbusername2=$row2['UserName'];
	$dbpassword2=$row2['Password'];
	
	}

	if($user == $dbusername2 && $pass == $dbpassword2)
	{
	session_start();
	$_SESSION['sess_user']=$user;
   
	

	/* Redirect browser */
	header("Location: staff.php");
	}
	} else {
	echo("<script type=\"text/javascript\" > alert('Invalid username or password for Staff!'); </script>");

	}
	}

} else {
	echo("<script type=\"text/javascript\" > alert('All fields are required!'); </script>");

}
}



?>

</body>
</html>