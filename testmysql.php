<?php 
$link = mysql_connect('hostname','dbuser','dbpassword'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysqli_error($link)); 
} 
echo 'Connection OK'; mysql_close($link); 
?> 