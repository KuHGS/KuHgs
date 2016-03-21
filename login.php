<!doctype html>
<html>
<head>
<title>Login</title>
</head>
<body>

<h3>Login Form</h3>
<form action="" method="POST">
Username: <input type="text" name="uname"><br />
Password: <input type="password" name="passw"><br />	
Log in as: <select name="loginType">
<option value="1">Student</option> 
<option value="2">Staff</option> 
</select>
<br />
<input type="submit" value="Login" name="submit" />
</form>

<a href="signup.php">Sign Up</a>


<?php
if(isset($_POST["submit"])){

if(!empty($_POST['uname']) && !empty($_POST['passw'])) {
	$type=$_POST['loginType'];
	$user=$_POST['uname'];
	$pass=$_POST['passw'];

 if($type == 1){


	$con = mysql_connect("localhost","hgs-project","w28mkH9H") or die(mysql_error());
    mysql_select_db("hgs_project", $con)or die("cannot select DB");
    
  
	$query=mysql_query("SELECT * FROM Students WHERE UserName='$user' AND Password='$pass' ");
	$numrows=mysql_num_rows($query);
	if($numrows!=0)
	{
	while($row=mysql_fetch_assoc($query))
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
	echo "Invalid username or password for Student!";
	}
	} 
	
	else {
	
	
	$con2 = mysql_connect("localhost","hgs-project","w28mkH9H") or die(mysql_error());
    mysql_select_db("hgs_project", $con2)or die("cannot select DB");
    
	$query2=mysql_query("SELECT * FROM Security_Staff WHERE UserName='$user' AND Password='$pass'");
	$numrows2=mysql_num_rows($query2);
	if($numrows2!=0)
	{
	while($row2=mysql_fetch_assoc($query2))
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
	echo "Invalid username or password for Staff!";
	}
	}

} else {
	echo "All fields are required!";
}
}



?>

</body>
</html>