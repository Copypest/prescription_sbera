<?php
include "../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
    $chamber_name = $_SESSION['chamber_name'];
    $doc_name= $_SESSION['doc_name'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$allergy_id = $_GET['ID'];
$admin= new admin($link);
$result = $admin->deleteAllergy($PRESCRIPTION_ID,$allergy_id,$chamber_name,$doc_name);

echo $result;
echo '<table>';
/*
if (mysqli_affected_rows($link) > 0){
   echo "<tr><td colspan='2'>". mysqli_affected_rows($link) ." item(s) deleted</td></tr>";
} */

$q15 = "SELECT b.ALLERGY_NAME, b.ALLERGY_ID FROM prescribed_allergy a, allergy_master b
                WHERE a.ALLERGY_ID = b.ALLERGY_ID
                AND a.prescription_id = '$PRESCRIPTION_ID' and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id
			AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
        $rsd1 = mysqli_query($link,$q15) or die(mysqli_error($link));

        if(mysqli_num_rows($rsd1) > 0){
        while($rs = mysqli_fetch_assoc($rsd1)) {
            $allergy_name = $rs['ALLERGY_NAME'];
            $allergy_id = $rs['ALLERGY_ID'];
            echo "<tr><td style='width: 180px;'>".$allergy_name."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($allergy_id,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
}
?>
