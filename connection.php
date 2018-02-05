<?php
   	$host = "localhost";
	$user = "root";     // Alter to your User
	$pass= "ramos3d";  // Alter to your password
	$db	  = "generator"; // Alter to your darabase name
	$Mysqli = new mysqli($host, $user, $pass, $db);
	//checking your connection
	mysqli_connect_errno()? printf("Connect failed: %s\n", mysqli_connect_error()): "Connected";
