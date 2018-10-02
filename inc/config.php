<?php
define("HOST", "localhost");
define("USER", "myepresc_pres");
define("PASSWORD", "KTHUsQI(xaCy");
define("DB_NAME", "myepresc_prescription");


$link = mysqli_connect(HOST, USER, PASSWORD,DB_NAME) or die("Could not connect to the database");

//$con = mysql_connect(HOST, USER, PASSWORD) or die(mysqli_error($link));
//mysql_select_db(DB_NAME, $con) or die(mysql_error);



function query($a){
	$r = mysqli_query($link,$a) or die(mysqli_error($link));
	return $r;
}
?>