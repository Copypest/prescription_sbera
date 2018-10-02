<?php include_once "./inc/datacon.php"; 
include_once "classes/admin_class.php";?>
<?php include_once "./inc/header.php"; ?>
<body>
<?php
if(isset($_SESSION['user_type']) && isset($_SESSION['PRESCRIPTION_ID']) && isset($_SESSION['VISIT_ID']) && isset($_SESSION['chamber_name']) && isset($_SESSION['doc_name']) ){
	$VISIT_ID = $_SESSION['VISIT_ID'];
	$PRESCRIPTION_ID = $_SESSION['PRESCRIPTION_ID'];
	$chamber_name = $_SESSION['chamber_name'];
	$doc_name= $_SESSION['doc_name'];
	$admin= new admin($link); 
?>
<div class="container"><!-- Begin container -->
       
    <!--BEGIN header-->
            <?php include("banner.php");?>
            
    <!--END of header-->
<?php
    
    if(isset($_POST['MAKE_PRESCIPTION'])){ 
    
    //$referred_to = $_POST['referred_to'];
    $diet = $_POST['diet'];
    
    //$nextvist = date("Y-m-d", strtotime($_POST['nextvisit']));
    $next_visit = "After ".$_POST['nextvisit']." Months / Weeks";
    //$comments = $_POST['comments'];
    
    $patient_id = $_POST['patient_id'];
    $visit_id = $_POST['VISIT_ID'];
    $other_comment = htmlspecialchars($_POST['other_comment']);
   
    $oth_comnt = mysqli_real_escape_string($link,$other_comment);
    mysqli_query($link,"update prescription set VISIT_ID = '$VISIT_ID',DIET = '$diet', NEXT_VISIT = '$next_visit', 
    		STATUS ='SAVE', ANY_OTHER_DETAILS='$oth_comnt' where PRESCRIPTION_ID = '$PRESCRIPTION_ID' and STATUS='DRAFT'") or die(mysqli_error($link));
    
   
    if (isset($_POST['inv'])) {
    
        $inv = $_POST['inv'];
        //$temp = implode(',',$inv);
        //echo "Checked Values" . $temp ;
        if (!empty($inv)) {
        	$precribed_inv_id = $admin->getmaxPrescribedInvestigationID($chamber_name, $doc_name);
            $invarray = array_map(array($link,'mysqli_real_escape_string'),$inv);
            //echo "Checked Values" . $invarray ;
            foreach ($invarray as $value) {
                    // Act on $value
                    //insert into prescribed_INVESTIGATION
                //echo "VALUE -> ".$value;
                    mysqli_query($link,"INSERT INTO prescribed_investigation (PRESCRIBED_INVESTIGATION_ID, PRESCRIPTION_ID,INVESTIGATION_ID,chamber_id, doc_id) 
                            values ('$precribed_inv_id', '".$PRESCRIPTION_ID."','".$value."','$chamber_name','$doc_name')");
                    $precribed_inv_id = $precribed_inv_id +1;
            }
        }
    }
    
        $query = "update visit set VISITED = 'yes' where VISIT_ID = '$VISIT_ID' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
        //$query = "update visit a set a.VISITED = 'yes' where a.PATIENT_ID = 
          //          (select b.PATIENT_ID  from prescription b where b.prescription_id = '$PRESCRIPTION_ID')";
        mysqli_query($link,$query) or die(mysqli_error($link));
        
        $query = "select * from visit where VISIT_ID = '$VISIT_ID' AND chamber_id='$chamber_name' AND doc_id='$doc_name'";
        $result = mysqli_query($link,$query) or die(mysqli_error($link));
        
        while($row = mysqli_fetch_assoc($result)){
            mysqli_query($link,"update visit set VISITED = 'yes' where patient_id = '".$row['PATIENT_ID']."' AND chamber_id='$chamber_name' AND doc_id='$doc_name'") or die(mysqli_error($link));
        }
        
        //echo "<div class='b_success'>PRESCRIPTION created successfully<br><h2><a href='visit_list.php'>OK</a></h2></div>";
        //echo "<div class='b_success'>PRESCRIPTION created successfully<br><h2><a href='print.php?patient_id=$_GET[patient_id]&prescription_id=$PRESCRIPTION_ID&visit_id=$VISIT_ID'>OK</a></h2></div>";
        
        ?>
        <div class="alert alert-warning" role="alert" >
        <?php echo "Prescription Created Successfully.<a href='./archievedprescription.php?PRESCRIPTION_ID=".$PRESCRIPTION_ID."&visit_id=".$VISIT_ID."&patient_id=".$patient_id."' target='_blank' >Click here to view and print. </a>";?>
        </div>
        
        <div class="alert alert-success" role="alert" >
        <?php echo "<a href='./visit_list.php'>Click here to go to Visit List </a>";?>
        </div>
        <?php 
        
    
       include "footer_pg.php";
        
        ?>
    <!--END of footer-->
   </div> <!-- End container -->
    
    <?php } else { 
    	$admin= new admin($link); 
    	$patient_id = $admin->getPatientDetailsFromVisit($VISIT_ID, $chamber_id,$doc_name)->patient_id;
    	echo "<script>location.href='./archievedprescription.php?PRESCRIPTION_ID=$PRESCRIPTION_ID&visit_id=$VISIT_ID&patient_id=$patient_id'</script>";
    	
    	echo "<script>location.href='/visit_list.php'</script>";
    }
?>
<!--BEGIN wrapper-->
<div align="center"><a href="logout.php">Logoff</a></div>

            
<?php 
}  else {
echo "Please logout and login again.";
}?> 
            
        	 

        <?php include_once './inc/footer.php';?>
    </body>
</html>