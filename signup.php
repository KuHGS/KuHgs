<!doctype html>
<html>
<head>
<title>Sign Up</title>
<link href="style/main.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div id="center">
<div id="login-form">

<br />
<img src="/style/images/ku_logo.png" alt="Koc University">
<p>&nbsp;</p>

<h3>Sign Up</h3>
<form action="" method="POST">
<div class="login-form-row"> <p> 📨 </p> <input placeholder="Email" type="text" name="email"><br/></div>
<p>&nbsp;</p>
<input type="submit" value="Sign Up" name="submit" id="login-form-submit-button"/>
</form>
<p>&nbsp;</p>
<a class="login-form-link" href="login.php">Go To <br/>Log In Page </a>

<a class="login-form-link"href="forget.php">Go To <br/>Forget Password</a>

<p>&nbsp;</p>


</div>
</div>


<?php
if(isset($_POST["submit"])){

if(!empty($_POST['email'])) {


	$length = 10;
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);

 
	$email = $_POST['email'];
	
	
	$my_Array = explode('@', $email);
	
    $username = $my_Array[0];
    $ku = $my_Array[1]; 
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  	
  	if(strcmp($ku,"ku.edu.tr") == 0){
  	
  	$con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
  	$result =mysqli_query($con, "SELECT email FROM Students WHERE email='$email' ");
  	$row=mysqli_fetch_assoc($result);
  	
    $dbStdEmail = $row['email'];
	
	if(strlen($dbStdEmail) != 0){
	
	echo("<script type=\"text/javascript\" > alert('$email is already registered! '); </script>");
	
	} else {
  	
  	$to      = $_POST['email'];
	$subject = 'Login Password';
	$message = "Username: " . $username . "\r\n" . "Password: ". $randomString;
	$headers = 'From: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'Reply-To: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

    $sql =mysqli_query($con, "INSERT INTO `Students` (`System_ID`, `School_ID`, `StudentName`, `StudentSurname`, `UserName`, `Password`, `email`, `PhoneNo`, `HGS_Number`) VALUES ('', '', '', '', '$username', '$randomString', '$email', NULL, '0')");
	
	echo("<script type=\"text/javascript\" > alert('An email containing your password has been sent to $email. Please check your mail for your login information! '); </script>");

	} 
	}
	else 
	{
	echo("<script type=\"text/javascript\" > alert('$email is not a valid koç university email address. Please try with your koç university email address! '); </script>");
	}


	} else {
	echo("<script type=\"text/javascript\" > alert('$email is not a valid email address. Please try again! '); </script>");

	}
	
	
} else {
echo("<script type=\"text/javascript\" > alert('Please Enter Your Email Address! '); </script>");

}
}


?>

</body>
</html>