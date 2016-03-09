<!doctype html>
<html>
<head>
<title>Sign Up</title>
</head>
<body>

<h3>Login Form</h3>
<form action="" method="POST">
Email: <input type="text" name="email"><br />
<br />
<input type="submit" value="Sign Up" name="submit" />
</form>


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
  	$result =mysqli_query($con, "SELECT email FROM Students WHERE email='$email");
  	

	
	if(strcmp($result,$email) == 0){
	
		echo("$email is is already registered! ");
	
	} else {
  	
  	$to      = $_POST['email'];
	$subject = 'Login Password';
	$message = $randomString;
	$headers = 'From: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'Reply-To: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

    $sql =mysqli_query($con, "INSERT INTO `Students` (`System_ID`, `School_ID`, `StudentName`, `StudentSurname`, `UserName`, `Password`, `email`, `PhoneNo`, `HGS_Number`) VALUES ('', '', '', '', '$username', '$randomString', '$email', NULL, '0')");
	
	echo("An email containing your password has been sent to $email. Please check your mail for your login information! ");
	} 
	}
	else 
	{
  		echo("$email is not a valid koç university email address. Please try with your koç university email address! ");
	}


	} else {
  		echo("$email is not a valid email address. Please try again! ");
	}
	
	
} else {
	echo "Please Enter Your Email Address!";
}
}


?>

</body>
</html>