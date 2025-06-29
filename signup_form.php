<?php
session_start();
include('includes/database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];
	$gender = $_POST['gender'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$birthday = "$year-$month-$day";
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$location = "image/default.png";

	// Save form values
	$_SESSION['form_data'] = [
		'firstname' => $firstname,
		'lastname' => $lastname,
		'username' => $username,
		'month' => $month,
		'day' => $day,
		'year' => $year,
		'gender' => $gender,
		'number' => $number,
		'email' => $email
	];

	// Check if email exists
	$email_check = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
	if (mysqli_num_rows($email_check) > 0) {
		$_SESSION['email_error'] = "E-mail already taken!";
		header("Location: signup.php");
		exit();
	}

	// Check if username exists
	$username_check = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
	if (mysqli_num_rows($username_check) > 0) {
		$_SESSION['username_error'] = "Username already taken!";
		header("Location: signup.php");
		exit();
	}

	// Password match check
	if ($password !== $password2) {
		$_SESSION['email_error'] = "Passwords do not match!";
		header("Location: signup.php");
		exit();
	}

	// Insert into database
	$query = "INSERT INTO user (firstname, lastname, username, birthday, gender, number, email, password, profile_picture, cover_picture)
	          VALUES ('$firstname', '$lastname', '$username', '$birthday', '$gender', '$number', '$email', '$hashed_password', '$location', '$location')";

	if (mysqli_query($con, $query)) {
		unset($_SESSION['form_data']);
		unset($_SESSION['email_error']);
		unset($_SESSION['username_error']);
		$_SESSION['signup_success'] = "Account created successfully!";
		header("Location: home.php");
		exit();
	} else {
		echo "Database Error: " . mysqli_error($con);
	}
}
