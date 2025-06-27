<?php

	include('includes/database.php');

	$get_id =$_GET['id'];
	
	// Sending Query
	mysqli_query($con,"DELETE FROM comments WHERE comment_id = '$get_id'");
	header("Location: home.php");

?>
