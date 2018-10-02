<?php
include_once"../inc/datacon.php";
include '../classes/admin_class.php';

	
    $admin = new admin($link);

			//if(isset($_POST['CREATE_PATIENT_DATA'])){
    			$role = $_POST['role'];
				$gender = $_POST['gender'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$full_name = $fname." ".$lname;
				$addr = $_POST['addr'];
				$city = $_POST['city'];
				$uid = $_POST['uid'];
				$password = $_POST['password'];
				$cellnum = $_POST['cellnum'];
				$altcellnum = $_POST['altcellnum'];
				$email = $_POST['email'];
				$dob = date("Y-m-d", strtotime($_POST['theDate']));
				
				
				
				$sql1 = "insert into user_master (GENDER,user_first_name,
				user_last_name, user_address, user_city, user_dob, user_cell_num,
				user_alt_cell_num, user_email, create_date)
				values('$gender','$fname', '$lname', '$addr', '$city', '$dob' ,'$cellnum', '$altcellnum', 
                        '$email',  NOW() )";
				mysqli_query($link,$sql1) or die(mysqli_error($link));
			
				//Insert into user table
				
				$inert_query = "insert into user(user_name,	user_full_name,	user_password,	role) values(
				'$uid','$full_name','".md5($password)."','$role')";
				mysqli_query($link,$inert_query) or die(mysqli_error($link));
				
				echo "Dear  $fname $lname !! Registration is successful. <a class='btn btn-primary' href='./index_login.php'>Login Now !!</a>";
				
			//}
		

?>
