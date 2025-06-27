<?php
	date_default_timezone_set("Asia/Manila");
	$date=date('F j, Y g:i:a');

	$con = mysqli_connect('localhost','root','','archive_db');
	if(!$con){
		die("Connection failed: " . mysqli_connect_error());
	}
?>
