<?php

include_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$q = $_GET["term"];

if (!$q) return;

$sql = "select distinct(a.NAME) from  patient_health_details_master a where NAME LIKE '$q%' and a.STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
/* $rsd = mysqli_query($link,$sql);
while($rs = mysqli_fetch_assoc($rsd)) {
	$cname = $rs['investigation_type'];
	echo "$cname\n";
} */
$result = mysqli_query($link,$sql)or die(mysqli_error($link));


$return_arr= array();

while ($row = mysqli_fetch_assoc($result))
{
	$row_array['label'] = $row['NAME'];
	$row_array['value'] = $row['NAME'];
	
	array_push($return_arr,$row_array);
	
}
echo json_encode($return_arr);
}else {
	echo "Session expired";
}
?>
