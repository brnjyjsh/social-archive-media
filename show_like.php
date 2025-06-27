<?php
	include('includes/database.php');
	session_start();
	
	if (isset($_POST['showlike'])){
		$id = $_POST['id'];
		$query2=mysqli_query($con,"select * from `like` where post_id='$id'");
		echo mysqli_num_rows($query2);	
	}
?>

