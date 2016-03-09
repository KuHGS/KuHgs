<?php
/**
 * Test MySQL connection / inserting
 *
 * Test db table
 *
  CREATE  TABLE `test`.`test_log` (
   `id` INT NOT NULL AUTO_INCREMENT ,
   `message` VARCHAR(255) NULL ,
    PRIMARY KEY (`id`) )
	ENGINE = InnoDB;
  
 * 
 */
// Handle errors and warnings
function exceptions_error_handler($severity, $message, $filename, $lineNo)
{
	throw new ErrorException($message, 0, $severity, $filename, $lineNo);
}
set_error_handler('exceptions_error_handler');
/**
 * @param mysqli $mysql
 *
 * @return mysqli_result
 */
function get_messages(mysqli $mysql)
{
	$logs = $mysql->query('SELECT ID, StudentName , StudentSurname FROM Students');
	if($mysql->error)
	{
		die($mysql->error . "\n");
	}
	return $logs;
}
try
{
	$mysql = new mysqli('localhost', 'root', '', 'HGS_Database');
}
catch (Exception $e)
{
	die($e->getMessage() . "\n");
}
$logs = get_messages($mysql);

$mysql->close();
?>

<!doctype html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>MySQL test</title>
</head>
<body>

<table>
	<?php while($log = $logs->fetch_object()): ?>
	<tr>
		<th><?php echo $log->ID ?></th>
		<td><?php echo $log->StudentName ?></td>
		<td><?php echo $log->StudentSurname ?></td>
	</tr>
	<?php endwhile; $logs->free(); ?>
</table>

</body>
</html>