<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';
if(isset($_SESSION['user_type']) &&   isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name'])  ){
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
$admin= new admin($link);
$result = $admin->deleteClinicalImpression($PRESCRIPTION_ID,$ci_id, $chamber_name, $doc_name);

//echo $result;

/*
if (mysqli_affected_rows($link) > 0){
   echo "<tr><td colspan='2'>". mysqli_affected_rows($link) ." item(s) deleted</td></tr>";
} */

$q15 = "SELECT b.type, b.ID FROM prescribed_cf a, clinical_impression b
                WHERE a.clinical_impression_id = b.id and a.chamber_id=b.chamber_id and a.doc_id=b.doc_id
                AND a.prescription_id = '$PRESCRIPTION_ID' AND a.chamber_id='$chamber_name' AND a.doc_id='$doc_name'";
//echo $q15;
        $rsd1 = mysqli_query($link,$q15) or die(mysqli_error($link));

        if(mysqli_num_rows($rsd1) > 0){
        while($rs = mysqli_fetch_assoc($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<div class='row'>
            		
	            <div class='col-md-10'>". $type. "</div>
					<div class='col-md-2' ><a href='#' class='minus' onclick='deleteClinicalImpression(". $cf_d .",". $PRESCRIPTION_ID.")'>[-]</a>
				</div>
									
				</div>"; 

        }
            
        } 
}

?>
