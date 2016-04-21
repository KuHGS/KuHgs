<?php 
session_start();
if(!isset($_SESSION["sess_user"])){
	header("location:index.php");
	
}
    
    $con = mysqli_connect("localhost","hgs-project","w28mkH9H","hgs_project") or die(mysqli_error());
    $query = mysqli_query($con,"SELECT * FROM HGS_Application WHERE ApplicationStatus=1 ");
    

    
?>

<!doctype html>
<html>
<head>
<title>Welcome <?=$_SESSION['sess_user'];?>.</title>
<meta charset="utf-8">
<link href="style/staff.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div id="header">

<div id="logout"> <a id="logout-button" href="logout.php">Logout</a> </div>
<div id="logo"> <img src="/style/images/ku_logo_2.png" alt="Koc University"> </div>
<div id="title"> <h1>Welcome, <?=$_SESSION['sess_user'];?>. </h1> </div>

</div>


<div id="titlebar"> &nbsp; </div>

<div id="center">
<div id="information-form">

<table border="0" >
<th> </th>
<th>Name</th>
<th>Surname</th>
<th>License Plate</th>
</tr>

<?php
    while($log = mysqli_fetch_assoc($query)):
    $id = $log['Sys_ID'];
    $q2 = mysqli_query($con,"SELECT * FROM Students WHERE System_ID='$id'");
    $r2=mysqli_fetch_assoc($q2); ?>
<tr>
<tr>
<!-- <th> <a href="#"> <img src="arrow.png"> </a></th> -->
<th> <form action="" method="post"> <input type="image" src="style/images/arrow.png" name="submit" value="<?php echo $log['Sys_ID'] ?>">
<td><?php echo $r2['StudentName'] ?></td>
<td><?php echo $r2['StudentSurname'] ?></td>
<td><?php echo $log['License_Plate'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<div class="information-form-row">
<p>&nbsp;</p>
</div>

</div>
</div>

<div id="titlebar"> &nbsp; </div>


<?php
    
    if (isset($_POST['submit'])) {
        
        //echo '<br />The ' . $_POST['submit'] . ' button was pressed<br />';

        $id = $_POST['submit'];
        session_start();
        
        $q3 = mysqli_query($con,"SELECT * FROM Students WHERE System_ID='$id'");
        $r3=mysqli_fetch_assoc($q3);
        $_SESSION['sess_username']= $r3['UserName'];
        $_SESSION['sess_systemid']= $id;
        header("Location: ApplicationDetails.php");
        
    }
    

?>

</body>
</html>