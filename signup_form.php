<?php include('session.php'); ?>
<?php
include('includes/database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


if (isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$birthday = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
	$gender = $_POST['gender'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$location = "image/default.png";
	$sql = mySQLi_query($con, "select * from user WHERE email='$email'");
	$row = mySQLi_num_rows($sql);
	if ($row > 0) {
		echo "<script>alert('E-mail already taken!'); window.location='index.php'</script>";;
	} elseif ($password != $password2) {
		echo "<script>alert('Password do not match!'); window.location='index.php'</script>";
	} else {
		mySQLi_query($con, "INSERT INTO user (firstname,lastname,username,birthday,gender,number,email,password,password2,profile_picture, cover_picture)
		VALUES ('$firstname','$lastname','$username','$birthday','$gender','$number','$email','$hashed_password','$hashed_password', '$location', '$location')");

		echo "<script>alert('Account successfully created!'); window.location='signin.php'</script>";
	}
}

?>