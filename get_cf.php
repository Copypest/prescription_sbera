<?php
require_once "inc/config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select * from patient_health_details_master where NAME LIKE '$q%'";
$rsd = mysqli_query($link,$sql);
while($rs = mysqli_fetch_assoc($rsd)) {
	$cname = $rs['NAME'];
	echo "$cname\n";
}
?>
