<?php
include('includes/database.php');
include('session.php');

if (isset($_POST['post_comment'])) {
	$u = $_SESSION['id'];
	$c = mysqli_real_escape_string($con, $_POST['content_comment']);
	$pid = intval($_POST['post_id']);
	$t = time();
	mysqli_query($con, "INSERT INTO comments (post_id,user_id,content_comment,created)
        VALUES ('$pid','$u','$c','$t')");
}
header("Location: home.php");
