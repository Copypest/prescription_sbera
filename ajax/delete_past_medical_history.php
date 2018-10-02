<?php
include "../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
$admin= new admin($link);
//$result = $admin->deleteClinicalImpression($PRESCRIPTION_ID,$ci_id);
$result = $admin->deletePastMedicalHistory($PRESCRIPTION_ID,$ci_id, $chamber_name, $doc_name);

echo $result;
echo '<table>';
/*
if (mysqli_affected_rows($link) > 0){
   echo "<tr><td colspan='2'>". mysqli_affected_rows($link) ." item(s) deleted</td></tr>";
} */

$q15 = "SELECT b.type, b.ID FROM prescribed_past_med_history a, past_medical_history_master b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($link,$q15);

        if(mysqli_num_rows($rsd1) > 0){
            while($rs = mysqli_fetch_assoc($rsd1)) {
                $type = $rs['type'];
                $cf_d = $rs['ID'];
                echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                    "<td><a id='minusSymptoms' href='#' onclick='deletePastMedicalHistory($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;
            }
        } 
echo '</table>';
}
?>
