<?php
    session_start();
    if(!isset($_SESSION["sess_user"])){
        header("location:login.php");
        
    }
    
    $dbadminusername = $_SESSION["sess_user"];
    $dbusername = $_SESSION['sess_username'];
    
    $con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    $query = mysqli_query($con,"SELECT * FROM Students WHERE UserName='$dbusername'");
    
    $row=mysqli_fetch_assoc($query);
    
    $dbName=$row['StudentName'];
    $dbSurname=$row['StudentSurname'];
    $dbStdID = $row['School_ID'];
    $dbStdEmail = $row['email'];
    $dbPhoneNo = $row['PhoneNo'];
    
    $id = $_SESSION['sess_systemid'];
    
    $result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
    
    $row2=mysqli_fetch_assoc($result);
    
    $dbbrand = $row2['Car_Brand'];
    $dbmodel = $row2['Car_Model'];
    $dbcolor = $row2['Car_Color'];
    $dbplate = $row2['License_Plate'];
    $dbdriverlicenseFront = $row2['Drivers_License_Front'];
	$dbdriverlicenseBack = $row2['Drivers_License_Back'];
	$dbcarRegistration1 = $row2['Car_Registration_P1'];
	$dbcarRegistration2 = $row2['Car_Registration_P2'];	
	$dbstdIDCardFront = $row2['std_ID_Card_Front'];
	$dbstdIDCardBack = $row2['std_ID_Card_Back'];	
	$dbpaymnetDocument = $row2['Payment_Document'];
	
	$DBAPPLICATIONSTATUS = $row2['ApplicationStatus'];

	function isEmpty($variable) {
	if (strlen($variable) == 0)
	return true;
	else 
	return false;
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
		
	function isCompatible($variable) {
	if (strlen($variable) == 0)
	return false;
	else 
	return true;
	}
	
	function isLocked($variable) {
	if ($variable == 1)
	echo 'onclick="return false"';
	else 
	echo 'onclick="return true"';
	}
    
    ?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$dbadminusername;?>.</title>
<meta charset="utf-8">
<link href="style/staff.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div id="header">

<div id="logout"> <a id="logout-button" href="logout.php">Logout</a> </div>
<div id="logo"> <img src="/style/images/ku_logo_2.png" alt="Koc University"> </div>
<div id="title"> <h1>Welcome, <?=$dbadminusername;?>. </h1> </div>


</div>

<div id="titlebar"> &nbsp; </div>

<div id="center">
<div id="information-form">

<a class="information-form-link-2" href="staff.php">See All <br /> Applications</a>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

<form action="" method="post">

<div id="myDIV" style="">

<h2> Information Confirmation </h2>

<p> Name : <?=$dbName?> </p>
<p> Surname : <?=$dbSurname?> </p>
<p> ID: <?=$dbStdID?> </p>
<p> Mail : <?=$dbStdEmail?> </p>
<p> Phone Number : <?=$dbPhoneNo?> </p>
<p> Car Brand : <?=$dbbrand?> </p>
<p> Car Model : <?=$dbmodel?> </p>
<p> Car Color : <?=$dbcolor?> </p>
<p> Car Plate : <?=$dbplate?> </p>
<p> Drivers License Front : <br/> <?=showImage($id,"Drivers_License_Front");?> </p>
<p> Drivers License Back : <br/> <?=showImage($id,"Drivers_License_Back");?> </p>
<p> Car Registration Page 1 : <br/> <?=showImage($id,"Car_Registration_P1");?> </p>
<p> Car Registration Page 2 :<br/> <?=showImage($id,"Car_Registration_P2");?> </p>
<p> Student ID Card Front : <br/> <?=showImage($id,"std_ID_Card_Front");?> </p>
<p> Student ID Card Back : <br/> <?=showImage($id,"std_ID_Card_Back");?> </p>
<p> Payment Document : <br/> <?=showImage($id,"Payment_Document");?> </p>


<input id="information-form-approve-button" type="submit" name="Approve" value="Approve" />
<input id="information-form-decline-button" type="submit"  name="Disapprove" value="Disapprove" />
<br/>
</div>

<p id="DisapproveParagraph" style=" display:none" > Please enter your message. Your Disapproval message will sent to <?=$dbStdEmail?> </p>
<br/>
<input type="hidden"  name="emailBody" id="msgBox" size="50""/>
<input type="hidden"  name="sendBtn" id="SendButton" value="Send Mail"/>


<p id="ApproveParagraph" style=" display:none" > Please enter HGS Number message. The Approval message will sent to <?=$dbStdEmail?> automatically.</p>
<br/>
<input type="hidden"  name="NumberBody" id="NumberBox" size="5" maxlength="5""/>
<input type="hidden"  name="NoSendBtn" id="NoSendButton" value="Complete Application"/>

</form>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

</div>
</div>

<div id="titlebar"> &nbsp; </div>

<?php


if(isset($_POST["Approve"])){

	echo( "<script language=\"javascript\">
    changeVisibilityApprove = function () {
    	document.getElementById(\"ApproveParagraph\").style.display = \"inline\"; 
        document.getElementById('NumberBox').type = \"text\";
        document.getElementById('NoSendButton').type = \"submit\";
        document.getElementById(\"myDIV\").style.display = \"none\"; 
    }
	</script> ");
	
	echo("<script type=\"text/javascript\" > changeVisibilityApprove(); </script>");
	

}


if(isset($_POST["Disapprove"])){
	
	
	
	echo( "<script language=\"javascript\">
    changeVisibilityDisapprove = function () {
    	document.getElementById(\"DisapproveParagraph\").style.display = \"inline\"; 
        document.getElementById('msgBox').type = \"text\";
        document.getElementById('SendButton').type = \"submit\";
        document.getElementById(\"myDIV\").style.display = \"none\"; 
    }
	</script> ");
	
	echo("<script type=\"text/javascript\" > changeVisibilityDisapprove(); </script>");
	 

}

if( !empty($_POST["emailBody"]) ){

	
	$aaa = $_POST["emailBody"];
     
    $to      = $dbStdEmail;
	$subject = 'HGS Application Denial';
	$message = "Your HGS application has been denied. This is your message from security office: \r\n" . $aaa;
	$headers = 'From: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'Reply-To: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	
	echo("<script type=\"text/javascript\" > alert('Your email to ");
    echo $dbStdEmail;
    echo(" has been sent succesfully'); </script>");
    
	$sql =mysqli_query($con, "UPDATE `HGS_Application` SET `ApplicationStatus` = 0 WHERE `Sys_ID` = '$id'");
	die('<script type="text/javascript">window.location="staff.php";</script>');

}

if( !empty($_POST["NumberBody"]) ){

	
	$to      = $dbStdEmail;
	$subject = 'HGS Application Approval';
	$message = "Your HGS application has been approved. You can come to the securiy office with your Drivers license, Student ID and Car Registration document to collect your HGS sticker. \r\n";
	$headers = 'From: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'Reply-To: noreply@hgs-project.ku.edu.tr' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	
	echo("<script type=\"text/javascript\" > alert('The Approval message to ");
    echo $dbStdEmail;
    echo(" has been sent succesfully'); </script>");
    
    mysqli_query($con, "UPDATE `HGS_Application` SET `ApplicationStatus` = 2 WHERE `Sys_ID` = '$id'");
    
    $HGSno = $_POST["NumberBody"];
    mysqli_query($con, "INSERT INTO HGS_Owners VALUES ('$id', '$HGSno' )");
	mysqli_query($con, "UPDATE `Students` SET `HGS_Number` = '$HGSno' WHERE `System_ID` = '$id'");
    
    
	die('<script type="text/javascript">window.location="staff.php";</script>');
	

}


?>


</body>
</html>