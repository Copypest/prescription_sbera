<?php
$medicine_name=ucfirst($_GET["medicine_name"]);
$dose = $_GET['dose'];
$direction = $_GET['direction'];
$timing = $_GET['timing'];
$patient_id = $_GET['patient_id'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$VISIT_ID = $_GET['VISIT_ID'];

include("inc/config.php");

$sql0 = "select * from medicine_master where MEDICINE_NAME = '$medicine_name'";
$result0 = mysqli_query($link,$sql0) or die(mysqli_error($link));
if(mysqli_num_rows($result0) == 0){
mysqli_query($link,"insert into medicine_master(MEDICINE_NAME, MEDICINE_DIRECTION, MEDICINE_ENTRY_DATE_TIME) 
			values('$medicine_name', '$direction', NOW())") or die(mysqli_error($link));
}


$sql3 = "insert into precribed_medicine (PRESCRIPTION_ID, MEDICINE_NAME, MEDICINE_DIRECTION, MEDICINE_DOSE, MEDICINE_TIMING) 
								values('$PRESCRIPTION_ID','$medicine_name', '$direction', '$dose', '$timing')";
mysqli_query($link,$sql3) or die(mysqli_error($link));


$sql2 = "select * from precribed_medicine where PRESCRIPTION_ID = '$PRESCRIPTION_ID'";
$result = mysqli_query($link,$sql2) or die(mysqli_error($link));

echo "<table width='100%'>";
while($d = mysqli_fetch_object($result)){
	echo "<tr>";
	echo "<td class='odd_tb' width='400'>".$d->MEDICINE_NAME."</td>";
	echo "<td class='odd_tb' align='center' width='149'>".$d->MEDICINE_DOSE."</td>";
        echo "<td class='odd_tb' align='center' width='150'>".$d->MEDICINE_DIRECTION."</td>";
	
	echo "<td class='odd_tb' align='center' width='150'>".$d->MEDICINE_TIMING."</td>";
	//echo "<td class='odd_tb'  align='center'><a href=''>Edit</a></td>";
	echo "<td class='odd_tb' align='center'><a id='minus7' href='#' onclick='del($d->MEDICINE_ID ,$PRESCRIPTION_ID )'>[-]</a> </td>";
	echo "</tr>";
}

echo "</table'>";
//echo $medicine_name."+".$dose."+".$direction."+".$timing."+".$patient_id;
								
?>