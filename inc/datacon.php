<?php 
session_start(); 
//echo phpinfo();     
error_reporting('E_ALL');
/* script to connect fo Mandir Database and pick up neccesary Information to display on screen */
      /* declare some relevant variables */
      $hostname = "localhost";
      $username = "root";
      $passwordsc = "";
      $dbName = "myepresc_sbera";

      /* $con = mysql_connect($hostname,$username,$passwordsc);
		if (!$con)
		  {
		  die('Could not connect: ' . mysqli_error($link));
		  }
	mysql_select_db($dbName, $con); */
	
	$link = mysqli_connect($hostname,$username,$passwordsc,$dbName) or die("Could not connect to the database");

?>