<?php
require_once "inc/config.php";
$visit_id = $_GET['visit_id'];
$cf_id = $_GET['ID'];
$mode = $_GET['mode'];
$cfvalue = str_replace("PLUS","+",$_GET['cfvalue']);
//$message = "";
echo '<table>';
if($mode == 'UPDATE'){
    
mysqli_query($link,"update patient_health_details 
             set VALUE = '$cfvalue' where VISIT_ID = '$visit_id' 
             and ID  ='$cf_id' ") or die(mysqli_error($link));
    if (mysqli_affected_rows($link) > 0){
        echo "<tr><td colspan='3'>". mysqli_affected_rows($link) ." item(s) updated</td></tr>";
    }
} else if($mode == 'DELETE'){
    mysqli_query($link,"update patient_health_details 
             set VALUE = '$cfvalue' where VISIT_ID = '$visit_id' 
             and ID  ='$cf_id' ") or die(mysqli_error($link));
    if (mysqli_affected_rows($link) > 0){
        echo "<tr><td colspan='3'>". mysqli_affected_rows($link) ." item(s) deleted</td></tr>";
    }
}




$q15 = "select a.VALUE, b.NAME, a.ID from
                            patient_health_details a ,patient_health_details_master b
                            where
                            a.ID = b.ID
                            and a.VISIT_ID = '$visit_id'";
$rsd1 = mysqli_query($link,$q15);


    while($rs = mysqli_fetch_assoc($rsd1)) {
            $name = $rs['NAME'];
            $value = $rs['VALUE'];
            $id = $rs['ID'];
            
            if($id == '1' || $id == '2' || $id == '3') {
                echo"<tr>
                            <td width='100%' >$name</td>
                            <td width='100%' style='width: 40px;'>$value</td>
                            <td >&nbsp;
                            </td> 
                        </tr>"; 
            } else {
            echo"<table><tr>";

            echo "<td width='100%' >".$rs['NAME']."</td>";
            echo "<td width='100%' ><input type='text'  class='input_box_small' id='CF_".$id."' style='width: 40px;' value='".$rs['VALUE']."' /><a id='minus7' href='#' ></a></td>";
            ?>
            <td><input type="button" class="update_row" onclick="updateDeleteCF('<?php echo $id ; ?>','<?php echo $visit_id; ?>','UPDATE')"/>
            </td>
            <?php    
            echo"</tr></table> ";
            }

    }
            
       
echo '</table>';
?>
