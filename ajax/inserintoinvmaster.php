
<?php
include_once "../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$investigation_name =$_GET["investigation_name"];
$prescription_id = $_GET["PRESCRIPTION_ID"];
$type = $_GET["investigation_type"];
$admin = new admin($link);

//get the maximum id for investigation
$inv_id = $admin->getMaxInvestigationIdfromMaster($chamber_name, $doc_name);
$sql = "insert into investigation_master(ID, investigation_name,investigation_type, chamber_id, doc_id) values ('$inv_id','$investigation_name','$type','$chamber_name','$doc_name')";
mysqli_query($link,$sql) or die(mysqli_error($link));
if(mysqli_affected_rows($link) > 0){
    //echo "<input name='".$investigation_name."' type='checkbox' value='".$investigation_name."'/>&nbsp;".$investigation_name."&nbsp;";
    echo $investigation_name;
}
}else {
	echo "Session expired";
}
?>

 