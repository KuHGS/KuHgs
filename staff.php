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
</head>
<body>

<h1>Welcome, <?=$_SESSION['sess_user'];?>. </h1>
<p align="right" ><a href="logout.php">Logout</a></p>


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
<th> <form action="" method="post"> <input type="image" src="arrow.png" name="submit" value="<?php echo $log['Sys_ID'] ?>">
<td><?php echo $r2['StudentName'] ?></td>
<td><?php echo $r2['StudentSurname'] ?></td>
<td><?php echo $log['License_Plate'] ?></td>
</tr>
<?php endwhile; ?>
</table>



<?php
    
    if (isset($_POST['submit'])) {
        
        echo '<br />The ' . $_POST['submit'] . ' button was pressed<br />';

        $id = $_POST['submit'];
        session_start();
        
        $q3 = mysqli_query($con,"SELECT * FROM Students WHERE System_ID='$id'");
        $r3=mysqli_fetch_assoc($q3);
        $_SESSION['sess_username']= $r3['UserName'];
        $_SESSION['sess_systemid']= $id;
        header("Location: student4.php");
        
    }
    

?>

</body>
</html>