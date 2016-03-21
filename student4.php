<?php
    session_start();
    if(!isset($_SESSION["sess_username"])){
        header("location:login.php");
        
    }
    
    
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
    
    $con2 = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    $result = mysqli_query($con,"SELECT * FROM HGS_Application WHERE Sys_ID='$id'");
    
    $row2=mysqli_fetch_assoc($result);
    
    $dbbrand = $row2['Car_Brand'];
    $dbmodel = $row2['Car_Model'];
    $dbcolor = $row2['Car_Color'];
    $dbplate = $row2['License_Plate'];

    
    
    ?>

<!doctype html>
<html>
<head>
<title>Welcome, <?=$_SESSION['sess_username'];?>.</title>
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_username'];?> ! </h1>

<h2 >1 2 3 <i> 4 </i> </h2>
<p> Information Confirmation </p>
<p> Name : <?=$dbName?> </p>
<p> Surname : <?=$dbSurname?> </p>
<p> ID: <?=$dbStdID?> </p>
<p> Mail : <?=$dbStdEmail?> </p>
<p> Phone Number : <?=$dbPhoneNo?> </p>
<p> Car Brand : <?=$dbbrand?> </p>
<p> Car Model : <?=$bmodel?> </p>
<p> Car Color : <?=$dbcolor?> </p>
<p> Car Plate : <?=$dplate?> </p>
<p> SUBMIT YOUT APPLICATION IF INFORMATIONS ABOVE IS CORRET! </p>

<a href="student3.php">Previous Page: Document Upload Page | </a>




</body>
</html>