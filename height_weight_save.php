<?php
 include "classes/admin_class.php"; 
 include "datacon.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if( isset($_GET['MODE']) ){
    
   
    $height = $_GET['HEIGHT'];
    $weight = $_GET['WEIGHT']; 
    $visit_id = $_GET['VISIT_ID'];
    $update = new admin($link);
    $bmi = $update->calcBMI($weight, $height);
    
    //Delete
    $query_del = "delete from patient_health_details where VISIT_ID = '".$visit_id."'";
    mysqli_query($link,$query_del);
    
    $query1 = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
            values('2' , '".$weight."', '".$visit_id."')";
    mysqli_query($link,$query1);

    $query2 = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
                values('1' , '".$height."', '".$visit_id."')";
    mysqli_query($link,$query2);

    $query3 = "insert into patient_health_details(ID, VALUE, VISIT_ID) 
                values('3' , '".$bmi."', '".$visit_id."')";
    
    mysqli_query($link,$query3);
    
     echo 'UPDATED -> '.$height." ".$weight." ".$visit_id;
 }  else {
echo "Error. Try later";
 }
?>
