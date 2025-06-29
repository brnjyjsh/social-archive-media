<?php
session_start();
include('includes/database.php');

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$result = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
	$user = mysqli_fetch_assoc($result);

	if ($user && password_verify($password, $user['password'])) {
		$_SESSION['id'] = $user['user_id'];
		header("Location: home.php");
		exit();
	} else {
		$_SESSION['error'] = "Invalid email or password.";
		header("Location: index.php");
		exit();
	}
}
