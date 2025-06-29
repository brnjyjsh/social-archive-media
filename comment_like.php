<?php
include('includes/database.php');
include('session.php');

if (isset($_POST['comment_id'])) {
	$comment_id = $_POST['comment_id'];
	$user_id = $_SESSION['id'];

	// Check if this user already liked this comment (use temp tracking table)
	$check = mysqli_query($con, "SELECT * FROM comment_like WHERE user_id='$user_id' AND comment_id='$comment_id'");

	if (mysqli_num_rows($check) > 0) {
		// Unlike
		mysqli_query($con, "DELETE FROM comment_like WHERE user_id='$user_id' AND comment_id='$comment_id'");
		mysqli_query($con, "UPDATE comments SET likes = likes - 1 WHERE comment_id='$comment_id'");
	} else {
		// Like
		mysqli_query($con, "INSERT INTO comment_like (user_id, comment_id) VALUES ('$user_id', '$comment_id')");
		mysqli_query($con, "UPDATE comments SET likes = likes + 1 WHERE comment_id='$comment_id'");
	}

	// Return updated like count
	$res = mysqli_query($con, "SELECT likes FROM comments WHERE comment_id='$comment_id'");
	$row = mysqli_fetch_assoc($res);
	echo $row['likes'];
}
