<?php

require_once "inc/config.php";
$q = $_GET["q"];
if (!$q) return;

$sql = "select distinct(investigation_type) from  investigation_master where investigation_type LIKE '$q%' and STATUS = 'ACTIVE'";
/* $rsd = mysqli_query($link,$sql);
while($rs = mysqli_fetch_assoc($rsd)) {
	$cname = $rs['investigation_type'];
	echo "$cname\n";
} */
$result = mysqli_query($link,$sql)or die(mysqli_error($link));
$rowObject = mysqli_fetch_assoc($result) ;

$return_arr= array();

while ($row = mysqli_fetch_assoc($result))
{
	$row_array['label'] = $row['investigation_type'];
	$row_array['value'] = $row['investigation_type'];
	
	array_push($return_arr,$row_array);
	
}
echo json_encode($return_arr);
?>
