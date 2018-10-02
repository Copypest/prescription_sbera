<?php
require_once "inc/config.php";
$PRESCRIPTION_ID = $_GET['PRESCRIPTION_ID'];
$ci_id = $_GET['ID'];
//$message = "";
mysqli_query($link,"delete from prescribed_cf 
             where prescription_id = '$PRESCRIPTION_ID' 
             and clinical_impression_id  ='$ci_id' ") or die(mysqli_error($link));

echo '<table>';
if (mysqli_affected_rows($link) > 0){
   echo "<tr><td colspan='2'>". mysqli_affected_rows($link) ." item(s) deleted</td></tr>";
}

$q15 = "SELECT b.type, b.ID FROM prescribed_cf a, clinical_impression b
                WHERE a.clinical_impression_id = b.id
                AND a.prescription_id = '$PRESCRIPTION_ID'";
        $rsd1 = mysqli_query($link,$q15);

        if(mysqli_num_rows($rsd1) > 0){
        while($rs = mysqli_fetch_assoc($rsd1)) {
            $type = $rs['type'];
            $cf_d = $rs['ID'];
            echo "<tr><td style='width: 180px;'>".$type."<a id='minus7' href='#' ></a></td>".
                "<td><a id='minus7' href='#' onclick='deleteClinicalImpression($cf_d,$PRESCRIPTION_ID)'>[-]</a></td> </tr>" ;

        }
            
        } 
echo '</table>';
?>
