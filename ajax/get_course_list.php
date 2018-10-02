<?php
require_once "../inc/datacon.php";
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$q = strtolower($_GET["term"]);
if (!$q) return;
if(isset($_GET["MODE"])){
    $mode = ($_GET["MODE"]);
    if($mode == "ALL")
        $sql = "select * from medicine_master a where a.MEDICINE_NAME LIKE '$q%' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
}else {
    $sql = "select * from medicine_master a where a.MEDICINE_NAME LIKE '$q%' and a.MEDICINE_STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
}
//$sql = "select * from medicine_master a where a.MEDICINE_NAME LIKE '$q%' and a.MEDICINE_STATUS = 'ACTIVE' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
/* $rsd = mysqli_query($link,$sql);
while($rs = mysqli_fetch_assoc($rsd)) {
	$cname = $rs['MEDICINE_NAME'];
	echo "$cname\n"; */

	$result = mysqli_query($link,$sql)or die(mysqli_error($link));

	
	$return_arr= array();
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$row_array['label'] = $row['MEDICINE_NAME'];
		$row_array['value'] = $row['MEDICINE_NAME'];
		$row_array['id'] = $row['MEDICINE_ID'];
		array_push($return_arr,$row_array);
		
	}
	echo json_encode($return_arr);
}else {
	echo "Session expired";
}
?>